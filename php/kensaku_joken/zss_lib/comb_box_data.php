<?php
require_once 'common.php';
class CombBoxData{
	
	//初期選択値
	var $defaultSelectValue;
	
	//プロパティ名
	var $propertyName;
	
	//選択項目(プロパティの値をキーとし、値に表示項目をセット）
	var $items;
	
	
	public function test(){
		
		log2('初期値：'.$this->defaultSelectValue);
		log2('プロパティ名：'.$this->propertyName);
		foreach ($this->items as $key => $val){
			log2('内部値：'.$key.'    '.'選択項目：'.$val);
			
		}
	}
}
?>