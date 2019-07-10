<?php

/**
 * XML出力クラス
 * @author uehara
 * @date 2010/10/25
 */
class XmlOutputClient{
	

	/**
	 * クライアント側にXMLファイルをダウンロードさせます。
	 * @param  $data　POIデータ
	 * @param  $xml_file　XMLファイル名（パスは付けない）
	 */
	function output($data,$xml_file){
		
		//出力データを生成する。
		$odt=$this->createOutputData($data);
		
		// MIMEタイプの設定
		header("Content-Type: application/octet-stream");
		
		// ファイル名の表示
		header("Content-Disposition: attachment; filename=$xml_file");
		
		// データの出力
		for ($i=0;$i<count($odt);$i++){
			echo($odt[$i])."\n";
			
		}
		
	}
	
	//出力データを生成する。
	private function createOutputData($data){
		
		$strCode = 'utf-8';
		$title='人気のある場所情報一覧';
		$strEntName='hotspot';
		
		//ヘッダーを追加。
		$odt[count($odt)]="<?xml version=\"1.0\" encoding=\"".$strCode."\"?>";
		$odt[count($odt)]='<rss version="2.0" '.
							'xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#" '.
							'xmlns:georss="http://www.georss.org/georss" '.
							' >';
		
		//レコードの件数分、以下の処理を繰り返す。
		foreach ((array)$data as $rec){
			
			//	エンティティ名を追加
			$odt[count($odt)]='    <'.$strEntName.'>';
			
			//フィールドの件数分、以下の処理を繰り返す。
			foreach ($rec as $key => $val){
				
				//▼フィールドタグでくくったデータを追加。XMLで使えない文字はサニタイズする。
				if($key=='geo:Point'){
					$odt[count($odt)]='        <'.$key.'>'.$val.'</'.$key.'>';
				}else{
					$odt[count($odt)]='        <'.$key.'>'.htmlspecialchars($val).'</'.$key.'>';
				}
			}
			
			//エンティティ閉を追加
			$odt[count($odt)]='    </'.$strEntName.'>';
		}
		
		//タイトル閉を追加
		$odt[count($odt)]='</rss>';
		
		return  $odt;
		
	}
	
}

?>