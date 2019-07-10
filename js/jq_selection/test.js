/**
 * 選択状態のテキストを取得 | jQuery.selection
 * @date 2016-3-28
 */



$( function() {
	//～読込イベント処理～
});


function test1(){
	var res = $.selection();
	$('#res1').html(res);
}


function test2(){
	var res = $.selection('html');
	$('#res1').html(res);
}