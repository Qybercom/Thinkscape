<?php
namespace Services\Post;

use Models\Head;
use Models\HeadAccess;
use Quark\IQuarkAuthorizableService;
use Quark\IQuarkGetService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Post;

use ViewModels\AuthErrorView;
use ViewModels\CommonErrorView;
use ViewModels\LayoutView;
use ViewModels\Post\CreateView;

/**
 * Class CreateService
 *
 * @package Services\Post
 */
class CreateService implements IQuarkGetService, IQuarkPostService, IQuarkAuthorizableService, IQuarkSignedPostService {
	/**
	 * @return string
	 */
	public function AuthorizationProvider () {
		return THINK_SESSION;
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return bool
	 */
	public function AuthorizationCriteria (QuarkDTO $request, QuarkSession $session) {
		return $session->User() != null;
	}

	/**
	 * @return mixed
	 */
	public function AuthorizationFailed () {
		return QuarkView::InLayout(new AuthErrorView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		$head = null;

		if (isset($request->head)) {
			$head = QuarkModel::FindOneById(new Head(), $request->head);

			if ($head == null || !$head->Rights($session->User(), HeadAccess::RIGHT_WRITE))
				return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
		}

		return QuarkView::InLayout(new CreateView(), new LayoutView(), array(
			'head' => $head
		));
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Post (QuarkDTO $request, QuarkSession $session) {
		$user = $session->User();

		$post = new QuarkModel(new Post(), $request->Data());
		$post->author = $user;

		if (isset($request->head)) {
			$head = QuarkModel::FindOneById(new Head(), $request->head);

			$post->head = $head;

			if ($head == null || !$head->Rights($user, HeadAccess::RIGHT_WRITE))
				return QuarkView::InLayout(new CreateView(), new LayoutView(), $post);
		}

		if (!$post->Create())
			return QuarkView::InLayout(new CreateView(), new LayoutView(), $post);

		Quark::Redirect('/');
	}

	/**
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost () {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}