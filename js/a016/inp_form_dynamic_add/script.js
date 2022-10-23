let app; // vue app

$(()=>{
	
	var animalTypeList = {
		1:'哺乳類',
		2:'爬虫類',
		3:'鳥類',
		4:'両生類',
		5:'魚類',
		6:'無脊椎動物',
	};

	var data = [
		{animal_name:'イモリ', value:100, animal_date:'2022-10-13', animal_type:4},
		{animal_name:'ネコ', value:101, animal_date:'2022-10-14', animal_type:1},
		{animal_name:'カンガルー', value:102, animal_date:'2022-10-15', animal_type:1},
		{animal_name:'バイソン', value:103, animal_date:'2022-10-16', animal_type:1},
	];
	
	var createEnt = {animal_name:'ヌタウナギ', value:3000, animal_date:'2022-10-23', animal_type:5};

	app = new Vue({
			el: '#app',
			data: {
				'data': data,
				'animalTypeList': animalTypeList,
				'createEnt': createEnt,
			},
		});
	
})

// 新規入力
function store(){
	app.data.push(app.createEnt);
}