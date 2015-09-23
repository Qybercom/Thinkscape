<?php
namespace Services;

use Quark\Extensions\SocialNetwork\SocialNetwork;
use Quark\IQuarkGetService;
use Quark\IQuarkAuthorizableLiteService;

use Quark\IQuarkPostService;
use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkSession;

use Quark\Extensions\SocialNetwork\Providers\Facebook;
use Quark\Extensions\SocialNetwork\Providers\VKontakte;
use ViewModels\TestView;

/**
 * Class TestService
 *
 * @package Services
 */
class TestService implements IQuarkGetService, IQuarkPostService, IQuarkAuthorizableLiteService {
	/**
	 * @param QuarkDTO $request
	 *
	 * @return string
	 */
	public function AuthorizationProvider (QuarkDTO $request) {
		return THINK_SESSION;
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return bool|mixed
	 */
	public function AuthorizationCriteria (QuarkDTO $request, QuarkSession $session) {
		return true;//$session->User() != null;
	}

	/**
	 * @param QuarkDTO $request
	 * @param          $criteria
	 *
	 * @return mixed
	 */
	public function AuthorizationFailed (QuarkDTO $request, $criteria) {
		return '401';
	}

	/**
	 * @param QuarkDTO $request
	 */
	private function _r (QuarkDTO $request) {
		//print_r($request);

		$out = $request->SerializeRequest();

		var_dump($out);

		$req = new QuarkDTO();
		$req->UnserializeRequest($out);

		print_r($req);
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		//$this->_r($request);
		return new TestView();
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Post (QuarkDTO $request, QuarkSession $session) {
		$this->_r($request);
	}
}