<?php
namespace Services\Post\Comment;

use Quark\IQuarkAuthorizableService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Post;
use Models\Comment;

use ViewModels\AuthErrorView;
use ViewModels\CommonErrorView;
use ViewModels\LayoutView;
use ViewModels\Post\CreateView;

/**
 * Class CreateService
 *
 * @package Services\Post\Comment
 */
class CreateService implements IQuarkPostService, IQuarkAuthorizableService, IQuarkSignedPostService {
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
	public function Post (QuarkDTO $request, QuarkSession $session) {
		$id = strip_tags($request->URI()->Route(3));
		$post = QuarkModel::FindOneById(new Post(), $id);

		if ($post == null)
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		$comment = new QuarkModel(new Comment(), $request->Data());
		$comment->author = $session->User();

		if (!$comment->Create())
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		$post->comments->Add($comment);

		if (!$post->Save())
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		Quark::Redirect('/post/' . $id);
	}

	/**
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost () {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}