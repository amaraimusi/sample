<?php
require_once 'common.php';

/**
 * 汎用入力チェッククラス
 * @author uehara
 * @date 2010/10/25
 * 2011/07/14 数値系チェックから文字長チェックを削除
 * 2011/07/22 isIntEx修正
 * 2011/07/26 is_rangeバグ修正
 * 2011/11/29 is_hankakuAlf,is_hankakuAlfPlus,is_hankakuAlfFileSign追加
 * 2013/08/02 時刻関連の入力チェックメソッドを幾つか追加。
 */ 
class InputCheck{
	
	/**
	 * 汎用テキストチェック。
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isTextEx1($str,$len,$reqFlg){
		
		//文字数チェック
		$ln=mb_strlen($str,'utf8');
	
		if($ln>$len){
			return false;
		}

		//必須入力チェック
		if($reqFlg){
			if($str===null || $str===''){
			
				return false;
			}
		}
		
		return true;
		
	}
	
	
	/**
	 * 数値チェック。
	 * 
	 * 数値チェックを行う。（小数点、負もＯＫ）
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isNumEx($str,$len,$reqFlg){

		//数値チェック		
		if(is_numeric($str)==false){
			return false;
		}
		
		
		//必須入力チェック
		if($reqFlg){
			if(isSet($str)==false || $str==''){
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * 正数チェック。
	 * 
	 * 数値チェックを行う。（小数点、負は不可）
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isPNumEx($str,$len,$reqFlg){

		//数値チェック		
		if($this->isPNum($str)==false){
			return false;
		}
		
		
		//必須入力チェック
		if($reqFlg){
			if(isSet($str)==false || $str==''){
				return false;
			}
		}
		
		return true;
	}
	

	/**
	 * 整数チェック。
	 * 
	 * 数値チェックを行う。（小数点不可、負はＯＫ）
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isIntEx($str,$len,$reqFlg){
		
		//▼必須入力チェック。
		if($str==null ||  $str==''){
			if($reqFlg==true){
				return false;
			}else{
				return true;
			}
		}

		//▼整数チェック		
		if($this->isInt($str)==false){
			return false;
		}
		
		return true;
	}
	
	
	
	/**
	 * 日付チェック。閏年対応にも対応。（Y/M/DかY-M-D)
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数 使いません。
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isDateEx($str,$len=null,$reqFlg){
		
		
		$str=trim($str);
		
		//空値且つ、必須入力がnullであれば、TRUEを返す。
		if(!$str && !$reqFlg){
			return true;
		}
		
		//日付チェック		
		if($this->isDate($str)==false){
			return false;
		}
		

		
		return true;
	}	
	
		/**
	 * 時刻チェック。  h-i-s,h:i:s,hhiiss型に対応
	 * @param $str 対象文字列
	 * @param $len　制限文字数 使いません。
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isTimeEx($str,$len=null,$reqFlg){
		
		
		$str=trim($str);
		
		//空値且つ、必須入力がnullであれば、TRUEを返す。
		if(!$str && !$reqFlg){
			return true;
		}

		//時刻チェック		
		if($this->isTime_his($str)==false){
			return false;
		}
		
		return true;
	}	
	
			/**
	 * 日時チェック。 yyyymmddhhiidd,y/m/d h:i:s,y-m-d h:i:s型に対応
	 * @param $str 対象文字列
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isDatetimeEx($str,$reqFlg){
		
		//トリミングをする。
		$str=trim($str);
		
		//空値且つ、必須入力がnullであれば、TRUEを返す。
		if(!$str && !$reqFlg){
			return true;
		}
		
		//日時入力チェック
		$ret=$this->isDate($str);
		
		return $ret;
	}	
	
	/**
	 * 左から印文字を探し、見つかった場所から左側の文字列を返す。（印文字は含めず）
	 * 検索文字列が存在しない場合は、対象文字列をそのまま返す。
	 * 検索文字列が先頭にあった場合も、対象文字列をそのまま返す。
	 * @param  $str　対象文字列
	 * @param  $mark　印文字列
	 * @return string
	 */
	function stringLeft($str,$mark){
		$a=mb_strpos($str,$mark,0,'utf8');
		if(!$a){return $str;}
		$len=mb_strlen($str,'utf8');
		$rtn=mb_substr($str,0,$a,'utf8');
		
		return $rtn;
	}
	
	
	/**
	 * メールアドレスチェック。
	 * 文字数チェックを行う。
	 * 必須入力チェックを行う。
	 * @param $str 対象文字列
	 * @param $len　制限文字数
	 * @param $reqFlg 必須入力のチェックも行う場合はtrueとする。
	 * @return boolean
	 */
	function isMailEx($str,$len,$reqFlg){

		//日付チェック		
		if($this->isMail($str)==false){
			return false;
		}
		
		//文字の長さチェック
		$ln=mb_strlen($str);
		if($ln>$len){
			return false;
		}
		
		//必須入力チェック
		if($reqFlg){
			if(isSet($str)==false || $str==''){
				return true;
			}
		}
		
		return true;
	}
	

	/**
	 * メールアドレスチェック
	 * @param  $str　メールアドレス文字列
	 * @return boolean
	 */
	function isMail($str){
		
		$ary=split("@",$str);
		if(sizeof($ary)!=2){

			return false;
		}else{
			if (mb_strlen($ary[0],'utf8')<1 || mb_strlen($ary[1],'utf8')<4){
				return false;
			}
		}
		
		return true;
		
	}
	
	

