

/**
 * ★概要
 * 共通メソッドを提供
 * ★履歴
 * 2011/8/4		新規作成
 * 2011/11/09	preタグをdebug出力に追加
 * 2011/12/5	escape_html_tag,sanitaizeTreeData,isArray,replaceAllを追加
 * 2012/08/07	stringLeft,stringRightを追加
 * 2012/08/08	getGETを追加
 * 2013/02/20	getDateTimeStr
 * 2013/09/04	nidoosi
 * 2014/05/21	a_debug.jsとしてcommon.jsから分離
 */




/**
 * 文字列を出力する。
 * ※HTMLコード中に次のタグを埋め込むこと。<div id='js_test'></div>
 * @param 出力するメッセージ
 */
function a_debug(msg){
	obj=document.getElementById('js_test');
	obj.innerHTML=obj.innerHTML +  msg + '<br>';
}

/**
 * 配列の中身を出力する。
 * ※HTMLコード中に次のタグを埋め込むこと。<div id='js_test'></div>
 * @param 出力するメッセージ
 */
function a_debugArray(ary){

	if(ary==null){
		a_debug('配列はnullです');
	}else{
		msg=ary.join('<br>');
		if (msg==''){
			a_debug('空白データです');
		}else{
			a_debug(msg);
		}
	}

}

//データの中身を出力する。データは配列の配列）
function a_debugData(data){

	if(data==null){
		a_debug('データはnullです');
	}else{
		for (var i=0;i<data.length;i++){
			var ent=data[i];
			if(ent==null){
				a_debug('エンティティはnull');
			}else{
				msg=ent.join(',');
				a_debug(msg);
			}


		}

	}

}



//配列であるかチェックする。
function isArray(array){
  return !(
    !array ||
    (!array.length || array.length == 0) ||
    typeof array !== 'object' ||
    !array.constructor ||
    array.nodeType ||
    array.item
  );
}



