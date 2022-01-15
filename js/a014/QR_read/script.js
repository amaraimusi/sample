let jsQrEx;
$(()=>{
	jsQrEx = new JsQrEx('qr_canvas', callback);
});

function callback(value){
	$('#res').append(value + '<br>');
	console.log(value);
}

function errFunc(err){
	alert('カメラが不許可ですよ');
}

function start(){
	jsQrEx.start();
}

function stop(){
	jsQrEx.stop();
}