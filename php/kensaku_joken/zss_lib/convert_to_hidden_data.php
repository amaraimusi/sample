<?php

/**
 * データの値をhiddenフィールドタグ形式に変換する。<br>
 * 文字列の場合はURLエンコードも行う。<br>
 * 履歴<br>
 * 2012/1/11	新規作成
 * @author uehara
 *
 */
class ConvertToHiddenData{
	
	function &convert(&$data){
		
		if($data==null){return null;}
		
		//▼変換処理
		foreach ($data as $i => &$ent){
			
			foreach ($ent as $key=>&$val){
				if(is_string($val)){
					
					//URLエンコードする。
					$val=urlencode($val);
				}
				
				$key2=$key.'['.$i.']';
				
				//hiddenタグデータ化する。
				$val="<input type=\"hidden\" name=\"{$key2}\" value=\"{$val}\" />";
				
				unset($val);
			}
			unset($ent);
			

			
		}
		
		return $data;
	}
	
}
?>