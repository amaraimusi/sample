

	
$(()=>{
	if ('serviceWorker' in navigator) {
	  navigator.serviceWorker.register('./sw.js', { scope: './' })
	  .then(function(reg) {
	    console.log('Service workerの登録に成功しました。 Scope は ' + reg.scope);
	  }).catch(function(error) {
	    console.log('Service workerの登録に失敗しました。' + error);
	  });
	}
})


function test1(){
// 許可情報を取得
Push.Permission.get(); // denied || granted || denied
// hasを使うとboolで許可情報を取得できます
Push.Permission.has() // true || false

	console.log(Push.Permission.has());//■■■□□□■■■□□□


  // 通知許可された時のみ実行
  if (Push.Permission.has()) {
    Push.create("Welcomeメッセージ!", {
      body: "ログインしました",
      icon: "icon.png",
      timeout: 3000,
      onClick: function() {
        window.focus();
        this.close();
      } // ! onClick()
    }); // ! create()
  } // ! if
  
}