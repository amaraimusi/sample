<?php

require_once 'common.php';
/**
 * 拡張ファイルコピー。
 * ディレクトリごとコピーできる。
 * @author uehara
 * @date 2010/10/22
 */
class CopyEx{
	
	

	/**
	 * 拡張コピー　存在しないディテクトリも自動生成
	 * 日本語ファイルに対応
	 * @param コピー元ファイル名 $source
	 * @param コピー先ファイル名 $newFn
	 */
	function copy_($source,$newFn){
		
		//フルファイル名からパスを取得する。
		$di=dirname($newFn);
		
		
		//コピー先ファイル名とコピー元ファイル名が同名であれば、Nullを返して処理を終了
		if($source==$newFn){
			return null;
		}
		
		//ディレクトリが存在するかチェック。
		
		if (is_dir_ex($di)){
			;
			//存在するならそのままコピー処理
			$source=mb_convert_encoding($source,'SJIS','UTF-8');
			$newFn=mb_convert_encoding($newFn,'SJIS','UTF-8');
			copy($source,$newFn);
		}else{
			
			
			//存在しない場合。
			//パスを各ディレクトリに分解し、ディレクトリ配列をして取得する。
			$ary=explode('/', $di);
			//ディレクトリ配列の件数分以下の処理を繰り返す。
			$iniFlg=true;
			foreach ($ary as $key => $val){
				
				//作成したディレクトリが存在しない場合、ディレクトリを作成
				if ($iniFlg==true){
					$iniFlg=false;
					$dd=$val;
				}else{
					$dd.='/'.$val;
					
				}
				
				if (!(is_dir_ex($dd))){
					mkdir($dd);//ディレクトリを作成
				}
				
			}
			
			$source=mb_convert_encoding($source,'SJIS','UTF-8');
			$newFn=mb_convert_encoding($newFn,'SJIS','UTF-8');
			copy($source,$newFn);//ファイルをコピーする。
			

	}
	}
}
	
?>