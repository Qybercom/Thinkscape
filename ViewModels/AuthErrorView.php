<?php
namespace ViewModels;

use Quark\IQuarkViewModel;

/**
 * Class AuthErrorView
 *
 * @package ViewModels
 */
class AuthErrorView implements IQuarkViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'AuthError';
	}
}