<?php

require_once '../poi_lib/common.php';


/**
 * サムネイル画像URLを作成する。
 * @author user01
 *
 */
class ThumFile{
	
	
	
	function createThumFile($thimDirName,$modifieddate,$id,$ext){
		

		$mdStr=str_replace(' ', "_", $modifieddate);
		$mdStr=str_replace('/', "-", $mdStr);
		$mdStr=str_replace(':', "_", $mdStr);
		$thumFn=$thimDirName.$id.'_'.$mdStr.".".$ext;
		
		return $thumFn;
	}
	
	function isThumFile($modifieddate,$id,$ext){
		$thfn=$this->createThumFile($modifieddate, $id, $ext);
		if(is_file($thfn)){
			return true;
		}else{
			return false;
		}
		
	}
	
}