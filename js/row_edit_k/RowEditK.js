

/**
 * 一覧用・行編集フォーム | RowEditK.js
 * 
 * @date 2016-6-13 新規作成
 */

var m_row_edit_k_show_flg=0;// 「閉じる」イベント制御フラグ

var m_fields = [];//フィールドリスト

/**
 * 初期化
 */
function rowEditK_Init(option){
	
	if(option==undefined){
		option = {};
	}

	// フォームからフィールドリストを取得する
	m_fields = getFields('#row_edit_k_form');
	
	
	// フォームのオブジェクトを取得する
	var form = $('#row_edit_k_form');
	
	//デフォルトCSSデータ
	var cssData = {
		'z-index':9,
		'background-color':'white',
		'position':'absolute',
		'border':'solid 2px #ccb1bf',
		'padding':'5px',
		'width':'280px',
		'height':'460px',
		'overflow-y':'auto',
	}
	
	// オプションのcssデータが空でなければ、デフォルトCSSデータにマージする。
	var p_css = undefined;
	if(option.css != undefined){
		p_css = option.css;
		$.extend(cssData, p_css);
	}
	
	// フォームにCSSデータをセットする
	form.css(cssData);
	
	//ツールチップの外をクリックするとツールチップを閉じる
	$(document).click(
			function (){
				
				// フォーム表示ボタンが押されたときは、フォームを閉じないようにする。（このイベントはフォームボタンを押した時にも発動するため）
				if(m_row_edit_k_show_flg==1){
					m_row_edit_k_show_flg=0;
				}else{
					$('#row_edit_k_form').hide();
				}
				
				
			});
	
	//領域外クリックでツールチップを閉じるが、ツールチップ自体は領域内と判定させ閉じないようにする。
	form.click(function(e) {
		e.stopPropagation();
	});
	
	form.hide();//フォームを隠す
	
}


/**
 * フォーム表示
 * @param parentSlt 親セレクタ
 * @param triggerElm トリガー要素  ボタンなどの要素
 */
function rowEditK(parentSlt,triggerElm){

	// フォーム外クリックによる「閉じる」イベントがこの関数の実行後に起こるので、フォームを閉じないようにフラグをONにする。
	m_row_edit_k_show_flg=1;
	
	// 親セレクタから親要素オブジェクトを取得する
	var parElm = getParentElem(parentSlt,triggerElm);
	
	
	// 入力用のフォーム
	var form = $('#row_edit_k_form');
	
	// フォームに親要素内の各フィールド値をセットする。
	setFieldsToForm(form,parElm,m_fields);
	
	// triggerElm要素の下付近に入力フォームを表示する。
	showForm(form,triggerElm);
	

}

/**
 * 親セレクタから親要素オブジェクトを取得する
 * 
 * @param string parentSlt 親セレクタ
 * @param triggerElm トリガー要素
 * @return object 親要素オブジェクト
 */
function getParentElem(parentSlt,triggerElm){
	
	var parElm = null;
	
	// 先頭の一文字を取得する
	var f = parentSlt.charAt(0);
	
	// セレクタのフラグメント識別子が「.」または「#」であるなら、通常の方法で要素オブジェクトを取得。
	if(f=='.' || f=='#'){
		parElm = $(parentSlt);
		
	}
	
	// タグ名であるなら、トリガー要素の先祖から該当する要素を探し、それを親要素とする。
	else{
		parElm=$(triggerElm).parents(parentSlt);
	}
	
	return parElm;
	
}


/**
 * フォームに親要素内の各フィールド値をセットする。
 * @param object form フォーム
 * @param object parElm 親要素
 * @param array m_fields フィールドリスト
 */
function setFieldsToForm(form,parElm,m_fields){
	
	// フィールドリストをループして親要素のフィールド値をフォームへセットする
	for(var i=0 ; i<m_fields.length ; i++){
		var fldSlt = '.' + m_fields[i];
		var elm = parElm.find(fldSlt);
		var v = elm.html();
		
		// v が空なら、value属性から取得を試みる。
		if(v =='' || v==null){
			
			var tagName = elm.get(0).tagName;
			if(tagName == 'INPUT' || tagName == 'SELECT'){
				v = elm.val();
			}
		}
		
		form.find(fldSlt).val(v);
	}
	
	
}




/**
 * triggerElm要素の下付近に入力フォームを表示する。
 * 
 * @param object form フォーム要素オブジェクト
 * @param string triggerElm トリガー要素  ボタンなどの要素
 */
function showForm(form,triggerElm){
	
	form.show();
	
	//対象要素の右上位置を取得
	var offset=$(triggerElm).offset();
	var left = offset.left;
	var top = offset.top;


	//ツールチップの位置を算出
	var tt_left=left;
	var tt_top=top + 16;
	

	// 最小サイズの調整
	var minWidth = 250;
	var ww = $(window).width();
	if(tt_left + minWidth > ww){
		tt_left = ww - minWidth;
	}
	

	//ツールチップ要素に位置をセット
	form.offset({'top':tt_top,'left':tt_left });
}



/**
 * フォームの入力要素（input,textarea,select）からフィールドリストを取得する
 * 
 * @note
 * フィールドリストはclass属性名から取得する。
 * 
 * @param form_slt フォームセレクタ
 * @returns array フィールドリスト
 */
function getFields(form_slt){
	
	var list = [];// フィールドリスト
	
	
	// フォーム範囲セレクタ内を、入力要素（input,textarea,select）の数だけループしてデータ取得する。
	$(form_slt + ' input,textarea,select').each(function(){
		
		var class_name = $(this).attr('class');
		var str = stringLeft(class_name,' ');
		if(str !=''){
			class_name = str;
		}
		
		list.push(class_name);

	});
	
	return list;
	
}

/**
 * 印から左側の文字列を切り出す。
 * @param s 対象文字列
 * @param mark 印
 * @returns 切り出した文字列
 */
function stringLeft(s,mark){
	if (s==null || s==""){
		return s;
	}
	var a=s.indexOf(mark);
	var s2=s.substring(0,a);
	return s2;
}


