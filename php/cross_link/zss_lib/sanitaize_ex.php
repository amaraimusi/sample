<?php

/**
 * SQLインジェクション対策、XSS対策を行う。連結文字用データ変換も行う。
 * 2011/12/5新規作成
 *
 */
class SanitaizeEx {
	
	/**
	 * インスタンスを取得
	 * @return 当クラスのインスタンス
	 */
	public static function getInstance(){
		
		if(!$_REQUEST['SanitaizeEx']){
			$obj=new SanitaizeEx();
			$_REQUEST['SanitaizeEx']==$obj;
		}else{
			$obj=$_REQUEST['SanitaizeEx'];
		}
		
		return $obj;

	}
	
	/**
	 * DB取得直後データにかけるサニタイジング。XSS対策および、SQLインジェクションによる無駄な「\」はずし。
	 * 文字列データだけがサニタイズ対象
	 * @param $treeData ツリー構造配列。値でも可
	 */
	function &sanitaizeAfterReadingDb(&$treeData){
		if (is_array($treeData)){
			foreach ($treeData as $i => &$val){
				$treeData[$i]=$this->sanitaizeAfterReadingDb($val);
			}
		}else{
			if(gettype($treeData)=='string'){
				
				$treeData=htmlspecialchars($treeData);//XSS用サニタイズ。HTML用の記号を無効化にする。
				$treeData=stripslashes($treeData);//SQLインジェクションサニタイズで付加された￥を解除。特定の記号から\マークを削除する。
						
			}
		}
		
		return $treeData;
	}
	
	
	
	/**
	 * DB登録直前データにかけるサニタイジング。SQLインジェクション対策を行う。
	 * 文字列データだけがサニタイズ対象
	 * ※DBコネクションを開いている状態で実施する必要がある。
	 */
	function &sanitaizeBeforeRegDb(&$treeData){
		if (is_array($treeData)){
			foreach ($treeData as $i => &$val){
				$treeData[$i]=$this->sanitaizeBeforeRegDb($val);
			}
		}else{
			//XSSサニタイジング
			if(gettype($treeData)=='string'){
				
				$treeData=mysql_real_escape_string($treeData);//SQLインジェクション対策
				
			}
		}
		
		return $treeData;
	}
	
	
	/**
	 * HTMLのhiddenにも埋め込める
	 */
	function &createJoinData(){
		
	}

	function &exploadJoinData(){
		
	}
	
	

	
	

	
	
	
}
?>