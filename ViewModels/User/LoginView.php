<?php
namespace ViewModels\User;

use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class LoginView
 *
 * @package ViewModels\User
 */
class LoginView implements IQuarkViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Login';
	}
}