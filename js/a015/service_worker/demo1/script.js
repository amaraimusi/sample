

	
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

