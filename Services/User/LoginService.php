<?php
namespace Services\User;

use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;
use Quark\IQuarkPostService;

use Quark\QuarkDTO;
use Quark\QuarkSession;
use Quark\QuarkView;

use ViewModels\LayoutView;
use ViewModels\User\LoginView;

/**
 * Class LoginService
 *
 * @package Services\User
 */
class LoginService implements IQuarkGetService, IQuarkPostService, IQuarkAuthorizableLiteService {
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
		if (!$session->Login($request))
			return QuarkView::InLayout(new LoginView(), new LayoutView());

		return QuarkDTO::ForRedirect('/');
	}
}