<?php
require_once 'calc_string.php';
require_once 'common.php';
class DefReader{
	
	///エラーメッセージ
	var  $m_err;
	
	/**
	 * defファイルを読み込みます。
	 * 例：
	 * 　「kani=カニ ;コメント」というデータの場合、キーはkani,値は「カニ」のデータが取得されます。
	 * 	$excuteFlgがfalseである場合は、キーによるマッピングは行われません。
	 * 
	 * @param  $defFileName defファイル名を読み込みます。
	 * @param  $excuteFlg　キーによるマッピングを行いたい場合はtrue;
	 * @return defデータ
	 */
	function getData($defFileName,$excuteFlg=false){
		//▼defファイル存在チェック
		if (!file_exists( $defFileName)) {
			$this->m_err='defファイルが見つかりません。:'.$defFileName;
			return null;
		}
		
		//▼defファイル開き、全データを取得します。
		if ( $fp = fopen ($defFileName, "r")) {
			
			while (false !== ($line = fgets($fp))){
				$data[sizeof($data)]=$line;
	
			}
		}
		
		if (!$data){
			return null;
		}
		
		//▼データからコメントと空値を除去します。
		fclose ($fp) ;
		foreach ((array)$data as $key => $val){
			$val=trim($val);
			if($val){
				$ary=explode(';',$val);
				$val=$ary[0];
				if($val){
					$data2[sizeof($data2)]=$val;
				}
			}
		}
		
		
		if (!$data2){
			return null;
		}
		
		
		//▼UTF8にエンコードします。
		foreach ($data2 as $key => $val){
		
			$data2[$key]=$filename=mb_convert_encoding($val, 'utf-8', 'sjis,euc_jp,jis');
			
		}
		
		
		//▼値を取得します。
		$cstr=new CalcString;
		foreach ($data2 as $k => $str){
			//値を取得する。
			$val=$cstr->stringRight($str, '=');//「=」から右の文字を取得する。
			$key=$cstr->stringLeft($str, '=');//キーを取得する。
			$key=trim($key);
			if($key){
				if ($excuteFlg){//処理方法フラグを確認
					//▼キーで値をマッピング
					$data3[$key]=$val;
					
				}else{
					//▼値を追加(キーは無視)
					$data3[sizeof($data3)]=$val;
				}
			}
			
		}
		
		return $data3;
		
		
		
		
	}
}