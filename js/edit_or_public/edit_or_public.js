/**
 * 編集モードと一般モードの切替関数
 * 
 * @note
 * 編集モードと一般モードに関する機能である。
 * この機能はedit_or_public関数として用意され、編集モードと一般モードの切替を一括管理する。
 * 
 * ## 挙動
 * edit_or_public関数に引数を渡して呼び出すだけで、編集モードと一般モードが切り替わる。
 * 引数はmodeである。"0"は一般モード、"1"は編集モードである。
 * 
 * ## 実装について
 * 実装は、切替対象の要素のclass属性に、edit_only,public_onlyを追加するだけである。
 * edit_onlyにすると編集モードのときにしか表示されない。public_onlyなら一般モードのみである。
 * 
 * @param bool flg 0:一般モード  1:編集モード
 * @date 2016-9-9
 * 
 */
function edit_or_public(flg){
	if(flg =='' || flg==null){
		$('.public_only').show();
		$('.edit_only').hide();
		
	}else{
		$('.public_only').hide();
		$('.edit_only').show();
		
	}
}