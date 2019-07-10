var app; // vue.js
jQuery(() => {
	app = new Vue({
		el: '#app1',
		data: {
			fish_type: '',
			fish_type2: '',
			amphibian_type: '2',
			amphibianOptions: [
				{ text: 'カエル', value: '1' },
				{ text: 'イモリ', value: '2' },
				{ text: 'ｻﾝｼｮｳｳｵ', value: '3' }
			]
		},
	})
});