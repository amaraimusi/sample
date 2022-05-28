

	
$(()=>{
	if (navigator.serviceWorker) {
	  navigator.serviceWorker.register('./sw.js', { scope: './' })
	  .then(function(reg) {
		console.log('Service workerの登録に成功しました。 Scope は ' + reg.scope);
	 }).catch(function(error) {
		console.log('Service workerの登録に失敗しました。' + error);
	 });

	  navigator.serviceWorker.addEventListener('message', event => {
		// event は MessageEvent オブジェクトです
		console.log(`${event.data}はおいしい`);
	 });
	
	}
	
})


function test1(){

		// ServiceWorkerにメッセージを送信する
	 navigator.serviceWorker.ready.then( registration => {
		let msg1 = 'ウナギ';
		console.log(msg1);
		registration.active.postMessage(msg1);
	  });

}

// fetchのテスト
function test2(){
	$('#res').html('abc');
	fetch("./backend.php")
	  .then(response => {
		console.log('response');
		console.log(response);
		return response.json();
	  })
	  .then(data => {
		console.log('data');
		console.log(data);
		$('#res').html(JSON.stringify(data));
	  })
	  .catch(error => {
		console.log(error);
		console.log("失敗しました");
	});

}

function test3(){

	// ServiceWorkerにメッセージを送信する
	 navigator.serviceWorker.ready.then( registration => {
		let msg1 = 'test3_action';
		console.log(msg1);
		registration.active.postMessage(msg1);
	  });

}

