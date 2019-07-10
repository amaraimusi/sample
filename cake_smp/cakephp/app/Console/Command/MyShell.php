<?php
/**
 * テスト用シェル
 * ☆履歴
 * 2014/8/22
 * @author k-uehara
 *
 */
class MyShell extends AppShell {
	public function main() {
		echo 'Shell Hello world!';
		$this -> out( "Shell Hello world!");

	}

}
