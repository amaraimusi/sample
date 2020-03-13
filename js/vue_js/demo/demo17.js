
class AnimalClass{

	init(){
		
		this.cbv = new CrudBaseValidation(); // 汎用バリデーション関数群クラス
		
		let ent = {
				animal_name: '西表山猫',
				animal_value: 1234, 
				animal_date: '2020-3-12',
				animal_kana:'イリオモテヤマネコ',
				animal_hira:'いりおもてやまねこ',
				animal_mail:'iriomote_yamaneko.1.2@example.com',
				animal_tell:'090-xxxx-1234',
				animal_post:'907-1435',
				animal_password:'12345abcd',
				animal_code:'ab-123',
		};
		
		let valids = this._getValids(ent); // バリデーションエラーメッセージリスト
		let methods = this._getValidMethods(); // バリデーションメソッドリスト
		
		// ボタンクリックイベントを追加
		methods['clickBtn1'] = ()=>{
				this.clickBtn1();
		};
		
		this.app = new Vue({
				el: '#app1',
				data: {
					ent:ent,
					valids:valids,
					err_msg:'',
				},
				methods:methods,
			});
		
		this._validationAll(); // エンティティ内の全フィールドを一括バリデーション

	}
	
	/**
	 * バリデーションエラーメッセージリスト
	 */
	_getValids(ent){
		let valids = {};
		for(let field in ent){
			valids[field] = '';
		}
		return valids;
	}
	
	/**
	 * バリデーションメソッドリスト
	 */
	_getValidMethods(){
		let methods = {
				valid_animal_name:(value)=>{
					
					// 必須入力＆文字数制限
					let err = '';
					if(value == null || value == ''){
						err = '必須入力です。';
					}else{
						if(value.length > 10){
							err = '10文字以内で入力してください。';
						}
					}
					this.app.valids.animal_name = err;
				},
				
				valid_animal_value:(value)=>{
					let err = '';
					
					// 自然数バリデーション
					if(!this.cbv.isNaturalNumber(value)){
						err = '自然数で入力してください。';
					}
					this.app.valids.animal_value = err;
				},
				
				valid_animal_date:(value)=>{
					// 日付チェック
					let err = '';
					if(!this.cbv.isDate(value)){
						err = "日付形式(例：2020-12-31)で入力してください。";
					}
					this.app.valids.animal_date = err;
				},
				
				valid_animal_kana:(value)=>{
					
					// カタカナチェック
					let err = '';
					if(!this.cbv.isKatakana(value)){
						err = 'カタカナで入力してください。';
					}
					this.app.valids.animal_kana = err;
				},
				
				valid_animal_hira:(value)=>{
					
					// ひらがなチェック
					let err = '';
					if(!this.cbv.isHiragana(value)){
						err = 'ひらがなで入力してください。';
					}
					this.app.valids.animal_hira = err;
				},
				
				valid_animal_mail:(value)=>{
					
					// メールアドレスチェック
					let err = '';
					if(!this.cbv.isMail(value)){
						err = '正しいメールアドレス形式で入力してください。';
					}
					this.app.valids.animal_mail = err;
				},
				
				valid_animal_tell:(value)=>{
					
					// 電話番号チェック
					let err = '';
					if(!this.cbv.isTell(value)){
						err = '電話番号形式で入力してください。（例： 080-xxxx-1234)【半角数字】';
					}
					this.app.valids.animal_tell = err;
				},
				
				valid_animal_post:(value)=>{
					// 郵便番号チェック
					let err = '';
					if(!this.cbv.isPost(value)){
						err = '郵便番号形式で入力してください。（例： 123-4567)【半角数字】';
					}
					this.app.valids.animal_post = err;
				},
				
				valid_animal_password:(value)=>{
					
					// パスワードチェック
					let err = '';
					if(!this.cbv.isPassword(value)){
						err = '半角英数字で入力してください。（アルファベットまた数字を最低1字ずつ含めてください。）';
					}
					this.app.valids.animal_password = err;
				},
				
				valid_animal_code:(value)=>{
					
					// パスワードチェック
					let err = '';
					if(!this.cbv.isAlphaNum(value)){
						err = '半角英数字で入力してください。';
					}
					this.app.valids.animal_code = err;
				},
		}
		return methods;
	}
	
	
	/**
	 * ボタンクリックイベント
	 * @note
	 * まとめてバリデーションを行い、一つのエラーメッセージにまとめて表示する。
	 */
	clickBtn1(){
		let err_msg = ''; // エラーメッセージ
		this._validationAll(); // エンティティ内の全フィールドを一括バリデーション
		
		let valids = this.app.valids;
		for(let i in valids){
			let err = valids[i];
			if(err == '' || err == null) continue;
			err_msg +=err + '<br>';
		}
		
		this.app.err_msg = err_msg; // エラーメッセージ表示
	}
	
	/**
	 * エンティティ内の全フィールドを一括バリデーション
	 */
	_validationAll(){
		let methods = this._getValidMethods();
		let ent = this.app.ent;
		
		for(let field in ent){
			let key = 'valid_' + field;
			let validFunction = methods[key];
			if(validFunction == null) continue;
			let value = ent[field];
			validFunction(value);
		}
	}
	
}

jQuery(() => {
	let animal = new AnimalClass;
	animal.init();
});

