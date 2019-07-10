<?php
require_once 'common.php';


/**
 * CSV読込書出クラス<br>
 *2011/09/26　新規作成。　出力機能は未実装<br>
 *2012/1/12		readを改良。最初の一行をキーにする機能を追加
 *
 */
class CsvIo{
	
	
	/**
	 *CSV読込
	 * @param  $csvFn　CSVファイル名
	 * @param  $fieldFlg　Trueの場合、最初の一行をキーにする。
	 * @return ２次元データ
	 */
	function read($csvFn,$fieldFlg=false){
		
		//引数のiniファイル名が空、もしくは存在しなければ、なら、nullを返して終了
		if(!$csvFn){return null;}
		if ( !is_file_ex($csvFn)) {return null;}
		
	
		//▼デフォルトエンティティをdefalut.iniファイルのデータで上書きします。
		$csvFn=mb_convert_encoding($csvFn,'SJIS','UTF-8');
		if ( $fp = fopen ($csvFn, "r")) {
			$data=array();
			while (false !== ($line = fgets($fp))){
			
				$str=mb_convert_encoding($line, 'utf-8', 'utf-8,sjis,euc_jp,jis');
				$ent=explode(',',$str);
				array_push($data,$ent);

				
			}
		}
		
		
		fclose ($fp) ;
		
		
		//▼フィールドフラグがTrueの場合、最初の一行をキーにする。
		if(fieldFlg==true){
			
			foreach ($data as $i => $ent){
				if($flg==null){
					$flg=1;
					
					$keys=$data[0];//キーリストを取得
					
				}else{
					foreach ($keys as $j=>$key){
						$ent2[$key]=$ent[$j];
					}
					$data2[]=$ent2;
				}
			}

			
			
		}else{
			$data2=&$data;
		}
		
		return $data2;
	}
	
	

	/**
	 * --------未実装------------------
	 * @param unknown_type $csvFn
	 * @param unknown_type $data
	 */
	function write($csvFn,$data){
		

	}
	

}
?>