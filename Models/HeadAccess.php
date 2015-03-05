<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkStrongModel;

/**
 * Class HeadAccess
 *
 * @package Models
 */
class HeadAccess implements IQuarkModel, IQuarkStrongModel {
	const RIGHT_NONE = 'none';
	const RIGHT_READ = 'read';
	const RIGHT_WRITE = 'write';
	const RIGHT_MANAGE = 'manage';

	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'head' => new Head(),
			'rights' => array(self::RIGHT_NONE)
		);
	}

	/**
	 * @return mixed
	 */
	public function Rules () {
		// TODO: Implement Rules() method.
	}
}