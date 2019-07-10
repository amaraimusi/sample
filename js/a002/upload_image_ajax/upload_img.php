<?php
/**
 * 画像ファイルアップロード
 * ★概要
 * 非同期通信を使い、画像をアップロードする。
 * GETリクエストで配置先の画像ファイル名を変更可能。
 * ★履歴
 * 2013/10/11	新規作成
 * 2014/4/23	拡張子チェックとMIMEチェックを追加
 *
 */
		require_once '../../../zss_lib/ADebug.php';
		require_once '../../../zss_lib/GetMimeType.php';


		$imgFn="img/" . $_FILES["upload_file"]["name"];
		$tmp_ary = explode('.', $imgFn);
		$ext = $tmp_ary[count($tmp_ary)-1];
		//拡張子チェックをする。
		if($ext=='jpg' || $ext=='jpeg' || $ext=='jpeg' || $ext=='png' || $ext=='gif'){

			$imgFn='img/bigcat.'.$ext;

			move_uploaded_file($_FILES["upload_file"]["tmp_name"], $imgFn);

//MIMEチェックは現在、不安定であるため使用中止。
// 			//MIMEタイプチェックをする。
// 			$gmt=new GetMimeType();
// 			$mimeType=$gmt->getMime($imgFn);
// 			//$mimeType=finfo_file($imgFn);
// 			$mimeType=$gmt->getfinfo($imgFn);

// 			a_debug('mime='.$mimeType);//■■■□□□■■■□□□■■■□□□

// 			if($mimeType=='image/jpeg' || $mimeType=='image/gif' || $mimeType=='image/png'){

// 				a_debug($imgFn);//■■■□□□■■■□□□■■■□□□
// 			}else{
// 				unlinkEx($imgFn);//画像以外は削除
// 			}

		}else{

		}



    echo $imgFn;


//     function unlinkEx($fn,$fileStrCode='sjis'){
//     	$fn=mb_convert_encoding($fn, $fileStrCode, 'utf-8,sjis,euc_jp,jis');
//     	if(file_exists($fn)==true){
//     		$suc=@unlink($fn);
//     		if($suc==true){
//     			$rtn=1;
//     		}else{
//     			$rtn=0;
//     		}
//     	}else{
//     		$rtn=2;
//     	}

//     	return $rtn;
//     }
?>