<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CSVファイルを非同期(AJAX)で読込む</title>

		<link href="../../style2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../../style2/css/common2.css" rel="stylesheet">

		<script src="../../style2/js/jquery-1.11.1.min.js"></script>
		<script src="../../style2/js/bootstrap.min.js"></script>
		<script src="jquery.upload-1.0.2.min.js"></script>

		<script>

		//ファイルアップロードされたときのイベント。
	    $(function() {
	        $('#medaka').change(function() {

	        	//ファイル名
	        	var fn="test.php";


		     	//☆非同期通信で画像ファイルをアップロードする。
	            $(this).upload(fn, function(res) {
					//▽以下はファイルアップロードに成功したときの処理。

					$("#res").html(res);

	            }, 'html');
	        });
	    });

		</script>
	</head>

<body>
<div class="container">

	<div class="row">
		<div id="header" class="col-lg-12" >
			<h1>CSVファイルを非同期(AJAX)で読込む</h1>
			<p></p>
		</div>
	</div>

	<div class="sec3">
		<h2>サンプル</h2>
		<input type="file" name="upload_file" id="medaka"><br />
		<hr>

		<h3>結果</h3>
		<div id="res" style="color:red"></div>


	</div>





	<hr>



	<h2>ソースコード</h2>


	<div class="sec1">
		<input type="button" onclick="$('#html_source').toggle()"; value="HTMLソースコード" class="btn btn-info" value="info" />
		<pre id="html_source" style="display:none">
&lt!DOCTYPE html&gt
&lthtml lang="ja"&gt

	&lthead&gt
		&ltmeta charset="utf-8"&gt
		&lttitle&gtサンプル&lt/title&gt


		&ltscript src="jquery-1.11.1.min.js"&gt&lt/script&gt
		&ltscript src="jquery.upload-1.0.2.min.js"&gt&lt/script&gt

		&ltscript&gt

		//ファイルアップロードされたときのイベント。
	    $(function() {
	        $('#medaka').change(function() {

	        	//ファイル名
	        	var fn="test.php";


		     	//☆非同期通信で画像ファイルをアップロードする。
	            $(this).upload(fn, function(res) {
					//▽以下はファイルアップロードに成功したときの処理。

					$("#res").html(res);

	            }, 'html');
	        });
	    });

		&lt/script&gt
	&lt/head&gt

	&ltbody&gt

		&lth2&gtサンプル&lt/h2&gt
		&ltinput type="file" name="upload_file" id="medaka"&gt&ltbr /&gt
		&lthr&gt

		&lth3&gt結果&lt/h3&gt
		&ltdiv id="res" style="color:red"&gt&lt/div&gt

	&lt/body&gt
&lt/html&gt
		</pre>
	</div>












	<div class="sec1">
		<input type="button" onclick="$('#test_php_source').toggle()"; value="test.php" class="btn btn-info" value="info" />
		<pre id="test_php_source" style="display:none">


&lt?php

require_once 'CsvIo2.php';

//header("Access-Control-Allow-Origin:*");//クロスドメイン通信を許可する。




$tmpFn=$_FILES["upload_file"]["tmp_name"];

//一時的にアップロードしたファイル名が空でないかチェック。（キャンセルを押された時など）
if(empty($tmpFn)){
	echo 'no_data';
}


//CSVファイルからデータを取り出し、さらにアクセスデータを抽出
$data=null;
try {
	//CSVファイルからデータを取り出す。
	$cio=new CsvIo2();
	$data=$cio->load($_FILES["upload_file"]["tmp_name"]);

	unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除


	echo var_dump($data);

} catch (Exception $e) {
	unlink($_FILES["upload_file"]["tmp_name"]);//一時ファイルを削除
	echo 'no_data';
}


?&gt
		</pre>
	</div>






	<div class="sec1">
		<input type="button" onclick="$('#csvio_php_source').toggle()"; value="CsvIo2.php" class="btn btn-info" value="info" />
		<pre id="csvio_php_source" style="display:none">
&lt?php




define("SDQ","%DXQ#");
define("SSQ","%SXQ#");

/**
 *
 * CSV読込書出クラス&ltbr&gt
 * ★主なメソッド
 *  load()					リソース（サーバー内のファイル）に存在するCSVファイルを読込みdataに変換する。
 *  save()					dataをリソース内のCSVファイルとして保存する。
 *  cnvToAryForDq()	コンマ区切りの文字列を配列化する。ダブルクォートに対応している。ダブルクォート内のコンマは区切らない。
 *
 * ★履歴
 * 2011/09/26　新規作成。　出力機能は未実装&ltbr&gt
 *　2012/1/12		readを改良。最初の一行をキーにする機能を追加
 *　2013/8/14	readを非推奨にし、loadを作成。saveメソッドを新規追加。
 *　2014/4/11	rakuten用に改造
 *　2014/5/22	cnvToAryForDqのnull判定にバグ。コンマが連続するCSVでエラーが発生した。
 *　2014/5/23	splitExで上記のバグを修正。さらに高速化。
 *　2015/4/16	ver2にバージョンアップ。
 *
 *
 * creater wacgance
 * this is free
 */

