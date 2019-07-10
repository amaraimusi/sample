<?php


/**
 * エンティティを合成します。
 * @author user01
 *2011/09/16	新規作成
 */
class MargeEntity{
	
	
	/**
	 * エンティティ１にエンティティ２をマージする。
	 * 	（エンティティ１のnull値にエンティティ2の値をセット）
	 * @param  $ent1 
	 * @param  $ent2　
	 * @return $ent1
	 */
	function &marge(&$ent1,&$ent2){
		
		foreach ($ent1 as $key => &$val){
			if ($val==null){
				$val=$ent2[$key];
			}
		}
		unset($val);
	
		return $ent1;
	}
	
}