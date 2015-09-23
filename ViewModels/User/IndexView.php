<?php
namespace ViewModels\User;

use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class IndexView
 *
 * @package ViewModels\User
 */
class IndexView implements IQuarkViewModel, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'User/Index';
	}
}