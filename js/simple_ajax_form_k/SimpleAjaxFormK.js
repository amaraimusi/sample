/**
 * SimpleAjaxFormK.js | Ajax簡易入力フォーム
 * 
 * @note
 * 指定要素内に存在するinput系要素から、すべての値を取得してJSON化する。
 * そのJSONをサーバー先に転送する
 * 
 * @version 1.0
 * 
 * @date 2016-5-9 新規作成
 */


function simpleAjaxFormK(param){
	
	var range = param.range;
	
	var data = getDataFromInputs(range);
	
	// Ajaxでサーバー側にデータを送信する。
	ajax(data,param.url,param.msg_slt,param.callback)

	
}

/**
 * フォーム範囲セレクタ内の入力要素（input,textarea,select）から値データを取得する
 * 
 * @note
 * データのキーはid属性。
 * キーを「.」で区切ればツリー構造データとして取得できる。
 * 
 * @param range_slt フォーム範囲セレクタ
 * @returns object 値データ
 */
function getDataFromInputs(range_slt){
	
	
	var data = {};
	
	
	// フォーム範囲セレクタ内を、入力要素（input,textarea,select）の数だけループしてデータ取得する。
	$(range_slt + ' input,textarea,select').each(function(){
		
		// 入力要素のid属性からidを取得する。id属性が空であればname属性を取得する。
		var elm = $(this);
		var id = elm.attr('id');
		if(id==null){
			var id = elm.attr('name');
		}
		
		// idが空であるなら、この入力要素からデータ取得を行わずスキップする。
		if(!id){
			return;
		}
		
		// 入力要素がラジオボタンである場合、checked属性の入っていないのであればデータ取得を行わず。
		var type = elm.attr('type');
		if(type=='radio'){
			if(!elm.prop('checked')){
				return;
			}
		}
		
		// 入力要素から値を取得する
		var val = elm.val();

		
		// idを「.」で分解し、ツリー構造に変換する。
		var keys = id.split('.');
		var tree = data;
		for(var i=0 ; i<keys.length ; i++){
			var key = keys[i];
			
			if(tree[key]===undefined){
				tree[key]={};
			}
	
			if(i == keys.length-1){
				tree[key]=val;
			}else{
				tree = tree[key];
			}
		}

	});
	
	return data;
	

}

/**
 * Ajaxでサーバー側にデータを送信する。
 * @param data データ
 * @param url Ajax送信先URL
 * @param msg_slt メッセージ要素セレクタ
 */
function ajax(data,url,msg_slt,callback){

	var json_str = JSON.stringify(data);//データをJSON文字列にする。

	//☆AJAX非同期通信
	$.ajax({
		type: "POST",
		url: url,
		data: "key1="+json_str,
		cache: false,
		dataType: "text",
		success: function(res, type) {
			
			callback(res);//コールバック関数呼び出し

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			
			showMsg(xmlHttpRequest.responseText,msg_slt,1);// エラー表示
		}
	});
}

/**
 * メッセージ表示
 * @param msg メッセージ
 * @param msg_slt メッセージ要素
 * @param errFlg エラーフラグ 0:正常 , 1:エラー
 *  - エラーフラグが1である場合、文字の色を赤くする。
 */
function showMsg(msg,msg_slt,errFlg){
	if($(msg_slt)[0]){

		if(errFlg){
			msg = "<span style='color:red'>" + msg + "</span>";
		}
		$(msg_slt).html(msg);
	}
	
}


 