<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkModelWithAfterFind;
use Quark\IQuarkModelWithBeforeCreate;
use Quark\IQuarkModelWithBeforeSave;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkStrongModel;

use Quark\Quark;
use Quark\QuarkFile;
use Quark\QuarkCollection;

use Quark\DataProviders\MongoDB;

use Quark\ViewResources\WysiBB\WysiBB;

/**
 * Class Post
 *
 * @package Models
 */
class Post implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider, IQuarkModelWithBeforeCreate, IQuarkModelWithBeforeSave, IQuarkModelWithAfterFind {
	const RIGHT_COMMENT = 'comment';
	const RIGHT_VOTE = 'vote';
	const RIGHT_MANAGE = 'manage';

	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'_id' => new \MongoId(),
			'author' => new User(),
			'date' => date('Y-m-d H:i:s'),
			'title' => '',
			'content' => '',
			'comments' => new QuarkCollection(new Comment()),
			'head' => new Head(),
			'poster' => new QuarkFile(Quark::Host() . '/storage/1344074312.jpg')
		);
	}

	/**
	 * @return mixed
	 */
	public function Rules () {
		// TODO: Implement Rules() method.
	}

	/**
	 * @return string
	 */
	public function DataProvider () {
		return THINK_DATA;
	}

	/**
	 * @param $raw
	 * @param array $options
	 *
	 * @return mixed
	 */
	public function AfterFind ($raw, $options) {
		$this->content = WysiBB::ToHTML(htmlspecialchars($this->content));
	}

	/**
	 * @param $options
	 *
	 * @return mixed
	 */
	public function BeforeCreate ($options) {
		$this->content = WysiBB::ToBB($this->content);
	}

	/**
	 * @param $options
	 *
	 * @return mixed
	 */
	public function BeforeSave ($options) {
		$this->content = WysiBB::ToBB(htmlspecialchars_decode($this->content));
	}

	/**
	 * @param $user
	 * @param array $rights
	 *
	 * @return bool
	 */
	public function Rights ($user, $rights = []) {
		$out = true;

		if (in_array(self::RIGHT_COMMENT, $rights))
			$out = $out && $user != null;

		if (in_array(self::RIGHT_MANAGE, $rights))
			$out = $out && $user != null && MongoDB::_id($user) == MongoDB::_id($this->author);

		return $out;
	}
}