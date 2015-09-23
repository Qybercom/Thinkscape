<?php
namespace ViewModels\User;

use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\User
 */
class CreateView implements IQuarkViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Create';
	}
}