<?php


$fn="日本語.pdf";
$ffn="tmp2/".$fn;

$ffn2 ='dummy2/'. $fn;//コピー先。dummy2は未作成でも良い。


//拡張コピー。存在しないディレクトリも自動生成し、日本語ファイル名にも対応。
copyEx($ffn,$ffn2);

echo $ffn."<br>";
echo $ffn2."<br>";
echo "ok";


/**
 * 拡張コピー　存在しないディテクトリも自動生成
 * 日本語ファイルに対応
 * @param コピー元ファイル名 $sourceFn
 * @param コピー先ファイル名 $copyFn
 */
function copyEx($sourceFn,$copyFn){

	//フルファイル名からパスを取得する。
	$di=dirname($copyFn);


	//コピー先ファイル名とコピー元ファイル名が同名であれば、Nullを返して処理を終了
	if($sourceFn==$copyFn){
		return null;
	}

	//ディレクトリが存在するかチェック。
	if (is_dir_ex($di)){

		//存在するならそのままコピー処理
		$sourceFn=mb_convert_encoding($sourceFn,'SJIS','UTF-8');
		$copyFn=mb_convert_encoding($copyFn,'SJIS','UTF-8');
		copy($sourceFn,$copyFn);
	}else{


		//存在しない場合。
		//パスを各ディレクトリに分解し、ディレクトリ配列をして取得する。
		$ary=explode('/', $di);
		//ディレクトリ配列の件数分以下の処理を繰り返す。
		$iniFlg=true;
		foreach ($ary as $key => $val){

			//作成したディレクトリが存在しない場合、ディレクトリを作成
			if ($iniFlg==true){
				$iniFlg=false;
				$dd=$val;
			}else{
				$dd.='/'.$val;

			}

			if (!(is_dir_ex($dd))){
				mkdir($dd);//ディレクトリを作成
			}

		}

		$sourceFn=mb_convert_encoding($sourceFn,'SJIS','UTF-8');
		$copyFn=mb_convert_encoding($copyFn,'SJIS','UTF-8');
		copy($sourceFn,$copyFn);//ファイルをコピーする。


	}
}


/**
 * 日本語ファイルも扱えるis_dir
 * @param  $dn
 * @return boolean
 */
function is_dir_ex($dn){
	$dn=mb_convert_encoding($dn,'SJIS','UTF-8');
	if (is_dir($dn)){
		return true;
	}else{
		return false;
	}
}