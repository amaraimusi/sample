<?php

/**
 * メニューHTML生成クラス
 * ★履歴
 * 2013/7/17	新規作成
 * @author KENJI UEHARA
 *
 */
class MenuHtmlCreater{
	
	/**
	 * メニューHTMLコードを作成する。
	 * @param $menuId		メニューID
	 * @param $menuData	メニューデータ
	 * @param $css			CSS属性
	 * @param $class		class属性
	 * @return メニューHTMLコード
	 */
	function getMenuHtml($menuId,$menuData,$css='',$hid='',$class=''){
		
		
		foreach($menuData as $i=>$ent){
			$id=$ent['id'];//メニューIDを取得
			$menuName=$ent['menuName'];//メニュー名を取得
			$link=$ent['link'];//リンクを取得
			
			
			//メニュー項目HTMLを作成
			$s='';
			if($id!=$menuId){
			
				$s="<li><a href='{$link}'>{$menuName}</a></li>\n";
				
			//引数のメニューIDと同値の場合、メニュー項目を非リンク化する。
			}else{
				$s="<li>{$menuName}</li>\n";
			}
			
			$s2.=$s;
		}
		

		//属性を加工する
		$css=$this->makeZokuse('style',$css);
		$hid=$this->makeZokuse('id',$hid);
		$class=$this->makeZokuse('class',$class);
		
		$cd="<ul {$hid} {$class} {$css} >\n{$s2}</ul>";
		return $cd;
	}
	
	//属性を加工する
	private function makeZokuse($name,$val){
		$v2='';
		if($val!=''){
			$v2="{$name}='{$val}'";
		}
		return $v2;
	}
	
}
?>