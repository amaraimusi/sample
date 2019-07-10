


/**
 * デバイスタイプの切替
 * @param tbl_slt テーブルセレクタ
 * @param device_type デバイスタイプ pc / sp
 */
function changeStyleByDevice(tbl_slt,device_type){
	var tblElm = jQuery(tbl_slt);
	if(device_type == 'pc'){
		tblElm.removeClass('tbl_sp');
		tblElm.addClass('tbl2');
	}else if(device_type == 'sp'){
		tblElm.removeClass('tbl2');
		tblElm.addClass('tbl_sp');
	}
}
