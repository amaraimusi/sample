


/**
 * プルダウン・パネル
 * 
 * @note
 * プルダウン・パネルを自動作成します。
 * プルダウン・パネルはボタン要素などのトリガー要素セレクタをクリックすると表示されます。
 * 
 * @date 2016-4-19
 * @version 1.0
 * 
 * @param string trigger トリガー要素セレクタ  ボタンなど
 * @param string panel_id パネルID  
 * @param string contents パネル内のコンテンツ
 * @param object panel_css パネルのCSSデータ
 */
function pulldown_panel(trigger,panel_id,title,contents,panel_css){
	
	// パネルの基本構造
	var panel_html = 
		"<div id='%0' style='display:none'>" +
		"	<div id='%0_head'>" +
		"		<div id='%0_head1'>%2</div>" +
		"		<div id='%0_head2'>" +
		"			<button id='%0_close' type=\"button\" class=\"btn btn-primary btn-xs\">" +
		"				<span class=\"glyphicon glyphicon-remove\"></span>" +
		"			</button>" +
		"		</div>" +
		"	</div>" +
		"	<div id='%0_body' style='padding:4px' >" +
		"		%1" +
		"	</div>" +
		"</div>" +
		"";
	
	// パネルにパネルIDとコンテンツを埋め込む
	panel_html = panel_html.replace(/%0/g,panel_id);
	panel_html = panel_html.replace('%1',contents);
	if(title != null){
		panel_html = panel_html.replace('%2',title);
	}
	
	// トリガーの後ろにパネルを非表示で追加
	$(trigger).after(panel_html);
	
	// パネルセレクタとパネルオブジェクトを取得
	var panel_slt = '#' + panel_id;
	var panelElm = $(panel_slt);
	
	
	// デフォルト・パネルCSSを定義
	var def_css = {
			'position':'absolute',
			'width':'150px',
			'height':'100px',
			'border':'solid 4px #4088ca',
			'border-radius':'10px',
			'z-index':'1',
			'display':'none',
		};
	
	// 引数CSSが空であるなら、デフォルト・パネルCSSをセットする。空でないならマージする。
	if(panel_css == undefined){
		panel_css = def_css;
	}else{
		panel_css = $.extend(def_css,panel_css);
	}

	// パネルにCSSを適用する
	panelElm.css(panel_css);
	

	
	
	// パネルのヘッダーにCSSスタイルを適用する
	$(panel_slt + '_head').css({
		'width':'100%',
		'background-color':'#4088ca',
	});
	$(panel_slt + '_head1').css({
		'float':'left',
		'width':'80%',
		'color':'white',
		'display':'inline-block;',
	});
	$(panel_slt + '_head2').css({
		'width':'15%',
		'margin-left':'auto',
		'text-align':'right',
		'display':'inline-block;',
	});
	
	
	
	
	//　トリガー要素セレクタ位置からパネルの位置を算出する。
	var trgElm = $(trigger);
	var offset = trgElm.offset();
	var h = trgElm.outerHeight();
	var w = trgElm.outerWidth();
	var top = offset.top + h;
	var left = offset.left;

	// パネルに位置をセットする。
	panelElm.offset({'top':top,'left':left });
	
	
	
	
	// トリガー要素セレクタのクリックイベントを作成
	$(trigger).click(function(e){
		panelElm.toggle();
	});
	
	// 閉じるボタンクリックボタンイベント
	$(panel_slt + '_close').click(function(e){
		panelElm.hide();
	});
	
	
}