class CsvIo2{


	/**
	 *CSV読込
	 * @param  $csvFn　CSVファイル名
	 * @return ２次元データ
	 */
	function load($csvFn){


		//引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if(!$csvFn){return null;}
		if ( !$this-&gtis_file_ex($csvFn)) {return null;}



		//▼CSVファイルのデータを読み込みdataを作成
		$csvFn=mb_convert_encoding($csvFn,'SJIS','UTF-8');
		if ( $fp = fopen ($csvFn, "r")) {



			$data=array();
			while (false !== ($line = fgets($fp))){


				$str=mb_convert_encoding($line, 'utf-8', 'utf-8,sjis,euc_jp,jis');



				//▽コンマで区切った文字列を配列に変換。ダブルクォート区切りに対応している。
				$ent=$this-&gtsplitEx($str);

				array_push($data,$ent);


			}
		}
		fclose ($fp) ;




		return $data;
	}

	/**
	 * CSV読込その２。
	 * 先頭行をキーとしているデータ用。
	 * １行目の行はデータのエンティティのキーとして利用する。
	 * @param $csvFn				CSVファイル名
	 * @return data
	 */
	function load2($csvFn){
		$data=$this-&gtread($csvFn,$fieldFlg=false);
		return $data;
	}

	/**
	 *CSV読込
	 * @param  $csvFn　CSVファイル名
	 * @param  1行目のデータをキーとして利用する場合true;
	 * @return ２次元データ
	 */
	function read($csvFn,$fieldFlg=false){

		$data=$this-&gtload($csvFn);

		//▼フィールドフラグがTrueの場合、最初の一行をキーにする。
		if($fieldFlg==true){

			foreach ($data as $i =&gt $ent){
				if(empty($flg)){
					$flg=1;

					$keys=$data[0];//キーリストを取得

				}else{
					foreach ($keys as $j=&gt$key){
						$ent2[$key]=$ent[$j];
					}
					$data2[]=$ent2;
				}
			}



		}else{
			$data2=&$data;
		}

		return $data2;
	}




	/**
	 * CSV保存（リソースへ保存する）
	 * @param $csvFn	保存するCSVファイル名
	 * @param $data		データ
	 * @return なし
	 */
	function save($csvFn,$data){

			// CSVファイル名の設定
			$csv_file = $csvFn;

			// CSVデータの初期化
			$csv_data = "";



			// CSVデータの作成
			foreach((array)$data as $key =&gt $value ){

				$csv_data.=join($value,',');


				if(count($data) !== intval($key)+1){

					$csv_data .= "\n";

				}
			}

			// ファイルを追記モードで開く
			$fp = fopen($csv_file, 'ab');

			// ファイルを排他ロックする
			flock($fp, LOCK_EX);

			// ファイルの中身を空にする
			ftruncate($fp, 0);

			// データをファイルに書き込む
			fwrite($fp, $csv_data);

			// ファイルを閉じる
			fclose($fp);


	}





	private function splitEx($str){

		//「\"」を待避する。
		$s=$str;
		$n=mb_strpos($s,'\"',0);//「\"」を検索
		$sdqFlg=false;
		if(!empty($n) || $n===0){
			$sdqFlg=true;
			$s = str_replace('\"', SDQ, $s);//「\"」を待避させる。

		}

		//「"」でくくられた「,」を待避する。
		$dqFlg=false;
		$n=mb_strpos($s,'"',0);//「"」を検索
		if(!empty($n) || $n===0){
			$dqFlg=true;

			$ary=explode ( '"' , $s );
			for($i=1;$i&ltcount($ary);$i=$i+2){
				//echo $i."-";
				$ary[$i]=str_replace(',', SSQ, $ary[$i]);//「,」待避させる
			}
			$s=join("",$ary);

		}

		//待避文字から「"」に戻す。
		if($sdqFlg==true){
			$s = str_replace(SDQ, '"', $s);
		}

		$ary=explode ( ',' , $s );//分解

		//待避文字から「,」に戻す。
		if($dqFlg==true){
			foreach($ary as $i=&gt$v){
				$ary[$i]=str_replace(SSQ,',', $v);
			}
		}


		return $ary;
	}


	/**
	 * 日本語ファイルも扱えるis_file
	 * @param unknown_type $fn
	 * @return boolean
	 */
	function is_file_ex($fn){
		$fn=mb_convert_encoding($fn,'SJIS','UTF-8');
		if (is_file($fn)){
			return true;
		}else{
			return false;
		}
	}


}
?&gt
		</pre>
	</div>
























	<div class="row">
		<div id="footer" class="col-md-12"  >
			<p>(c)wacgance 2015-04-16</p>
		</div>
	</div>

</div><!-- container  -->
</body>
</html>