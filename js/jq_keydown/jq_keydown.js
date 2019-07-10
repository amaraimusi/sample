/**
 * キーボードのイベント| keydown keypress keyup
 * @date 2016-4-6 新規作成
 */


$(function(){
	// キーを離したときのイベント
	$('#test1').keyup(function(e){
		var str = 'keyup:' + e.keyCode + '<br>';
		$('#res').append(str);
	});
	
	// キーを押しこんだときのイベント
	$('#test1').keydown(function(e){
		var str = 'keydown:' + e.keyCode + '<br>';
		$('#res').append(str);
	});
	
	// キーを押下イベント（keydownとkeyupを組み合わせたイベント）
	$('#test1').keypress(function(e){
		var str = 'keypress:' + e.keyCode + '<br>';
		$('#res').append(str);
	});
	
});