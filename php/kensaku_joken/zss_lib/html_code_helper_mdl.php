<?php

/**
 * HTMLコード作成支援メソッドを提供<br/>
 * 
 * 2011/7/29 新規作成<br/>
 * 2011/8/1  バグ修正<br/>
 * 2011/8/4  radioTd追加
 */




/**
 * * ※非推奨（cmbbox2を推奨）
 * コンボボックスのHTMLコードを作成する。
 * @param CombBoxData $cmbData	コンボボックスデータ
 * @param  $selectValue　初期選択値
 * @param  $disabled 入力可の場合nullを設定
 * @param  $option1　入力可の場合のオプション
 * @param  $option2　入力不可の場合のオプション
 * @param  $prpName　nameの値がコンボボックスデータと異なる場合に指定。
 * @return string　HTMLコード
 */
function cmbbox(CombBoxData &$cmbData, $selectValue,$disabled=null,$option1=null,$option2,$prpName=null){
	
	
	$cmbs=&CombBoxShow::getInstance();
	return $cmbs->createCmbHtmlCode($cmbData, $selectValue,$option1,$prpName,$disabled);

}


/**
 * ※非推奨（textbox2を推奨）
 * テキストボックスを作成する。
 * 入力可と入力不可の２種類が作成可能。
 * @param  $name　name属性
 * @param  $value　value属性
 * @param  $disabled　入力可の場合はnullを指定。
 * @param  $option1　入力可の場合のオプション。
 * @param  $option2　入力不可の場合のオプション。
 * @return HTMLコード
 */
function textbox($name,$value,$disabled=null,$option1=null,$option2=null){
	
	//▼▼▼DAMS用の固有設定
	$option1='class="com_input1"';
	$option2='class="gray"';
	
			
	//▼入力可の場合の表示
	if($disabled==null){
		$code= sprintf('<input type="text" name="%s" value="%s" %s />',$name,$value,$option1);
		
	//▼入力不可の場合の表示
	}else{
		$code='<span %s>%s</span>'.
			'<input type="hidden" name="%s" value="%s" />';

		$code=sprintf($code,$option2,$value,$name,$value);

	}
	
	return $code;
		
}

/**
 * テキストボックスの表示、入力不可の場合は通常表示とhiddenをセット
 * @param  $eiData　エンティティ情報
 * @param  $ent		エンティティ
 * @param  $key		キー名
 * @return string　HTMLコード
 */
function textbox2(&$eiData,&$ent,$key){
	
	//$name,$value,$disabled=null,$option1=null,$option2=null
	
	//▼▼▼DAMS用の固有設定
	$option1='class="com_input1"';
	$option2='class="gray"';
	
	//▼各種パラメータを取得
	$name=$eiData[$key]['htmlName'];
	$value=$ent[$key];
	$disabled=$eiData[$key]['disabled'];
	
	//▼sizeが0もしくはnullでなければmaxlength属性を作成
	$size=$eiData[$key]['size'];
	if ($size !=0 && $size !=null){
		$maxlen='maxlength="'.$size.'"';
	}
	

	
	
			
	//▼入力可の場合の表示
	if($disabled==null){
		$code= sprintf('<input type="text" name="%s" value="%s" %s %s />',$name,$value,$maxlen,$option1);
		
	//▼入力不可の場合の表示
	}else{
		$code='<span %s>%s</span>'.
			'<input type="hidden" name="%s" value="%s" />';

		$code=sprintf($code,$option2,$value,$name,$value);

	}
	

	
	return $code;
		
}

/**
 * テキストボックスの表示、入力不可の場合は通常表示とhiddenをセット。
 * id属性もセットする。
 * @param  $eiData　エンティティ情報
 * @param  $ent		エンティティ
 * @param  $key		キー名
 * @return string　HTMLコード
 */
