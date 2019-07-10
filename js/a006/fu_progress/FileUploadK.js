
/**
 * ファイルアップロードの拡張クラス
 * 
 * @note
 * DnD（ドラッグ&ドロップに対応。
 * アップロード区分のドレスアップ。
 * エンティティなどのデータも一緒に送信。
 * 複数のファイルをアップロードできる。
 * 複数のファイルアップロード要素に対応。
 * 進捗バーの表示
 * 
 * @version 1.0
 * @date 2018-7-6
 * @history 
 *  - 2018-7-6 新規作成
 * 
 */
class FileUploadK{
	
	
	/**
	 * コンストラクタ
	 * 
	 * @param param
	 * - ajax_url 通信先URL
	 * - style_flg 専用スタイルフラグ デフォルトON
	 * - unit_slt まとまり要素のセレクタ  省略時はbody
	 * - prog_slt 進捗バー要素のセレクタ
	 * - err_slt  エラー要素のセレクタ
	 * - first_msg_text 初期メッセージテキスト
	 * - adf    補足データフラグリスト (Ancillary Data Flgs)
	 *     - fn_flg ファイル名・表示フラグ (デフォ:1 以下同じ)
	 *     - size_flg 容量・表示フラグ
	 *     - mime_flg MIME・表示フラグ
	 *     - modified 更新日時・表示フラグ
	 */
	constructor(param){
		
		this.filesData = {}; // ファイルズデータ
		
		this.param = this._setParamIfEmpty(param);
		
		this.unit = jQuery(param.unit_slt);
		
		this.feData = {}; // ファイル要素データ
		

	}

	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null){
			throw new Error("Please set 'ajax_url' in 'param");
		}
		
		if(param['ajax_url'] == null){
			throw new Error("Please set 'ajax_url' in 'param");
		}
		
		if(param['style_flg'] == null) param['style_flg'] = 1;
		
		if(param['unit_slt'] == null) param['unit_slt'] = 'body';
		
		if(param['err_slt'] == null) param['err_slt'] = '#err';
		
		if(param['first_msg_text'] == null) param['first_msg_text'] = '';
		
		// 補足データフラグリスト
		if(param['adf'] == null){
			param['adf'] = {
					'fn_flg':1,
					'size_flg':1,
					'mime_flg':1,
					'modified_flg':1,
			};
		}
		
		return param;
	}
	
	
	
	/**
	 * ファイルアップロード関連のイベントを追加する。
	 * 
	 * @note
	 * ファイルチェンジイベントの追加。
	 * DnDイベントの追加
	 * 
	 * @param fue_id ファイルアップロード要素のid属性
	 * @param option 未使用
	 */
	addEvent(fue_id,option){
		
		// ファイルアップロード要素の親ラベル（DnD要素）を取得する
		var parLabel = this._getElement(fue_id,'label');
		
		// 親ラベル要素にfue_idを属性として追加する。
		parLabel.attr('data-fue-id',fue_id);
		
		// 各要素から値を取ってきて、ファイル要素データにセットする。
		var feData = this._setFeData(fue_id,this.feData);
		
		// 親ラベル要素にいくつかの関連要素を追加する。
		this._addRelatedElements(parLabel,fue_id,feData);
		
		// 関連要素にCSSスタイルを適用する
		this._applyStyle(fue_id);
		
		// DnDイベントをラッパー要素に追加
		parLabel[0].addEventListener('drop',(evt) => {
			evt.stopPropagation();
			evt.preventDefault();

			// ファイルズデータにアップロードファイル情報を追加
			var files = evt.dataTransfer.files; 
			this.filesData[fue_id] = files;
			this._preview(fue_id); // プレビュー表示
			
		},false);
		// ドラッグオーバーイベントを発動させないようにする。
		parLabel[0].addEventListener('dragover',(evt) => {
			evt.preventDefault();
		},false);
		
		// ファイルアップロード要素のチェンジイベントを追加する。
		var fu = this._getElement(fue_id,'file');
		fu.change((e) => {
			
			// ファイルズデータにアップロードファイル情報を追加
			var files = e.target.files; // ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）

			if(files == null || files.length == 0) return;// ファイル件数が0件なら処理抜け
			
			this.filesData[fue_id] = files;
			this._preview(fue_id); // プレビュー表示
			
		});
		
		// クリアボタンにイベントを実装する
		var clearBtn = this._getElement(fue_id,'clear_btn');
		clearBtn.click((e) => {
			this._clearBtnClick(e);
		});
	}
	
	
	/**
	 * 親ラベル要素にいくつかの関連要素を追加する。
	 * @param jQuery parLabel 親ラベル要素
	 * @param int fue_id FU要素ID
	 * @param object feData ファイル要素データ
	 */
	_addRelatedElements(parLabel,fue_id,feData){
		
		var html = '';
		
		// 初期メッセージ要素を追加
		var first_msg_text = feData[fue_id]['first_msg_text']; // 初期メッセージテキスト
		html += "<span class='fuk_first_msg'>" + first_msg_text +"</span>";
		
		// プレビュー要素を追加
		html += "<span class='fuk_preview' style='display:'inline-block''></span>";
		
		// クリアボタン用を追加
		html += "<div class='fuk_clear_btn_w'><input type='button' value='Clear' class='btn btn-default btn-xs fuk_clear_btn' " +
				"data-fue-id='" + fue_id + "' /></div>";
		
		parLabel.append(html);
		
	}
	
	
	/**
	 * 関連要素にCSSスタイルを適用する
	 * 
	 * @param int fue_id FU要素ID
	 */
	_applyStyle(fue_id){
		if(!(this.param.style_flg)) return;
		
		var parLabel = this._getElement(fue_id,'label'); // 親ラベル要素
		parLabel.addClass('fuk'); // CSSスタイルの適用
		
	}
	
	
	/**
	 * プレビュー表示
	 * @param fue_id ファイルアップロード要素のid属性
	 */
	_preview(fue_id){
		
		var files = this.filesData[fue_id];

		
		// 親ラベル要素を内部要素に合わせてフィットさせるため幅をautoにする。
		var parLbl = this._getElement(fue_id,'label');
		parLbl.css({'width':'auto','height':'auto'});
		
		// 初期メッセージ要素を隠す。
		var firsMsgElm = this._getElement(fue_id,'first_msg');
		firsMsgElm.hide();
		
		// クリアボタンを表示する
		var clearBtnW = this._getElement(fue_id,'clear_btn_w');
		clearBtnW.show();
		
		
		
		var preview_html = ''; // プレビューHTML
		
		// プレビュー用の要素であるプレビューHTMLを作成する。
		for(var i in files){
			var file = files[i];
			if(file.size == null) continue;
			
			// ファイルユニットHTMLを作成して、プレビューHTMLに連結する。
			preview_html += this._makeFileUnitHtml(fue_id,file); 

		}
		
		// プレビュー区分要素にプレビューHTMLをセットする。
		var prvElm = this._getElement(fue_id,'preview');
		if(prvElm[0]) prvElm.html(preview_html);
		
		// リソースプレビュー要素を取得する。リソースプレビュー要素はプレビュー区分要素内に複数存在するDIV要素群のこと。
		var rpElms = {}; // リソースプレビュー要素リスト
		prvElm.children('div').each((i,elm)=>{
			elm = jQuery(elm);
			var rpElm = elm.find('.fuk_rp');
			if(rpElm[0]){
				rpElms[i] = rpElm;
			}else{
				rpElms[i] = null;
			}
		});
	
		// リソース（画像など）をリソースプレビュー要素に表示させる。（非同期処理あり）
		for(var i in rpElms){
			if(rpElms[i]==null) continue;
			var file = files[i];

			if(file.size == null) continue;
			
			// リソース（ファイル）のレンダリングを行い、リソースプレビュー要素に画像などを表示する。
			this._setupRender(file,rpElms,i);

		}
		
	}
	
	
	/**
	 * リソース（ファイル）のレンダリングを行い、リソースプレビュー要素に画像などを表示する。
	 * @param object file ファイルデータ
	 * @param array rpElms リソースプレビュー要素群
	 * @param int i インデックス
	 */
	_setupRender(file,rpElms,i){
		var reader = new FileReader();
		reader.readAsDataURL(file);
		
		// After conversion of the event.
		reader.onload = (evt) => {

			var rpElm = rpElms[i];
			rpElm.attr('src',reader.result);

		}
	}
	
	/**
	 * ファイルユニットHTML
	 * @param int fue_if FU要素ID
	 * @param object file ファイルデータ
	 * @return string プレビューユニットHTML
	 */
	_makeFileUnitHtml(fue_id,file){
		
		var p_unit_html = ""; // プレビューユニットHTML
		var mime = file.type; // MIME
		// MIMEからファイル種別を判別する。
		var file_type = '';
		if(mime != null){
			if(mime.indexOf('image') >= 0) file_type = 'image';
			if(mime.indexOf('audio') >= 0) file_type = 'audio';
		}
		
		// 画像要素と音楽要素の作成
		if(file_type == 'image'){
			p_unit_html += "<img src='' class='fuk_rp' style='width:240px;height:160px;' />";
		}else if(file_type == 'audio'){
			p_unit_html += "<audio src='' class='fuk_rp' controls />";
		}
		
		var fn = ''; // ファイル名
		if(file.name != null) fn = file.name;
		
		var size_str = 0; // サイズ（ファイル容量）
		if(file.size != null) size_str = file.size;
		if(!isNaN(size_str)){
			size_str = this._convSizeUnit(size_str); // 単位付き表示に変換
		}

		var mime_str = ''; // MIME
		if(mime != null) mime_str = mime;
		
		var modified = ''; // 更新日
		if(file.lastModifiedDate != null){
			modified = file.lastModifiedDate.toLocaleString();
		}
		
		
		var adf = this.param.adf;// 付属データフラグリスト
	
		// 通常パラメータの表示
		var paramData = [
			{'label':'ファイル名','val':fn,'flg':adf.fn_flg},
			{'label':'サイズ','val':size_str,'flg':adf.size_flg},
			{'label':'MIME','val':mime_str,'flg':adf.mime_flg},
			{'label':'更新日','val':modified,'flg':adf.modified_flg},
		];
		
		// パラメータ区分のHTMLを組み立てる
		for(var i in paramData){
			var pEnt = paramData[i];
			if(pEnt.flg != 1) continue;
			p_unit_html += 
				"<div><label class='fuk_param_label'>" + pEnt.label + "</label>" + 
				"<val class='fuk_param_val'>" + pEnt.val + "</val></div>";
		}

		p_unit_html = "<div class='fuk_file_unit' >" + p_unit_html + '</div>';

		return p_unit_html;
		
	}
	
	
	
	
	/**
	 * クリアボタンのクリックイベント
	 */
	_clearBtnClick(e){
		
		// クリアボタン要素を取得、そのクリアボタン要素から要素ID(fue_id)を取得。ついでにクリアボタンも隠す。
		var clickBtn = jQuery(e.currentTarget);
		var fue_id = clickBtn.attr('data-fue-id');

		// クリアボタンラッパー要素を隠す
		var clearBtnW = this._getElement(fue_id,'clear_btn_w');
		clearBtnW.hide();
		
		// FU要素を取得し、中身をクリアする。
		var fue = this._getElement(fue_id,'file');
		fue.val('');
		
		// 初期メッセージ要素を再表示する。
		var firstMsg = this._getElement(fue_id,'first_msg');
		firstMsg.show();
		
		// プレビュー要素を取得し、中身をクリアする。
		var preview = this._getElement(fue_id,'preview');
		preview.html('');

		// 親ラベルの幅をautoから初期サイズに戻す
		var label_width = this.feData[fue_id]['label_width']
		var label_height = this.feData[fue_id]['label_height']
		var parLabel = this._getElement(fue_id,'label');
		parLabel.width(label_width);
		parLabel.height(label_height);
		
	}
	
	/**
	 * AJAXによるアップロード
	 * 
	 * @param callback(res) ファイルアップロード後コールバック
	 * @param withData 一緒に送るデータ
	 * @param option 未使用
	 */
	uploadByAjax(callback,withData,option){
		
		var param = this.param;
	
		var fd = new FormData();
		
		var index = 0;
		for(var fu_id in this.filesData){
			var files = this.filesData[fu_id];
			for(var i in files){
				fd.append(index, files[i]);
				index ++;
			}
		}

		// ファイル情報と一緒に送信するデータをセットする
		withData = this._escapeForAjax(withData); // Ajax送信データ用エスケープ
		var with_json = JSON.stringify(withData);
		fd.append( "key1", with_json );
	
		var prog1 = null; // 進捗バー要素
		if (param.prog_slt) prog1 = this.unit.find(param.prog_slt);

		
		
		// AJAXによるファイルアップロード
		jQuery.ajax({
			type: "POST",
			url: param.ajax_url,
			data: fd,
			cache: false,
			dataType: "text",
			processData : false,
			contentType : false,
			xhr : () => { // 進捗イベント
				var XHR = jQuery.ajaxSettings.xhr();
				if (XHR.upload) {
					XHR.upload.addEventListener('progress',
							(e) => {
								if(prog1){
									var prog_value = parseInt(e.loaded / e.total * 10000) / 100;
									prog1.val(prog_value);
								}
							}, false);
				}
				return XHR;
			},
	
		})
		.done((str_json, type) => {
			var res;
			try{
				res =jQuery.parseJSON(str_json);//パース
			}catch(e){
				jQuery(this.param.err_slt).html(str_json);
				return;
			}
			
			resOutput(res); // レスポンス出力
			
			
		})
		.fail((jqXHR, statusText, errorThrown) => {
			
			var err_res = jqXHR.responseText;
			console.log(err_res);
			jQuery(this.param.err_slt).html(err_res);
			alert(statusText);
		});
	}
	
	
	getFileParams(){
		
		var pData = [];
		for(var fu_id in this.filesData){
			var files = this.filesData[fu_id];
			var pEnt = {};
			for(var i in files){
				
				var file = files[i];
				if(file.size == null) continue;
				
				pEnt['fu_id'] = fu_id;
				pEnt['name'] = file.name;
				pEnt['size'] = file.size;
				pEnt['mime'] = file.type;
				pEnt['modified'] = file.lastModifiedDate.toLocaleString();
				
				pData.push(pEnt);
			}
		}
		return pData;
	}
	
	
	/**
	 * ファイルアップロード関連の要素を引数を指定して取得する
	 * @param fue_id ファイルアップロード要素のid属性
	 * @param key 要素を指定するキー　label,file,first_msg,preview
	 * @return jQuery 要素
	 */
	_getElement(fue_id,key){
		
		var feData = this.feData; // ファイル要素データ
		
		if(feData[fue_id] == null) feData[fue_id] = {};
		
		// ファイル要素を取得
		if(key == 'file'){
			var elm = null;
			if(feData[fue_id]['file']){
				elm = feData[fue_id]['file'];
			}else{
				elm = this.unit.find('#' + fue_id);
				feData[fue_id]['file'] = elm;
			}
			return elm; 
		}
		
		// 親ラベル要素を取得。ついでにラベル幅も取得。
		else if(key == 'label'){
			var elm = null;
			if(feData[fue_id]['label']){
				elm = feData[fue_id]['label'];
			}else{
				var fileElm = this._getElement(fue_id,'file');
				if(fileElm == null) return null;
				elm = fileElm.parents('label');
				feData[fue_id]['label'] = elm;
				

			}
			return elm; 
		}
		
		// 初期メッセージ要素を取得
		else if(key == 'first_msg'){
			var elm = null;
			if(feData[fue_id]['first_msg']){
				elm = feData[fue_id]['first_msg'];
			}else{
				var label = this._getElement(fue_id,'label');
				if(label == null) return null;
				elm = label.find('.fuk_first_msg');
				feData[fue_id]['first_msg'] = elm;
			}
			return elm; 
		}
		
		// プレビュー要素を取得
		else if(key == 'preview'){
			var elm = null;
			if(feData[fue_id]['preview']){
				elm = feData[fue_id]['preview'];
			}else{
				var label = this._getElement(fue_id,'label');
				if(label == null) return null;
				elm = label.find('.fuk_preview');
				feData[fue_id]['preview'] = elm;
			}
			return elm; 
		}
		
		// クリアボタン要素を取得
		else if(key == 'clear_btn'){
			var elm = null;
			if(feData[fue_id]['clear_btn']){
				elm = feData[fue_id]['clear_btn'];
			}else{
				var label = this._getElement(fue_id,'label');
				if(label == null) return null;
				elm = label.find('.fuk_clear_btn');
				feData[fue_id]['clear_btn'] = elm;
			}
			return elm; 
		}
		
		// クリアボタンラッパー要素を取得
		else if(key == 'clear_btn_w'){
			var elm = null;
			if(feData[fue_id]['clear_btn_w']){
				elm = feData[fue_id]['clear_btn_w'];
			}else{
				var label = this._getElement(fue_id,'label');
				if(label == null) return null;
				elm = label.find('.fuk_clear_btn_w');
				feData[fue_id]['clear_btn_w'] = elm;
			}
			return elm; 
		}
		
		return null;

	}
	
	/**
	 * 各要素から値を取ってきて、ファイル要素データにセットする。
	 * 
	 * @param int fue_id FU要素ID
	 * @param object feData ファイル要素データ
	 * @return ファイル要素データ
	 */
	_setFeData(fue_id,feData){
		
		var feEnt = {};
		if(feData[fue_id]) feEnt = feData[fue_id];
		
		// 親ラベル要素から幅を取得してセット
		var parLebel = this._getElement(fue_id,'label'); // 親ラベル要素
		feEnt['label_width'] = parLebel.width(); 
		feEnt['label_height'] = parLebel.height(); 
		
		// paramの初期メッセージテキストをセット。空ならFU要素のtitle属性をセット
		var first_msg_text = ''; // 初期メッセージテキスト
		if(this.param.first_msg_text){
			first_msg_text = this.param.first_msg_text;
		}else{
			var fe = this._getElement(fue_id,'file'); // FU要素
			var fe_title = fe.attr('title');
			if(fe_title){
				first_msg_text = fe_title;
			}else{
				first_msg_text = 'File Upload';
			}
		}
		feEnt['first_msg_text'] = first_msg_text;
		
		feData[fue_id]  = feEnt;
		
		return feData;
	}
	
	
	
	
	/**
	 * 容量サイズの数値を適切な単位表示に変換する（Byte,KB,MB,GB,TB)
	 * @param int value1 入力数値
	 * @param int n 小数点以下の桁（四捨五入）
	 * @returns string 単位表示
	 */
	_convSizeUnit(value1,n){
		
		if(n == null) n=1;
	
		var res = '';
		if(value1 < 1000){
			res = value1 + 'Byte';
		}else if(value1 < Math.pow(10,6)){
			value1 = Math.round( value1  * Math.pow(10,n - 3) ) / Math.pow(10,n); // 四捨五入
			res = value1 + 'KB';
		}else if(value1 < Math.pow(10,9)){
			value1 = Math.round( value1  * Math.pow(10,n - 6) ) / Math.pow(10,n);
			res = value1 + 'MB';
		}else if(value1 < Math.pow(10,12)){
			value1 = Math.round( value1  * Math.pow(10,n - 9) ) / Math.pow(10,n);
			res = value1 + 'GB';
		}else{
			value1 = Math.round( value1  * Math.pow(10,n - 12) ) / Math.pow(10,n);
			res = value1 + 'TB';
		}
		return res;
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
	

}