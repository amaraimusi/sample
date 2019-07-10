/**
 * jQuery UI ダイアログ | シンプルひな形
 * 2015-11-17	新規作成
 */


$( function() {
	
	nekoDlgInit();//ダイアログの初期化
});




/**
 * ネコダイアログの初期化
 */
function nekoDlgInit(){
	//ダイアログの初期化
    $('#neko_dlg').dialog({
    	title:'ネコダイアログ',
        autoOpen: false,
        width: 400,
        modal: true,
    });


}

/**
 * ネコダイアログの表示
 */
function nekoDlgOpen(){
	$('#neko_dlg').dialog('open');//ダイアログオープン

}

/**
 * ネコダイアログを閉じる
 */
function nekoDlgClose(){
	$('#neko_dlg').dialog('close');

}

/**
 * ネコダイアログ、OKボタン押下
 */
function nekoDlgOk(){
	
	//入力フォームからURLを取得する。
	var neko_text = $('#neko_text').val();

	//ホスト・ドメイン入力フォームへセットする。
	$('#neko_res').html(neko_text);
	
	$('#neko_dlg').dialog('close');

}


