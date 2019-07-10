/**
 * MdEditorK | MDエディタ
 * 
 * @version 1.0
 * @date 2016-3-29 新規作成
 */



$( function() {
	//■■■□□□■■■□□□■■■□□□検証
	

	
	//ドラッグ機能を有効化する。
	offDraggable();
	
	//テキストエリアのサイズをパネルに合わせる
	_adjustTextArea();

	
	
	$('#panel1').resizable({
		maxHeight:2500,
		maxWidth:2500,
		minHeight:40,
		minWidth:250,
		stop: function( event, ui ) {
			//リサイズ操作から手を放した瞬間のイベント
			var h=ui.size.height-130;
			var w=ui.size.width-37;
			
			//サイズ変更したとき、別の要素も連動させてみる。
			$( "#pnl1_ta" ).height(h);
			$( "#pnl1_ta" ).width(w);
			
		}
	});
	
	
	// アンドゥ、リドゥ機能の初期化
	var undoA = new UndoA({
		'ta_slt':'#pnl1_ta',
		'undo_btn_slt':'#pnl1_undo',
		'redo_btn_slt':'#pnl1_redo',
	});
});

//ドラッグ機能を有効化する。
function onDraggable(){
	var draggableDiv = $('#panel1').draggable();
	
	//ドラッグ移動を組み込むとテキスト選択ができなくなるので、パネルボディ部分をテキスト選択可能にする。
	$('.panel-body',draggableDiv).mousedown(function(ev) {
		  draggableDiv.draggable('disable');
		}).mouseup(function(ev) {
		  draggableDiv.draggable('enable');
		});
	

	
	$('#panel1').css({
		'top':'150px',
		'left':'50px',
		'width':'700px',
		'height':'600px',
	});
	

	$('#pnl1_fullscreen').show();
	$('#pnl1_window').hide();
	
	//テキストエリアのサイズをパネルに合わせる
	_adjustTextArea();
	
	//プレビュー区分を画面幅いっぱいにする。
	$('#panel1_rap').width(0);
	$('#prv_content').css('width','100%');

}

/**
 * エディタパネルを小窓化する
 */
function offDraggable(){
	var draggableDiv = $('#panel1').draggable();
	draggableDiv.draggable('destroy');

	$('#panel1').css({
		'position':'none',
		'top':'0px',
		'left':'0px',
		'width':'100%',
		'height':'100%',
	});

	$('#pnl1_fullscreen').hide();
	$('#pnl1_window').show();
	
	
	//プレビュー区分を画面幅を半分にする
	$('#panel1_rap').css('width','50%');
	$('#prv_content').css('width','50%');

	
	//テキストエリアのサイズをパネルに合わせる
	_adjustTextArea();

	

}

// パネルを閉じる
function closePanel(){
	$('#panel1').hide();
}

// パネルを表示する
function showPanel(){
	$('#panel1').show();
}

// テキストエリアのサイズをパネルに合わせる
function _adjustTextArea(){
	var w = $('#panel1').outerWidth() - 37;
	var h = $('#panel1').outerHeight() - 130;
	$( "#pnl1_ta" ).height(h);
	$( "#pnl1_ta" ).width(w);
}





/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {


	//記号「;&<>",」をサニタイズ
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/\t/g, '&#x0009;');
    str = str.replace(/\r\n|\r|\n/g, '<br>');

    return str;
}




















/**
 * olリスト化
 * 
 */
function exeOl(){
	
	
	// 選択中のテキストを取得する
	var text = $('#pnl1_ta').selection();
	
	if(text==null){
		return;
	}
	
	// 選択テキストを改行で分割してテキスト配列を取得する
	var ary = text.split(/\r\n|\r|\n/);
	
	// 
	
	// テキスト配列の値に番号識別子を付加する。
	var ary2 = [];
	for(var i=0 ; i<ary.length ; i++){
		var t = ary[i];
		t = _removeMark(t);//印をはずす
		var no = i + 1;
		t = no + '. ' + t;
		ary2.push(t);
		
	}
	
	// テキスト配列を再連結してテキスト2を作成する。
	var text2 = ary2.join('\r\n');
	
	// 選択中のテキストをテキスト2に置き換える。
	$('#pnl1_ta').selection('replace', {text: text2});
	

}



/**
 * 印を外す
 * @param str 印を外す前
 * @returns 印を外したあと
 */
function _removeMark(str){
	
	// olリストによる数値印をはずす
	str = str.replace(/^\d{1,4}\./, '');
	
	
	str = str.trim();
	
	return str;

}





