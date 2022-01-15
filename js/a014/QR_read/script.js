let jsQrEx;
$(()=>{
	jsQrEx = new JsQrEx('qr_canvas', callback, null);
	
});

function callback(value){
	$('#res').append(value);
	console.log('コールバック');//■■■□□□■■■□□□
	console.log(value);//■■■□□□■■■□□□);
}

function start(){
	jsQrEx.start();
}

function stop(){
	jsQrEx.stop();
}