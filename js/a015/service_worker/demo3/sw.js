// Service Worker インストール時に実行される
self.addEventListener('install', (event) => {
	console.log('service worker install. demo3.');
});

// installイベント後に実行される。基本的に初回アクセスの時にのみ実行。
self.addEventListener('activate', (event) => {
	console.log('activate', event);
});

// cssやjsなどファイル読み込み、Fetch APIによる非同期通信時
self.addEventListener('fetch', (event) => {
	console.log('service worker fetch ');
	console.log(event.request);
});

// フロントエンドとサービスワーカーでのやりとりはここで行う。
self.addEventListener('message', event => {
	// event は ExtendableMessageEvent オブジェクトです
	let msg2 = `${event.data}のエサ3-2`;
	console.log(msg2);
	
	if(event.data == 'test3_action'){
		console.log('test3_action　2');
		
		// サービスワーカー内ではもFetch APIが使用可能である。
		fetch("./backend.php")
		  .then(response => {
			console.log('response');
			console.log(response);
			return response.json();
		  })
		  .then(data => {
			console.log('data');
			console.log(data);
			
		  })
		  .catch(error => {
			console.log(error);
			console.log("失敗しました");
		});
	}

	event.source.postMessage(msg2);
});