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
 *　2015/4/16	指定CSV判定メソッド追加
 *　2015/4/17	load3を追加。
 *
 *
 * creater wacgance
 * this is free
 */

class CsvIo2{


	/**
	 * CSV読込。
	 * CSVファイルの内容をそのままシンプルな2次元データとして取得
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

		//「"」が存在しないなら通常の分割。
		if(empty($n) && $n!==0){
			$ary=explode(",", $str);

			//最後の行から改行を削除
			$l_i=count($ary)-1;
			$ary[$l_i] = str_replace("\r\n", '', $ary[$l_i]);
			$ary[$l_i] = str_replace("\r", '', $ary[$l_i]);
			$ary[$l_i] = str_replace("\n", '', $ary[$l_i]);

			return $ary;
		}

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




	/**
	 * 識別列名リストから指定CSVであるか判定する。
	 * CSVデータの列名が識別列名リストと一致するなら、指定CSVと判定する。
	 * @param $data CSVデータ
	 * @param $idents 識別列名リスト
	 * @return true:指定CSVである    false:指定CSVでない
	 */
	function checkIdent($data,$idents){

		$rets['res']=true;
		$rets['err_msg']=null;

		// 識別列名リストが空である場合、判定処理はせず、OKとみなす。
		if(empty($idents)){
			return $rets;
		}



		// CSVデータが空である場合、エラー
		if(empty($data)){
			$rets['res']=false;
			$rets['err_msg']="CSVデータが空です。";
			return $rets;
		}

		// CSVデータから列配列を取得
		$heads=$data[0];

		// 識別別名リストの件数が、列配列を超える場合、エラー。
		$idents_cnt=count($idents);
		if($idents_cnt > count($heads)){
			$rets['res']=false;
			$rets['err_msg']="指定外のCSVファイルです。指定CSVは列が{$idents_cnt}件以上です。";
			return $rets;
		}

		// 識別列名リストでCSVデータの列を判定する。
		$res=true;
		$err_msg=null;
		foreach($idents as $i=>$ident){

			$clm=trim($heads[$i]);


			if(is_array($ident)){
				// 値が配列である場合、列名が別名リストに存在するかチェックする。
				$res=$this->checkIdentAlias($clm,$ident);

			}else{

				// 列名と識別列名が一致しないならフラグ＝false
				if($clm != $ident){
					$res=false;
				}

			}

			if($res==false){

				//識別列名を取得
				$ident_clm=$this->getIdentClm($ident);

				$clm_no=$i+1;//列番号

				//エラーメッセージを組み立て
				$err_msg="指定外のCSVファイルです。{$clm_no}列目の列名が「{$ident_clm}」でありません。";
				break;
			}


		}

		$rets['res']=$res;
		$rets['err_msg']=$err_msg;

		return $rets;

	}

	//識別列名を取得
	private function getIdentClm($ident){
		$ident_clm=null;
		if(is_array($ident)){
			if(!empty($ident)){
				$ident_clm=$ident[0];
			}

		}else{
			$ident_clm=$ident;
		}
		return $ident_clm;
	}




	/**
	 * 値が配列である場合、列名が別名リストに存在するかチェックする。
	 * @param $clm   列名
	 * @param $alias 別名リスト
	 */
	private function checkIdentAlias($clm,$alias){

		$res=false;

		if(empty($alias)){
			$res=true;
			return $res;
		}

		//別名リストに1件でも列名に一致するデータがあればtrueを返す。
		foreach($alias as $a_clm){
			if(empty($a_clm)){
				continue;
			}

			if($clm==$a_clm){
				$res=true;
				break;
			}
		}

		return $res;
	}


	/**
	 * CSV読込。
	 * 入力チェックが充実している。
	 * 識別列名リストでCSVデータの列名が一致するか調べ、指定CSVファイルか判定できる。
	 * 対象列リストで指定の列だけデータを取得できる。
	 *
	 * @param $files ←$_FILES["upload_file"]を指定する。
	 * @param $idents 識別列名リスト
	 * @param $targets 対象列リスト(取得対象の列）
	 * @return res:成功可否（boolean)    err_msg:エラーメッセージ（文字列）   data:CSVデータ（2次元配列）
	 */
	public function load3($files,$idents,$targets){

		$csvFn=$files["tmp_name"];


		$rets['res']=true;
		$rets['err_msg']=null;
		$rets['data']=array();



		//引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if(!$csvFn){

			$rets['res']=false;
			$rets['err_msg']="CSVファイル名が指定されていません";
			return $rets;
		}