function textbox3(&$eiData,&$ent,$key){
	
	//$name,$value,$disabled=null,$option1=null,$option2=null
	
	//▼▼▼DAMS用の固有設定
	$option1='class="com_input1"';
	

	$option2='style="background-color:#a5a5a5;color:black;width:100%;border:1px;"';
	
	//▼各種パラメータを取得
	$name=$eiData[$key]['htmlName'];
	$value=$ent[$key];
	$disabled=$eiData[$key]['disabled'];
	
			
	//▼入力可の場合の表示
	if($disabled==null){
		$code= sprintf('<input type="text" id="%s" name="%s" value="%s" %s />',$name,$name,$value,$option1);
		
	//▼入力不可の場合の表示
	}else{
//		$code='<input type="hidden" id="%s" name="%s" value="%s" />';
//
//		$code=sprintf($code,$name,$name,$value);
		$code= sprintf('<input type="text" id="%s" name="%s" value="%s" %s disabled="disabled" />',$name,$name,$value,$option2);
	}
	
	return $code;
		
}




/**
 * コンボボックス表示（combboxの上位版）
 * 
 * @param  $ei　エンティティ情報
 * @param  $ent　エンティティ
 * @param  $key		フィールド
 * @param CombBoxData $cmbData　コンボデータ
 * @return string
 */
function combbox2(&$ei,&$ent,$key,CombBoxData &$cmbData){
	
	$selectValue=$ent[$key];
	$option='class="com_input2"';
	$prpName=$ei[$key]['htmlName'];
	$disabled=$ei[$key]['disabled'];

	$cmbs=&CombBoxShow::getInstance();
	$code= $cmbs->createCmbHtmlCode($cmbData, $selectValue,$option,$prpName,$disabled);

	return $code;
}

/**
 * コンボボックス表示（combboxの上位版）
 * 
 * @param  $ei　エンティティ情報
 * @param  $ent　エンティティ
 * @param  $key		フィールド
 * @param CombBoxData $cmbData　コンボデータ
 * @return string
 */
function combbox3(&$ei,&$ent,$key,CombBoxData &$cmbData,$option='class="com_input2"'){
	
	$selectValue=$ent[$key];
	//$option='class="com_input2"';
	$prpName=$ei[$key]['htmlName'];
	$disabled=$ei[$key]['disabled'];
	

	$cmbs=&CombBoxShow::getInstance();
	$code= $cmbs->createCmbHtmlCode($cmbData, $selectValue,$option,$prpName,$disabled,true);

	return $code;
}


/**
 * ラジオボタンコードを生成する。
 * @param unknown_type $eiData
 * @param unknown_type $ent
 * @param unknown_type $key
 * @param unknown_type $rdoData
 * @return unknown
 */
function radio2(&$eiData,&$ent,$key,&$rdoData){
	
	$name=$eiData[$key]['htmlName'];
	$value=$ent[$key];
	$disabled=$eiData[$key]['disabled'];

	
		//▼入力可の場合の表示
	if($disabled==null){
		foreach ($rdoData as $i=> $rdoEnt){
			if($rdoEnt['value']==$value){
				$checked='checked';
			}else{
				$checked=null;
			}
			
			$code='<input type="radio" name="%s" value="%s" %s />%s ';
			$code=sprintf($code,$name,$rdoEnt['value'],$checked,$rdoEnt['inner_html']);
			$list[$i]=$code;
		}
		
		$code2=join("\n",$list);
		
	//▼入力不可の場合。
	}else{
		foreach ($rdoData as  $rdoEnt){
			if($rdoEnt['value']==$value){
				$code2=$rdoEnt['inner_html'];
				$code2=$code2.hidden2($eiData, $ent, $key);
			}
		}
	}
	return $code2;
}


/**
 * hidden埋め込み
 * @param  $eiData　エンティティ情報
 * @param  $ent		エンティティ
 * @param  $key		キー名
 * @return string　HTMLコード
 */
