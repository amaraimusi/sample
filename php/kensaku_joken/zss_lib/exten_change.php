<?php
require_once 'common.php';
/**
 * ファイル名の拡張子を変更する。
 * 2012/1/16	新規作成
 *
 */
class ExtenChange{
	
	/**
	 * 拡張子を変更したファイル名を取得する。
	 * @param  $fn　拡張子変更前ファイル名（パス付でも可能）
	 * @param  $ext			変更する拡張子
	 * @return string	拡張子変更後ファイル名
	 */
	function change($fn,$ext){
		if($fn==null){return null;}
		$path_parts = pathinfo($fn);

		if($path_parts['dirname']=='.' || $path_parts['dirname']==null){

			$fn2=$path_parts['filename'].'.'.$ext;

			
		}else{

			$fn2=$path_parts['dirname'].'/'.$path_parts['filename'].'.'.$ext;
		}
		
		
		return $fn2;
	}
	
}