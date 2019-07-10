var app; // vue.js
jQuery(() => {
	app = new Vue({
		el: '#app1',
		data: {
			cats: [false, true, true, false],
			catData:[
				{text:'赤猫', value:1, xid:'cb_cat_aka'},
				{text:'白猫', value:2, xid:'cb_cat_siro'},
				{text:'三毛猫', value:3, xid:'cb_cat_mike'},
				{text:'茶白猫', value:4, xid:'cb_cat_chasiro'},
			],
		},
	})
});