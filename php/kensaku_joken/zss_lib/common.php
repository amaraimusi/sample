<?php




define('DEBUG_FILE_NAME','a_debug.log');
define('LOG2_FN','a_log.log');
define('ERR_FN','a_err.log');

/**
 * 共通メソッドを提供<br/>
 * 
 * 2011/7/13 	debugDataを追加<br/>
 * 2011/8/11 	getSerial追加
 * 2011/8/19　	バグ修正
 * 2011/9/6		sprintf_sqlを追加
 * 2011/9/13	ログ出力関連を修正
 * 2011/9/30	dateToday,dateTimeNow,timeNowを追加
 * 2011/10/03	dateToday,dateTimeNow,timeNowをdateEx,dateTimeEx,timeExに変更
 * 2011/10/11	echoArrayとechoDataを追加。
 * 2011/11/2	file_existsExとunlinkExを追加
 * 2011/11/4	renameExを追加
 * 2011/12/5	debugTree,echoTreeメソッドを追加
 * 2012/01/11	標準バージョンにする。
 * 2012/01/13	array_merge_exを追加
 * 2013/08/12	getVersionZssLibを追加
 */

/**
 * zss_libのバージョン情報を取得
 * @return バージョン番号
 */
function getVersionZssLib(){
	return 2.4;
}

/**
 * SQLクエリー用のsprintf.サニタイズも自動的に行ってくれる。使い方はsprintfと同じ。
 * @param  $format
 * @param  $args　
 * @return 
 */
