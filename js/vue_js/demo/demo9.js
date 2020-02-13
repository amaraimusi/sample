var app; // vue.js
jQuery(() => {
	app = new Vue({
			el: '#app1',
			data: {
				data:[
					{id:100, fish_name:'グルクン', fish_price:200},
					{id:101, fish_name:'フィーフチャー', fish_price:300},
					{id:102, fish_name:'ミーバイ', fish_price:400},
					{id:103, fish_name:'グルクマー', fish_price:200},
				]
			},
			methods: {
				deleteAction:(index)=>{
					app.data.splice(index, 1);
				},
				addAction:()=>{
					let newRow = {id:900, fish_name:'追加テスト', fish_price:999};
					app.data.push(newRow);
				}
			}
		})
});


