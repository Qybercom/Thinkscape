<?php
namespace Services\Post;

use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Post;

use ViewModels\CommonErrorView;
use ViewModels\Post\IndexView;
use ViewModels\LayoutView;

/**
 * Class IndexService
 *
 * @package Services\Post
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
		$post = QuarkModel::FindOneById(new Post(), $request->URI()->Route(1));

		if ($post == null)
			return QuarkView::InLayout(new CommonErrorView(), new LayoutView());

		return QuarkView::InLayout(new IndexView(), new LayoutView(), array(
			'post' => $post
		));
	}
}