<?php

require_once 'common.php';
/**
 * 日付関連のデータを操作する。
 * 
 * デフォルトでY/m/d型
 * @author Kenji Uehara
 *2011/8/19	新規作成
 *2013/08/04　DateFormatChangeからDateUtilに変更。メソッドも追加。
 */
class DateUtil{
	
	
	/**
	 * 日時を「yyyy/mm/dd hh:ii:ss」型に変換する。
	 * 
	 * @param $v	「yyyymmddhhiiss」型の日時(数値以外の文字は削除する）
	 * @return フォーマット変換後の日時
	 */
	function cnvDatetime1($v){

		//文字列中に数値以外の文字があれば削除する。
		$v=$this->cnvDatetime2($v);

		//数値系であれば、以下処理を実行する。
		if(is_numeric($v)==true){

			//文字を8桁分解し、年月日と時分秒に分解する。
			$ary = str_split($v,8);
			$ymd=$ary[0];
			$his=$ary[1];
			
			//年月日のフォーマットを変換する
			$ymd=$this->cnvDate1($ymd);
			
			//時分秒のフォーマットを変換する。
			$his=$this->cnvTime1($his);
			
			//日時を組み立てる。
			$v=$ymd.' '.$his;
	}

		return $v;		
	}
	
	/**
	 * 日時を「yyyymmddhhiiss」型に変換する。
	 * 文字列中から数値以外の文字列を削除。また14文字分を切り取る。
	 * @param $v 日時
	 * @return 「yyyymmddhhiiss」型の日時
	 */
	function cnvDatetime2($v){
		
		
		//文字列に対して、一文字ずつ処理を行う。
		for($i = 0; $i < strlen($v); $i++) {
			
			//数値系であれば、新文字列に連結する。
			if(is_numeric($v[$i])==true){
				$v2.=$v[$i];
			}
			
		}
		
		//左から１４文字を切り取る。
		$v2=substr($v2, 0, 14);
	
		return $v2;
		
	}
	
	/**
	 * 日付を「y/m/d」型にフォーマット変換する。
	 * 変換元の日付は「ymd」「y-m-d」に対応
	 * @param $d	変換対象の日付
	 * @return 変換後の日付
	 */
	function cnvDate1($d){
		//トリミングをする。
		$d=trim($d);
		
		//文字列に「-」が含まれている場合、「/」に置換する。
		if(strstr($d,'-')){
			$d = str_replace('-', '/', $d);
		}


		
		//含まれていない場合。
		else{
			
			//数値系であれば、以下処理を実行する。
			if(is_numeric($d)==true){
				
				//文字を4桁ずつ分解して配列を作成。
				$ary = str_split($d,4);
				$yyyy=$ary[0];
				$mmdd=$ary[1];
				
				//月と日に分解。
				$ary2 = str_split($mmdd,2);
				$mm=$ary2[0];
				$dd=$ary2[1];
				
				//月、日がnullでなければ区切り文字をはさむ。
				if($mm!==null && $mm!==''){$mm='/'.$mm;}
				if($dd!==null && $dd!==''){$dd='/'.$dd;}
				
				//年月日を組み立てる
				$d=$yyyy.$mm.$dd;
			}

			
		}
		
		return $d;		
	}
	

	
	/**
	 * 時刻を「h:i:s」型にフォーマット変換する。
	 * 変換元の時刻は、his,h:i:s,hi,h:iに対応
	 * @param $t	変換元の時刻。
	 * @return 時刻（h:i:s)
	 */
	function cnvTime1($t){
		
		//トリミングをする。
		$t=trim($t);
		
		//文字列に「:」が含まれている場合、以下の処理を行う。
		if(strstr($t,':')){

				
		}
		
		//含まれていない場合。
		else{
			//数値系であれば、以下処理を実行する。
			if(is_numeric($t)==true){
				//文字を2桁ずつ分解して配列を作成。
				$ary = str_split($t,2);
				
				//配列Ｊｏｉｎをして、h:i:sの時刻を作成する。
				$t = join(":", $ary);
			}
			
		}
		
		return $t;
	}
	
	/**
	 * エンティティ中の指定プロパティの日付フォーマットを変換する。
	 * @param  $ent 		変換対象エンティティ
	 * @param  $jPrpName　	変換対象のプロパティ名。コンマで複数指定可能。
	 * @param  $dateFormat　日付フォーマット
	 * @return $ent
	 */
	function changeDateFormatForEnt(&$ent,$jPrpName,$dateFormat='Y/m/d'){
		
		//▼プロパティ名リストを取得する。
		$prps=explode(',', $jPrpName);
		
		//▼プロパティ名リストの件数分、以下の処理を繰り返し、日付フォーマット変換を行う。
		foreach ($prps as $key){
			$val=$ent[$key];
			if (isSet($val)){
				
				$ent[$key] = date($dateFormat,strtotime($val));
				
			}
			
		}

		
		return $ent;
		
	}
	/**
	 * データ中の指定プロパティの日付フォーマットを変換する。
	 * @param  $data 		変換対象データ
	 * @param  $jPrpName　	変換対象のプロパティ名。コンマで複数指定可能。
	 * @param  $dateFormat　日付フォーマット
	 * @return $ent
	 */
	function changeDateFormatForData(&$data,$jPrpName,$dateFormat='Y/m/d'){
		
		//▼プロパティ名リストを取得する。
		$prps=explode(',', $jPrpName);
		
		foreach ((array)$data as $i => $ent){
			
			//▼プロパティ名リストの件数分、以下の処理を繰り返し、日付フォーマット変換を行う。
			foreach ($prps as $key){
				$val=$ent[$key];
				if (isSet($val) ){
					
					$ent[$key] = date($dateFormat,strtotime($val));
					
				}
			
			}
			$data[$i]=$ent;
		}

		
		return $data;
		
	}
	
	
	
}