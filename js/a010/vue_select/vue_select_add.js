var app; // vue.js
jQuery(() => {
	
	let amphibianList = [
			'アフリカツメガエル',
			'シリケンイモリ',
			'トウキョウサンショウウオ',
			'カジカガエル',
	];
	
	app = new Vue({
		el: '#app1',
		data: {
			amphibian_value: '2',
			new_amphibian:'',
			amphibianList: amphibianList,
		},
		methods:{
			addList:()=>{
				let add_value = this.app.new_amphibian;
				this.app.amphibianList.push(add_value);
			}
		},
	})
});