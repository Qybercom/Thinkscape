<?php
namespace ViewModels;

use Quark\IQuarkViewModel;
use Quark\IQuarkViewModelWithResources;
use Quark\ViewResources\Google\GoogleMap;
use Quark\ViewResources\Quark\QuarkUI;

/**
 * Class TestView
 *
 * @package ViewModels
 */
class TestView implements IQuarkViewModel, IQuarkViewModelWithResources {
	/**
	 * @return string
	 */
	public function View () {
		return 'Test';
	}

	/**
	 * @return array
	 */
	public function Resources () {
		return array(
			new GoogleMap(),
			new QuarkUI()
		);
	}
}