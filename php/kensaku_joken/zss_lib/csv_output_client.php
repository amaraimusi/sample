<?php
require_once 'common.php';
require_once 'poi.php';

/**
 * クライアント側にCSVファイルをダウンロードさせます。
 * @author uehara
 * @date 2010/10/22
 */
class CsvOutputClient{
	
	/**
	 * クライアント側にCSVファイルをダウンロードさせます。
	 * @param  $data POIデータ
	 * @param  $csv_file csvファイル名（パスは付けない）
	 */
	function output($data,$csv_file){
		

		//データの先頭行にフィールド名を追加する。
		$data=$this->appField($data);

		
		//半角カンマを全角カンマに変換する。
		//$data2=$this->convertReplace1($data);
		
		//半角カンマが存在する場合、ダイブルクォートでくくる。
		$data2=$this->convertReplace2($data);
		
		//CSV用の文字列に変換する。
		foreach((array)$data2 as $key => $rec ){
			
		
			$csv_rec=join(',',$rec);
			$csv_rec_sjis=mb_convert_encoding($csv_rec, "SJIS", "UTF-8");//SJISで出力するため。ExcelはUTF-8をサポートしていない。
			$csv_data[count($csv_data)] = $csv_rec_sjis."\n";
			
		}
	
		
		// MIMEタイプの設定
		header("Content-Type: application/octet-stream");
		
		// ファイル名の表示
		header("Content-Disposition: attachment; filename=$csv_file");
		
		// データの出力
		for ($i=0;$i<count($csv_data);$i++){
			echo($csv_data[$i]);
			
		}
		
		
		
	}
	
	//データの先頭行にフィールド名を追加する。
	private function appField($data){
		if (!$data){
			$poi=new Poi;
			$rec=$poi->getDefalutEnt();
		}else{
			$rec=$data[0];
		}
		
		foreach($rec as $key => $val ){
			$field[$key]=$key;
		}
		
		$data2[count($data2)]=$field;
		foreach((array)$data as $key => $rec ){
			$data2[count($data2)]=$rec;
		}
		//$data=array_unshift($data, $field);
		return $data2;
		
	}
	
	//半角カンマを全角カンマに変換する。
	private function convertReplace1($data){
		
		for ($i=0;$i<count($data);$i++){
			$rec=$data[$i];
			foreach((array)$rec as $key => $val ){
				$rec2[$key]=str_replace (',', '，', $val);
				
			}
			
			$data2[count($data2)]=$rec2;
		}
		
		return $data2;
	}
	//半角カンマが存在する場合、ダイブルクォートでくくる。
	private function convertReplace2($data){
		
		for ($i=0;$i<count($data);$i++){
			$rec=$data[$i];
			foreach((array)$rec as $key => $val ){
				if(strstr($val,',')){
					$rec2[$key]="\"".$val."\"";
				}else{
					$rec2[$key]=$val;
					
				}
				
				
			}
			
			$data2[count($data2)]=$rec2;
		}
		
		return $data2;
	}
	
	
}

?>