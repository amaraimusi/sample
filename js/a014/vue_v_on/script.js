	var app; // vue.js
	jQuery(() => {
		app = new Vue({
				el: '#app1',
				data: {
					message1: 'クリックテスト',
					message2: 'チェンジテスト',
					message2b: 'チェンジテスト',
					message3: 'v-on:inputテスト',
					message3b: 'テスト',
				},
				methods:{
			        testClick: function (value) {
						alert(value);
			        },
					testChange: function(){
						app.message2b = app.message2 + '星人';
					},
					testInput: function(){
						app.message3b = app.message3 + '大人';
					}
				}
			})
	});	