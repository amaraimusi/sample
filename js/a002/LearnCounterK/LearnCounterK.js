



/**
 * 覚数 | LearnCounterK.js
 * 
 * 覚えた数をカウントし、記録する。
 * 
 * 認証機能とサーバーDB連動に対応する。（ver 1.2以降）
 * 
 * @version 1.3.1
 * @date 2016-4-15 | 2016-10-21
 * 
 * @param array dormants 休眠日数配列 休眠期間を日数で設定する
 * @param array option オプション
 *  - dormants 休眠日数配列
 *  - category_code カテゴリコード
 *  - menu_xid 自動Ajax保存フラグ メニュー要素のID属性
 *  - msg_xid メッセージ要素のID属性
 *  - auto_ajax_save AJAX自動保存フラグ
 */
var LearnCounterK =function(option){
	
	// 休眠日数配列
	this.dormants;
	
	// オプション
	this.option = option;
	
	// ローカルストレージキー
	this.ls_key = location.href;
	
	// 覚データ
	this.data = {};
	
	// 自分自身のインスタンス。  プライベートメソッドやコールバック関数で利用するときに使う。
	var myself=this;
	
	

	/**
	 * コンストラクタ
	 */
	this.constract=function(){
		
		// オプションのプロパティが空ならデフォルトをセットする。
		setOptionIfEmpty();
		
		// 休眠日数配列をセット
		this.dormants = this.option.dormants;
		
		// メニューを作成する
		createMenu();
		
		// 対象要素から覚データを取得
		this.data = getDataFromContens();

		// サーバーからデータを取得
		getServerData(this.data,function(srvData){
			
			// 構造変換
			srvData = convert(srvData);
			
			// ローカルストレージのデータをマージする。
			myself.data = meargeLsData(myself.data);
	
			// DBサーバーのデータををマージする。
			myself.data = meargeDbData(myself.data,srvData);
		
			// 覚ボタンを作成
			createLeanBtns(myself.data);
		});

		
		
		


		
	};
	
	
	// 構造変換
	function convert(srvData){
		var data = {};
		for(var i in srvData){
			var srvEnt = srvData[i];
			var xid = srvEnt.xid;
			data[xid] = srvEnt;
		}
		
		return data;
		
	}
	
	
	// オプションのプロパティが空ならデフォルトをセットする。
	function setOptionIfEmpty(){
		
		if(myself.option == undefined){
			myself.option = {};
		}
		
			


		setOptionProp('dormants',[0,0.01,0.5,2,7,8,9,10,14,21,30,40,50,60,70,80,90,180]); // カテゴリコード
		setOptionProp('category_code','none'); // カテゴリコード
		setOptionProp('menu_xid','learn_count_k_menu'); // メニュー要素のID属性
		setOptionProp('msg_xid','learn_count_k_msg'); // メッセージ要素のID属性
		setOptionProp('auto_ajax_save',1); // AJAX自動保存フラグ
		
		
	}
	
	
	function setOptionProp(key,v){
		if(myself.option[key] == undefined){
			myself.option[key] = v;
		}
	}
	
	
	
	// メニューと設定区分を作成する
	function createMenu(){

		var class_css ="btn btn-primary btn-xs"; // ボタンスタイル
		// メニューデータ
		var menus = [
				"<button type='button' id='lck_only_target' class = '" + class_css + "'>ONLY</button>",
				"<button type='button' id='lck_all_ajax_save' class = '" + class_css + "'>ALL SAVE</button>",
				"<button type='button' id='lck_json_panel_show' class = '" + class_css + "'>JSON</button>",
				"<button type='button' id='lck_config_btn' class = '" + class_css + "'>CONF</button>",
				];
		
		var menu_html = menus.join(' ');
		$("#" + myself.option.menu_xid).html(menu_html);
		
		
		// 対象表示の生成
		onlyTarget();
		
		// 全データのAJAX保存：ボタンイベントの組み込み
		addClickAllAjaxSave();
		
		// JSONパネルの生成
		createJsonPanel();

		
		// 設定区分を作成
		createConfigDiv();
		
		// メッセージ要素を作成
		createMsgElment();

		
	};
	
	
	// 対象表示の生成
	function onlyTarget(){
		// JSON表示クリックボタンイベント
		$('#lck_only_target').click(function(e){
			
			// 覚え対象のみ表示する。
			learnOfOnlyTarget();
		});
	}
	
	/**
	 * 覚え対象のみ表示する
	 */
	function learnOfOnlyTarget(){
		
		$('.learn_count_k li').each(function(){
			
			// li要素、または内部のアンカーからxidを取得する。
			xid = getIdFromLi(this);
			
			// xidから空ならコンテニューする
			if(xid==undefined){
				return true;
			}
			
			var ent = myself.data[xid];

			// 現在日時
			var today = new Date();

			// 休眠チェック
			var flg = checkDormant0(today,ent);
			
			// 休眠中のli要素を非表示にする
			if(flg==false){
				$(this).hide();
			}
			
		});
	}
	
	
	
	// 全データのAJAX保存：ボタンイベントの組み込み
	function addClickAllAjaxSave(){
		// JSON表示クリックボタンイベント
		$('#lck_all_ajax_save').click(function(e){
			
			// 全データのAJAX保存
			allAjaxSave();
		});
	}
	
	/**
	 * 全データのAJAX保存
	 */
	function allAjaxSave(){
		
		// カテゴリコードの再セット
		for(var i in myself.data){
			var ent = myself.data[i];
			ent.category_code = myself.option.category_code;
		}

		var json_str = JSON.stringify(myself.data);//データをJSON文字列にする。
		

		$.ajax({
			type: "POST",
			url: "/zss_rec/learn_counter_k/all_ajax_save",
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
			success: function(res, type) {

				if(res=='success'){

					showMsg('DBに保存しました。','success');
				}else{

					showMsg(res,'err');
				}

				

			},
			error: function(xmlHttpRequest, textStatus, errorThrown){

				showMsg(xmlHttpRequest.responseText,'err');
				alert(textStatus);
			}
		});
		
		
	}
	
	
	
	
	
	
	
	/**
	 * JSONパネルの生成
	 */
	function createJsonPanel(){
		
		// JSONパネルのコンテンツ
		var contents =
			"	<div style='width:400px;height:400px'>" +
			"		<textarea id='lck_json_ta' style='width:100%;height:80%;display:none'></textarea>" +
			"		<div id=\"lck_json_preview\" style='width:100%;height:80%'></div>" +
			"		<button type='button' id='lck_json_inp_btn' class = 'btn btn-primary btn-xs'>編集</button>" +
			"		<button type='button' id='lck_json_rtn_btn' class = 'btn btn-primary btn-xs' style='display:none'>戻る</button>" +
			"		<button type='button' id='lck_json_upd_btn' class = 'btn btn-primary btn-xs' style='display:none'>更新</button>" +
			"	</div>";
		

		// 設定パネルをプルダウンパネルとして作成する。
		var trigger = '#lck_json_panel_show';
		var panel_id = 'lck_json';
		var title = 'JSON';
		var panel_css = {
				'width':'420px',
				'height':'420px',
				'background-color':'#fef3ed'
		};
		pulldown_panel(trigger,panel_id,title,contents,panel_css);
		
		
		// JSON表示クリックボタンイベント
		$('#lck_json_panel_show').click(function(e){
			
			// ローカルストレージからJSON文字列を取得し、プレビューとテキストエリアにセットする。
			var json_str = localStorage.getItem(myself.ls_key);
			$('#lck_json_ta').val(json_str);
			$('#lck_json_preview').html(json_str);
		});
		
		

		
		// 編集ボタンクリックイベント
		$('#lck_json_inp_btn').click(function(e){
			$('#lck_json_ta').show();
			$('#lck_json_preview').hide();
			$('#lck_json_inp_btn').hide();
			$('#lck_json_rtn_btn').show();
			$('#lck_json_upd_btn').show();
		});
		
		// 更新ボタンクリックイベント
		$('#lck_json_upd_btn').click(function(e){
			
			//テキストエリアからJSON文字列を取得し、ローカルストレージへ保存、およびプレビューへセットする。
			var json_str = $('#lck_json_ta').val();
			json_str = json_str.trim();
			localStorage.setItem(myself.ls_key,json_str);
			$('#lck_json_preview').html(json_str);
			
			// プレビュー表示に切り替える
			$('#lck_json_ta').hide();
			$('#lck_json_preview').show();
			$('#lck_json_inp_btn').show();
			$('#lck_json_rtn_btn').hide();
			$('#lck_json_upd_btn').hide();
		});
		
		// 戻るボタンクリックイベント
		$('#lck_json_rtn_btn').click(function(e){
			$('#lck_json_ta').hide();
			$('#lck_json_preview').show();
			$('#lck_json_inp_btn').show();
			$('#lck_json_rtn_btn').hide();
			$('#lck_json_upd_btn').hide();
		});
	}
	
	
	
	// 設定区分を作成
	function createConfigDiv(){
		
		

			
		
		// 設定パネルをプルダウンパネルとして作成する。
		var trigger = '#lck_config_btn';
		var panel_id = 'lck_config';
		var title = '設定';
		var contents = "<div id='lck_xxx'>準備中</div>";
		var panel_css = {
				'width':'300px',
				'height':'200px',
				'background-color':'#fef3ed'
		};
		pulldown_panel(trigger,panel_id,title,contents,panel_css);
		
	}
	
	
	
	
	
	
	// メッセージ要素を作成
	function createMsgElment(){
		
		var msgElm = $('#' + myself.option.msg_xid);
		if(!msgElm[0]){
			var msg_html = "<div id='" + myself.option.msg_xid + "'></div>";
			$('#' + myself.option.menu_xid).after(msg_html);
		}
	}
	
	
	
	

	
	

	/**
	 * 覚データを取得する
	 * メンバにアクセスするときはthisではなくmyselfを使ってアクセスすること。
	 * @return object 覚データ
	 */
	function getDataFromContens(){

		var data = {};//覚データ
		
		// 現在日時を取得（文字列）
		var nowDt=new Date().toLocaleString();
		
		
		// 対象要素をループ
		$('.learn_count_k li').each(function(index){
			
			// li要素、または内部のアンカーからxidを取得する。
			var xid = getIdFromLi(this);
			
			// xidから空ならコンテニューする
			if(xid==undefined){
				return true;
			}			
		

			//覚エンティティ
			var ent = {
				'xid':xid,
				'dtm':nowDt,
				'level':0,
				'category_code':myself.option.category_code,
			};
	
			// 覚データにxidをキーに覚エンティティを追加
			data[xid] = ent;
			
	
			
		});
		

		return data;
	};
	
	
	
	
	/**
	 * サーバーからデータを取得
	 * @param object data 覚データ
	 * @param function callback ajax後に呼び出されるコールバック関数
	 */
	function getServerData(data,callback){

		var xids = [];
		for(var i in data){
			var ent = data[i];
			xids.push(ent.xid);
		}
		
		
		var json_str = JSON.stringify(xids);//データをJSON文字列にする。

		$.ajax({
			type: "POST",
			url: "/zss_rec/learn_counter_k/ajax_get_data",
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
			success: function(str_json, type) {
				
				var srvData=null;
				try{
					srvData=$.parseJSON(str_json);//パース

				}catch(e){
					
					showMsg(str_json,'err');
				}
				
				// コールバックの呼出し
				callback(srvData);
				

			},
			error: function(xmlHttpRequest, textStatus, errorThrown){
			
				showMsg('サーバーへのアクセス失敗','err');
				callback(undefined);

			}
		});
		
		
	};
	
	
	
	
	
	
	
	
	/**
	 * li要素、または内部のアンカーからidを取得する
	 * @param liSlt li要素セレクタ
	 */
	function getIdFromLi(liSlt){

		// li要素のid属性値を取得する。
		var xid = $(liSlt).attr('id');
		
		// idが空であるのなら、アンカーのリンク先からidを取得
		if(xid==undefined){
			xid = $(liSlt).children('a').attr('href');
			if(xid != undefined){
				xid = xid.substring(1,xid.length);
			}
		}
		
		return xid;
	}	
	
	
	// ローカルストレージのデータをマージする。
	function meargeLsData(data){
		
		// ローカルストレージからデータを取得する
		var lsData = getDataFromLs();

		// 覚データ件数分ループ
		for(var xid in data){
			var ent = data[xid];
			if(lsData[xid] != undefined){
				
				var lsEnt = lsData[xid];
				
				
				$.extend(ent, lsEnt);

				
			}
			
		}
		
		return data;
	};
	
	
	
	
	
	/**
	 *  DBサーバーのデータををマージする。
	 *  
	 * @note 
	 * DBエンティティの日時が新しいのであれば、覚えエンティティにマージする。
	 * 
	 * @param data 覚えデータ
	 * @parma srvData サーバーから取得した覚えデータ
	 * @returns DBデータをマージした覚えデータ
	 */
	function meargeDbData(data,srvData){


		// DBデータが空ならマージ処理は行わない。
		if(!srvData){
			return data;
		}
		

		// 覚データ件数分ループ
		for(var xid in data){
			
			var ent = data[xid];
			if(srvData[xid] != undefined){
				var dEnt = srvData[xid];
				
				var modified1 = ent.modified;
				if(!modified1){
					$.extend(ent, dEnt);
				}else{
					var modified2 = dEnt.modified;
					
					// DBデータの方が最新であるならマージする。
					if(diffDate(modified2,modified1) > 0){

						$.extend(ent, dEnt);
					}
				}
				

			}
			
		}
		
		return data;
	};
	
	
	
	
	
	
	// 覚ボタンを作成
	function createLeanBtns(data){
		
		var xidList = [];
		
		$('.learn_count_k li').each(function(){
			
			// li要素、または内部のアンカーからidを取得する。
			xid = getIdFromLi(this);
			
			// idから空ならコンテニューする
			if(xid==undefined){
				return true;
			}

			
			xidList.push(xid);
			
			// 覚エンティティ
			var ent = data[xid];
			
			var btn_id = 'lck_btn_' + xid;
			var btn = "<button id=" + btn_id + " class='btn btn-primary btn-xs' level='2'>覚:" + ent.level + "</button>"

			$(this).append("&nbsp;" + btn);
			
		});
		
		//覚えボタンにクリックイベントを追加
		for(var i = 0 ; i < xidList.length ; i++){
			var xid = xidList[i];
			var btn_id = 'lck_btn_' + xid;

			$('#' + btn_id).click(function(e){
				
				
				//覚ボタンクリック
				lean_btn_click(this);
				

			});
		}
		
	}

	/**
	 * 覚ボタンクリック
	 */
	function lean_btn_click(btnElm){

		// ボタンＩＤからセクションＩＤを取得する
		var xid = $(btnElm).attr('id');
		xid = xid.replace('lck_btn_','');

		// 覚エンティティを取得
		var ent = myself.data[xid];

		
		// 休眠チェック
		var res = checkDormant(ent);
		if(res.flg == true){
			
			
			// 現在日時を取得（文字列）
			var nowDt=new Date().toLocaleString();
			
			// レベルの加算と、日付を更新
			ent.level ++;
			ent.dtm = nowDt;
			ent.modified = nowDt;
			ent.category_code = myself.option.category_code;
			
			// ボタン名に覚数を表示
			btn_v = "覚:" + ent.level;
			$(btnElm).html(btn_v);
			
			// 覚データをローカルストレージに保存する
			saveToLs();
			
		}else{
			alert(res.err_msg);
		}
		

		
	};
	
	/**
	 *  休眠チェック
	 *  @param ent 覚エンティティ
	 */
	function checkDormant(ent){
		
		// 現在日時
		var today = new Date();

		// 休眠チェック
		var flg = checkDormant0(today,ent);

		
		// 経過日数が休眠日数に達していない場合は、チェックＮＯにしエラーメッセージを作成する。
		err_msg = '';
		if(flg==false){
			
			// レベルから休眠日数を算出する
			var dorman = getDormanByLevel(ent.level);
			
			// 残り約時を算出
			var str_rem = calcAboutRem(today,dorman,ent.dtm);
			
			err_msg = '残り:' + str_rem;
		}
		
		var res = {
			'flg':flg,
			'err_msg':err_msg,
		};
		return res;
	}
	
	/**
	 * 休眠チェック(シンプル版）
	 * @return true:覚え対象 , false:休眠中
	 */
	function checkDormant0(today,ent){
		// 2つの日付の日数差を経過日数として取得する
		var elapsed = diffDate(today,ent.dtm);
		
		// レベルから休眠日数を算出する
		var dorman = getDormanByLevel(ent.level);
		
		// 経過日数が休眠日数を超えている場合、チェックＯＫにする。
		flg = false;
		
		if (elapsed > dorman){
			flg = true;
		}
		
		return flg;
		
	}
	
	/**
	 * 残り約時を算出
	 * @param date today 現在日時
	 * @param int dorman 休眠日数
	 * @param string dtm 更新日
	 * @return 残り約時
	 */
	function calcAboutRem(today,dorman,dtm){

		var today_u = Math.floor(today);
		var dorman_u = dorman * 86400000;
		var dtm_u = Math.floor(new Date(dtm));

		// 残り = 更新日 + 休眠 - 現在
		var rem_u = dtm_u + dorman_u - today_u;
		
		var str_rem = aboutDate(rem_u);
		
		return str_rem;

		
	}
	
	// レベルから休眠日数を算出する
	function getDormanByLevel(level){
		
		var dorman = 0;//休眠日数
		
		if(myself.dormants.length > level){
			dorman = myself.dormants[level]
		}else{
			var y = level - myself.dormants.length + 1;
			dorman = y * 365.2425;
		}
		
		return dorman;
	}
	

	
	// 覚データをローカルストレージに保存する
	function saveToLs(){
		
		var json = JSON.stringify(myself.data);
		localStorage.setItem(myself.ls_key,json);
		
	};
	
	// ローカルストレージからデータを取得する
	function getDataFromLs(){
		
		var data = {};
		try{
			var json = localStorage.getItem(myself.ls_key);
			var data = JSON.parse(json);
			if(data==null){
				return {};
			}
		}catch(e){
			
		}

		return data;
	};
	
	
	
	

	
	
	
	
	
	
	
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
			"<div id='%0' style='display:none;position:absolute'>" +
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
	
	
	
	
	
	/**
	 * UNIXタイムスタンプから適切な単位（年月日時分秒のいずれか）で返す
	 * 
	 * 文字列型日付、日付オブジェクトの両方に対応
	 * 
	 * @param date1 比較日付1
	 * @param date2 比較日付2
	 * @returns number 日数
	 */
	function aboutDate(u){

		var v = 0;
		var data_str = '';
		
		if(u >= 31556952000){
			v = Math.round(u / 31556952000);
			date_str = '約' + v + '年間';
		}else if(u >= 2629746000){
			v = Math.round(u / 2629746000);
			date_str = '約' + v + 'ヶ月間';
		}else if(u >= 86400000){
			v = Math.round(u / 86400000);
			date_str = '約' + v + '日間';
		}else if(u >= 3600000){
			v = Math.round(u / 3600000);
			date_str = '約' + v + '時間';
		}else if(u >= 60000){
			v = Math.round(u / 60000);
			date_str = '約' + v + '分間';
		}else if(u >= 1000){
			v = Math.round(u / 1000);
			date_str = '約' + v + '秒';
		}else{
			date_str = '約' + v + 'ミリ秒';
		}
		return date_str;
	}
	
	
	
	
	/**
	 * 2つの日付の日数差を算出
	 * 
	 * 文字列型日付、日付オブジェクトの両方に対応
	 * 
	 * @param d1 比較日付1
	 * @param d2 比較日付2
	 * @returns number 日数
	 */
	function diffDate(d1,d2){
		
		// 引数が文字列型の日付なら日付オブジェクトに変換
		if(typeof d1 == "string"){
			
			if(d1.indexOf('-') > -1){
				d1 = d1.replace('-','/');// IEは「-」の区分に対応していないので「/」に置換
			}
			var d1 = new Date(d1);
		}
		if(typeof d2 == "string"){
			if(d2.indexOf('-') > -1){
				d2 = d2.replace('-','/');
			}
			var d2 = new Date(d2);
		}
		
		var u1 = Math.floor(d1);// UNIXタイムスタンプに変換
		var u2 = Math.floor(d2);
		
		// 2つの日付の日数差を算出
		var diff_u = u1 - u2;
		var date_count = diff_u / 86400000 ;
		
		return date_count;

	}
	
	
	/**
	 * メッセージを表示する
	 * @param msg 表示するメッセージ
	 * @param msg_type メッセージ種別 success:成功系のメッセージ   err:エラー系のメッセージ
	 */
	function showMsg(msg,msg_type){
		
		var msgElm = $('#' + myself.option.msg_xid);
		if(msg_type == 'success'){
			msgElm.attr('class','text-success');
			msgElm.html(msg);
			msgElm.show();
			msgElm.hide(4000);
		}else if(msg_type == 'err'){
			msgElm.attr('class','text-danger');
			msgElm.html(msg);
			msgElm.show();
		}else{
			console.log(msg);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//コンストラクタ呼出し(クラス末尾にて定義すること）
	this.constract();
};




function learn_counter_k(){
	
	window.setTimeout(function(){
		
		var learnCounterK = new LearnCounterK();
	}, 1);
	
}