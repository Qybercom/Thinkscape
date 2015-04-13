<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkModelWithBeforeCreate;
use Quark\IQuarkStrongModel;
use Quark\IQuarkModelWithDataProvider;
use Quark\IQuarkLinkedModel;
use Quark\IQuarkAuthorizableModel;
use Quark\IQuarkAuthorizationProvider;

use Quark\Quark;
use Quark\QuarkCollection;
use Quark\QuarkFile;
use Quark\QuarkModel;

use Quark\DataProviders\MongoDB;

use Quark\Extensions\SocialNetwork\SocialNetwork;

/**
 * Class User
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
			'avatar' => new QuarkFile(Quark::Host() . '/storage/default.png'),
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
	 * @param $criteria
	 *
	 * @return mixed
	 */
	public function Authorize ($criteria) {
		return QuarkModel::FindOne($this, array(
			'email' => $criteria->email,
			'password' => self::Password($criteria->email, $criteria->password)
		));
	}

	/**
	 * @param IQuarkAuthorizationProvider $provider
	 * @param                             $request
	 *
	 * @return mixed
	 */
	public function RenewSession (IQuarkAuthorizationProvider $provider, $request) {
		return isset($request->_id) ? QuarkModel::FindOneById($this, $request->_id) : null;
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
}