	/**
	 * 日時チェック 閏年対応
	 * @param  $strDate　日付文字列
	 * @return boolean　可否
	 */
	function isDate($strDateTime){
		
		
		//トリミング
		$strDateTime=trim($strDateTime);
		
		//空であればエラー
		if (!$strDateTime){return false;}
		
		
		//日時を　年月日時分秒に分解する。
		$aryA =preg_split( '|[ /:_-]|', $strDateTime );
		foreach ($aryA as $key => $val){
			
			//▼正数以外が混じっているば、即座にfalseを返して処理終了
			if ($this->isPNum($val)==false){
				return false;
			}
			$aryA[$key]=trim($val);
		}
		
		//▼グレゴリオ暦と整合正が取れてるかチェック。（閏年などはエラー）
		if(!checkdate($aryA[1],$aryA[2],$aryA[0])){
			return false;
		}
		
		
		//▼時刻の整合性をチェック
		if ($this->checkTime($aryA[3], $aryA[4], $aryA[5])==false){
			return false;
		}
		
		return true;
		
		
	}
	
	/**
	 * hhiiss型の時刻チェック
	 * @param $v	時刻文字列
	 * @return true:false
	 */
	function isTime_hhiiss($v){
		
		//文字数が6でなければfalseを返す。
		if(mb_strlen($v)!=6){
			return false;
		}
		
		//文字が数値でなければ、falseを返す。
		if($this->isInt($v)==false){
			return false;
		}
		
		//2文字ずつ分割し、時分秒を取得。
		$ary = str_split($v,2);
		
		//時刻の整合性をチェックする。
		$ret =$this->checkTime($ary[0],$ary[1],$ary[2]);
		
		return $ret;
	}
	
	/**
	 * hhii型の時刻チェック（時分のみ）
	 * @param $v	時刻文字列
	 * @return true:false
	 */
	function isTime_hhii($v){
		
		//文字数が6でなければfalseを返す。
		if(mb_strlen($v)!=4){
			return false;
		}
		
		//文字が数値でなければ、falseを返す。
		if($this->isInt($v)==false){
			return false;
		}
		
		//2文字ずつ分割し、時分を取得。
		$ary = str_split($v,2);
		
		//時刻の整合性をチェックする。
		$ret =$this->checkTime($ary[0],$ary[1],0);
		
		return $ret;
	}
	
	/**
	 * h:i:s,h-i-s,hhiiss型の時刻チェック
	 * @param $v	時刻文字列
	 * @return true:false
	 */
	function isTime_his($v){
		//区切りが「：」である場合。
		if(strstr($v,':')){
			$dimi=':';
		}
		
		//区切りが「-」である場合。
		elseif(strstr($v,'-')){
			$dimi='-';
			
		}
		
		//区切りがない場合。
		else{
			$ret=$this->isTime_hhiiss($v);
		}
		
		//区切り文字がnullでない場合、以下の処理を行う。
		if($dimi!=null){
			$ary=explode($dimi,$v);
			
			//時刻の整合性をチェックする。
			$ret =$this->checkTime($ary[0],$ary[1],$ary[2]);
		
		}
	
		return $ret;
	}
	
	/**
	 * 時刻の整合性をチェック
	 * @param  $hou　時
	 * @param  $min　分
	 * @param  $sec　秒
	 * @return boolean　可否
	 */
	function checkTime($hou,$min,$sec){
		
		
		if($hou < 0 || $hou > 23){
			
			return false;
		}
		if($min < 0 || $min > 59){
			
			return false;
		}
		if($sec < 0 || $sec > 59){
			
			return false;
		}
		
		return true;
	}
	
	
	
	/**
	 * 正数チェック
	 * @param  $str　正数文字列
	 * @return boolean
	 */
	function isPNum($str){
		if (preg_match("/^[0-9]+$/", $str)) {
		    return true;
		} else {
		    return false;
		} 
	}
	
	/**
	 * 整数チェック
	 * @param  $str　整数文字列
	 * @return boolean
	 */
	function isInt($str){
		if (preg_match("/^-?[0-9]+$/", $str)) {
		    return true;
		} else {
		    return false;
		} 
	}
	
	
	/**
	 * 値が範囲値ないであるかチェックする。
	 * valが文字列である場合、falseを返す。
	 * valが数値且つ、最小値と最大値のいずれかがnullの場合はtrueを返す。
	 * @param 対象値 $val
	 * @param 最小値 $minvalue
	 * @param 最大値 $maxvalue
	 */
	function is_range($val,$minvalue,$maxvalue,$req=false){
		
		//▼必須入力チェック。
		if($val==null ||  $val==''){
			if($reqFlg==true){
				return false;
			}else{
				return true;
			}
		}
		
		if (!is_numeric($val)){
			
			return false;
		}
		if($minvalue ===null || $maxvalue ===null){
			
			return true;
		}
		if($val<$minvalue || $val > $maxvalue){
			
	
			return false;
		}
		
		return true;
	}
	
	
	/**
	 * 半角英数字ファイル名許可記号チェック
	 * @param  $str
	 * @return boolean
	 */
	function is_hankakuAlfFileSign(&$str){
		if($str==null){return true;}
		if(preg_match("/^[a-zA-Z0-9$ % ' - _ @ ! ` ( ) ~.]+$/", $str)){
			return true;
		} else {
			return false;
		}
		
	}
	
	/**
	 * 半角英数字チェック
	 * @param unknown_type $str
	 * @return boolean
	 */
	function is_hankakuAlf(&$str){
		if($str==null){return true;}
		if(preg_match("/^[a-zA-Z0-9]+$/", $str)){
			return true;
		} else {
			return false;
		}
		
	}
	/**
	 * 半角英数字「_-」チェック
	 * @param unknown_type $str
	 * @return boolean
	 */
	function is_hankakuAlfPlus(&$str){
		if($str==null){return true;}
		if(preg_match("/^[a-zA-Z0-9._-]+$/", $str)){
			return true;
		} else {
			return false;
		}
		
	}
	



}


?>