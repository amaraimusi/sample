
let app;

$(()=>{
	
	let formData = {
		'cat_name':'ボウシちゃん',
		'cat_nickname':'オコモさん',
	};
	
	app = new Vue({
		el: '#app1',
		data: {
			'formData':formData,
		},
	});
	
	let plainData = getPlainDataFromVue(app, 'formData');
	console.log(plainData);
	$('#res').html(JSON.stringify( plainData));
	
});

/**
* Vueのappからバインドされていないプレーンなデータを取得する
* ＠param app VueのApp
* @param key データのキー省略可
* @return {} プレーンなデータ
*/
function getPlainDataFromVue(app, key){
	let anyData = null;
	if(key==null){
		anyData = app._data;
	}else{
		anyData = app[key];
	}
	
	let plainData = {};
	for(let key2 in anyData){
		plainData[key2] = anyData[key2];
	}
	
	return plainData;
}

