/**
 * 検索条件用JavaScript
 * ★概要
 * 検索条件演算子コンボボックスと入力フォームの連動をする。
 * ★履歴
 * 2013/8/07	新規作成
 */


//条件検索演算子・テキスト・変更イベント
function jkCmbChgCndOpeNum(key){
	var cmb_v=$('#kj_cmb_cnd_ope_'+key).val();
	var id_a2='#kj_'+key+ '_a2';//非表示するタグのキー
	if(cmb_v==3){
		$(id_a2).css('display','inline');
	}else{
		$(id_a2).css('display','none');
	}
}