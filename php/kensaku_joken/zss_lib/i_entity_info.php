<?php


/**
 * エンティティ情報のインターフェース<br />
 * @author user01
 * 2011/7/14	新規作成
 */
interface IEntityInfo{
	
	/**
	 * エンティティ情報を取得する。
	 */
	public function getEntityInfo();
	
	/**
	 * エンティティ情報をセットする。
	 * @param  $eiData　エンティティ情報
	 */
	public function setEntityInfo(&$eiData);
	
	/**
	 * デフォルトエンティティを取得する。
	 * @return Ambigous <string, number, NULL>
	 */
	public function getDefalutEnt();
	
	
}
?>