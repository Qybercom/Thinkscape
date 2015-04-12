<?php
namespace Services;

use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Post;

use ViewModels\IndexView;
use ViewModels\LayoutView;

/**
 * Class IndexService
 *
 * @package Services
 */
class IndexService implements IQuarkGetService, IQuarkAuthorizableLiteService {
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
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		return QuarkView::InLayout(new IndexView(), new LayoutView(), array(
			'posts' => QuarkModel::Find(new Post(), array(), array(
					QuarkModel::OPTION_LIMIT => 30,
					QuarkModel::OPTION_SKIP => (int)$request->URI()->Route(1)
				))
		));
	}
}