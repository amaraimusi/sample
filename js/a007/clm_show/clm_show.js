

function clmShow(){
	var tbl = jQuery('#samp_tbl');
	var clm_index = jQuery('#clm_index').val();
	tblClmShow(tbl,clm_index);
}

function clmHide(){
	var tbl = jQuery('#samp_tbl');
	var clm_index = jQuery('#clm_index').val();
	tblClmShow(tbl,clm_index,0);
}

/**
 * テーブルの列表示を切り替える
 * @param object tbl テーブル要素（セレクタ）
 * @param int 列インデックス（一番左は0)
 * @param int show_flg 表示フラグ 0:非表示 , 1:表示（デフォルト）
 */
function tblClmShow(tbl,clm_index,show_flg){
	
	if(show_flg == null ) show_flg = 1;
	if(!(tbl instanceof jQuery)) tbl = jQuery(tbl);
	if(!tbl[0]) return;
	if(isNaN(clm_index)) return;
	

	var th = tbl.find("thead tr th").eq(clm_index);
	if(show_flg == 1){
		th.show();
	}else{
		th.hide();
	}
	
	jQuery.each(tbl.find("tbody tr"), (i,elm) => {

		var td=$(elm).children();
		if(show_flg == 1){
			td.eq(clm_index).show();
		}else{
			td.eq(clm_index).hide();
		}
	});

}