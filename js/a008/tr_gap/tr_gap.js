

// 初期化
$(() => {
	
	// ▼ 編集フォームのダミー登録ボタンにテスト用のクリックイベントを組み込む
	$('#reg_btn').click((e) => {
		alert('クリックイベントのテスト');
	});

});

// TR要素の編集ボタン・クリックイベント
function clickEdit(btnElm){
	
	// ▼ 編集フォームをクリックしたTR要素の下に移動させる。
	var tr = jQuery(btnElm).parents('tr');
	jQuery('#edit_form').insertAfter(tr);
	
}
