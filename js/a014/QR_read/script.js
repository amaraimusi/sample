let jsQrEx;
$(()=>{
	jsQrEx = new JsQrEx(
			'qr_canvas', 
			(url)=>{
				callback(url);
			}, 
			 'qr_read_config'
		);
	
});

function callback(value){
	$('#res').append(value);
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