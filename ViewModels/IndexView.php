<?php
namespace ViewModels;

use Quark\IQuarkViewModel;

/**
 * Class IndexView
 *
 * @package ViewModels
 */
class IndexView implements IQuarkViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'Index';
	}
}