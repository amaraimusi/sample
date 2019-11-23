

$(()=>{
	
	var app; // vue.js
	jQuery(() => {
		app = new Vue({
				el: '#app1',
				data: {
					text1: '奄美大島に生息\n改行→アマミノクロウサギ\tタブのテスト<div>AA</div>', 
				},
			})
	});
	
});