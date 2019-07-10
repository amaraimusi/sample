/**
 * 
 */

function test1(){

	confirmDialog_jQueryUI('ダイアログのテストです。',null, function(res){
		
		if(res == true){
			$('#res1').append('OK<br>');
		}else{
			$('#res1').append('キャンセル<br>');
		}

	});
	
}


/**
 * JQuery UIによる確認ダイアログ
 * 
 * @note
 * ダイアログを閉じた場合はキャンセルと同じ挙動になる
 *
 * @param msg_html メッセージHTML: ダイアログの内容テキスト
 * @param option (省略可)
 *  - title 		ダイアログのタイトル
 *  - btn_ok 		OKボタンの表示
 *  - btn_cancel 	キャンセルボタンの表示
 *  - width			ダイアログの横幅
 *  - height		ダイアログの縦幅
 */
function confirmDialog_jQueryUI(msg_html,option,callback){
	
	var res = false;
	
	if(option==null){
		option = {};
	}
	if(option['title']==null){
		option['title'] = '確認';
	}
	if(option['btn_ok']==null){
		option['btn_ok'] = 'OK';
	}
	if(option['btn_cancel']==null){
		option['btn_cancel'] = 'CANCEL';
	}
	if(option['width']==null){
		option['width'] = 320;
	}
	if(option['height']==null){
		option['height'] = 240;
	}
	
	// ベースとなるダイアログ要素を作成
	var dlgElm = $("<div>" + msg_html + "</div>"); 
 
	// ボタン類の初期化（コールバックの組み込み）
	var btns = {};
	btns[option.btn_ok] = function(){
		res = true;
		$(this).dialog('close');
	};
	btns[option.btn_cancel]  = function(){
		res = false;
		$(this).dialog('close');
	};
  
	// ダイアログの生成、および表示
	dlgElm.dialog({
		modal:true,
		draggable:false,
		title:option.title,
		height:option.heigt,
		width:option.width,
		buttons:btns,
		close: function() {
			callback(res);
		}
	});
}
