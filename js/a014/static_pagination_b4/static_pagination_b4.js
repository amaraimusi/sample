
/**
 * 静的テーブルをページネーション化する。ページネーションはBootstrap4に対応
 * @since 2022-1-20
 * @license MIT
 * @auther amaraimusi
 * 
 */
class StaticPaginationB4{
	
	/**
	 * 静的テーブルをページネーション化する
	 * @param xid string テーブル要素のid属性値
	 * @param {} param パラメータ
	 * - visible_row_count 表示行数
	 * - cur_page_num カレントページ番号	 0にすると先頭が初期アクティブ、任意の数値を入れるとそのぺージがアクティブ、 「last」入力すると最後のページがアクティブになる。
	 * - pn_position ページネーションの位置 top:テーブルの上, bottom:テーブルの下(デフォルト)
	 */
	pagenation(xid, param){
		
		// パラメータにデフォルトをセット
		if(param == null) param = {};
		if(param.visible_row_count == null ) param.visible_row_count = 8; // 表示行数
		if(param.cur_page_num == null) param.cur_page_num = 0; // 初期カレント行番号
		if(param.pn_position == null ) param.pn_position = 'bottom'; // 表示行数
		
		param['xid'] = xid;
		
		let visible_row_count = param.visible_row_count;
		let pn_position = param.pn_position;
		
		let tbl = jQuery('#' + xid);
		let trs = tbl.find('tbody tr');
		let num_rows = trs.length;
		if(num_rows == 0) return; //行数が0件ならページネーション作成を中断
		
		param['num_rows'] = num_rows; // 全行数
		param['all_page_count'] = Math.ceil(num_rows / visible_row_count); // 全ページ数
		
		// 初期カレントページにlast(最終ページ)が指定されている場合、最終ページ番号をセットする
		if(param.cur_page_num == 'last'){
			param.cur_page_num = param.all_page_count - 1;
		}
		let cur_page_num = param.cur_page_num;

		// テーブルに適用する
		this._applyToTable(trs, cur_page_num, visible_row_count);
		
		// ページネーションHTMLを作成する。
		let pg_html = this._createPagenationHtml(param);
		
		tbl.after(pg_html);
		
		// ページネーションにクリックイベントを追加する
		this._bindClickPagenation(param); 
		
		this.param = param;
		this.trs =trs;
	}
	
	/**
	 * テーブルに適用する
	 * @param trs TR群要素
	 * @param cur_page_num カレントページ番号
	 * @param visible_row_count 表示行数
	 */
	_applyToTable(trs, cur_page_num, visible_row_count){
		trs.hide().slice(cur_page_num * visible_row_count, (cur_page_num + 1) * visible_row_count).show();
	}
	
	
	// ページネーションHTMLを作成する。
	_createPagenationHtml(param){
		
		let items_html = '';
		for(let page_no=0; page_no < param.all_page_count; page_no++){
			
			let active_str = '';
			if(page_no == param.cur_page_num) active_str = 'active';
			items_html += `<li class="page-item ${active_str}"><span class="page-link">${page_no + 1}</span></li>`;
		}
		
		let html = `<ul id="${param.xid}_pagenation" class="pagination">${items_html}</ul>`;
		
		return html;
	}
	
	// ページネーションにクリックイベントを追加する
	_bindClickPagenation(param){
		let pgItems = jQuery(`#${param.xid}_pagenation li`);
		this.pgItems = pgItems;
		pgItems.each((i,elm) => {
			
				// ページ番号要素をクリックしたときのイベント
				jQuery(elm).click(evt=>{
					this.pgItems.removeClass('active');
					let cur_page_num = this.param.cur_page_num;
					let visible_row_count = this.param.visible_row_count;
					cur_page_num = i;
					this._applyToTable(this.trs, cur_page_num, visible_row_count);
					this.param.cur_page_num = cur_page_num;
					
					var item = $(evt.currentTarget);
					item.addClass('active');
					
				});
			});
		
	}
	
}