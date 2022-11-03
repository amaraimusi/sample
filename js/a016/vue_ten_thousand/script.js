var app;

$(()=>{
	
	let data_json = $('#data_json').val();
	let data = JSON.parse(data_json);
	
	app = new Vue({
		el: '#app1',
		data: {
			message1: 'ゴロニャゴゴロニャゴ',
			data:data,
		}
	});
});