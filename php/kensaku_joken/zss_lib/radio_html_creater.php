<?php

/**
 * ラジオボタンHTMLを生成する。
 * ★履歴
 * 2013/7/24	新規作成
 * @author Kenji Uehara
 *
 */
class RadioHtmlCreater{
	
	
	/**
	 * ラジオボタンHTMLを生成する。
	 * @param $id			タグのid属性とname属性に適用される。
	 * @param $defVal	デフォルト選択項目の値。
	 * @param $data		ラジオボタンのデータ（※詳細は下記参照）
	 * @param $option タグの属性値
	 * @return unknown_type
	 */
	public function createHtml2($id,$defVal,$data,$option=''){
		$html=$this->createHtml($id,$defVal,$data,'','',$option);
		return $html;
	}
	
	/**
	 * ラジオボタンHTMLを生成する。
	 * @param unknown_type $id			タグのid属性とname属性に適用される。
	 * @param unknown_type $defVal	デフォルト選択項目の値。
	 * @param unknown_type $data		ラジオボタンのデータ（※詳細は下記参照）
	 * @param unknown_type $css			タグのstyle属性
	 * @param unknown_type $class		タグのclass属性
	 * @return html									HTMLコード
	 * 
	 * ※ラジオボタンデータについて
	 *  ラジオボタンデータは以下のエンティティのリストである。
	 *  エンティティのプロパティは値（value）とテキスト（text）である。
	 *  また、これらのプロパティはHTMLコードに組み込まれる。以下に例を示す。
	 *  <input type="radio" name="q2" value="値"> テキスト
	 */
	public function createHtml($id,$defVal,$data,$css='',$class='',$option=''){

		//属性を加工する
		$css=$this->makeZokuse('style',$css);
		$class=$this->makeZokuse('class',$class);
		$name=$this->makeZokuse('name',$name);

		
		//データ件数分、繰り返す。
		foreach($data as $i=>$ent){
			//値とテキストをデータから取得
			$v=$ent['value'];
			$text=$ent['text'];
			
			//値とデフォルト値が一致する場合、「checked」をセット。一致しないばあいは空文字をセット
			$checked='';
			if($v==$defVal){
				$checked='checked';
			}
			

			
			//ラジオボタンＨＴＭＬを作成
			$h="<input type='radio'  id='{$id}' name='{$id}' value='{$v}' {$checked} {$option} > {$text}\n";
			
			//html文字列へ追加。";
			$html.=$h;
		}
		
		
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