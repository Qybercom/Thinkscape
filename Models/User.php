<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkModelWithBeforeCreate;
use Quark\IQuarkStrongModel;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkLinkedModel;
use Quark\IQuarkAuthorizableModel;

use Quark\Quark;
use Quark\QuarkCollection;
use Quark\QuarkFile;
use Quark\QuarkModel;

use Quark\DataProviders\MongoDB;

use Quark\Extensions\SocialNetwork\SocialNetwork;

/**
 * Class User
 *
 * @property string $email
 * @property string $password
 *
 * @package Models
 */
class User implements IQuarkModel, IQuarkStrongModel, IQuarkModelWithDataProvider, IQuarkLinkedModel, IQuarkAuthorizableModel, IQuarkModelWithBeforeCreate {
	const ROLE_USER = 'user';
	const ROLE_MODERATOR = 'moderator';
	const ROLE_ADMIN = 'admin';

	/**
	 * @return mixed
	 */
	public function Fields () {
		return array(
			'_id' => new \MongoId(),
			'email' => '',
			'password' => '',
			'role' => self::ROLE_USER,
			'date' => date('Y-m-d H:i:s'),
			'name' => '',
			'nickname' => '',
			'avatar' => new QuarkFile(__DIR__ . '/../static/placeholder-avatar.png'),
			'favourites' => new QuarkCollection(new Head()),
			'heads' => new QuarkCollection(new HeadAccess()),
			'facebook' => new SocialNetwork(THINK_FACEBOOK),
			'vkontakte' => new SocialNetwork(THINK_VKONTAKTE)
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
		return QuarkModel::FindOneById(new User(), $raw);
	}

	/**
	 * @return mixed
	 */
	public function Unlink () {
		return MongoDB::_id($this);
	}

	/**
	 * @param $email
	 * @param $password
	 *
	 * @return string
	 */
	public static function Password ($email, $password) {
		return sha1(sha1($email . $password) . strlen($password) . md5($email));
	}

	/**
	 * @param $options
	 *
	 * @return mixed
	 */
	public function BeforeCreate ($options) {
		$this->password = self::Password($this->email, $this->password);
	}

	/**
	 * @param string $name
	 * @param        $session
	 *
	 * @return mixed
	 */
	public function Session ($name, $session) {
		return QuarkModel::FindOneById(new User(), $session->_id);
	}

	/**
	 * @param string $name
	 * @param        $criteria
	 * @param int    $lifetime (seconds)
	 *
	 * @return QuarkModel
	 */
	public function Login ($name, $criteria, $lifetime) {
		return QuarkModel::FindOne(new User(), array(
			'email' => $criteria->email,
			'password' => self::Password($criteria->email, $criteria->password)
		));
	}

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function Logout ($name) {
		// TODO: Implement Logout() method.
	}
}