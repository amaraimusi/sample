// Service Worker インストール時に実行される
self.addEventListener('install', (event) => {
    console.log('service worker install ...');
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
  console.log(`The client sent me a message: ${event.data}`);

  event.source.postMessage("Hi client");
});