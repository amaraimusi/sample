/**
 * ファイルアップロード拡張クラス
 * 
 * @note
 * ES6版
 * FileuploadsX.jsはファイルアップロードを拡張し、進捗バー、DnD、複数ファイルに対応させる。
 * 
 * @date 2017-10-30 | 2017-11-1
 * @version 1.0.1
 * 
 */
class FileuploadsX{
	
	
	/**
	 * コンストラクタ
	 * 
	 * @param param
	 *  - wrap_slt ラッパー要素のセレクタ
	 *  - fu_slt ファイルアップロード要素のセレクタ
	 *  - prog_slt 進捗バー要素のセレクタ
	 *  - ajax_url AJAX通信先URL
	 *  - callback(res) ファイルアップロード後コールバック: 省略可
	 *  - fu_show_flg ファイルアップロード要素の表示 0:非表示（デフォルト） , 1:表示
	 *  - start_prog_v デフォルト進捗値: 省略時は0
	 *  - end_prog_v 最大進捗値: 省略時は100
	 *  - err_slt エラー要素のセレクタ
	 */
	constructor(param){
		
		this.param = this._setParamIfEmpty(param);
		
		// ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する
		this._fileuploadEx(param);
	}

	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null){
			param = {};
		}
		
		if(param['wrap_slt'] == null){
			throw new Error('Empty wrap_slt !');
		}
		
		if(param['fu_slt'] == null){
			throw new Error('Empty fu_slt !');
		}
		
		if(param['prog_slt'] == null){
			throw new Error('Empty prog_slt !');
		}
		
		if(param['ajax_url'] == null){
			throw new Error('Empty ajax_url !');
		}
		
		if(param['callback'] == null){
			param['callback'] == null;
		}
		
		if(param['fu_show_flg'] == null){
			param['fu_show_flg'] = 0;
		}
		
		if(param['start_prog_v'] == null){
			param['start_prog_v'] = 0;
		}
		
		if(param['end_prog_v'] == null){
			param['end_prog_v'] = 100;
		}
		
		if(param['err_slt'] == null){
			param['err_slt'] = '#err';
		}
		
		return param;
	}
	


	/**
	 * ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する
	 * 
	 * @param param
	 */
	_fileuploadEx(param){
		
		var fuw = $(param.wrap_slt);
		
		// DnDイベントをラッパー要素に追加
		fuw[0].addEventListener('drop',(evt) => {
			evt.stopPropagation();
			evt.preventDefault();

			var files = evt.dataTransfer.files; 
			this._uploadByAjax(files,param); // AJAXによるアップロード

		},false);
		
		fuw[0].addEventListener('dragover',(evt) => {
			evt.preventDefault();
		},false);
		
		// ファイルアップロード要素のイベント
		var fu = $(param.fu_slt);
		fu.change((e) => {
			
			var files = e.target.files; // ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
			this._uploadByAjax(files,param); // AJAXによるアップロード
		});
		
		// ファイルアップロード要素の表示フラグがOFFならファイルアップロード要素を隠す。
		if(param.fu_show_flg == 0){
			fu.hide();
		}
		
	}

	/**
	 * AJAXによるアップロード
	 * @param files ファイルオブジェクトリスト
	 * @param param
	 */
	_uploadByAjax(files,param){

		var fd = new FormData();
		for(var i in files){
			fd.append(i, files[i]);
		}

		var prog1 = $(param.prog_slt); // 進捗バー要素

		// AJAXによるファイルアップロード
		$.ajax({
			type: "POST",
			url: param.ajax_url,
			data: fd,
			cache: false,
			dataType: "text",
			processData : false,
			contentType : false,
			xhr : () => { // 進捗イベント
				var XHR = $.ajaxSettings.xhr();
				if (XHR.upload) {
					XHR.upload.addEventListener('progress',
							(e) => {

								var rate = this.param.end_prog_v - this.param.start_prog_v;
								var prog_value = this.param.start_prog_v + (e.loaded / e.total * rate);
								prog1.val(Math.ceil(prog_value));
								
							}, false);
				}
				return XHR;
			},

		})
		.done((res, type) => {
			if(param.callback != null){
				param.callback(res);
			}

		})
		.fail((jqXHR, statusText, errorThrown) => {
			
			var err_res = jqXHR.responseText;
			console.log(err_res);
			jQuery(param.err_slt).html(err_res);
			alert(statusText);
		});
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
