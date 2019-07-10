/**
 * 小分けZIP
 * 
 * @date 2017-10-10
 * @version 1.0.0
 * 
 */
class ZipSubdiv{
	
	
	/**
	 * コンストラクタ
	 * 
	 * @param param
	 * - cmp_ajax_url 圧縮AjaxURL
	 * - prog_bar_slt 進捗バーのセレクタ
	 * - subroot サブルート： システムルートから圧縮対象ファイル群が存在するディレクトリへのパス
	 * - zip_subroot ZIPサブルートパス: システムルートからZIP展開先へのパス
	 * - zip_tmp_fn ZIPひな型ファイル名
	 * - size_limit 容量制限: 一つのZIPに詰め込むファイル容量(byte)
	 * - prog_max 最大進捗値: 省略時は100
	 * - prog_value 現在進捗値
	 * 
	 */
	constructor(param){
		
		this.saveKeys = ['flg','xxx']; // ローカルストレージへ保存と読込を行うparamのキー。
		this.ls_key = "ZipSubdiv"; // ローカルストレージにparamを保存するときのキー。
		
		this.param = this._setParamIfEmpty(param);
		
		this.progBar = $(param.prog_bar_slt); // 進捗バー要素
		
		
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
		
		if(param['cmp_ajax_url'] == null){
			throw new Error('Empty cmp_ajax_url !');
		}
		
		if(param['prog_bar_slt'] == null){
			throw new Error('Empty prog_bar_slt !');
		}
		
		if(param['subroot'] == null){
			throw new Error('Empty subroot !');
		}
		
		if(param['zip_subroot'] == null){
			
			param['zip_subroot'] = "";
		}
		
		if(param['zip_tmp_fn'] == null){
			param['zip_tmp_fn'] = 'zip';
		}
		
		if(param['size_limit'] == null){
			param['size_limit'] = 200000000;
		}
		
		if(param['prog_max'] == null){
			param['prog_max'] = 100;
		}
		
		if(param['prog_value'] == null){
			param['prog_value'] = 0;
		}
		
		return param;
	}
	
	
	

	
	/**
	 * 圧縮
	 * @param fileList ファイルリスト
	 * @param callbackInter 中間コールバック（省略可）
	 * @param callbackEnd 終了コールバック（省略可）
	 */
	compression(fileList,callbackInter,callbackEnd){
		
		
		if(this._empty(fileList)){
			return;
		}
		
		var param = self.param;

		var fileData = [];
		for(var i in fileList){
			var fp = fileList[i];
			var fEnt = {'fp':fp};
			fileData.push(fEnt);
		}
		
		
	
		param['zip_no'] = 1; // ZIP番号の初期化
		
		
		var dataset = {
				'fileData':fileData,
				'param':param
		};
		
		
		self._iteratorCmpr(dataset,callbackInter,callbackEnd);
		
	}
	
	/**
	 * 圧縮イテレータ
	 * @param param dataset データセット
	 * @param callbackInter 中間コールバック（省略可）
	 * @param callbackEnd 終了コールバック（省略可）
	 */
	_iteratorCmpr(dataset,callbackInter,callbackEnd){

		var json_str = JSON.stringify(dataset);//データをJSON文字列にする。

		// AJAX
		$.ajax({
			type: "POST",
			url: self.param.cmp_ajax_url,
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
		})
		.done(function(str_json, type) {
			
			try{
				dataset = jQuery.parseJSON(str_json);//パース
				
				
			}catch(e){
				jQuery("#err").html(str_json);
				console.log('エラー終了');
				return;
			}
			
			var param = dataset.param;
			
			// 進捗値を取得して進捗バーにセットする
			var prog_value = param.prog_value;
			self.progBar.val(prog_value);

			// 圧縮処理がまだ残っている場合
			if(param.complete_flg == 0){

				// 再起呼び出し
				self._iteratorCmpr(dataset,callbackInter,callbackEnd);
				
				// 中間コールバックの呼び出し
				if(typeof callbackInter == 'function'){
					callbackInter(dataset);
				}
				
			}
			
			// すべての圧縮処理が完了した場合
			else{
				// 終了コールバックの呼び出し
				if(typeof callbackEnd == 'function'){
					callbackEnd(dataset);
				}
			}
			
			
			
			
			
		})
		.fail(function(jqXHR, statusText, errorThrown) {
			jQuery('#err').html(jqXHR.responseText);
			alert(statusText);
		});
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