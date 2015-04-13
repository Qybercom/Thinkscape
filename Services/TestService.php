<?php
namespace Services;

use Quark\Extensions\SocialNetwork\SocialNetwork;
use Quark\IQuarkGetService;
use Quark\IQuarkAuthorizableLiteService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkSession;

use Quark\Extensions\SocialNetwork\Providers\Facebook;
use Quark\Extensions\SocialNetwork\Providers\VKontakte;

/**
 * Class TestService
 *
 * @package Services
 */
class TestService implements IQuarkGetService, IQuarkAuthorizableLiteService {
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
		return $session->User() != null;
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
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		/*$vk = new SocialNetwork(THINK_VKONTAKTE);

		Quark::Redirect($vk->LoginURL(Quark::URLOf('/social')));*/
		print_r($session->User()->facebook->Profile(Facebook::CURRENT_USER));
		print_r($session->User()->vkontakte->Profile(VKontakte::CURRENT_USER));
	}
}