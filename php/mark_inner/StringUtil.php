<?php


	/**
	 * 文字列汎用関数クラス
	 * @author uehara
	 * @date 2010/10/22
	 * @date 2013/08/15	cals_stringからstring_funcモジュールに移植
	 * @date 2014/05/22	stringLeftとstringRightのバグを修正
	 */
class StringUtil{


	/**
	 * ２つの囲み文字に挟まれた文字列を取得する
	 * @param  $str	対象文字列
	 * @param  $s1	囲み文字1
	 * @param  $s2	囲み文字2
	 */
	public function markInner($str,$s1,$s2){

		$s_r=$this->stringRight($str,$s1);

		$s=$this->stringLeft($s_r,$s2);


		return $s;
	}

	/**
	 *
	 * 固定長文字列に変換する。
	 * @param  $str　データ文字列
	 * @param  $len 固定文字数
	 * @param  $block 文字数をそろえるために、データ文字列の先頭につける文字。省略時は全角スペース
	 * @param  $code　文字コード。デフォルトはutf8
	 * @return 固定長文字列
	 */
	function convertFixedLength($str,$len,$block="　",$code='utf8'){



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
		if(!isset($a)){return $str;}
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
		if(!isset($a)){return $str;}
		$len=mb_strlen($str,'utf8');
		$m_l=mb_strlen($mark,'utf8');
		$rtn=mb_substr($str,$a+$m_l,$len,'utf8');

		return $rtn;
	}

	/**
	 * 文字列の末尾の一文字を返す。
	 * @param $str
	 * @return 末尾の一文字
	 */
	function stringLast($str){
		$len=mb_strlen($str,'utf8');
		$rtn=mb_substr($str,$len-1,1,'utf8');
		return $rtn;
	}

	/**
	 * 文字列の先頭の一文字を取得
	 * @param $str
	 * @return 先頭の一文字
	 */
	function stringHead($str){

		$rtn=mb_substr($str,0,1,'utf8');
		return $rtn;

	}

}
?>