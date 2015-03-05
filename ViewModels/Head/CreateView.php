<?php
namespace ViewModels\Head;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\Head
 */
class CreateView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'Head/Create';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}