function sprintf_sql($format, $args, $_){
	
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
function getSerial(){
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
function log2( $value) {
	log0('a_log2',$vaule,LOG2_FN);
//	$log=LoggerOne::getInstance();
//	$log->prints($value, DEBUG_FILE_NAME);
	
}

/**
 * デバッグログ出力
 * @param  String $value　デバッグする文字列
 */
function debug( $value) {
	log0('a_debug',$value,DEBUG_FILE_NAME);

}

//基本ログ出力。リクエストのたびにログはクリアされる。
function log0($logKey,$value,$fn){
	if($_REQUEST[$logKey]==null){
		$_REQUEST[$logKey]=true;
		if(file_exists($fn)){
	
			$handle = fopen($fn, "w");
			//▼PHP ver 5.2以上用
			$now=dateTimeEx()."\n";//本日日付を取得する。
			
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
function debugArray( $ary) {
	//$log=LoggerOne::getInstance();
	
	
	$list;
	

	if($ary==null){
		//$log->prints('nullです。', DEBUG_FILE_NAME);
		debug('nullです');
		return;
	}
	
	if (is_array($ary)==false){
		//$log->prints('配列型でない:'.$data, DEBUG_FILE_NAME);
		debug('配列型でない:');
		return;
	}
	
	foreach ($ary as $key => $val){
		
		$msg="$key=$val";
		//$log->prints($msg, DEBUG_FILE_NAME);
		debug($msg);
	}
		
}

/**
 * 配列用echo
 * @param   $ary　配列
 */
function echoArray( $ary) {
	//$log=LoggerOne::getInstance();
	
	
	$list;
	

	if($ary==null){
		//$log->prints('nullです。', DEBUG_FILE_NAME);
		echo('nullです<br>');
		return;
	}
	
	if (is_array($ary)==false){
		//$log->prints('配列型でない:'.$data, DEBUG_FILE_NAME);
		echo('配列型でない:<br>');
		return;
	}
	
	foreach ($ary as $key => $val){
		
		$msg="$key=$val";
		//$log->prints($msg, DEBUG_FILE_NAME);
		echo($msg.'<br>');
	}
		
}

/**
 * データ用デバッグログ出力
 * @param   $data　2次元配列
 */
function debugData( $data) {
	
	
	//$log=LoggerOne::getInstance();
	$list;
	

	if($data==null){
		//$log->prints('nullです。', DEBUG_FILE_NAME);
		debug('nullです。');
		return;
	}
	
	if (is_array($data)==false){
		//$log->prints('データ型でない:'.$data, DEBUG_FILE_NAME);
		debug('データ型でない:');
		return;
	}
		
	foreach ($data as $i=>$ent){
		//$log->prints('◇'.$i, DEBUG_FILE_NAME);
		debug('◇'.$i);
		foreach ((array)$ent as $key => $val){
			//echo("$key=$val"); 
			$list[$key]="$key=$val";
		}
		if($list==null){
			$msg='nullです。';
		}else{
			$msg=join(',',$list);
			
		}
		//$log->prints($msg, DEBUG_FILE_NAME);
		debug($msg);
		$list=null;
	}
}

/**
 * データ用echo出力
 * @param   $data　2次元配列
 */
function echoData( $data) {
	
	
	//$log=LoggerOne::getInstance();
	$list;
	

	if($data==null){
		//$log->prints('nullです。', DEBUG_FILE_NAME);
		echo('nullです。<br>');
		return;
	}
	
	if (is_array($data)==false){
		//$log->prints('データ型でない:'.$data, DEBUG_FILE_NAME);
		echo('データ型でない:<br>');
		return;
	}
		
	foreach ($data as $i=>$ent){
		//$log->prints('◇'.$i, DEBUG_FILE_NAME);
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
		//$log->prints($msg, DEBUG_FILE_NAME);
		echo($msg.'<br>');
		$list=null;
	}
}


/**
 * ３重データを出力する（配列の配列の配列）
 * @param $data3
 */
function debugData3fold(&$data3){

	foreach ($data3 as $i=> $data2){
		debug('■■■'.$i);
		debugData($data2);
	}
}



/**
 * エラーログ出力。
 * @param  String $value
 */
function errLog( $value) {
//	$log=LoggerOne::getInstance();
//	$log->prints($value, DEBUG_FILE_NAME);
	log0('a_err',$value,ERR_FN);
}



/**
 * 日本語ファイルも扱えるis_file
 * @param unknown_type $fn
 * @return boolean
 */
function is_file_ex($fn){
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
function is_dir_ex($dn){
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
function dateEx($format='Y-m-d',$strDateTime=null){
	$d=new DateTime($strDateTime);
	$rtn=$d->format($format);
	return $rtn;
}
/**
 * 日付時刻関数。引数を省略すると本日時間を返す。<br />
 * 2011/10/03 新規作成<br />
 */
function dateTimeEx($format='Y-m-d H:i:s',$strDateTime=null){
	$d=new DateTime($strDateTime);
	$rtn=$d->format($format);
	return $rtn;
}
/**
 *時刻関数。引数を省略すると現在時刻を返す。<br />
 * 2011/10/03 新規作成<br />
 */
function timeEx($format='H:i:s',$strDateTime=null){
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
	function file_existsEx($fn){
		$fn=mb_convert_encoding($fn, 'sjis', 'utf-8,sjis,euc_jp,jis');
		return file_exists($fn);
	}
	/**
	 * ファイル削除（拡張版）
	 * 日本語に対応
	 * @param  $fn　削除ファイル名
	 * @return 0：削除失敗		1：削除成功		2:削除対象ファイルが見つからない
	 */
	function unlinkEx($fn,$fileStrCode='sjis'){
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
	function renameEx( $fn1, $fn2 ){
		$fn1=mb_convert_encoding($fn1, 'sjis', 'utf-8,sjis,euc_jp,jis');
		$fn2=mb_convert_encoding($fn2, 'sjis', 'utf-8,sjis,euc_jp,jis');
		$rtn=@rename($fn1,$fn2);
		return $rtn;
	}
	

	/**
	 * ツリー構造データ（多次元配列）のデバッグ。引数は$anyのみに指定すればよい。
	 * @param  $any　ツリー構造データ。　通常の文字列だけでも出力
	 * @param  $lv	  内部利用の引数なので、この引数に値をセットしてはならない。
	 * @param  $key	　同上
	 */
	function debugTree(&$any,$lv=1,$key=null){
		if($any==null){
			debug('nullです。');
			return;
		}
		if (is_array($any)){
			$lv+=1;
			foreach ($any as $key=>&$v){
				echoTree($v,$lv,$key);
			}
		}else{
			if($key!==null){
				$key2='-'.$key;
			}
			debug("{$lv}{$key2} : {$any}<br />\n");
		}
	}
	
	/**
	 * ツリー構造データ（多次元配列）のechoデバッグ。引数は$anyのみに指定すればよい。
	 * @param  $any　ツリー構造データ。　通常の文字列だけでも出力
	 * @param  $lv	  内部利用の引数なので、この引数に値をセットしてはならない。
	 * @param  $key	　同上
	 */
	function echoTree(&$any,$lv=1,$key=null){
		if($any==null){
			echo('nullです。<br />');
			return;
		}
		if (is_array($any)){
			$lv+=1;
			foreach ($any as $key=>&$v){
				echoTree($v,$lv,$key);
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
	function debugDataEx(&$data,$keyJS=null){
		
		$keys=explode(',', $keyJS);
		
		$list;
		
		if($data==null){
			//$log->prints('nullです。', DEBUG_FILE_NAME);
			debug('nullです。');
			return;
		}
		
		if (is_array($data)==false){
			//$log->prints('データ型でない:'.$data, DEBUG_FILE_NAME);
			debug('データ型でない:');
			return;
		}
			
		foreach ($data as $i=>$ent){
			//$log->prints('◇'.$i, DEBUG_FILE_NAME);
			debug('◇'.$i);
			foreach ($keys as $key){
				$list[$key]="{$key}={$ent[$key]}";
			}

			if($list==null){
				$msg='nullです。';
			}else{
				$msg=join(',',$list);
				
			}
			//$log->prints($msg, DEBUG_FILE_NAME);
			debug($msg);
			$list=null;
		}
	}
	
	

/**
 * 本日日付を取得する。2038年対応版
 * @param  $format_str
 */
function dateToday($format_str='Y/m/d'){
	$today=new DateTime();
	$rtn=$today->format($format_str);
	return $rtn;
}
/**
 * 本日日付時刻を取得する。2038年対応版
 * @param  $format_str
 */
function dateTimeNow($format_str='Y/m/d h:i:s'){
	$today=new DateTime();
	$rtn=$today->format($format_str);
	return $rtn;
}
/**
 * 現在時刻を取得する。2038年対応版
 * @param  $format_str
 */
function timeNow($format_str='h:i:s'){
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
function &array_merge_ex(&$ary1,&$ary2){
	
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

?>