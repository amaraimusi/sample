<?php
require_once 'common.php';
/**
 * ページネーション作成
 * ★概要
 * ページネーション用のHTMLコードをお生成する。
 * ★履歴
 * 2012/08/17	新規作成
 * 2013/07/17 createHtmlメソッドに引数pageNameを追加。
 * 
 */
class PagenationCreater{
	


	/**
	 * ページネーション用のHTMLコードを生成する。
	 * @param  $nowPageNo	現在のページ番号（０から開始）
	 * @param  $params		リンクのURLに付加するパラメータ（キー、値）
	 * @param  $dtCnt			データ数
	 * @param  $limitCnt	限界表示行数（最大表示行数）
	 * @param  $midasiCnt	表示する見出し数
	 * @return NULL|string
	 */
	function createHtml($nowPageNo,$params,$dtCnt,$limitCnt,$midasiCnt=8,$pageName="list.php"){
		
		
		if($dtCnt==0){
			return null;
		}

		
		//▼ページネーションを構成する総リンク数をカウントする。
		$allMdCnt=ceil($dtCnt/$limitCnt);
		$md2=$allMdCnt;
		if($md2>$midasiCnt){
			$md2=$midasiCnt;
		}
		$linkCnt=4+$md2;


		
		//▼最終ページ番号を取得
		if($md2>0){
			$lastPageNo=$allMdCnt-1;
		}
		
		//▼その他パラメータコードを作成する。
		foreach($params as $key=>$val){
			if($val!==null && $val!=='')
			$strParams=$strParams.'&'.$key.'='.$val;
		}
		
		
		//▼最戻リンクを作成
		$rtnMax='&lt&lt';
		if($nowPageNo>0){
		
			$rtnMax="<a href='{$pageName}?pageNo=0{$strParams}'>{$rtnMax}</a>";
			//$rtnMax="<a href='list.php?pageNo=0{$strParams}'>{$rtnMax}</a>";
		}
		
		//▼単戻リンクを作成
		$rtn1='&lt';
		if($nowPageNo>0){
			$p=$nowPageNo-1;
			$rtn1="<a href='{$pageName}?pageNo={$p}{$strParams}'>{$rtn1}</a>";
		}
		
		//▼単進リンクを作成
		$next1='&gt';
		if($nowPageNo<$lastPageNo){
			$p=$nowPageNo+1;
			$next1="<a href='{$pageName}?pageNo={$p}{$strParams}'>{$next1}</a>";
		}
		
		//▼最進リンクを作成
		$nextMax='&gt&gt';
		if($nowPageNo<$lastPageNo){
			$p=$lastPageNo;
			$nextMax="<a href='{$pageName}?pageNo={$p}{$strParams}'>{$nextMax}</a>";
		}
		
				

		//▼見出し配列を作成
		$fno=$lastPageNo-$md2+1;
		if($nowPageNo<$fno){
			$fno=$nowPageNo;
		}
		$lno=$fno+$md2-1;

		for($i=$fno;$i<=$lno;$i++){
			$pn=$i+1;
			if($i!=$nowPageNo){
				$midasiList[]="<a href='{$pageName}?pageNo={$i}{$strParams}'>{$pn}</a>";
			}else{
				$midasiList[]=$pn;
			}
		}
		
		//▼CSSを適用
		$w=100/$linkCnt;
		$div1="<div style=\"width:{$w}%;height:24px;float:left\">";
		$rtnMax=$div1.$rtnMax."</div>\n";
		$rtn1=$div1.$rtn1."</div>\n";
		$next1=$div1.$next1."</div>\n";
		$nextMax=$div1.$nextMax."</div>\n";
		foreach($midasiList as $key=>$val){
			$midasiList[$key]=$div1.$val."</div>\n";
		}
		$strMidasi=join($midasiList,'');
		$html=$rtnMax.$rtn1.$strMidasi.$next1.$nextMax.'<div style="clear:both"></div>'."\n";
		return $html;
	}
}
?>