		//csvファイルが存在しない場合、エラーを返して終了。
		if ( !$this->is_file_ex($csvFn)) {
			$rets['res']=false;
			$rets['err_msg']="CSVファイルが取り込めません。サーバーに制限されている可能性があります。";
			return $rets;
		}



		//指定CSVであるか識別列名リストから判定する。
		if($this->is_exten_csv($files["name"])==false){

			$rets['res']=false;
			$rets['err_msg']="CSVファイルの拡張子がCSVでありません。";
			return $rets;
		}




		//▼CSVファイルのデータを読み込みdataを作成
		try {
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
			@fclose ($fp) ;

		} catch (Exception $e) {

			@fclose ($fp) ;
			$rets['res']=false;
			$rets['err_msg']="CSVファイルからデータを読み取れませんでした。";
			return $rets;
		}



		// 識別列名リストから指定CSVであるか判定する。
		$chks=$this->checkIdent($data,$idents);
		if ($chks['res']==false){
			$rets['res']=false;
			$rets['err_msg']=$chks['err_msg'];
			return $rets;
		}


		//列配列から対象列リストに紐づく列番号を取得する。
		$data=$this->exitractByTargetClms($data,$targets);

		$rets['data']=$data;


		return $rets;

	}

	/**
	 * ファイル名の拡張子がCSVであるか調べる。
	 * @param $fn	ファイル名
	 * @return boolean true:CSVである	false:CSVでない
	 */
	private function is_exten_csv($fn){
		$res=false;
		$extension = pathinfo( basename($fn), PATHINFO_EXTENSION );

		if ( strcasecmp( $extension, "csv" ) == 0 ) {

			$res=true;
		}
		return $res;
	}


	/**
	 * 対象列リストから指定列のデータだけ抽出
	 * @param  $data	CSVデータ
	 * @param  $targets	対象列リスト
	 * @return 抽出後のCSVデータ
	 */
	function exitractByTargetClms($data,$targets){

		// 対象列リストが空なら抽出処理は行わない。
		if(empty($targets)){

			return $data;
		}

		if(empty($data)){
			return $data;
		}

		// CSVデータから列配列を取得
		$heads=$data[0];


		// 列配列から対象列リストに紐づく列番号リストを取得する。
		$tarClmNos=$this->getTargetClmNos($heads,$targets);

		if(empty($tarClmNos)){
			return $data;
		}


		//CSVデータから列番号リストに該当する列のみ抽出。
		$data2=array();
		foreach($data as $ent){
			$ent2=array();
			foreach($tarClmNos as $clmNo){
				$ent2[]=$ent[$clmNo];
			}
			$data2[]=$ent2;
		}


		return $data2;

	}


	/**
	 *  列配列から対象列リストに紐づく列番号を取得する。
	 * @param  $heads	列配列
	 * @param  $targets	対象列リスト
	 */
	private function getTargetClmNos($heads,$targets){

		$tarClmNos=array();//列番号リスト

		//対象列リストの件数分、以下の処理を繰り返す。
		foreach($targets as $target){

			//対象列が別名配列である場合、別名配列数分、一致する列名を探す。
			if(is_array($target)){
				foreach($target as $alias){

					$clmNo=array_search($alias,$heads);//一致する列名を探す。

					//一致する列名が見つかった場合、列番号リストに見つかった列番号をセット
					if($clmNo!==false){
						$tarClmNos[]=$clmNo;
						break;
					}
				}
			}

			//対象列が文字列である場合,その文字列に一致する列名を探す。
			else{
				$clmNo=array_search($target,$heads);//一致する列名を探す。

				//一致する列名が見つかった場合、列番号リストに見つかった列番号をセット
				if($clmNo!==false){
					$tarClmNos[]=$clmNo;
				}
			}

		}

		//重複する列番号を除去
		$tarClmNos=array_unique($tarClmNos);


		return $tarClmNos;


	}






}
?>