function hidden2(&$eiData,&$ent,$key){
	
	//▼各種パラメータを取得
	$name=$eiData[$key]['htmlName'];
	$value=$ent[$key];

	$code='<input type="hidden" name="%s" value="%s" />';
	$code=sprintf($code,$name,$value);
	
	return $code;
		
}



/**
 * 表用テキストボックス表示
 * @param  $ei　 エンティティ情報
 * @param  $ent　エンティティ
 * @param  $key　エンティティのプロパティ
 * @param  $i		Index（行番号）
 * @param  $optionTd	tdのCSSなど
 * @param  $optionTdDis 	tdのCSSなど（入力不可の場合）　省略した場合は$optionTdと同じになる。
 */
function textboxTd(&$ei,&$ent,$key,$i,$optionTd=null,$optionTdDis=null){
	
	if ($i===null){
		$prpName=$ei[$key]['htmlName'];
	}else{
		$prpName=$ei[$key]['htmlName'].'['.$i.']';
	}
	
	if($optionTdDis==null){
		$optionTdDis=$optionTd;
	}
	
	//▼sizeが0もしくはnullでなければmaxlength属性を作成
	$size=$ei[$key]['size'];
	if ($size !=0 && $size !=null){
		$maxlen='maxlength="'.$size.'"';
	}
	
	if ($ei[$key]['disabled']==null){
		$clm="<td ".$optionTd."><input type=\"text\" id=\"%s\" name=\"%s\" value=\"%s\" %s class=\"com_input1\" /></td>\n";
		$clm=sprintf($clm,$prpName,$prpName,$ent[$key],$maxlen);
	}else{
		$clm='<td '.$optionTdDis.'>%s</td><input type="hidden" id=\"%s\" name="%s" value="%s" />'."\n";
		$clm=sprintf($clm,$ent[$key],$prpName,$prpName,$ent[$key]);
		
	}
	echo $clm;
}
/**
 * 表用hidden埋め込み
 * @param  $ei　 エンティティ情報
 * @param  $ent　エンティティ
 * @param  $key　エンティティのプロパティ
 * @param  $i		Index（行番号）
 */
function hiddenTd(&$ei,&$ent,$key,$i){
	
	if ($i===null){
		$prpName=$ei[$key]['htmlName'];
	}else{
		$prpName=$ei[$key]['htmlName'].'['.$i.']';
	}
	
	$code='<input type="hidden" name="%s" value="%s" />'."\n";
	$code=sprintf($code,$prpName,$ent[$key]);
	
	
	echo $code;
}

/**
 * 表用hidden埋め込み
 * @param  $ei　 エンティティ情報
 * @param  $ent　エンティティ
 * @param  $key　エンティティのプロパティ
 * @param  $i		Index（行番号）
 */
function hiddenForList(&$ei,&$ent,$key,$i){
	
	if ($i===null){
		$prpName=$ei[$key]['htmlName'];
	}else{
		$prpName=$ei[$key]['htmlName'].'['.$i.']';
	}
	
	$code='<input type="hidden" id="%s" name="%s" value="%s" />';
	$code=sprintf($code,$prpName,$prpName,$ent[$key]);
	
	
	return $code;
}
	
/**
 * 表用コンボボックス表示
 * @param  $ei　 エンティティ情報クラス
 * @param  $ent　エンティティ
 * @param  $key　エンティティのプロパティ
 * @param  $i		Index（行番号）省略可能。
 * @param  $cmbData	　コンボボックスデータ
 */
function combboxTd(&$ei,&$ent,$key,$i,CombBoxData &$cmbData,$option='class="com_input2"',$optionDis=null){
	

	if($optionDis==null){
		$optionDis=$option;
	}
	
	$selectValue=$ent[$key];
	if ($i===null){
		$prpName=$ei[$key]['htmlName'];
	}else{
		$prpName=$ei[$key]['htmlName'].'['.$i.']';
	}
	$disabled=$ei[$key]['disabled'];

	$cmbs=&CombBoxShow::getInstance();

	$code= $cmbs->createCmbHtmlCode($cmbData, $selectValue,$option,$prpName,$disabled,true);
	
	if($disabled==null){
		$code='<td>'.$code.'</td>';
	}else{
		$code='<td>'.$code.'</td>';
		
	}

	return $code;
}

