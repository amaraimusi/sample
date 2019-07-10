<?php
require_once 'common.php';
/**
 * 指定ディレクトリからファイル名のリストを取得します。
 * @author uehara
 * @date 2010/10/22
 */
class GetFileList{
	

	/**
	 * 指定ディレクトリのファイル名を列挙します。日本語ファイル名対応
	 * 日本語ディレクトリ・ファイル未対応
	 * パスの区切りは\ではなく/を指定すること。
	 * @param $dn　パス付きディレクリ 
	 * @return ファイル名リスト
	 */
	function getList($dn){
		$h=opendir($dn);
		if($h){
			while (false !==($filename = readdir($h))){
				
				$filename=mb_convert_encoding($filename, 'utf-8', 'sjis,euc_jp,jis');
			
					//ディレクトリ以外
					if(!(is_dir($dn.'/'.$filename))){
						
						$files[sizeof($files)]=$filename;
						
					}
					
				//}
			}
			closedir($h);
		}
		
		return $files;
	}
	
	
	
	

	/**
	 * 指定ディレクトリのファイル名を列挙します。拡張子も指定します。日本語ファイル名対応
	 * 日本語ディレクトリ・ファイル未対応
	 * パスの区切りは\ではなく/を指定すること。
	 * @param  $dn　パス付きディレクリ
	 * @param  $ext　絞り込む拡張子
	 * @return ファイル名リスト
	 */
	function getList2($dn,$ext){
		$ext=strtolower($ext);
		$h=opendir($dn);
		if($h){
			while (false !==($filename = readdir($h))){
				
				$filename=mb_convert_encoding($filename, 'utf-8', 'sjis,euc_jp,jis');
				
				//ディレクトリ以外
				$ffn=$dn.'/'.$filename;
				if(!(is_dir($ffn))){
					$file_info = pathinfo($ffn);
					$ext2 = $file_info["extension"];
					$ext2=strtolower($ext2);
					
					//拡張子が同じであること
					if($ext==$ext2){
					
						$files[sizeof($files)]=$filename;
						
					}
					
				}
					
			
			}
			closedir($h);
		}
		
		return $files;
	}
	
	
	/**
	 * 指定ディレクトリのファイル名を列挙します。日本語ファイル名対応
	 * 日本語ファイル/ディレクトリに対応
	 * パスの区切りは\ではなく/を指定すること。
	 * @param $dn　パス付きディレクリ 
	 * @return ファイル名リスト
	 */
	function getFileAndDirList($dn,$ext=null){
		
		$ext=strtolower($ext);
		$exts=explode(',', $ext);
		//mb_convert_encoding('日本語を含むローカルパス','SJIS','UTF-8'=mb_convert_encoding($dn, 'utf-8', 'sjis,euc_jp,jis');
		$dn=mb_convert_encoding($dn,'SJIS','UTF-8');
		$h=opendir($dn);
		if($h){
			while (false !==($filename = readdir($h))){
				
				//$filename=mb_convert_encoding($filename, 'utf-8', 'sjis,euc_jp,jis');
				$ffn=$dn.'/'.$filename;	
					
			
				//ファイルであるか判定
				if(!is_dir($ffn)){
					
					//引数の拡張子を指定されているか判定
					if($ext){
						//引数の拡張子と一致しているファイルのみ抽出
						$file_info = pathinfo($filename);
						$ext2 = $file_info["extension"];
						$ext2=strtolower($ext2);
						foreach ($exts as $key => $ext){
							if($ext==$ext2){
								
								$files[sizeof($files)]=$ffn;
								break;
							}
						}
					}else{//引数の拡張子がnullである場合
							
						$files[sizeof($files)]=$ffn;
					}

				}else{//ディレクトリである場合
					//「.」「..」を取り除く
					if($filename!='..' && $filename!='.' ){
						
						$files[sizeof($files)]=$ffn;
					}
				}

				
						

			}
			closedir($h);
		}
		
		//▼ファイル名をSJISからUTF8に戻す
		foreach ($files as $key => $val){ 
			$val=mb_convert_encoding($val,'UTF-8','SJIS');
			$files[$key]=$val;
		}
		
		return $files;
	}
	
	
	

	
	/**
	 * 指定パスの全階層下のファイルを列挙する。
	 * @param  $dn　ディレクトリ名
	 * @param  $ext　拡張子名
	 * @return string
	 */
	function getFileListAllHierarchy($dn,$ext=null){
		
		$ext=strtolower($ext);
		$exts=explode(',', $ext);
		//mb_convert_encoding('日本語を含むローカルパス','SJIS','UTF-8'=mb_convert_encoding($dn, 'utf-8', 'sjis,euc_jp,jis');
		$dn=mb_convert_encoding($dn,'SJIS','UTF-8');
		
		//ディレクトリが存在しないか、ディレクトリを指定しない場合は、nullを返して処理を終了
		if(!is_dir($dn)){
			return null;
		}
		
		$dirList[sizeof($dirList)]=$dn;
		$i=0;
		do{
			$dn=$dirList[$i];
			$h=opendir($dn);
			if($h){
				while (false !==($filename = readdir($h))){
					
					//$filename=mb_convert_encoding($filename, 'utf-8', 'sjis,euc_jp,jis');
					$ffn=$dn.'/'.$filename;	
						
					
					//ファイルであるか判定
					if(!is_dir($ffn)){
						
						//引数の拡張子を指定されているか判定
						if($ext){
							//引数の拡張子と一致しているファイルのみ抽出
							$file_info = pathinfo($filename);
							$ext2 = $file_info["extension"];
							$ext2=strtolower($ext2);
							foreach ($exts as $key => $ext){
								if($ext==$ext2){
									
									$files[sizeof($files)]=$ffn;
									break;
								}
							}
						}else{//引数の拡張子がnullである場合
								
							$files[sizeof($files)]=$ffn;
						}
	
					}else{//ディレクトリである場合
						//「.」「..」を取り除く
						if($filename!='..' && $filename!='.' ){
							
							$dirList[sizeof($dirList)]=$ffn;
						}
					}
	
					
							
	
				}
				closedir($h);
			}
			$i++;
		}while(sizeof($dirList)>$i);
		
		
		
		foreach ((array)$files as $key => $val){ 
			$val=mb_convert_encoding($val,'UTF-8','SJIS');
			$files[$key]=$val;
		}
		
		return $files;
	}
}
?>
