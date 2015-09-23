<?php
namespace ViewModels\Post;

use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\Post
 */
class CreateView implements IQuarkViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'Post/Create';
	}
}