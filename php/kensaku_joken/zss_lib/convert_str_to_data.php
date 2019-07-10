<?php
require_once 'common.php';

/**
 * ２次元データ文字列を展開して２次元データを生成する。
 * @author user01
 *
 */
class ConvertStrToData{
	


	/**
	 * ２次元データ文字列を展開して配列にする。要素１をキー、　要素２を配列にする。
	 * @param  $str ２次元データ文字列
	 * @return data
	 */
	function strToAry($str){
		
		//コンマで分解
		$ary=explode(',',$str);
		
		//「：」で分解して２次元データをセット
		foreach ($ary as $i=>$str2){
		
			$ary2=explode(':', $str2);
			$ent[$ary2[0]]=$ary2[1];

		}
		
		return $ent;
		
	}
	

	/**
	 * ２次元データ文字列を展開して２次元データを生成する。
	 * @param  $str ２次元データ文字列
	 * @return data
	 */
	function strToData($str){
		
		//コンマで分解
		$ary=explode(',',$str);
		
		//「：」で分解して２次元データをセット
		foreach ($ary as $i=>$str2){
		
			$ary2=explode(':', $str2);
	
			$data[$i]=$ary2;
			$ary2=null;
		}
		
		return $data;
		
	}
	
	/**
	 * ２次元データから２次元データ文字列を生成する。
	 */
	function dataToStr($data){
		
		foreach ($data as $i => $ent){
			$str2=join(':',$ent);
			$ary[$i]=$str2;
		}
		
		$str=join(',',$ary);
		
		return $str;
	}
	
}
?>