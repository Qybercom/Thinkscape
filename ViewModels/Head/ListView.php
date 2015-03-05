<?php
namespace ViewModels\Head;

use Quark\IQuarkViewModel;
use ViewModels\IThinkscapeSingleView;

/**
 * Class ListView
 *
 * @package ViewModels\Head
 */
class ListView implements IQuarkViewModel, IThinkscapeSingleView {
	/**
	 * @return string
	 */
	public function View () {
		return 'Head/List';
	}
}