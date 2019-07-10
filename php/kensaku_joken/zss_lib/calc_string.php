<?php
require_once 'common.php';
/**
 * 文字列汎用加工クラス
 * @author uehara
 * @date 2010/10/22
 */
class CalcString{
	
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['CalcString']){
			$obj=new CalcString();
			$_REQUEST['CalcString']=$obj;
		}else{
			$obj=$_REQUEST['CalcString'];
		}
		
		return $obj;

	}
	
	/**
	 * 固定長文字列に変換する。
	 * @param  $str　データ文字列
	 * @param  $len 固定文字数
	 * @param  $block 文字数をそろえるために、データ文字列の先頭につける文字。省略時は全角スペース
	 * @param  $code　文字コード。デフォルトはutf8
	 * @return 固定長文字列
	 */
	public function convertFixedLength($str,$len,$block="　",$code='utf8'){
		$len2=mb_strlen($str,'utf8');
		
		$len3=$len-$len2;
		for ($i=0;$i<$len3;$i++){
			$cns.=$block;
			
		}
		
		return $cns.$str;
		
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
	 * 左から印文字を探し、見つかった場所から右側の文字列を返す。（印文字は含めず）
	 * 検索文字列が存在しない場合は、対象文字列をそのまま返す。
	 * 検索文字列が先頭にあった場合も、対象文字列をそのまま返す。
	 * @param  $str　対象文字列
	 * @param  $mark　印文字
	 * @return string　
	 */
	function stringRight($str,$mark){
		$a=mb_strpos($str,$mark,0,'utf8');
		if(!$a){return $str;}
		$len=mb_strlen($str,'utf8');
		$rtn=mb_substr($str,$a+1,$len,'utf8');
		
		return $rtn;
	}
}
?>