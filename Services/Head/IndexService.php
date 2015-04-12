<?php
namespace Services\Head;

use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Head;
use Models\Post;

use ViewModels\CommonErrorView;
use ViewModels\Head\IndexView;
use ViewModels\LayoutView;

/**
 * Class IndexService
 *
 * @package Services\Head
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
		$head = QuarkModel::FindOne(new Head(), array(
			'name' => $request->URI()->Route(1)
		));

		if ($head == null)
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		return QuarkView::InLayout(new IndexView(), new LayoutView(), array(
			'head' => $head,
			'posts' => QuarkModel::Find(new Post(), array(
					'head' => (string)$head->_id
				))
		));
	}
}