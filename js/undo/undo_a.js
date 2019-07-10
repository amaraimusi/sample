
/**
 * アンドゥ機能 | Undo,Redo
 * 
 * @note
 * Undo機能とRedo機能を備える
 * 
 * @version 1.0
 * @date 2016-3-31 新規作成
 * @auther k_uehara
 * 
 * @param params
 * - ta_slt テキストエリアのセレクタ
 * - undo_btn_slt アンドゥボタンセレクタ
 * - redo_btn_slt リドゥボタンセレクタ
 * 
 */
var UndoA =function(params){
	
	// テキストエリアセレクタ
	this.ta_slt = params.ta_slt;
	
	// アンドゥボタンセレクタ
	this.undo_btn_slt = params.undo_btn_slt;
	
	// リドゥボタンセレクタ
	this.redo_btn_slt = params.redo_btn_slt;
	
	// 最大履歴数
	this.max_count=16;

	// 履歴データ
	this.data={};
	
	// 履歴インデックス
	this.a_idx = 0;
	
	// アンドゥインデックス
	this.u_idx = 0;
	
	// 自分自身のインスタンス  コールバック関数で利用するため
	var mySelf=this;
	
	/**
	 * コンストラクタ
	 */
	this.constract=function(){
		var ta = $(this.ta_slt);
		
		// 履歴配列に最初のテキストを追加する。
		var text = ta.val();
		this.add(text);

		// テキストエリアのフォーカス外れイベント
		ta.blur(function(e){
			
			// テキストエリアのテキストを履歴配列に追加する
			var text = ta.val();
			mySelf.add(text);

		});
		
		
		var undo_btn = $(this.undo_btn_slt);
		
		// アンドゥボタンクリックイベント
		undo_btn.click(function(e){

			var text = mySelf.undo();
			ta.val(text);

		});
		
		var redo_btn = $(this.redo_btn_slt);
		
		// リドゥボタンクリックイベント
		redo_btn.click(function(e){

			var text = mySelf.redo();
			ta.val(text);

		});
		
		
	};
	
	/**
	 * 履歴配列に履歴文字を追加する。
	 * @param string str 履歴文字
	 */
	this.add=function(str){
		
		if(this.checkOverrap(str) == false){
			return;
		}
		var a = this.a_idx;
		
		this.data[a] = str;
		
		var a_del = a - this.max_count;
		if(a_del >= 0){
			delete this.data[a_del];
		}
		
		a++;
		this.a_idx = a;
		this.u_idx = 0;

	};
	
	
	
	
	/**
	 * 直前履歴と同値であるか重複チェックする。
	 * @param string str 履歴文字
	 * @return false:重複   true:重複していない
	 * 
	 */
	this.checkOverrap = function(str){

		var a = this.a_idx;
		if(a == 0){
			return true;
		}
		
		if(this.data[a-1] == str){
			return false;
		}
		
		return true;

	};
	
	
	/**
	 * 直前履歴の文字を取得する
	 * @reuturn string 直前履歴文字
	 */
	this.undo = function(){
		
		var a =this.a_idx;
		
		this.u_idx++;
		if(this.u_idx < this.max_count){
			
			var a2 = a-2;
			if(this.data[a2] != undefined){
				a--;
				
			}else{
				this.u_idx--;
			}
			
		}else{
			this.u_idx = this.max_count-1;
		}
		
		
		this.a_idx = a;
		return this.data[a-1];

	}
	
	/**
	 * REDO
	 * @reuturn string 履歴文字
	 */
	this.redo = function(){
		
		var u = this.u_idx;
		var a = this.a_idx;
		
		u--;
		if(u < 0){
			u = 0;
			return this.data[a-1];
		}
		
		a++;
		
		this.u_idx = u;
		this.a_idx = a;
		

		return this.data[a-1];
		
		

	}
	


	this.constract();//コンストラクタ呼出し(クラス末尾にて定義すること）
	
};






