<?php

/**
 * 汎用データ操作関数
 * @author user01
 *2011/8/23 新規作成
 */
class DataOperator{

	
	//▼最終行のレコードのエンティティの値が、すべてnullならTrueを返す。
	public function isLastEntAllNull($data){
		$lastEnt=$data[count($data)-1];
		foreach ($lastEnt as $key => $val){
			if($val!=null){
				return false;
			}
		}
		
		return null;
	}
}