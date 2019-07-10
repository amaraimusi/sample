<?php require_once 'TxtIo.php';?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>テキストファイルの入出力</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>


		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">テキストファイルの入出力</h1>
		<div id="content" >

			<div class="sec1">

テキストファイルの内容を取得するサンプル<br>
<pre>

	$fn="test.txt";
	$str=load($fn,"&ltbr>");//★
	echo $str;

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

</pre>
▼出力<br>
<?php

	$fn="test.txt";
	$io=new TxtIo();
	$str=$io->load($fn,"<br>");
	echo $str;
?>

			</div><!-- sec1 -->








			<div class="sec1">

テキストファイルに書き出すサンプル<br>
<pre>

	$fn="test.txt";
	$d=date("Y-m-d H:i:s");
	$str=$d."\nいろはにほへとちりぬのを\nわかよたれそつねならむ\nうゐのおくやま けふこえて\nあさきゆめみし ゑひもせす\n";
	save($fn,$str);//★


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

</pre>
<?php

	$d=date("Y-m-d H:i:s");
	$str=$d."\nいろはにほへとちりぬのを\nわかよたれそつねならむ\nうゐのおくやま けふこえて\nあさきゆめみし ゑひもせす\n";
	$io->save($fn,$str);

?>

			</div><!-- sec1 -->




		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/07/22</div>
		</div><!-- page1 -->
	</body>
</html>