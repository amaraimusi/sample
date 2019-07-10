/**
 * Class of JavaScript for ES6
 * 
 * @date 2017-10-10
 * @version 1.0.0
 * 
 */
class Animal{
	
	
	/**
	 * コンストラクタ
	 * 
	 * @param param
	 * - flg
	 */
	constructor(param){
		
		this.saveKeys = ['flg','xxx']; // ローカルストレージへ保存と読込を行うparamのキー。
		this.ls_key = "Animal"; // ローカルストレージにparamを保存するときのキー。
		
		this.param = this._setParamIfEmpty(param);
		
		self = this; // Instance of myself.

	}
	

	
	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == undefined){
			param = {};
		}
	
		// ローカルストレージで保存していたパラメータをセットする
		var param_json = localStorage.getItem(self.ls_key);
		if(!this._empty(param_json)){
			var lsParam = JSON.parse(param_json);
			if(lsParam){
				for(var i in self.saveKeys){
					var s_key = self.saveKeys[i];
					param[s_key] = lsParam[s_key];
				}
			}
		}
		
		if(param['flg'] == undefined){
			param['flg'] = 0;
		}
		
		return param;
	}
	
	
	
	
	/**
	 * テストAJAX
	 */
	execute(){
		var data={'neko':'ネコ','same':{'hojiro':'ホオジロザメ','shumoku':'シュモクザメ'},'xxx':111};

		data = this._escapeForAjax(data); // Ajax送信データ用エスケープ。実体参照（&lt; &gt; &amp; &）を記号に戻す。
		var json_str = JSON.stringify(data);//データをJSON文字列にする。

		// AJAX
		$.ajax({
			type: "POST",
			url: "test.php",
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
		})
		.done(function(str_json, type) {
			var ent;
			try{
				ent =jQuery.parseJSON(str_json);//パース
				jQuery("#res").html(str_json);
				
				
			}catch(e){
				alert('エラー');
				jQuery("#err").html(str_json);
				return;
			}
			
			self.test1();
		})
		.fail(function(jqXHR, statusText, errorThrown) {
			jQuery('#err').html(jqXHR.responseText);
			alert(statusText);
		});
	}
	
	
	
	test1(){
		console.log('TEST');
	}
	
	
	
	
	/**
	 * Ajax送信データ用エスケープ。実体参照（&lt; &gt; &amp; &）を記号に戻す。
	 * 
	 * @param any data エスケープ対象 :文字列、オブジェクト、配列を指定可
	 * @returns エスケープ後
	 */
	_escapeForAjax(data){
		if (typeof data == 'string'){
			if ( data.indexOf('&') != -1) {
				data = data.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');
				return encodeURIComponent(data);
			}else{
				return data;
			}
		}else if (typeof data == 'object'){
			for(var i in data){
				data[i] = this._escapeForAjax(data[i]);
			}
			return data;
		}else{
			return data;
		}
	}
	
	


	/**
	 * ローカルストレージにパラメータを保存する
	 */
	saveParam(){
		var lsParam = {};
		for(var i in self.saveKeys){
			var s_key = self.saveKeys[i];
			lsParam[s_key] = self.param[s_key];
		}
		var param_json = JSON.stringify(lsParam);
		localStorage.setItem(self.ls_key,param_json);
	}
	
	
	/**
	 * ローカルストレージで保存しているパラメータをクリアする
	 */
	clear(){
		localStorage.removeItem(self.ls_key);
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