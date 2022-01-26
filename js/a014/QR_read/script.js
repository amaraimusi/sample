let jsQrEx;
$(()=>{
	jsQrEx = new JsQrEx('qr_canvas', callback);
});

function callback(value){
	$('#res').html(value);
	console.log(value);
}

function errFunc(err){
	alert('カメラが不許可ですよ');
}

function start(){
	jsQrEx.start(()=>{
		$('#start_btn').hide();
		$('#stop_btn').show();
	}, errFunc);
}

function stop(){
	jsQrEx.stop();
	$('#start_btn').show();
	$('#stop_btn').hide();
}