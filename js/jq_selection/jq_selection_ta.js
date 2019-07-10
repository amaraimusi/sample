/**
 * 選択状態のテキストを取得 | jQuery.selection
 * @date 2016-3-28
 */



$( function() {
	//～読込イベント処理～
});


function test1(){
	var res = $('#test1').selection();
	$('#res1').html(res);
}


function test2(){
	
	  $('#test1')
	  
	    //選択テキストの前に挿入
	    .selection('insert', {text: '【', mode: 'before'})

	    //選択テキストの後に挿入
	    .selection('insert', {text: '】', mode: 'after'});
	  
}

function test3(){
	  $('#test1').selection('replace', {text: 'XXX'});
	  
}