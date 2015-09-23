<?php
namespace ViewModels\Post;

use Quark\IQuarkViewModel;
use Quark\IQuarkViewModelWithResources;

use Quark\Quark;

use Quark\Extensions\SocialNetwork\OpenGraphResource;

use Quark\Extensions\SocialNetwork\Providers\Facebook;

/**
 * Class IndexView
 *
 * @package ViewModels\Post
 */
class IndexView implements IQuarkViewModel, IQuarkViewModelWithResources {
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
			OpenGraphResource::Article(
				Quark::WebHost() . '/post/' . $this->post->_id,
				$this->post->title,
				$this->post->poster->WebLocation()
			)
				->App(THINK_FACEBOOK)
				->Author($this->post->author->nickname)
		);
	}
}