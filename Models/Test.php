<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkStrongModel;

use Quark\QuarkField;

/**
 * Class Test
 *
 * @package Models
 */
class Test implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider{
	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'id' => 0,
			'name' => '',
			'age' => 0,
			'country' => ''
		);
	}

	/**
	 * @return mixed
	 */
	public function Rules () {
		return array(
			QuarkField::Unique($this, 'id')
		);
	}

	/**
	 * @return string
	 */
	public function DataProvider () {
		return THINK_PG;
	}
}