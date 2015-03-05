<?php
namespace ViewModels;

use Quark\IQuarkViewModel;
use Quark\IQuarkAuthorizableViewModel;
use Quark\IQuarkViewModelWithResources;

use Quark\QuarkJSViewResourceType;
use Quark\QuarkModel;
use Quark\QuarkProjectViewResource;

use Models\Head;
use Models\Post;

use Quark\ViewResources\Quark\CSS\QuarkThinkscape;
use Quark\ViewResources\WysiBB\WysiBB;

/**
 * Class LayoutView
 *
 * @package ViewModels
 */
class LayoutView implements IQuarkViewModel, IQuarkAuthorizableViewModel, IQuarkViewModelWithResources {
	public $heads = array();
	public $posts = array();

	/**
	 * Layout constructor
	 */
	public function __construct () {
		$this->heads = QuarkModel::Find(new Head(), array(), array(
			QuarkModel::OPTION_SORT => array(
				'ratio' => -1
			),
			QuarkModel::OPTION_LIMIT => 5
		));

		$this->posts = QuarkModel::Find(new Post(), array(), array(
			QuarkModel::OPTION_SORT => array(
				'ratio' => -1
			),
			QuarkModel::OPTION_LIMIT => 5
		));
	}

	/**
	 * @return string
	 */
	public function View () {
		return 'Layout';
	}

	/**
	 * @return string
	 */
	public function AuthProvider () {
		return THINK_SESSION;
	}

	/**
	 * @return array
	 */
	public function Resources () {
		return array(
			new QuarkThinkscape(),
			new WysiBB(),
			new QuarkProjectViewResource(__DIR__ . '/../static/main.js', new QuarkJSViewResourceType())
		);
	}
}