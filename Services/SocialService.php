<?php
namespace Services;

use Quark\IQuarkAuthorizableService;
use Quark\IQuarkGetService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkSession;
use Quark\QuarkView;

use ViewModels\LayoutView;
use ViewModels\CommonErrorView;

use Quark\Extensions\SocialNetwork\SocialNetwork;

/**
 * Class SocialService
 *
 * @package Services
 */
class SocialService implements IQuarkGetService, IQuarkAuthorizableService {
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
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO $request
	 *
	 * @return mixed
	 */
	public function SignatureCheckFailedOnGet (QuarkDTO $request) {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		$user = $session->User();

		$social = new SocialNetwork(THINK_VKONTAKTE);

		$user->vkontakte = $social->SessionFromRedirect(Quark::URLOf('/social'));

		if ($user->Save())
			Quark::Redirect('/');

		echo 'error while saving user';
	}
}