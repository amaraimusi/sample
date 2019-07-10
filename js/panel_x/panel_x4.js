/**
 * テキストエリア付パネル
 * @date 2016-3-29 新規作成
 * MIT
 */


$( function() {
	//～読込イベント処理～
	
	//ドラッグ機能を有効化する。
	onDraggable();
	
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
		'top':'50px',
		'left':'50px',
		'width':'500px',
		'height':'250px',
	});
	

	$('#pnl1_fullscreen').show();
	$('#pnl1_window').hide();
	
	//テキストエリアのサイズをパネルに合わせる
	_adjustTextArea();

}


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