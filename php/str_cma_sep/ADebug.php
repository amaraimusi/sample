<?php
error_reporting(E_ALL ^ E_NOTICE);



define('A_DEBUG_FILE_NAME','a_debug.log');
define('A_LOG2_FN','a_log.log');
define('A_ERR_FN','a_err.log');

/**
 * 共通メソッドを提供<br/>
 *
 * 2011/7/13 	debugDataを追加<br/>
 * 2011/8/11 	a_getSerial追加
 * 2011/8/19　	バグ修正
 * 2011/9/6		a_sprintf_sqlを追加
 * 2011/9/13	ログ出力関連を修正
 * 2011/9/30	a_dateToday,a_dateTimeNow,a_timeNowを追加
 * 2011/10/03	a_dateToday,a_dateTimeNow,a_timeNowをa_dateEx,a_dateTimeEx,a_timeExに変更
 * 2011/10/11	a_echoArrayとa_echoDataを追加。
 * 2011/11/2	a_file_existsExとa_unlinkExを追加
 * 2011/11/4	a_renameExを追加
 * 2011/12/5	a_debugTree,a_echoTreeメソッドを追加
 * 2012/01/11	標準バージョンにする。
 * 2012/01/13	a_array_merge_exを追加
 * 2013/08/12	getVersionZssLibを追加
 * 2013/10/08 	a_actHtmlMarkを追加
 * 2014/05/21 	a_debugTreeを修正
 */



/**
 * SQLクエリー用のsprintf.サニタイズも自動的に行ってくれる。使い方はsprintfと同じ。
 * @param  $format
 * @param  $args　
 * @return
 */
function a_sprintf_sql($format, $args, $_){

	$ary=func_get_args($args);
	array_shift($ary);
	foreach ($ary as &$val){
		$val=mysql_real_escape_string($val);
	}

	$s=vprintf($format,$ary);


	return $s;

}

/**
 * 連続番号を取得。（１リクエスト期間中の連続番号）
 */
function a_getSerial(){
	$sn=$_REQUEST['debug_serial_no'];
	if ($sn===null){
		$sn=0;
	}else{
		$sn++;
	}
	$_REQUEST['debug_serial_no']=$sn;
	return $sn;
}




/**
 * ログ出力
 * @param unknown_type $value
 */
function a_log2( $value) {
	a_log0('a_log2',$vaule,A_LOG2_FN);
//	$log=LoggerOne::getInstance();
//	$log->prints($value, A_DEBUG_FILE_NAME);

}

/**
 * デバッグログ出力
 * @param  String $value　デバッグする文字列
 */
function a_debug( $value) {
	a_log0('a_debug',$value,A_DEBUG_FILE_NAME);

}

//基本ログ出力。リクエストのたびにログはクリアされる。
function a_log0($logKey,$value,$fn){
	if(empty($_REQUEST[$logKey])){
		$_REQUEST[$logKey]=true;
		if(file_exists($fn)){

			$handle = fopen($fn, "w");
			//▼PHP ver 5.2以上用
			$now=a_dateTimeEx()."\n";//本日日付を取得する。

			//▼PHP　ver 5.1以下用
			//$now=date("Y-m-d H:i:s")."\n";//本日日付を取得する。

			fwrite($handle, '■'.$now);
			fclose($handle);

		}

	}


	error_log("$value\n", 3, $fn);
}



/**
 * 配列用デバッグログ出力
 * @param   $ary　配列
 */
function a_debugArray( $ary) {
	//$log=LoggerOne::getInstance();


	$list;


	if($ary==null){
		//$log->prints('nullです。', A_DEBUG_FILE_NAME);
		a_debug('nullです');
		return;
	}

	if (is_array($ary)==false){
		//$log->prints('配列型でない:'.$data, A_DEBUG_FILE_NAME);
		a_debug('配列型でない:');
		return;
	}

	foreach ($ary as $key => $val){

		$msg="$key=$val";
		//$log->prints($msg, A_DEBUG_FILE_NAME);
		a_debug($msg);
	}

}

/**
 * 配列用echo
 * @param   $ary　配列
 */
function a_echoArray( $ary) {
	//$log=LoggerOne::getInstance();


	$list;


	if($ary==null){
		//$log->prints('nullです。', A_DEBUG_FILE_NAME);
		echo('nullです<br>');
		return;
	}

	if (is_array($ary)==false){
		//$log->prints('配列型でない:'.$data, A_DEBUG_FILE_NAME);
		echo('配列型でない:<br>');
		return;
	}

	foreach ($ary as $key => $val){

		$msg="$key=$val";
		//$log->prints($msg, A_DEBUG_FILE_NAME);
		echo($msg.'<br>');
	}

}

/**
 * データ用デバッグログ出力
 * @param   $data　2次元配列
 */
