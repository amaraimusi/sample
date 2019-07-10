<?php
require_once 'common.php';

/**
 * クライアント側にCSVファイルをダウンロードさせます。
 * ２次元データを、そのまま出力します。
 * @author uehara
 * @date 2011/09/05
 */
class CsvOutputSimple{
	
	/**
	 * クライアント側にCSVファイルをダウンロードさせます。
	 * @param  $data POIデータ
	 * @param  $csv_file csvファイル名（パスは付けない）
	 */
	function output($data,$csv_file){
		

		//データの先頭行にフィールド名を追加する。
		//$data=$this->appField($data);

		//半角カンマを全角カンマに変換する。
		//$data2=$this->convertReplace1($data);
		
		
		//データにダイブルクォートが存在する場合「""」と置換。
		$data2=$this->convertReplace3($data);
		
		//半角カンマが存在する場合、ダイブルクォートでくくる。
		$data2=$this->convertReplace2($data2);

		//CSV用の文字列に変換する。
		foreach((array)$data2 as $key => $rec ){
			
		
			$csv_rec=join(',',$rec);
			$csv_rec_sjis=mb_convert_encoding($csv_rec, "SJIS", "UTF-8");//SJISで出力するため。ExcelはUTF-8をサポートしていない。
			$csv_rec_sjis=$csv_rec_sjis."\n";
			$csv_data[$key]=$csv_rec_sjis;
			
			
		}
		
		
		// MIMEタイプの設定
		header("Content-Type: application/octet-stream");
		
		// ファイル名の表示
		$csv_file=mb_convert_encoding($csv_file, "SJIS", "UTF-8");//SJISにCSVファイル名を変換
		header("Content-Disposition: attachment; filename=$csv_file");
		
		// データの出力
		$cnt=count($csv_data);
		for ($i=0;$i<$cnt;$i++){
			echo($csv_data[$i]);
			
		}
		
	}
	
	
	//半角カンマを全角カンマに変換する。
	private function convertReplace1($data){
		$cnt=count($data);
		$data2=array();
		for ($i=0;$i<$cnt;$i++){
			$rec=$data[$i];
			foreach((array)$rec as $key => $val ){
				$rec2[$key]=str_replace (',', '，', $val);
				
			}
			
		
			array_push($data2,$rec2);
		}
		
		return $data2;
	}
	//半角カンマが存在する場合、ダイブルクォートでくくる。
	private function convertReplace2($data){
		foreach ($data as $i => $ent){
			foreach ($ent as $key => $val){
				if(strstr($val,',')){
					$val='"'.$val.'"';
				}
				
				$ent[$key]=$val;
			}
			$data[$i]=$ent;
		}

		return $data;
	}
	

	
	//データにダイブルクォートが存在する場合「""」と置換。
	private function convertReplace3($data){
		
		foreach ($data as $i => $ent){
			foreach ($ent as $key => $val){
				
				$val=str_replace('"','""',$val);
				$ent[$key]=$val;
			}
			$data[$i]=$ent;
		}
		
		return $data;
	}
	
}

?>