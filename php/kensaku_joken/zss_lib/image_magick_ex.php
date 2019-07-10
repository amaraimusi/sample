<?php
require_once 'common.php';
/**
 * ImageMagickを利用して画像変換を行う。<br>
 * ※ImageMagickがサーバーにインストールされている必要がある。<br>
 * 2012/1/16	新規作成<br>
 *
 */
class ImageMagickEx{
	
	///モード 1:ImageMagickクラスを利用,0:system関数でコマンドを直接呼び出す（さくらサーバー用）
	var $m_mode=0;
	
	
	/**
	 * 画像変換。形式とサイズを変更できる。
	 * 拡張子を変更すると画像形式も自動変換する。
	 * @param  $fn1		変更前ファイル名
	 * @param  $fn2		変更後ファイル名
	 * @param  $width		 変更後サイズ
	 * @param  $height　変更後サイズ
	 */
	function convertImage($fn1,$fn2,$width,$height){
		

		//▼ImageMagickクラスを利用
		if ($this->m_mode==1){

			$this->convertImageUseImgMgckClass($fn1,$fn2,$width,$height);
			
		//▼system関数でコマンドを直接呼び出す（さくらサーバー用）	
		}else{

			$this->convertUseSystem($fn1,$fn2,$width,$height);
			
		}
		
	}
	
	private function convertImageUseImgMgckClass($fn1,$fn2,$width,$height){
		$im = new imagick( $fn1 );

		//$im->thumbnailImage( 200, 0);
		if($width!=null && $height !=null){
			$im->thumbnailImage($width, $height);
		}
		// write to disk
		$im->writeImage( $fn2 );
	}
	
	private function convertUseSystem($fn1,$fn2,$width,$height){
		system("convert -geometry {$width}x{$height} {$fn1} {$fn2}");
	}
	
	
}