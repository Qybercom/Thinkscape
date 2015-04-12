<?php
namespace ViewModels;

use Quark\IQuarkViewModel;
use Quark\IQuarkViewModelWithResources;

use Quark\Quark;

use Quark\Extensions\Facebook\FacebookSharedResource;
/**
 * Class ShareView
 *
 * @package ViewModels
 */
class ShareView implements IQuarkViewModel, IQuarkViewModelWithResources {
	/**
	 * @return string
	 */
	public function View () {
		return 'Share';
	}

	/**
	 * @return array
	 */
	public function Resources () {
		return array(
			FacebookSharedResource::Article(Quark::WebHost() . '/share', 'Some test share')
		);
	}
}