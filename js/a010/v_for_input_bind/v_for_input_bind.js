var app; // vue.js
jQuery(() => {
	app = new Vue({
		el: '#app1',
		data: {
			catData:{
				akaneko: {cat_name:'赤猫', cat_num:1},
				sironeko: {cat_name:'白猫', cat_num:2},
				mikeneko: {cat_name:'三毛猫', cat_num:3},
				chasiro: {cat_name:'茶白猫', cat_num:4},
			},
		},
	})
});