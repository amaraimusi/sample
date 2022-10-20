let app; // vue app

$(()=>{
	
	
	var data = [
		{animal_name:'イモリ', value:100, animal_date:'2022-10-13'},
		{animal_name:'ネコ', value:101, animal_date:'2022-10-14'},
		{animal_name:'カンガルー', value:102, animal_date:'2022-10-15'},
		{animal_name:'バイソン', value:103, animal_date:'2022-10-16'},
	];
	
	var createEnt = {animal_name:'-', value:0, animal_date:''};
		
	
	app = new Vue({
			el: '#app',
			data: {
				'data': data,
				'createEnt': createEnt,
			},
		});
	
})

// 新規入力
function store(){
	//let test = app.createEnt;
	app.data.push(app.createEnt);
	//console.log(test);//■■■□□□■■■□□□
}