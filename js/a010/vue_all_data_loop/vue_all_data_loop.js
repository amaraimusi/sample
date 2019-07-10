var app; // vue.js
jQuery(() => {
	app = new Vue({
		el: '#app1',
		data: {
			cat_name:'赤猫', 
			cat_num:100,
			cat_date:'2019-3-20'
		},
	})
	
	// ▼ 全データのループ
	for(var key in app._data){
		console.log('key=' + key);
		console.log(app[key]);
		jQuery('#res').append(key + ' = ' + app[key] + '<br>');
	}
	
});