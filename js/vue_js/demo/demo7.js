var app; // vue.js
jQuery(() => {
	app = new Vue({
			el: '#app1',
			data: {
				message1: 'ヌガー',
			}
		})
});


// クリックイベント
function test1(){
	$('#app1').insertAfter('#box1');
}


//クリックイベント
function test2(){
	$('#app1').insertAfter('#box2');
}