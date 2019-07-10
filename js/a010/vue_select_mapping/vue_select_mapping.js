var app; // vue.js
jQuery(() => {
	app = new Vue({
		el: '#app1',
		data: {
			amphibian: '2',
			amphibianList: {
				'100':'トウキョウサンショウウオ',
				'101':'シリケンイモリ',
				'102':'ホルストガエル',
				'103':'オオサンショウウオ',
				'104':'イボイモリ',
			}
		},
	})
});