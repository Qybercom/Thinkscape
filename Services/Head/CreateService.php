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
	 * @param QuarkDTO $request
	 *
	 * @return string
	 */
	public function AuthorizationProvider (QuarkDTO $request) {
		return THINK_SESSION;
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return bool|mixed
	 */
	public function AuthorizationCriteria (QuarkDTO $request, QuarkSession $session) {
		return $session->User() != null;
	}

	/**
	 * @param QuarkDTO $request
	 * @param          $criteria
	 *
	 * @return mixed
	 */
	public function AuthorizationFailed (QuarkDTO $request, $criteria) {
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
	 * @param QuarkDTO $request
	 *
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost (QuarkDTO $request) {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}