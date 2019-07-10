<?php




define("SDQ","%DXQ#");
define("SSQ","%SXQ#");

/**
 *
 * CSV読込書出クラス<br>
 * ★主なメソッド
 *  load()					リソース（サーバー内のファイル）に存在するCSVファイルを読込みdataに変換する。
 *  save()					dataをリソース内のCSVファイルとして保存する。
 *  cnvToAryForDq()	コンマ区切りの文字列を配列化する。ダブルクォートに対応している。ダブルクォート内のコンマは区切らない。
 *
 * ★履歴
 * 2011/09/26　新規作成。　出力機能は未実装<br>
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
		if ( !$this->is_file_ex($csvFn)) {return null;}



		//▼CSVファイルのデータを読み込みdataを作成
		$csvFn=mb_convert_encoding($csvFn,'SJIS','UTF-8');
		if ( $fp = fopen ($csvFn, "r")) {



			$data=array();
			while (false !== ($line = fgets($fp))){


				$str=mb_convert_encoding($line, 'utf-8', 'utf-8,sjis,euc_jp,jis');



				//▽コンマで区切った文字列を配列に変換。ダブルクォート区切りに対応している。
				$ent=$this->splitEx($str);

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
		$data=$this->read($csvFn,$fieldFlg=false);
		return $data;
	}

	/**
	 *CSV読込
	 * @param  $csvFn　CSVファイル名
	 * @param  1行目のデータをキーとして利用する場合true;
	 * @return ２次元データ
	 */
	function read($csvFn,$fieldFlg=false){

		$data=$this->load($csvFn);

		//▼フィールドフラグがTrueの場合、最初の一行をキーにする。
		if($fieldFlg==true){

			foreach ($data as $i => $ent){
				if(empty($flg)){
					$flg=1;

					$keys=$data[0];//キーリストを取得

				}else{
					foreach ($keys as $j=>$key){
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
			foreach((array)$data as $key => $value ){

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
			for($i=1;$i<count($ary);$i=$i+2){
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
			foreach($ary as $i=>$v){
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
?>