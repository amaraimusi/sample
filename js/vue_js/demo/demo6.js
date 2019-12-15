
var vueApp; // vue.js

jQuery(() => {
	vueApp = new Vue({
			el: '#app1',
			data: {
				animal1:'トウキョウサンショウウオ',
			},
		});
	
});

// 外部からデータを変更してみる
function testFunc1(){

	vueApp.$set('animal2', 'シリケンイモリ');
	
}