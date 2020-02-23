
var app; // vue.js
jQuery(() => {
	
	let catTypeList = {
			1:'三毛猫',
			2:'シャムトラ',
			3:'鯖トラ',
			4:'白黒',
	};
	app = new Vue({
			el: '#app1',
			data: {
				catTypeList:catTypeList,
				cat_type:2,
				res:'',
			},
			methods:{
				testChange:(name)=>{
					app.res = name + '→' + app.catTypeList[app.cat_type];
				}
			}
		})
});

