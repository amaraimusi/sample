<?php

/**
 * コンボボックスHTMLを生成する。
 * ★履歴
 * 2013/7/19	新規作成
 * 2013/7/23	createHtml2を作成」
 * @author Kenji Uehara
 *
 */
class CombboxHtmlCreater{
	
	
	/**
	 * コンボボックスHTMLを生成する。
	 * @param $id			タグのid属性とname属性に適用される。
	 * @param $defVal	デフォルト選択項目の値。
	 * @param $data		コンボボックスのデータ（※詳細は下記参照）
	 * @param $option タグの属性値
	 * @return unknown_type
	 */
	public function createHtml2($id,$defVal,$data,$option=''){
		$html=$this->createHtml($id,$id,$defVal,$data,'','',$option);
		return $html;
	}
	
	/**
	 * コンボボックスHTMLを生成する。
	 * @param  $id			タグのid属性に適用される。
	 * @param  $name		タグのname属性に適用される。
	 * @param  $defVal	デフォルト選択項目の値。
	 * @param  $data		コンボボックスのデータ（※詳細は下記参照）
	 * @param  $css			タグのstyle属性
	 * @param  $class		タグのclass属性
	 * @return html									HTMLコード
	 * 
	 * ※コンボボックスデータについて
	 *  コンボボックスデータは以下のエンティティのリストである。
	 *  エンティティのプロパティは値（value）とテキスト（text）である。
	 *  また、これらのプロパティはHTMLコードのoptionタグで組み込まれる。以下に例を示す。
	 *  <option value=値 >テキスト</option>
	 * 
	 */
	public function createHtml($id,$name,$defVal,$data,$css='',$class='',$option=''){
		
			//属性を加工する
			$css=$this->makeZokuse('style',$css);
			$id=$this->makeZokuse('id',$id);
			$class=$this->makeZokuse('class',$class);
			$name=$this->makeZokuse('name',$name);

		
		//「<select～」部分を生成。
		$html="<select {$id} {$name} {$class} {$css} {$option}>\n";
		
		//データ件数分、繰り返し、「option」部分を作成する。
		foreach($data as $i=>$ent){
			//値とテキストをデータから取得
			$v=$ent['value'];
			$text=$ent['text'];
			
			//値とデフォルト値が一致する場合、「selected」をセット。一致しないばあいは空文字をセット
			$selected='';
			if($v==$defVal){
				$selected='selected';
			}
			

			
			//「option」部分を作成
			$h="<option value='{$v}' {$selected}>{$text}</option>\n";
			
			//html文字列へ追加。
			$html.=$h;
		}
		
		//終了タグを生成して追加。
		$html.="</select>\n";
		
		//html文字を返す。
		return $html;
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