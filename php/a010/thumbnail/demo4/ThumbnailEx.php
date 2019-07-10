<?php
/**
 * サムネイル作成の拡張クラス
 * 
 * @note
 * 画像ファイルからサムネイル画像を作成する。
 * 
 * png,jpeg,gifに対応している。
 * MIMEタイプではなく、拡張子からファイルを分類している。(MIMEタイプではバグが発生する）
 * 
 * @date 2016-11-1
 * @version 1.0
 * @author k-uehara
 *
 */
class ThumbnailEx{
	
	
	/**
	 * 画像ファイルからサムネイル画像を作成する
	 * @param string $orig_pfn オリジナル画像のファイル名
	 * @param string $thum_pfn サムネイル画像のファイル名
	 * @param int $thum_width サムネイル画像の横幅
	 * @param int $thum_height サムネイル画像の縦幅
	 */
	public function createThumbnail($orig_pfn,$thum_pfn,$thum_width,$thum_height){

		// 拡張子を取得する
		$info = pathinfo($orig_pfn);
		$ext = $info["extension"];
		$ext = mb_strtolower($ext);

		// オリジナル画像の幅を取得する
		list($orig_width, $orig_height) = getimagesize($orig_pfn);
		
		
		// オリジナル画像のresourceオブジェクトを取得
		$origImg=null;
		if($ext == 'png'){
			$origImg = imagecreatefrompng($orig_pfn);
		}elseif($ext == 'gif'){
			$origImg = imagecreatefromgif($orig_pfn);
		}else{
			$origImg = imagecreatefromjpeg($orig_pfn);
		}
		
		
	
		// サムネイル画像のresourceオブジェクトを取得
		$thumImg = imagecreatetruecolor($thum_width, $thum_height);
	
		// サムネイル画像を作成
		imagecopyresized($thumImg, $origImg, 0, 0, 0, 0,
				$thum_width, $thum_height,
				$orig_width, $orig_height);
	
	
		// サムネイル画像を出力
		if($ext == 'png'){
			imagepng($thumImg,$thum_pfn);
		}elseif($ext == 'gif'){
			imagegif($thumImg,$thum_pfn);
		}else{
			imagejpeg($thumImg,$thum_pfn);
		}
	
		// resourceオブジェクトを破棄する
		imagedestroy($origImg);
		imagedestroy($thumImg);
		

	}
}