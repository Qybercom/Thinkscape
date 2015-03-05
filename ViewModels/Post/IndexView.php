<?php
namespace ViewModels\Post;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

/**
 * Class IndexView
 *
 * @package ViewModels\Post
 */
class IndexView implements IQuarkViewModel, IQuarkAuthorizableViewModel {
	/**
	 * @return string
	 */
	public function View () {
		return 'Post/Index';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}