<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkStrongModel;
use Quark\IQuarkLinkedModel;
use Quark\IQuarkModelWithDataProvider;

use Quark\Quark;
use Quark\QuarkFile;
use Quark\QuarkModel;

use Quark\DataProviders\MongoDB;

/**
 * Class Head
 *
 * @package Models
 */
class Head implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider, IQuarkLinkedModel {
	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'_id' => new \MongoId(),
			'date' => date('Y-m-d H:i:s'),
			'name' => '',
			'about' => '',
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
	 *
	 * @return mixed
	 */
	public function Link ($raw) {
		return QuarkModel::FindOneById(new Head(), $raw);
	}

	/**
	 * @return mixed
	 */
	public function Unlink () {
		return MongoDB::_id($this);
	}

	/**
	 * @param $user
	 * @param $right
	 *
	 * @return bool
	 */
	public function Rights ($user, $right) {
		if ($user == null) return false;

		$id = MongoDB::_id($this);

		foreach ($user->heads as $access) {
			if (MongoDB::_id($access->head) != $id) continue;
			if (in_array($right, $access->rights)) return true;
		}

		return false;
	}
}