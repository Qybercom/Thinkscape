<?php
namespace Services\User;

use Models\Head;
use Models\Post;
use Quark\DataProviders\MongoDB;
use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\User;

use ViewModels\CommonErrorView;
use ViewModels\User\IndexView;
use ViewModels\LayoutView;

/**
 * Class IndexService
 *
 * @package Services\User
 */
class IndexService implements IQuarkGetService, IQuarkAuthorizableLiteService {
	/**
	 * @return string
	 */
	public function AuthorizationProvider () {
		return THINK_SESSION;
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		$user = QuarkModel::FindOne(new User(), array(
			'nickname' => $request->URI()->Route(1)
		));

		if ($user == null)
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		return QuarkView::InLayout(new IndexView(), new LayoutView(), array(
			'user' => $user,
			/*'favourites' => QuarkModel::Find(new Head(), array(
					''
				)),*/
			'posts' => QuarkModel::Find(new Post(), array(
					'author' => MongoDB::_id($user)
				), array(
					QuarkModel::OPTION_SORT => array(
						'ratio' => -1
					),
					QuarkModel::OPTION_LIMIT => 4
				))
		));
	}
}