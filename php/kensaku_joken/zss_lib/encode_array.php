<?php

/**
 * 配列用文字エンコード
 * ☆概要
 * 配列データの文字の文字コードをまとめてエンコードする。
 * 多次元配列にも対応する。
 * ☆履歴
 * 2012/7/4	新規作成
 *
 */
class EncodeArray{

	function &encode(&$data,$fromStrCode,$toStrCode){
		if($data===null){
			return $data;
		}
		
		//データが配列であるなら、以下の処理を行う。
		if(is_array($data)){
			//配列件数分、以下の処理を繰り返す。
			foreach($data as $key=>$v){
				$data[$key]=$this->encode($v,$fromStrCode,$toStrCode);
			}
		}
		
		//データが配列でないなら、以下の処理を行う。
		else{
			//文字コードをエンコードする。
			$data=mb_convert_encoding($data, $toStrCode, $fromStrCode);
		}
		
		return $data;
	}
}