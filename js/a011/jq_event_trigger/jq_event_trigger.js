

$(()=>{
	// クリックイベント
	$('#btn1').click((evt)=>{
		var btn = $(evt.currentTarget);
		var msg = btn.attr('value') + 'が押されました。<br>';
		$('#res').append(msg);
	});
	
	// チェンジイベント
	$('#text1').change((evt)=>{
		var tb = $(evt.currentTarget);
		var msg = 'テキストチェンジ→ ' + tb.val() + '<br>';
		$('#res').append(msg);
	});
});

function fire(){
	$('#btn1').trigger('click'); // クリックイベント発火
	$('#text1').trigger('change'); // チェンジイベント発火
}

function test2(){
	$('#res').append('属性：onclickによる呼び出し<br>');
}