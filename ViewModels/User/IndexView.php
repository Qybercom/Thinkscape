<?php
namespace ViewModels\User;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class IndexView
 *
 * @package ViewModels\User
 */
class IndexView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Index';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}