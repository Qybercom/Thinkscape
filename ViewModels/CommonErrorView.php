<?php
namespace ViewModels;

use Quark\IQuarkViewModel;

/**
 * Class CommonErrorView
 *
 * @package ViewModels
 */
class CommonErrorView implements IQuarkViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'CommonError';
	}
}