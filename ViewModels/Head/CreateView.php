<?php
namespace ViewModels\Head;

use Quark\IQuarkViewModel;

use ViewModels\IThinkscapeSingleView;
use ViewModels\IThinkscapeThinHeaderView;

/**
 * Class CreateView
 *
 * @package ViewModels\Head
 */
class CreateView implements IQuarkViewModel, IThinkscapeSingleView, IThinkscapeThinHeaderView {
	/**
	 * @return string
	 */
	public function View () {
		return 'Head/Create';
	}
}