<?php

/**
 * テキストファイルの入出力クラス。
 *
 * ★履歴
 * 2014/7/22	新規作成
 * @author k-uehara
 *
 */
class TxtIo {

	/**
	 * テキストファイル内の文字列を取得
	 *
	 * @param $txtFn テキストファイル名
	 * @param $n 改行文字
	 * @return テキストファイル内の文字列（改行は\n)
	 */
	function load($txtFn, $n = "\n") {

		// 引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if (! $txtFn) {
			return null;
		}

		$str = null;
		if (! $this->is_file_ex ( $txtFn )) {
			return null;
		}

		// ▼CSVファイルのデータを読み込みdataを作成
		$txtFn = mb_convert_encoding ( $txtFn, 'SJIS', 'UTF-8' );
		if ($fp = fopen ( $txtFn, "r" )) {

			$data = array ();
			while ( false !== ($line = fgets ( $fp )) ) {

				$str .= mb_convert_encoding ( $line, 'utf-8', 'utf-8,sjis,euc_jp,jis' ) . $n;
			}
		}
		fclose ( $fp );

		return $str;
	}

	/**
	 * テキストファイル内のデータを行ごとに読みこみ、配列で返す。
	 *
	 * @param $txtFn テキストファイル名
	 * @return 配列。
	 */
	function loadList($txtFn) {

		// 引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if (! $txtFn) {
			return null;
		}

		$list = null;
		if (! $this->is_file_ex ( $txtFn )) {
			return null;
		}

		// ▼CSVファイルのデータを読み込みdataを作成
		$txtFn = mb_convert_encoding ( $txtFn, 'SJIS', 'UTF-8' );
		if ($fp = fopen ( $txtFn, "r" )) {

			$data = array ();
			while ( false !== ($line = fgets ( $fp )) ) {

				$list [] = mb_convert_encoding ( $line, 'utf-8', 'utf-8,sjis,euc_jp,jis' );
			}
		}
		fclose ( $fp );

		return $list;
	}

	/**
	 * テキストファイルに書き出して保存
	 *
	 * @param $txtFn テキストファイル名
	 * @param $str 文字列
	 * @return なし
	 */
	function save($txtFn, $str) {

		// ファイルを追記モードで開く
		$fp = fopen ( $txtFn, 'ab' );

		// ファイルを排他ロックする
		flock ( $fp, LOCK_EX );

		// ファイルの中身を空にする
		ftruncate ( $fp, 0 );

		// データをファイルに書き込む
		fwrite ( $fp, $str );

		// ファイルを閉じる
		fclose ( $fp );
	}

	/**
	 * 文字列配列をテキストファイルに書き出して保存
	 *
	 * @param $txtFn テキストファイル名
	 * @param $list 文字列リスト
	 * @return なし
	 */
	function saveList($txtFn, $list) {

		if(empty($list)){
			return null;
		}

		$str="";
		foreach($list as $v){
			$str.=$v."\n";
		}


		// ファイルを追記モードで開く
		$fp = fopen ( $txtFn, 'ab' );

		// ファイルを排他ロックする
		flock ( $fp, LOCK_EX );

		// ファイルの中身を空にする
		ftruncate ( $fp, 0 );

		// データをファイルに書き込む
		fwrite ( $fp, $str );

		// ファイルを閉じる
		fclose ( $fp );
	}

	private function splitEx($str) {

		// 「\"」を待避する。
		$s = $str;
		$n = mb_strpos ( $s, '\"', 0 ); // 「\"」を検索
		$sdqFlg = false;
		if (! empty ( $n ) || $n === 0) {
			$sdqFlg = true;
			$s = str_replace ( '\"', SDQ, $s ); // 「\"」を待避させる。
		}

		// 「"」でくくられた「,」を待避する。
		$dqFlg = false;
		$n = mb_strpos ( $s, '"', 0 ); // 「"」を検索
		if (! empty ( $n ) || $n === 0) {
			$dqFlg = true;

			$ary = explode ( '"', $s );
			for($i = 1; $i < count ( $ary ); $i = $i + 2) {
				// echo $i."-";
				$ary [$i] = str_replace ( ',', SSQ, $ary [$i] ); // 「,」待避させる
			}
			$s = join ( "", $ary );
		}

		// 待避文字から「"」に戻す。
		if ($sdqFlg == true) {
			$s = str_replace ( SDQ, '"', $s );
		}

		$ary = explode ( ',', $s ); // 分解

		// 待避文字から「,」に戻す。
		if ($dqFlg == true) {
			foreach ( $ary as $i => $v ) {
				$ary [$i] = str_replace ( SSQ, ',', $v );
			}
		}

		return $ary;
	}

	/**
	 * 日本語ファイルも扱えるis_file
	 *
	 * @param unknown_type $fn
	 * @return boolean
	 */
	function is_file_ex($fn) {
		$fn = mb_convert_encoding ( $fn, 'SJIS', 'UTF-8' );
		if (is_file ( $fn )) {
			return true;
		} else {
			return false;
		}
	}
}
?>