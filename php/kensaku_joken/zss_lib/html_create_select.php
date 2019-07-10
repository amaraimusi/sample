<?php
require_once 'common.php';
/**
 * HTMLのSELECTタグを自動生成する。
 * @author uehara
 * @date 2010/10/26
 */
class HtmlCreateSelect{
	
	
	/**
	 * (非推奨 combbox_html_createrをなるべく使う）
	 * 
	 * HTMLのSELECTタグを自動生成する。
	 * @param  $name　selectタグのnameに相当。
	 * @param  $data　$dataのキーはselectタグのvalueで、$dataの値はselectタグの表示文字となる。
	 * @param  $selectValue　選択している項目の値。
	 */
	function create($name, $data,$selectValue,$option=null){
		

		//▼最初の部分を作成（例：<select name="language" >）
		$part1="<select id='$name' name='$name' $option>\n";
		
		//▼中間部分を作成（例：<option value='0' selected="selected">）
		foreach ($data as $key => $val){
			
			if($selectValue==$key){
				$selected="selected='selected'";
			}else{
				$selected='';
			}
			
			$a="<option value='$key' $selected>$val</option>\n";
			$part2.=$a;
			
		}
		
		//▼最後の部分を作成 </select>
		$part3="</select>\n";

		$hc=$part1.$part2.$part3;

		return $hc;
		
	}
}
?>