function a_debugData( $data) {


	//$log=LoggerOne::getInstance();
	$list;


	if($data==null){
		//$log->prints('nullです。', A_DEBUG_FILE_NAME);
		a_debug('nullです。');
		return;
	}

	if (is_array($data)==false){
		//$log->prints('データ型でない:'.$data, A_DEBUG_FILE_NAME);
		a_debug('データ型でない:');
		return;
	}

	foreach ($data as $i=>$ent){
		//$log->prints('◇'.$i, A_DEBUG_FILE_NAME);
		a_debug('◇'.$i);
		foreach ((array)$ent as $key => $val){
			//echo("$key=$val");
			$list[$key]="$key=$val";
		}
		if($list==null){
			$msg='nullです。';
		}else{
			$msg=join(',',$list);

		}
		//$log->prints($msg, A_DEBUG_FILE_NAME);
		a_debug($msg);
		$list=null;
	}
}

/**
 * データ用echo出力
 * @param   $data　2次元配列
 */
function a_echoData( $data) {


	//$log=LoggerOne::getInstance();
	$list;


	if($data==null){
		//$log->prints('nullです。', A_DEBUG_FILE_NAME);
		echo('nullです。<br>');
		return;
	}

	if (is_array($data)==false){
		//$log->prints('データ型でない:'.$data, A_DEBUG_FILE_NAME);
		echo('データ型でない:<br>');
		return;
	}

	foreach ($data as $i=>$ent){
		//$log->prints('◇'.$i, A_DEBUG_FILE_NAME);
		echo('◇'.$i.'<br>');
		foreach ((array)$ent as $key => $val){
			//echo("$key=$val");
			$list[$key]="$key=$val";
		}
		if($list==null){
			$msg='nullです。<br>';
		}else{
			$msg=join(',',$list);

		}
		//$log->prints($msg, A_DEBUG_FILE_NAME);
		echo($msg.'<br>');
		$list=null;
	}
}


/**
 * ３重データを出力する（配列の配列の配列）
 * @param $data3
 */
function a_debugData3fold(&$data3){

	foreach ($data3 as $i=> $data2){
		a_debug('■■■'.$i);
		a_debugData($data2);
	}
}



/**
 * エラーログ出力。
 * @param  String $value
 */
function a_errLog( $value) {
//	$log=LoggerOne::getInstance();
//	$log->prints($value, A_DEBUG_FILE_NAME);
	a_log0('a_err',$value,A_ERR_FN);
}



/**
 * 日本語ファイルも扱えるis_file
 * @param unknown_type $fn
 * @return boolean
 */
function a_is_file_ex($fn){
	$fn=mb_convert_encoding($fn,'SJIS','UTF-8');
	if (is_file($fn)){
		return true;
	}else{
		return false;
	}
}


/**
 * 日本語ファイルも扱えるis_dir
 * @param unknown_type $dn
 * @return boolean
 */
function a_is_dir_ex($dn){
	$dn=mb_convert_encoding($dn,'SJIS','UTF-8');
	if (is_dir($dn)){
		return true;
	}else{
		return false;
	}
}



/**
 *日付関数。引数を省略すると本日を返す。<br />
 * 2011/10/03 新規作成<br />
 */
function a_dateEx($format='Y-m-d',$strDateTime=null){
	$d=new DateTime($strDateTime);
	$rtn=$d->format($format);
	return $rtn;
}
/**
 * 日付時刻関数。引数を省略すると本日時間を返す。<br />
 * 2011/10/03 新規作成<br />
 */
function a_dateTimeEx($format='Y-m-d H:i:s',$strDateTime=null){
	$d=new DateTime($strDateTime);
	$rtn=$d->format($format);
	return $rtn;
}
/**
 *時刻関数。引数を省略すると現在時刻を返す。<br />
 * 2011/10/03 新規作成<br />
 */
