<?php
namespace ViewModels\User;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\User
 */
class CreateView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Create';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}