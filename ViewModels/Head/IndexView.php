<?php
namespace ViewModels\Head;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

/**
 * Class IndexView
 *
 * @package ViewModels\Head
 */
class IndexView implements IQuarkViewModel, IQuarkAuthorizableViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'Head/Index';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}