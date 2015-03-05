<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkStrongModel;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkModelWithAfterFind;
use Quark\IQuarkModelWithBeforeCreate;
use Quark\IQuarkModelWithBeforeSave;
use Quark\IQuarkLinkedModel;

use Quark\QuarkModel;

use Quark\DataProviders\MongoDB;

use Quark\ViewResources\WysiBB\WysiBB;

/**
 * Class Comment
 *
 * @package Models
 */
class Comment implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider, IQuarkModelWithBeforeCreate, IQuarkModelWithBeforeSave, IQuarkModelWithAfterFind, IQuarkLinkedModel {
	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'_id' => new \MongoId(),
			'date' => date('Y-m-d H:i:s'),
			'author' => new User(),
			'content' => ''
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
	 *
	 * @return mixed
	 */
	public function AfterFind ($raw) {
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
		$this->content = WysiBB::ToBB($this->content);
	}


	/**
	 * @param $raw
	 *
	 * @return mixed
	 */
	public function Link ($raw) {
		return QuarkModel::FindOneById($this, $raw);
	}

	/**
	 * @return mixed
	 */
	public function Unlink () {
		return MongoDB::_id($this);
	}
}