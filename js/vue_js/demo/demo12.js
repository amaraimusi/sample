
var app; // vue.js
jQuery(() => {
	
	let animalTypeList = {1:'哺乳類', 2:'魚類', 3:'両生類', 4:'爬虫類', 5:'鳥類'};
	let ent = {id:100, animal_type:2, animal_name:'ネオンテトラ'};
	
	app = new Vue({
			el: '#app1',
			data: {
				animalTypeList: animalTypeList,
				ent,
			}
		})
});

