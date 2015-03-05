<?php
namespace ViewModels\User;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class LoginView
 *
 * @package ViewModels\User
 */
class LoginView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Login';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}