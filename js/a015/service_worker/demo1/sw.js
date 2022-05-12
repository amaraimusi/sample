// Service Worker インストール時に実行される
self.addEventListener('install', (event) => {
	console.log('service worker install');
});

// Service Worker アクティベート時に実行される
self.addEventListener('activate', (event) => {
  console.info('activate', event);
});

self.addEventListener('fetch', (event) => {
	console.log('service worker fetch ... ' + event.request);
});

// サービスワーカー内
self.addEventListener('message', event => {
  // event は ExtendableMessageEvent オブジェクトです
 let msg2 = `${event.data}のエサ`;
 console.log(msg2);

  event.source.postMessage(msg2);
});