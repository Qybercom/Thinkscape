<?php
namespace ViewModels\Post;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\Post
 */
class CreateView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'Post/Create';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}
}