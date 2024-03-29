/**
 * 年月による日付範囲入力 | RangeYm.js
 * @date 2019-8-17
 * @license MIT
 * @version 1.0.0
 */
class RangeYm{
	
	/**
	 * 初期化
	 * 
	 * @param param
	 * - div_xid 当機能埋込先区分のid属性
	 * - field フィールド名
	 * - wamei 和名
	 * - field_from 始め日付のフィールド名
	 * - field_to 終わり日付のフィールド名
	 */
	init(param){
		
		this.param = this._setParamIfEmpty(param);
		this.tDiv = jQuery('#' + this.param.div_xid); //  This division
		
		// 当機能のHTMLを作成および埋込
		let html = this._createHtml(); 
		this.tDiv.html(html);
		
		this.ymTb = this.tDiv.find('.range_ym_tb'); // 年月テキスト
		this.dtlBtn = this.tDiv.find('.range_ym_dtl_btn'); // 詳細表示ボタン
		this.rngDiv = this.tDiv.find('.range_ym_range_div'); // 範囲区分
		this.fromInp = this.tDiv.find('.range_ym_date_from'); // 始め日付入力テキスト
		this.toInp = this.tDiv.find('.range_ym_date_to'); // 終わり日付入力テキスト
		this.errElm = this.tDiv.find('.range_ym_err'); // エラー要素
		
		this.rngDiv.hide();
		
		this._addClickDtlBtn(this.dtlBtn); // 詳細表示ボタンのクリックイベント
		this._addChangeYmTb(this.ymTb); // 年月テキストのチェンジイベント
		
		// デフォルト値の取得とセット
		this.param['def'] = this.tDiv.attr('data-def');
		if(this.param.def !=null){
			this.setYm(this.param.def); // 年月をセット
		}
		

		
		
	}

	
	/**
	 * If Param property is empty, set a value.
	 */
	_setParamIfEmpty(param){
		
		if(param == null) param = {};

		if(param['div_xid'] == null) throw new Error('div_xid is empty');
		if(param['field'] == null) throw new Error('field is empty');
		if(param['wamei'] == null) throw new Error('wamei is empty');
		if(param['field_from'] == null) param['field_from'] = param.field + '1';
		if(param['field_to'] == null) param['field_from'] = param.field + '2';

		return param;
	}
	
	
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
	 * 当機能のHTMLを作成および埋込
	 */
	_createHtml(){
		
		let field = this.param.field; // フィールド
		let wamei = this.param.wamei; // 和名
		let field_from = this.param.field_from; // 始め日付のフィールド名
		let field_to = this.param.field_to; // 終わり日付のフィールド名
		
		let html = `
	<input type="month" class="range_ym_tb"  placeholder="「${wamei}」の年月" title="年月を選択すると「>」ボタンの先にその月の日付範囲が入力されます。" />	
	<button type="button" class="range_ym_dtl_btn btn btn-default btn-xs" title="日付を範囲入力する部分を表示します。"><span class="glyphicon glyphicon-chevron-right"></span></button>
	<div class="range_ym_range_div" style="display:inline-block">
		<input type="date" class="${field_from} range_ym_date_from "  placeholder="「${wamei}」の範囲【始め】" title="「${wamei}」範囲の始め日付です。" />	
		<input type="date" class="${field_to} range_ym_date_to "  placeholder="「${wamei}」の範囲【終わり】" title="「${wamei}」範囲の終わり日付です。" />	
		<div class="range_ym_err text-danger"></div>
	</div>
		`;
		return html;
	}
	
	
	/**
	 * エラーを表示
	 * @param string err_msg エラーメッセージ
	 */
	_showErr(err_msg){
		this.errDiv.append(err_msg + '<br>');
	}
	
	
	/**
	 * 詳細表示ボタンのクリックイベント
	 * @param jQuery dtlBtn 詳細表示ボタン
	 */
	_addClickDtlBtn(dtlBtn){
		
		dtlBtn.click((evt)=>{
			
			var d = this.rngDiv.css('display');
			if(d==null | d=='none'){
				let f_show_btn_name = this._getDtlBtnName(0);
				this.dtlBtn.val(f_show_btn_name);
				this.tDiv.css('display','block');
				this.rngDiv.show(100);
				
			}else{
				let f_show_btn_name = this._getDtlBtnName(1);
				this.dtlBtn.val(f_show_btn_name);
				this.tDiv.css('display','inline-block');
				this.rngDiv.hide(100);
				
			}

		});
	}
	
	
	/**
	 * 詳細表示ボタン名に「閉じる」の文字を付け足したり、削ったりする。
	 * @param string show_flg 表示フラグ 0:閉, 1:表示
	 * @return string 詳細表示ボタン名
	 */
	_getDtlBtnName(show_flg){
		let close_name = ' (閉じる)';
		let btn_name = this.dtlBtn.val();
		if(show_flg == 1){
			btn_name = btn_name.replace(close_name, '');
		}else{
			btn_name += close_name;
		}
		return btn_name;
	}
	
	
	/**
	 * 年月テキストのチェンジイベントを追加
	 * @param jQuery tb 年月テキストボックス
	 */
	_addChangeYmTb(tb){
		
		tb.change((evt)=>{
			let tb = jQuery(evt.currentTarget);
			this.changeYmTb(tb);
		});
	}
	
	
	/**
	 * 年月テキストのチェンジイベント
	 * @param jQuery tb 年月テキストボックス
	 */
	changeYmTb(tb){
		let ym = tb.val();
		
		let date1 = ym + '-01'; // 始め日付
		this.fromInp.val(date1);
		
		let date2 = this._getMonthEndDate(date1);
		this.toInp.val(date2);
		
	}
	
	
	/**
	 * 対象日付の月末日を取得する
	 * @param mixed date1 対象日付
	 * @return string 月末日
	 */
	_getMonthEndDate(date1){
		if(date1 == null) return null;
		if((typeof date1) == 'string'){
			date1 = new Date(date1);
		}

		// 月末日の算出
		var mEndDate = new Date(date1.getFullYear(), date1.getMonth() + 1, 0);
		
		var year = mEndDate.getFullYear();
		var month = mEndDate.getMonth() + 1;
		var day = mEndDate.getDate();
		
		// 2桁にそろえる。 例 3→03
		var month = ("0"+month).slice(-2);
		var day = ("0"+day).slice(-2);
		
		var date_str = year + '-' + month + '-' + day;
		
		return date_str;

	}
	
	
	/**
	 * 年月をセット
	 * @param string ym 年月
	 */
	setYm(ym){
		ym = this._toYyyyMm(ym); // 年月文字列をyyyy-mm型に変換する
		this.ymTb.val(ym);
		
		// 年月テキストのチェンジイベント
		this.changeYmTb(this.ymTb);
		
	}
	
	
	/**
	 * yyyy-mm型に変換する
	 * 
	 * @note
	 * 例) 2012-2 → 2012-02
	 * 例) 2012-12 → 2012-12
	 * 
	 * @param string ym 年月文字列
	 * @param string delim 区切り文字（デフォルトはハイフン）
	 * @return yyyy-mm型の年月文字列
	 */
	_toYyyyMm(ym, delim){
		ym = ym.trim();
		if(ym == null || ym == '' || ym == 0) return ym;
		if(delim == null) delim = '-';
		let ary = ym.split(delim);
		if (ary.length != 2) return ym;
		let month = ary[1];
		month = ("0"+month).slice(-2); // 2桁にそろえる。 例 3→03
		let ym2 = ary[0] + delim + month;
		return ym2;
	}

	
}





