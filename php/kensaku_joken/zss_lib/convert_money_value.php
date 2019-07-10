<?php
/**
 * 指定の数値を３桁カンマ区切りの貨幣タイプにする。
 * @author user01
 *2011/09/15　新規作成
 *2011/11/14　convMoneyEntを追加
 */
class ConvertMoneyValue{
	
	/**
	 * データ中の特定の値を３桁カンマ区切りの貨幣タイプに変換する。
	 * @param  $data　変換対象データ
	 * @param  $eiData　エンティティ情報
	 */
	function convMoneyData(&$data,&$eiData){
		
		if($data==null){return null;}
		
		//▼貨幣変換対象キーのリストを取得する。
		foreach ($eiData as $key => &$ei){
			if($ei['money']!=null){
				$keys[$key]=$key;
			}
		}
		
		//▼データ件数分、以下の貨幣タイプ変換処理を繰り返す。
		foreach ($data as $i => &$ent){
			foreach ((array)$keys as $key){
				$ent[$key]=number_format( $ent[$key] );//３桁カンマ区切りの貨幣タイプに変換
				
			}
		}
		
		return $data;
	}
	
	/**
	 * データ中の特定の値を３桁カンマ区切りの貨幣タイプに変換する。
	 * @param  $data　変換対象データ
	 * @param  $eiData　エンティティ情報
	 */
	function convMoneyEnt($ent,&$eiData){

		if($ent==null){return null;}
		
		//▼貨幣変換対象キーのリストを取得する。
		foreach ($eiData as $key => &$ei){
		
			if($ei['money']!=null){
				
				$keys[$key]=$key;
			
			}
		}
		
		//▼データ件数分、以下の貨幣タイプ変換処理を繰り返す。
		foreach ((array)$keys as $key){
			$ent[$key]=number_format( $ent[$key] );//３桁カンマ区切りの貨幣タイプに変換
			
		}
		
		return $ent;
	}
}
?>