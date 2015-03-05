<?php
namespace Services\Head;

use Quark\IQuarkAuthorizableService;
use Quark\IQuarkGetService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Head;

use ViewModels\AuthErrorView;
use ViewModels\CommonErrorView;
use ViewModels\LayoutView;
use ViewModels\Head\CreateView;

/**
 * Class CreateService
 *
 * @package Services\Head
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
		return QuarkView::InLayout(new CreateView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Post (QuarkDTO $request, QuarkSession $session) {
		$head = new QuarkModel(new Head(), $request->Data());

		if (!$head->Create())
			return QuarkView::InLayout(new CreateView(), new LayoutView(), $head);

		Quark::Redirect('/');
	}

	/**
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost () {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}