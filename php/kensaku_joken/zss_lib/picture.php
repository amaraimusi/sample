<?php

require_once 'common.php';

/**
 * 汎用画像処理クラス
 * @author uehara
 * @date 2010/10/25
 */
class Picture{
	

	/**
	 * 本当の拡張子のファイル名に変換する。（MIMEタイプの拡張子にする。）
	 * @param string $picFn 画像ファイル名
	 * @return string 本当の拡張子のファイル名
	 */
	function getRealExtensionFIleName($picFn){
		
		//▼MIMEタイプを取得する。
		$imageInfo = getimagesize($picFn);
		$mimeType = image_type_to_mime_type($imageInfo[2]);
		$mimeType=strtolower($mimeType);
		
		$ext=str_replace('image/', '', $mimeType);
		
		$path_parts = pathinfo($picFn);
		$newFn= $path_parts['dirname'].'/'.$path_parts['filename'].'.'.$ext;//拡張子の取得
		//image/
		return $newFn;
	}
	
	
	
	/**
	 * 拡張子とMIMEタイプが一致するかチェックする。
	 * @param string $picFn 画像ファイル名
	 * @return boolean
	 */
	function fakePicCheck($picFn){
		
		
		//▼拡張子を取得する。
		$path_parts = pathinfo($picFn);
		$ext= $path_parts['extension'];//拡張子の取得
		$ext=strtolower($ext);
		
		//▼JPGの拡張子をjpegで統一
		if ($ext=='jpg'){
			$ext='jpeg';
		}
		
		//▼MIMEタイプを取得する。
		$imageInfo = getimagesize($picFn);
		$mimeType = image_type_to_mime_type($imageInfo[2]);
		$mimeType=strtolower($mimeType);
		
		//▼比較
		$flg=false;
		if (strstr($mimeType,$ext)){
			$flg=true;
		}
			
		return $flg;
	}
	
	//
	//
	/**
	 * 画像の種類を変更したり、サイズを変更することができる。（gif,png,jpgに対応）
	 * $outputFileNameが空である場合、直接画像表示をする。動的な画像生成となる。
	 * $outputFileNameを指定した場合は、この名前でファイルを作成する。
	 * $widthあるいは$heightのうちいずれか一方だけnullである場合、null値はnull出ない側の割合にあわせる。
	 * @param string $picFn 画像ファイル名
	 * @param string $ext　変更する拡張子名（省略可）
	 * @param number $width　変更するサイズ（省略可）
	 * @param number $height　変更するサイズ（省略可）
	 * @param string $outputFileName　出力ファイル名（省略時は画像動的生成モードとなる。）
	 * @return 出力ファイル名。
	 */
	function convertPicture($picFn,$ext=null,$width=null,$height=null,$outputFileName=null){
		

		
		//▼サイズのいずれかが空値であった場合、デフォルト
		if(!$width && !$height){
			list($width, $height) = getimagesize($picFn);
			
		}elseif($width && !$height){
			//▼縦のみ空値の場合、横幅の割合に合わせた値をセット
			list($w0, $h0) = getimagesize($picFn);
			$height=$h0*$width/$w0;
		
			
		}elseif(!$width && $height){
			//▼上記の処理の逆
			list($w0, $h0)= getimagesize($picFn);
			$width=$w0*$height/$h0;
			
		}
	

		// サイズを指定して、背景用画像を生成
		$canvas = imagecreatetruecolor($width, $height);
		$path_parts = pathinfo($picFn);
		$ext0= $path_parts['extension'];//拡張子の取得'];//拡張子の取得
		switch ($ext0){
			case 'bmp':
//				$targetImage = "./image.bmp";
//				$image = imagecreatefrombmp($targetImage);
				break;
			case 'gif':
			
				$image = imagecreatefromgif($picFn);
				break;
			case 'png':
			
				$image = imagecreatefrompng($picFn);
				break;
			case 'jpg' || 'jpeg':
				$image = imagecreatefromjpeg($picFn);
				break;
			default:
				break;
		}
		
		
		//▼拡張子が空値であった場合、元画像の拡張子を設定する。
		if(!$ext){
			$ext=$ext0;
		}
		
		// コピー元画像のファイルサイズを取得
		list($image_w, $image_h) = getimagesize($picFn);
		
		//▼出力ファイル名の拡張子を元画像と同じにする。
		if($outputFileName){
			$fnInfo = pathinfo($outputFileName);
			$outputFileName=$fnInfo['dirname'].'/'.$fnInfo['filename'].'.'.$ext;
			
		
		}
		
		
		//▼背景画像に、画像をコピーする
		imagecopyresampled($canvas,  // 背景画像
		                   $image,   // コピー元画像
		                   0,        // 背景画像の x 座標
		                   0,        // 背景画像の y 座標
		                   0,        // コピー元の x 座標
		                   0,        // コピー元の y 座標
		                   $width,   // 背景画像の幅
		                   $height,  // 背景画像の高さ
		                   $image_w, // コピー元画像ファイルの幅
		                   $image_h  // コピー元画像ファイルの高さ
		                  );
		
			
		switch ($ext){
			case 'bmp':
				//header("Content-Type: image/bmp");
				//imagebmp($image);
		    	
				break;
			case 'gif':
				if(!$outputFileName){
					header("Content-Type: image/gif");
				}
				
		    	imagegif($canvas,$outputFileName);
				break;
			case 'png':
				if(!$outputFileName){
					header("Content-Type: image/png");
				}
				
		    	imagepng($canvas,$outputFileName);
				break;
			case 'jpg' || 'jpeg':
				if(!$outputFileName){
					header("Content-Type: image/jpeg");
				}
		    	imagejpeg($canvas,$outputFileName);
				break;
			default:
				break;
		}
		
		// メモリを開放する
		imagedestroy($canvas);
		imagedestroy($image);

		return $outputFileName;
	}
	
	
}
?>