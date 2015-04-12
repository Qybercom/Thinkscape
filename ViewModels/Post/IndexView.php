<?php
namespace ViewModels\Post;

use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModel;
use Quark\IQuarkViewModelWithResources;

use Quark\Quark;

use Quark\Extensions\Facebook\FacebookSharedResource;

/**
 * Class IndexView
 *
 * @package ViewModels\Post
 */
class IndexView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IQuarkViewModelWithResources {
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

	/**
	 * @return array
	 */
	public function Resources () {
		return array(
			FacebookSharedResource::Article(Quark::WebHost() . '/post/' . $this->post->_id, $this->post->title, $this->post->poster->WebLocation())
		);
	}
}