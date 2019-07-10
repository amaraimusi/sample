
var app; // vue.js
jQuery(() => {
	app = new Vue({
			el: '#app1',
			data: {
				message1: 'リュウキュウオオコウモリ',
				text1: '奄美大島に生息', 
				class1: 'text-danger'
			}
		})
});

// 外部からデータを変更してみる
function testFunc1(){
	app.message1 = "ヌマエビ";
	
}