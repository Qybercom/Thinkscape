<?php
namespace Services;

use Quark\IQuarkGetService;

use Quark\QuarkDTO;
use Quark\QuarkSession;
use Quark\QuarkView;

use ViewModels\LayoutView;
use ViewModels\ShareView;

/**
 * Class ShareService
 *
 * @package Services
 */
class ShareService implements IQuarkGetService {
	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		return QuarkView::InLayout(new ShareView(), new LayoutView());
	}
}