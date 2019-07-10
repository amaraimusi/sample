<?php
App::uses('AppController', 'Controller');
require_once '../Vendor/ZssLib2/ADebug.php';//■■■□□□■■■□□□■■■□□□

class TestCookieController extends AppController {
	public $name = 'TestCookie';
	public $uses = array ('TestCookie');
	public $components = array('Cookie');

	function index() {
		Debugger::dump('TestCookieのテスト');//■■■□□□■■■□□□■■■□□□

		$vers=Configure::version();
		Debugger::dump('$vers='.$vers);//■■■□□□■■■□□□■■■□□□


		$this->Cookie->name = 'okiracookie';
		$this->Cookie->key = 'qSI232qs*&sXeOgw!adarrte@3w4SgAvw!@e*(XSLg#$fw%)arsGb$@11~_+!@#HKis~#^';
		$this->Cookie->domain = $_SERVER['HTTP_HOST'];
		$this->Cookie->time = '1 year';  // または '1 hour'
		$this->Cookie->secure = false;  // true:セキュアな HTTPS で接続している時のみ発行されます
		$this->Cookie->httpOnly = false;




		$x=$this->getCartCount();
		Debugger::dump($x);//■■■□□□■■■□□□■■■□□□
// 		$this->set(array (
// 				'findData' => $findData,
// 				'usi' => 'XXX'
// 		));

	}


	/**
	 * カートの中身の個数取得
	 */
	private function getCartCount() {
		if (!$this->Cookie->check('Cart')) {
			return 0;
		} else {
			$cart = $this->Cookie->read('Cart');

			if (empty($cart) || !is_array($cart)) {

				$this->Cookie->delete('Cart');
				return 0;

			} else {
				$result = 0;
				foreach ($cart as $key => $val) {
					$result += count($val);
				}

				return $result;
			}
		}
	}



}