
var app; // vue.js
jQuery(() => {

	let animals = [
		{animal_name:'cat', value:1},
		{animal_name:'ヤンバルクイナ', value:2},
		{animal_name:'ヒージャー（やぎ）', value:3},
		{animal_name:'ウヮー（pig）', value:4},
		{animal_name:'インガー（The publish dog）', value:5},
	];
	
	app = new Vue({
			el: '#app1',
			data: {
				animals: animals,
				active_value:2,
				msg1:'テストメッセージ',
			},
			methods: {
				clickAnimalRdo:(index)=>{
					let animal_name = app.animals[index].animal_name;
					app.msg1 = index + ':' + animal_name;
				}
			}
		})
});

