<?php
namespace Services\User;

use Quark\IQuarkGetService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkSession;
use Quark\QuarkView;

use ViewModels\LayoutView;
use ViewModels\CommonErrorView;
use ViewModels\User\LoginView;

/**
 * Class LoginService
 *
 * @package Services\User
 */
class LoginService implements IQuarkGetService, IQuarkPostService, IQuarkSignedPostService {
	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		return QuarkView::InLayout(new LoginView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Post (QuarkDTO $request, QuarkSession $session) {
		if (!QuarkSession::Get(THINK_SESSION)->Login($request))
			return QuarkView::InLayout(new LoginView(), new LayoutView());

		Quark::Redirect('/');
	}

	/**
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost () {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}