<?php


/**
 * CSVダウンロード
 * ★概要
 * マトリクスデータをCSVファイルに変換してダウンロード
 * ★履歴
 * 2014/5/12	新規作成
 *
 * @author k-uehara
 *
 */
class CsvDownloader{

	/**
	 * マトリクスデータをCSVファイルに変換してダウンロード
	 * @param  $csv_file	CSVファイル名
	 * @param  $data	マトリクスデータ
	 */
	function output($csv_file,$data){


		$buf = "";

		if(!empty($data)){
			$i=0;
			foreach($data as $ent){
				foreach($ent as $v){
					$cell[$i][] = $v;
				}
				$buf .= mb_convert_encoding(implode(",",$cell[$i])."\r\n", "SJIS-win", "UTF-8");
				$i++;
			}

		}



		header ("Content-disposition: attachment; filename=" . $csv_file);
		header ("Content-type: application/octet-stream; name=" . $csv_file);
		print($buf);

	}

}


?>