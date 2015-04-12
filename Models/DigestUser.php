<?php
namespace Models;

use Quark\IQuarkModel;
use Quark\IQuarkAuthorizationProvider;
use Quark\IQuarkAuthorizableModel;
use Quark\IQuarkModelWithDataProvider;

use Quark\QuarkModel;

/**
 * Class DigestUser
 *
 * @package Models
 */
class DigestUser implements IQuarkModel, IQuarkAuthorizableModel, IQuarkModelWithDataProvider {
	/**
	 * @param $criteria
	 *
	 * @return mixed
	 */
	public function Authorize ($criteria) {
		// TODO: Implement Authorize() method.
	}

	/**
	 * @param IQuarkAuthorizationProvider|\Quark\AuthorizationProviders\PHPDigestAuth $provider
	 * @param $request
	 *
	 * @return mixed
	 */
	public function RenewSession (IQuarkAuthorizationProvider $provider, $request) {
		$user = QuarkModel::FindOne($this, array(
			'username' => $request->user
		));

		return $provider->Verify($user->password) ? $user : null;
	}

	/**
	 * @return mixed
	 */
	public function Fields () {
		// TODO: Implement Fields() method.
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
}