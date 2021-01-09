
/**
 * アイコン生成ツール
 * @date 2020-01-04
 * @license MIT
 * @version 2.0.0
 */
class ChrIconGenerater{
	
	/**
	 * 初期化
	 * 
	 * @param param
	 * - div_xid 当機能埋込先区分のid属性
	 */
	init(param){
		
		param = this._setParamIfEmpty(param);
		
		// ローカルストレージからパラメータを上書きセットする。
		param = this._setPraramFromLs(param);
		
		// ビューデータの初期化
		this.vueApp  = new Vue({
			el: '#vueApp',
			data: {
				param: param,
			},

			methods: {
				makeIcon: this.makeIcon.bind(this),
					
			}
		})
		
	}


	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null) param = {};

		if(param['corp_text'] == null) param['corp_text'] = '東京';
		if(param['group_text'] == null) param['group_text'] = '在宅';
		if(param['text_color'] == null) param['text_color'] = '#ffffff';
		if(param['back_color'] == null) param['back_color'] = '#2aa748';
		
		
		if(param['img_w'] == null) param['img_w'] = 128;
		if(param['img_h'] == null) param['img_h'] = 128;
		if(param['font_size'] == null) param['font_size'] = 34;
		
		

		return param;
	}
	
	/**
	 * ローカルストレージから取得したパラメータをマージする。
	 */
	_setPraramFromLs(param){
		let ls_key = this._getLsKey();
		let param_json = localStorage.getItem(ls_key);
		let lsParam = JSON.parse(param_json);
		if(lsParam == null) lsParam = {};
		
		for(let key in lsParam){
			param[key] = lsParam[key];
		}
		
		return param;
		
	}
	
	makeIcon(){
		
		let param = this.vueApp.param;
		let send_json = JSON.stringify(param);//データをJSON文字列にする。

		// AJAX
		jQuery.ajax({
			type: "post",
			url: "make_icon_action.php",
			data: "key1=" + send_json,
			cache: false,
			dataType: "text",
			processData: false,
			contentType : false,
		})
		.done((res_json, type) => {
			console.log('A1-2');//■■■□□□■■■□□□)
			var res;
			try{
				console.log('A2');//■■■□□□■■■□□□)
				res =jQuery.parseJSON(res_json);//パース
			}catch(e){
				this._showErr(res_json);
				console.log('A3');//■■■□□□■■■□□□)
				return;
			}
			console.log(res);
		})
		.fail((jqXHR, statusText, errorThrown) => {
			this._showErr('アクセスエラー');
			this._showErr(jqXHR.responseText);
			
			alert(statusText);
		});
	}

	
	/**
	 * エラーを表示
	 * @param string err_msg エラーメッセージ
	 */
	_showErr(err_msg){
		if(!this.errDiv){
			this.errDiv = jQuery('#err');
		}
		this.errDiv.append(err_msg + '<br>');

	}
	
	
	///■■■□□□■■■□□□以下未使用
	/**
	 * プロパティ値を取得する
	 * @param string key プロパティのキー
	 * @param mixed init_value 初期値
	 * @param object param
	 * @param object lsParam ローカルストレージから取得したパラメータ
	 * @return プロパティ値
	 */
	_getProperty(key, init_value, param, lsParam){

		// ローカルストレージ、引数、デフォルトを優先順にプロパティ値を取得する。
		let prop_v = null; // プロパティ値
		if(lsParam[key] != null){
			prop_v = lsParam[key];
		}else if(param[key] != null){
			prop_v = param[key];
		}else{
			prop_v = init_value;
		}
		return prop_v;
	}
	
	
	/**
	 * ローカルストレージパラメータを取得する
	 */
	_getLsParam(){
		
		let ls_key = this._getLsKey(); // ローカルストレージキーを取得する
		let param_json = localStorage.getItem(ls_key);
		let lsParam = JSON.parse(param_json);
		if(lsParam == null) lsParam = {};
		return lsParam;
		
	}
	
	/**
	 * ローカルストレージで保存しているパラメータをクリアする
	 */
	clearlocalStorage(){
		let ls_key = this._getLsKey(); // ローカルストレージキーを取得する
		localStorage.removeItem(ls_key);
	}
	
	
	/**
	 * ローカルストレージにプロパティを保存
	 */
	_saveLsProp(key, val){
		this.lsParam[key] = val;
		let ls_key = this._getLsKey(); // ローカルストレージキーを取得する
		var param_json = JSON.stringify(this.lsParam);
		localStorage.setItem(ls_key, param_json);
	}
	
	
	/**
	 * ローカルストレージキーを取得する
	 */
	_getLsKey(){
		// ローカルストレージキーを取得する
		let ls_key = location.href; // 現在ページのURLを取得
		ls_key = ls_key.split(/[?#]/)[0]; // クエリ部分を除去
		ls_key += '_ChrIconGenerater';
		return ls_key;
	}
	
	

	
	// Check empty.
	_empty(v){
		if(v == null || v == '' || v=='0'){
			return true;
		}else{
			if(typeof v == 'object'){
				if(Object.keys(v).length == 0){
					return true;
				}
			}
			return false;
		}
	}
	
}