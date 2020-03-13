
class AnimalClass{

	init(){
		let ent = {
				animal_name: '西表山猫',
		};
		
		// // バリデーションエラーメッセージリスト
		let valids = {
				animal_name: '',
		}; 
		
		this.app = new Vue({
				el: '#app1',
				data: {
					ent:ent,
					valids:valids,
					err_msg:'',
				},
				methods:{
					valid_animal_name:(value)=>{
						
						// 必須入力＆文字数制限
						let err = '';
						if(value == null || value == ''){
							err = '必須入力です。';
						}else{
							if(value.length > 4){
								err = '4文字以内で入力してください。';
							}
						}
						this.app.valids.animal_name = err;
					},
				},
			});
	}
}

jQuery(() => {
	let animal = new AnimalClass;
	animal.init();
});