function a_timeEx($format='H:i:s',$strDateTime=null){
	$d=new DateTime($strDateTime);
	$rtn=$d->format($format);
	return $rtn;
}

	/**
	 * ファイルサーチ（拡張版）
	 * 日本語に対応
	 * @param $fn　削除ファイル名
	 * @return boolean
	 */
	function a_file_existsEx($fn){
		$fn=mb_convert_encoding($fn, 'sjis', 'utf-8,sjis,euc_jp,jis');
		return file_exists($fn);
	}
	/**
	 * ファイル削除（拡張版）
	 * 日本語に対応
	 * @param  $fn　削除ファイル名
	 * @return 0：削除失敗		1：削除成功		2:削除対象ファイルが見つからない
	 */
	function a_unlinkEx($fn,$fileStrCode='sjis'){
		$fn=mb_convert_encoding($fn, $fileStrCode, 'utf-8,sjis,euc_jp,jis');
		if(file_exists($fn)==true){
			$suc=@unlink($fn);
			if($suc==true){
				$rtn=1;
			}else{
				$rtn=0;
			}
		}else{
			$rtn=2;
		}

		return $rtn;
	}

	/**
	 * ファイル名(ディレクトリ名）変更（拡張版）
	 * 日本語に対応
	 * @param  $fn1　	変更前のファイル名（ディレクトリ名）
	 * @param  $fn2		変更後のファイル名（ディレクトリ名）
	 * @return boolean	ファイル名の変更に成功した場合：TRUE
	 */
	function a_renameEx( $fn1, $fn2 ){
		$fn1=mb_convert_encoding($fn1, 'sjis', 'utf-8,sjis,euc_jp,jis');
		$fn2=mb_convert_encoding($fn2, 'sjis', 'utf-8,sjis,euc_jp,jis');
		$rtn=@rename($fn1,$fn2);
		return $rtn;
	}



	/**
	 * リー構造データ（多次元配列）のデバッグ。引数は$anyのみに指定すればよい。
	 * @param  $any	ツリー構造データ。
	 * @param  $kkk	内部利用の引数なので、この引数に値をセットしてはならない。
	 */
	function a_debugTree(&$any,$kkk=''){
		if($any==null){
			a_debug('nullです。');
			return;
		}
		if (is_array($any)){
			foreach ($any as $key=>&$v){
				$kkk2=$kkk.' - '.$key;
				a_debugTree($v,$kkk2);
			}
		}else{

			a_debug("{$kkk} : {$any}");
		}
	}

	/**
	 * ツリー構造データ（多次元配列）のechoデバッグ。引数は$anyのみに指定すればよい。
	 * @param  $any　ツリー構造データ。　通常の文字列だけでも出力
	 * @param  $lv	  内部利用の引数なので、この引数に値をセットしてはならない。
	 * @param  $key	　同上
	 */
	function a_echoTree(&$any,$lv=1,$key=null){
		if($any==null){
			echo('nullです。<br />');
			return;
		}
		if (is_array($any)){
			$lv+=1;
			foreach ($any as $key=>&$v){
				a_echoTree($v,$lv,$key);
			}
		}else{
			if($key!==null){
				$key2='-'.$key;
			}
			echo("{$lv}{$key2} : {$any}<br />\n");
		}
	}

	/**
	 * 拡張データデバッグ
	 * 	キーの指定が可能
	 * @param  $data	テスト対象データ
	 * @param  $keyJS		表示するキーを指定。複数存在する場合はコンマで連結。省略時はすべてのキーが対象となる。
	 */
	function a_debugDataEx(&$data,$keyJS=null){

		$keys=explode(',', $keyJS);

		$list;

		if($data==null){
			//$log->prints('nullです。', A_DEBUG_FILE_NAME);
			debug('nullです。');
			return;
		}

		if (is_array($data)==false){
			//$log->prints('データ型でない:'.$data, A_DEBUG_FILE_NAME);
			debug('データ型でない:');
			return;
		}

		foreach ($data as $i=>$ent){
			//$log->prints('◇'.$i, A_DEBUG_FILE_NAME);
			debug('◇'.$i);
			foreach ($keys as $key){
				$list[$key]="{$key}={$ent[$key]}";
			}

			if($list==null){
				$msg='nullです。';
			}else{
				$msg=join(',',$list);

			}
			//$log->prints($msg, A_DEBUG_FILE_NAME);
			debug($msg);
			$list=null;
		}
	}



/**
 * 本日日付を取得する。2038年対応版
 * @param  $format_str
 */
function a_dateToday($format_str='Y/m/d'){
	$today=new DateTime();
	$rtn=$today->format($format_str);
	return $rtn;
}
/**
 * 本日日付時刻を取得する。2038年対応版
 * @param  $format_str
 */
function a_dateTimeNow($format_str='Y/m/d h:i:s'){
	$today=new DateTime();
	$rtn=$today->format($format_str);
	return $rtn;
}
/**
 * 現在時刻を取得する。2038年対応版
 * @param  $format_str
 */
function a_timeNow($format_str='h:i:s'){
	$today=new DateTime();
	$rtn=$today->format($format_str);
	return $rtn;
}


/**
 * 配列を合成する。
 * 合成する配列がnullでもエラーがでないようにしてある。
 * @param  $ary1	配列１
 * @param  $ary2	配列２
 * @return 合成後の配列
 */
function &a_array_merge_ex(&$ary1,&$ary2){

	if($ary1!=null && $ary2!=null){
		$ary=array_merge($ary1,$ary2);
		return $ary;
	}
	if($ary1==null){
		$ary=&$ary2;
		return $ary;
	}


	if($ary2==null){
		$ary=&$ary1;
		return $ary;
	}


}

//HTMLマークアップを有効化
function a_actHtmlMark($str){
	$str=str_replace("amp;",'',$str);
	$str=str_replace('&lt;','<',$str);
	$str=str_replace('&gt;','>',$str);
	return $str;
}

?>