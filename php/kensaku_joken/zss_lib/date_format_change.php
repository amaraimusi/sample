<?php


/**
 * （非推奨クラス）DataUtilをなるべく利用してください。
 * DataUtil
 * データやエンティティで、日付型データのフォーマットを変換する。
 * デフォルトでY/m/d型
 * @author user01
 *2011/8/19	新規作成
 *2013/08/04　非推奨（DataUtil側にメソッドを移動）
 */
class DateFormatChange{
	
	
	
	
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