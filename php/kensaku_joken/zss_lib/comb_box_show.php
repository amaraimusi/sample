<?php


/**
 * 
 * コンボボックスデータからコンボボックスを作成する。<br />
 * @author user01
 *2011/7/13 新規作成<br />
 */
class CombBoxShow{
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['CombBoxShow']){
			$obj=new CombBoxShow();
			$_REQUEST['CombBoxShow']=&$obj;
		}else{
			$obj=&$_REQUEST['CombBoxShow'];
		}
		
		return $obj;

	}
	public function createCmbHtmlCode(CombBoxData &$cmbData,$selectValue,$option=null,$prpName=null,$disabled=null,$idFlg=null){
		
		//▼入力不可の表示
		if ($disabled != null){
			$cmbItems=$cmbData->items;
			$val=$cmbItems[$selectValue];
			
			
			//▼IDフラグがTrueである場合はID属性も追加。
			if ($idFlg==true){
				$code='%s<input type="hidden" id="%s" name="%s" value="%s" />';
				$code=sprintf($code,$val,$prpName,$prpName,$selectValue);
				
			//IDフラグがnullである場合はID属性は追加しない。
			}else{
				
				$code='%s<input type="hidden" name="%s" value="%s" />';
				$code=sprintf($code,$val,$prpName,$selectValue);
			}
		
		
			return $code;
		}
		
	
		
		//▼コンボボックスのヘッダー部分を作成して出力。
		if($prpName==null){
			$prpName =$cmbData->propertyName;
		}
		
		$part1=sprintf("<select id='%s' name='%s' %s  > ",$prpName,$prpName,$option);
		
		//▼コンボボックスの選択項目部分を作成して出力。
		$cmbItems=$cmbData->items;
		
		if($selectValue==null){
			$defValue =$cmbData->defaultSelectValue;
		}else{
			$defValue=$selectValue;
		}
		foreach ((array)$cmbItems as $key => $val){

			if ($defValue==$key){
				$p2=sprintf("<option value='%s' %s >%s</option>",$key,'selected=\'selected\'',$val);
			}else{
				$p2=sprintf("<option value='%s' >%s</option>",$key,$val);
			}
			
			$part2 =$part2.$p2."\n";
			
		}

		//▼コンボボックスの終わりを作成して出力。
		$part3='</select>';
		
		$part="\n".$part1."\n".$part2.$part3."\n";
		
		return $part;
		
	}
	
}

?>