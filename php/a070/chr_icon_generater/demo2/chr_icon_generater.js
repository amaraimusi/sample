
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
		
		
		this.version = '0.9.0';
		
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
				defaultParam: this.defaultParam.bind(this),
			}
		})
		
	}
	
	
	/** デフォルトパラメータを取得する
	 */
	_getDefParam(){
		
		let param = {};
		
		param['corp_text'] = '東京'; // 法人名
		param['corp_backcolor'] = '#2b4d58'; // 法人名・背景色
		param['corp_fontcolor'] = '#ffffff'; // 法人名・文字色
		param['corp_fontsize'] = '26'; // 法人名・文字サイズ
		param['group_text'] = '在宅'; // グループ名
		param['group_backcolor'] = '#613e38'; // グループ名・背景色
		param['group_fontcolor'] = '#ffffff'; // グループ名・文字色
		param['group_fontsize'] = 36; // 法人名・文字サイズ
		param['img_w'] = 128; // 画像の横幅
		param['img_h'] = 128; // 画像の縦幅
		param['font_size'] = '34'; // 
		param['rect1_w_rate'] = '95'; // グループ名矩形・横幅率
		param['rect1_h_rate'] = '70'; // グループ名矩形・縦幅率
		param['rect1_top_rate'] = '33'; // グループ名矩形・上位置率
		param['ellipse1_top_rate'] = '7'; // 法人名楕円・縦位置率
		param['ellipse1_w_rate'] = '95'; // 法人名楕円・横幅率
		param['ellipse1_h_rate'] = '45'; // 法人名楕円・縦幅率
		
		return param;
	}
	


	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null) param = {};
		
		let defs = this._getDefParam();
		
		for(let key in defs){
			if(param[key] == null) param[key] = defs[key];
		}
		
		param = this._calcRect1Position(param); // グループ名矩形・位置計算
		param = this._calcEllipse1Position(param); // 法人名楕円・位置計算
		
		return param;
	}
	
	
	
	
	/** 法人名楕円・位置計算
	 * @param {} param
	 * @return {} param
	 */
	_calcEllipse1Position(param){
		
		let img_w = param.img_w; // 画像横幅
		let img_h = param.img_h; // 画像縦幅
		let ellipse1_top_rate = param.ellipse1_top_rate; // 法人名楕円・縦位置率
		let ellipse1_w_rate = param.ellipse1_w_rate; // 法人名楕円・横幅率
		let ellipse1_h_rate = param.ellipse1_h_rate; // 法人名楕円・縦幅率
		
		let ellipse1_w = img_w * ellipse1_w_rate * 0.01;
		let ellipse1_h = img_h * ellipse1_h_rate * 0.01;
		let ellipse1_cx = img_w / 2;
		let ellipse1_cy = (img_h * ellipse1_top_rate * 0.01) + (ellipse1_h / 2);
		
		ellipse1_w = Math.round(ellipse1_w);
		ellipse1_h = Math.round(ellipse1_h);
		ellipse1_cx = Math.round(ellipse1_cx);
		ellipse1_cy = Math.round(ellipse1_cy);
		
		param['ellipse1_w'] = ellipse1_w;
		param['ellipse1_h'] = ellipse1_h;
		param['ellipse1_cx'] = ellipse1_cx;
		param['ellipse1_cy'] = ellipse1_cy;
		
		return param;
		
	}
	
	/**
	 * グループ名矩形・位置計算
	 * @param {} param
	 * @return {} param
	*/
	_calcRect1Position(param){
		
		let img_w = param.img_w; // 画像横幅
		let img_h = param.img_h; // 画像縦幅
		let rect1_w_rate = param.rect1_w_rate; // グループ名矩形・横幅率
		let rect1_h_rate = param.rect1_h_rate; // グループ名矩形・縦幅率
		let rect1_top_rate = param.rect1_top_rate; // グループ名矩形・上位置率
		
		let rect1_w = img_w * rect1_w_rate * 0.01; // 矩形の横幅
		let rect1_h = img_h * rect1_h_rate * 0.01; // 矩形の縦幅
		
		// 四隅の位置を算出する。
		let rect1_x1 = (img_w - rect1_w) * 0.5;
		let rect1_x2 = rect1_x1 + rect1_w;
		let rect1_y1 = img_h * rect1_top_rate * 0.01;
		let rect1_y2 = rect1_h + rect1_y1;
		
		
		rect1_w = Math.round(rect1_w);
		rect1_h = Math.round(rect1_h);
		rect1_x1 = Math.round(rect1_x1);
		rect1_y1 = Math.round(rect1_y1);
		rect1_x2 = Math.round(rect1_x2);
		rect1_y2 = Math.round(rect1_y2);
		
		param['rect1_w'] = rect1_w;
		param['rect1_h'] = rect1_h;
		param['rect1_x1'] = rect1_x1;
		param['rect1_y1'] = rect1_y1;
		param['rect1_x2'] = rect1_x2;
		param['rect1_y2'] = rect1_y2;
		
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
		param = this._escapeForAjax(param);
		let send_json = JSON.stringify(param);//データをJSON文字列にする。
		
		let fd = new FormData();
		fd.append( "key1", send_json );

		// AJAX
		jQuery.ajax({
			type: "POST",
			url: "make_icon_action.php",
			data: fd,
			cache: false,
			dataType: "text",
			processData: false,
			contentType : false,
		})
		.done((param_json, type) => {
			let param;
			try{
				param =jQuery.parseJSON(param_json);//パース
				this._setIconImg(param.img_fp);
				this._saveParam(param); // パラメータをローカルストレージに保存
			}catch(e){
				this._showErr(param_json);
				return;
			}
		})
		.fail((jqXHR, statusText, errorThrown) => {
			this._showErr('アクセスエラー');
			this._showErr(jqXHR.responseText);
			
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
	* 画像要素に画像パスをセットする
	 */
	_setIconImg(img_fp){
		let u = Math.floor($.now() / 1000);
		let img_fp2 = img_fp + '?' + u;
		if (!this.imgMain) this.imgMain = jQuery('#img_main');
		if (!this.imgOrig) this.imgOrig = jQuery('#img_orig');
		this.imgMain.attr('src', img_fp2);
		this.imgOrig.attr('src', img_fp2);
		
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
	
	
	
	
	/**
	 * ローカルストレージキーを取得する
	 */
	_getLsKey(){
		// ローカルストレージキーを取得する
		let ls_key = location.href; // 現在ページのURLを取得
		ls_key = ls_key.split(/[?#]/)[0]; // クエリ部分を除去
		ls_key += '_ChrIconGenerater';
		ls_key += this.version;
		return ls_key;
	}
	
	// パラメータをローカルストレージに保存する
	_saveParam(param){
		let ls_key = this._getLsKey(); // ローカルストレージキーを取得する
		let json_str = JSON.stringify(param);//データをJSON文字列にする。
		localStorage.setItem(ls_key, json_str);
		
	}
	
	
	/** 入力を初期状態に戻す
	 */
	defaultParam(){
		let param = this.vueApp.param;
		let defs = this._getDefParam();
		
		for(let key in defs){
			param[key] = defs[key];
		}

		param = this._calcRect1Position(param); // グループ名矩形・位置計算
		param = this._calcEllipse1Position(param); // 法人名楕円・位置計算
		
		this._saveParam(param);
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