<?php
namespace Services\User;

use Quark\IQuarkAuthorizableService;
use Quark\IQuarkGetService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\User;

use ViewModels\LayoutView;
use ViewModels\User\CreateView;
use ViewModels\CommonErrorView;

/**
 * Class CreateService
 *
 * @package Services\User
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
		return true;
	}

	/**
	 * @param QuarkDTO $request
	 * @param          $criteria
	 *
	 * @return mixed
	 */
	public function AuthorizationFailed (QuarkDTO $request, $criteria) {
		// TODO: Implement AuthorizationFailed() method.
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
		$user = new QuarkModel(new User(), $request->Data());

		if (!$user->Create())
			return QuarkView::InLayout(new CreateView(), new LayoutView());

		if (!QuarkSession::Get(THINK_SESSION)->Login($request))
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

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