/**
 * ラジオボタンコードを生成する。
 * @param unknown_type $eiData
 * @param unknown_type $ent
 * @param unknown_type $key
 * @param unknown_type $rdoData
 * @return unknown
 */
function radioTd(&$eiData,&$ent,$key,$i,&$rdoData){
	
	if ($i===null){
		$name=$eiData[$key]['htmlName'];
	}else{
		$name=$eiData[$key]['htmlName'].'['.$i.']';

	$value=$ent[$key];
	$disabled=$eiData[$key]['disabled'];
	}
	
	//▼入力可の場合の表示
	if($disabled==null){
		foreach ($rdoData as $i=> $rdoEnt){
			if($rdoEnt['value']==$value){
				$checked='checked';
			}else{
				$checked=null;
			}
			
			$code='<input type="radio" name="%s" value="%s" %s />%s ';
			$code=sprintf($code,$name,$rdoEnt['value'],$checked,$rdoEnt['inner_html']);
			$list[$i]=$code;
		}
		
		$code2=join("\n",$list);
		
	//▼入力不可の場合。
	}else{
		foreach ($rdoData as $rdoEnt){
			if($rdoEnt['value']==$value){
				$code2=$rdoEnt['inner_html'];
				
				$code2=$code2.hiddenTd($eiData, $ent, $key, $i);
			}
		}
	}
	
	if($disabled==null){
		$code2='<td>'.$code2.'</td>'."\n";
	}else{
		$code2='<td class="gray">'.$code2.'</td>';
		
	}
	return $code2;
}
	
/**
 * 表用チェックボックス表示
 * @param  $ei　 エンティティ情報クラス
 * @param  $ent　エンティティ
 * @param  $key　エンティティのプロパティ
 * @param  $i		Index（行番号）
 */
function checkboxTd(&$ei,&$ent,$key,$i){
	
	if ($i===null){
		$prpName=$ei[$key]['htmlName'];
	}else{
		$prpName=$ei[$key]['htmlName'].'['.$i.']';
	}
	
	if ($ei[$key]['disabled']==null){
		$clm="<td><input type=\"checkbox\" name=\"%s\" value ='checked' %s /></td>\n";
		$clm=sprintf($clm,$prpName,$ent[$key]);
	}else{
		$clm="<td class=\"gray\"><input type=\"checkbox\" name=\"%s\" value ='checked' %s disabled /></td>\n";
		$clm=sprintf($clm,$prpName,$ent[$key]);
	}
	
	echo $clm;
}


/**
 * テキストエリアの表示、入力不可の場合は通常表示とhiddenをセット。
 * @param  $eiData　	エンティティ情報
 * @param  $ent			エンティティ
 * @param  $key			キー名
 * @param  $option		入力可の場合のオプション文字列
 * @param  $optionDis	入力不可の場合のオプション文字列
 * @return string　	HTMLコード
 */
function textArea2(&$eiData,&$ent,$key,$option=null,$optionDis=null){
	
	//▼各種パラメータを取得
	$name=$eiData[$key]['htmlName'];
	$value=$ent[$key];
	$disabled=$eiData[$key]['disabled'];
	
			
	//▼入力可の場合の表示
	if($disabled==null){
		
		$code='<textarea id="%s" name="%s" %s>%s</textarea>';
		$code=sprintf($code,$name,$name,$option,$value);

	//▼入力不可の場合の表示
	}else{
		$code='<div %s>%s<input type="hidden" id="%s" name="%s" value="%s" /></div>';
		$code=sprintf($code,$optionDis,$value,$name,$name,$value);
		
	}
	
	return $code;
		
}
?>