<?php
namespace ViewModels\Head;

use Quark\IQuarkViewModel;

/**
 * Class IndexView
 *
 * @package ViewModels\Head
 */
class IndexView implements IQuarkViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'Head/Index';
	}
}