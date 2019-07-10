/**
 * 
 */

var app; // vue.js
jQuery(() => {
	app = new Vue({
			el: '#app1',
			data: {
				message1: 'リュウキュウオオコウモリ',
			}
		})
});	


function test1(){
	
	$('#text1').val('jQueryにてセット');
	$('#text1')[0].dispatchEvent(new Event('input')); // vue.js側に変更をイベント発信する
}