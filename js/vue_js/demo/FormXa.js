/**
 * 
 */
class FormXa{
	/**
	 * コンストラクタ
	 * 
	 * @param param
	 * - flg
	 */
	constructor(param){
		this.move_flg = "";
		this.move_start_x = 0;
		this.move_start_y = 0;
		this.boxElm;
		
		this.saveKeys = ['flg','xxx']; // ローカルストレージへ保存と読込を行うparamのキー。
		this.ls_key = "FormXa"; // ローカルストレージにparamを保存するときのキー。
		this.param = this._setParamIfEmpty(param);
		
		window.onmousedown = function(e) {
			
			if(this.move_flg == true){
				return;
			}
//			console.log('test=2');//■■■□□□■■■□□□■■■□□□)
			var boxElm = document.getElementById("obj");
			
			
//			var rect = boxElm.getClientRects();
//			var box_x = rect[0].x;
//			var box_y = rect[0].y;
			
			var box_x = boxElm.style.left;
			var box_y = boxElm.style.top;
			box_x = parseInt(box_x.replace("px",""));
			box_y = parseInt(box_y.replace("px",""));
			
			
			
			console.log('box_x=' + box_x);//■■■□□□■■■□□□■■■□□□)
			console.log('box_y=' + box_y);//■■■□□□■■■□□□■■■□□□)
			
			//console.log(boxElm.screen);//■■■□□□■■■□□□■■■□□□)
			var box_w = boxElm.offsetWidth;
			var box_h = boxElm.offsetHeight;
//			console.log('box_w=' + box_w);//■■■□□□■■■□□□■■■□□□)
//			console.log('box_h=' + box_h);//■■■□□□■■■□□□■■■□□□)
			
			
			var ev_x = event.clientX;
			var ev_y = event.clientY;
			if(box_x <= ev_x && ev_x <= box_x + box_w &&
					box_y <= ev_y && ev_y <= box_y + box_h){
				console.log('test=3');//■■■□□□■■■□□□■■■□□□)
				this.move_flg = true;
				this.move_start_x = event.clientX - box_x;
				this.move_start_y = event.clientY - box_y;
			}
			
			this.boxElm = boxElm;
			
			

			
			
		};
		
		// end drag
		window.onmouseup = function(e) {
			this.move_flg = false;
		}
		// dræg 
		window.onmousemove = function(e) {
			if(this.move_flg == true) {
				
				var rect = this.boxElm.getClientRects();
				
				//console.log(rect);//■■■□□□■■■□□□■■■□□□)
				
//				var box_x = parseInt(boxElm.style.left.replace("px",""));
//				var box_y = parseInt(boxElm.style.top.replace("px",""));
//				console.log(event.clientX - this.move_start_x);//■■■□□□■■■□□□■■■□□□)
//				rect[0].x = event.clientX - this.move_start_x;
//				rect[0].y = event.clientY - this.move_start_y;
				
				
				this.boxElm.style.left = (event.clientX - this.move_start_x) + "px";
				this.boxElm.style.top = (event.clientY - this.move_start_y) + "px";	
				
//				document.getElementById("obj").style.left = (event.clientX - move_start_x) + "px";
//				document.getElementById("obj").style.top = (event.clientY - move_start_y) + "px";	
//				document.getElementById("obj").style.left = (event.clientX - move_start_x) + "px";
//				document.getElementById("obj").style.top = (event.clientY - move_start_y) + "px";	
				
				
			}
		}

		
		
	}

	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null){
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
		
		if(param['flg'] == null){
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
		.done((str_json, type) => {
			var ent;
			try{
				ent =jQuery.parseJSON(str_json);//パース
				jQuery("#res").html(str_json);
				
			}catch(e){
				alert('エラー');
				jQuery("#err").html(str_json);
				return;
			}
			
			this.test1();
		})
		.fail((jqXHR, statusText, errorThrown) => {
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