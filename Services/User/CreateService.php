<?php
namespace Services\User;

use Quark\IQuarkGetService;
use Quark\IQuarkPostService;
use Quark\IQuarkSignedPostService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\User;

use ViewModels\LayoutView;
use ViewModels\User\CreateView;
use ViewModels\CommonErrorView;

/**
 * Class CreateService
 *
 * @package Services\User
 */
class CreateService implements IQuarkGetService, IQuarkPostService, IQuarkSignedPostService {
	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		return QuarkView::InLayout(new CreateView(), new LayoutView());
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Post (QuarkDTO $request, QuarkSession $session) {
		$user = new QuarkModel(new User(), $request->Data());

		if (!$user->Create())
			return QuarkView::InLayout(new CreateView(), new LayoutView());

		if (!QuarkSession::Get(THINK_SESSION)->Login($request))
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		Quark::Redirect('/');
	}

	/**
	 * @return mixed
	 */
	public function SignatureCheckFailedOnPost () {
		return QuarkView::InLayout(new CommonErrorView(), new LayoutView());
	}
}