<?php
namespace Services\Head;

use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\Quark;
use Quark\QuarkDTO;
use Quark\QuarkModel;
use Quark\QuarkSession;
use Quark\QuarkView;

use Models\Head;

use ViewModels\Head\ListView;
use ViewModels\LayoutView;

/**
 * Class ListService
 *
 * @package Services\Head
 */
class ListService implements IQuarkGetService, IQuarkAuthorizableLiteService {
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
		return QuarkView::InLayout(new ListView(), new LayoutView(), array(
			'heads' => QuarkModel::Find(new Head(), array(), array(
					QuarkModel::OPTION_SKIP => 0,
					QuarkModel::OPTION_LIMIT => 30
				))
		));
	}
}