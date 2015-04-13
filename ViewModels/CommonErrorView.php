<?php
namespace ViewModels;

use Quark\IQuarkViewModel;

/**
 * Class CommonErrorView
 *
 * @package ViewModels
 */
class CommonErrorView implements IQuarkViewModel, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'CommonError';
	}
}