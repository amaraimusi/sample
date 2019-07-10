<?php
require_once 'common.php';
//require_once '../poi_lib/poi.php';
//require_once '../poi_lib/marge_entity.php';
/**
 * iniファイルデータを読み取る。
 * 2011/09/26 新規作成
 */
class IniFileAction{

	
	/**
	 * iniファイルデータを読込、配列で返す。
	 * @param  $iniFn iniファイル名
	 * @return 配列データ
	 */
	function readIniFile($iniFn){
		

//		//▼定義されたデフォルトのPOIエンティティを取得。
//		$poi=Poi::getInstance();
//		$ent0=$poi->getDefalutEnt();

		
		//引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if(!$iniFn){return null;}
		if ( !is_file_ex($iniFn)) {return null;}
		
//		//▼引数のパスを除いたファイル名が「default.ini」でないならエンティティを返して処理を抜ける
//		$file_info = pathinfo($iniFn);
//		if($file_info["basename"]!='default.ini'){
//			return $ent0;
//		}
//
//		
//	
//		//▼ファイルが存在してなければ、エンティティを返して処理を抜ける
//		if ( !is_file_ex($iniFn)) {
//			return $ent0;
//		}
		
	
		//▼デフォルトエンティティをdefalut.iniファイルのデータで上書きします。
		$iniFn=mb_convert_encoding($iniFn,'SJIS','UTF-8');
		if ( $fp = fopen ($iniFn, "r")) {
			
			while (false !== ($line = fgets($fp))){
			
				$ary=split('=',$line);
				if (sizeof($ary)==2){
					$key=trim($ary[0]);
					$val=trim($ary[1]);
					
					$val=mb_convert_encoding($val, 'utf-8', 'utf-8,sjis,euc_jp,jis');
			
					$ent[$key]=$val;

					
					
				}
				
			}
		}
		
		
		fclose ($fp) ;
		
		
//		//entへent0をマージする。
//		$mre=new MargeEntity();
//		$ent=$mre->marge($ent,$ent0);
//		//▼定義デフォルトエンティティを空文字部分にセットする。
//		foreach ($ent as $key => $val){ 
//			if($val===''){
//				$ent[$key]=$ent0[$key];
//			}
//		}

		
		return $ent;
	}
	
	
//	/**
//	 * default.iniからデフォルトデータを取得する。
//	 * @param  $iniFn　iniファイル名
//	 * @return Ambigous <Ambigous, Ambigous <string, number, NULL, boolean>>|Ambigous <string, Ambigous, Ambigous <string, number, NULL, boolean>>
//	 */
//	function getDefEnt($iniFn=null){
//		
//
//		//▼定義されたデフォルトのPOIエンティティを取得。
//		$poi=Poi::getInstance();
//		$ent0=$poi->getDefalutEnt();
//
//	
//		//▼ファイルが存在してなければ、エンティティを返して処理を抜ける
//		if ( !is_file_ex($iniFn)) {
//			return $ent0;
//		}
//		
//	
//		//▼デフォルトエンティティをdefalut.iniファイルのデータで上書きします。
//		$iniFn=mb_convert_encoding($iniFn,'SJIS','UTF-8');
//		if ( $fp = fopen ($iniFn, "r")) {
//			
//			while (false !== ($line = fgets($fp))){
//			
//				$ary=split('=',$line);
//				if (sizeof($ary)==2){
//					$key=trim($ary[0]);
//					$val=trim($ary[1]);
//					
//					$val=mb_convert_encoding($val, 'utf-8', 'utf-8,sjis,euc_jp,jis');
//			
//					$ent[$key]=$val;
//
//					
//					
//				}
//				
//			}
//		}
//		
//		
//		fclose ($fp) ;
//		
//		
//		//▼定義デフォルトエンティティを空文字部分にセットする。
//		foreach ($ent as $key => $val){ 
//			if($val===''){
//				$ent[$key]=$ent0[$key];
//			}
//		}
//
//		
//		return $ent;
//	}
}
?>