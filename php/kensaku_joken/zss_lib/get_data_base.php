<?php
require_once 'dao_for_mysql.php';
require_once 'common.php';

/**
 * データベースからデータを取得するための基本クラス
 *★概要
 *2012/08/06	新規作成
 */
class GetDataBase{
	
	
	/**
	 * ページデータ
	 * pageNo=>現在ページ番号 （0ページから数える）
	 * limitCnt=>最大表示行数
	 * dataCnt=>データ数
	 * lastPageNo=>最終ページ番号
	 * 
	 */
	public $m_pageData;
	
	/**
	 * データベースからデータを取得する。(単一テーブル用）
	 * @param  $cn	DBコネクション
	 * @param  $tblName	取得対象DBテーブル名
	 * @param  $strParams	フィールド名（コンマで複数指定可能）
	 * @param  $pageNo	ページ番号
	 * @param  $limitCnt	最大表示行数
	 * @return データ（2次元配列）
	 */
	function &getData0(&$cn,$sql,$pageNo,$limitCnt){
		
		//DAOのインスタンスを取得する。
		$dao=DaoForMySql::getInstance();
		
		//行番号を算出
		$rowNo=$pageNo*$limitCnt;
		
		//SQLを構築する。
		$sql2=$sql." LIMIT {$rowNo},{$limitCnt}";

		//データベースからデータを取得する。
		$data=$dao->getData($sql2,$cn);
		
		
		//全データ数を取得するSQLを生成
		$s=$this->stringRight($sql,"FROM");
		$sql3="SELECT COUNT(*) AS RowCnt FROM ".$s;
		
		//全データ数を取得する。
		$data2=$dao->getData($sql3,$cn);
		$dataCnt=$data2[0]['RowCnt'];

		//最終ページ番号を算出
		$lastPageNo=0;
		if($dataCnt>0){
			$lastPageNo=floor($dataCnt-1/$limitCnt);
		}
		
		//ページデータにページ情報をセットする。
		$this->m_pageData['pageNo']=$pageNo;
		$this->m_pageData['limitCnt']=$limitCnt;
		$this->m_pageData['dataCnt']=$dataCnt;
		$this->m_pageData['lastPageNo']=$lastPageNo;
		

		
		return $data;
	}
	

	
	/**
	 * 左から印文字を探し、見つかった場所から右側の文字列を返す。（印文字は含めず）
	 * 検索文字列が存在しない場合は、対象文字列をそのまま返す。
	 * 検索文字列が先頭にあった場合も、対象文字列をそのまま返す。
	 * @param  $str　対象文字列
	 * @param  $mark　印文字
	 * @return string　
	 */
	private function stringRight($str,$mark){
		$a=mb_strpos($str,$mark,0,'utf8');
		if(!$a){return $str;}
		$len=mb_strlen($str,'utf8');
		$markLen=mb_strlen($mark,'utf8');
		$rtn=mb_substr($str,$a+$markLen,$len,'utf8');
		
		return $rtn;
	}
}

?>