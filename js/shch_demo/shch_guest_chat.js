
/**
 * SHCH ゲストチャット画面
 * 
 * ◇主要メソッド一覧（特に重要なメソッドに★マーク）
 * - run ★SHCHゲストチャットを起動する
 * - compactDivToggle コンパクト化、オープン化の切替
 * - stopReload 定期リロードを停止する
 * - startReload 定期リロードを開始する
 * - reload ★定期リロードを実行する
 * - sendMsg ★チャットメッセージを送信する
 * - configOk 設定を適用する
 * - clearConfig 設定を初期化
 * 
 * 
 * @version 1.1
 * @date 2015-10-1 新規作成
 * @date 2015-12-9 キャッシュ関連のバグが稀に起こるため、バグが連続して起こらない限り、ワーカースレッドを停めないようにしました。
 * 
 */
var ShchX = function(){
	

	
	///プロパティ(デフォルト値）
	this.prop={
			'chat_name':'ゲスト',//チャット名
			'last_dt':null,//最終メッセージ日時
			'info_room_id':null,//案内ルームID
			'teller_window_id':null,//窓口ID
			'show_limit':20,//チャット一覧表示件数
			'expiration':24,//有効時間（時）
			'hash':null,//ハッシュキー
			'info_room_name':null,//案内ルーム名
			'dt_show_flg':0,//日時表示フラグ
			'width':320,//横サイズ
			'height':420,//縦サイズ
			'compact_width':320,//コンパクト横サイズ
			'compact_height':80,//コンパクト縦サイズ
			'config_mode_width':320,//設定モード横サイズ
			'config_mode_height':400,//設定モード縦サイズ
			'chat_list_height':170,//チャット一覧の縦サイズ
			'host':'',//ホスト
			'debug_mode':2,//デバッグモード 0:なし  1:デバッグモード  2:デバッグモード(ダンプ）
			'debug_slc':'#debug',//デバッグ出力要素名
			'try_limit':3,//試行回数上限。エラーがあっても実行する回数。
			'try_counter':0,//試行回数
	};
	
	///自動間隔情報 info
	this.aiInfo={
			'base_ut':0,//基準UNIXタイムスタンプ
			'index':0,//自動間隔データのインデックス
			'interval':3000,//現在のタイマースレッド間隔
			'last_index':99,//最終インデックス
	};
	
	///自動間隔情報 start:変更時間(分)	interval:間隔(秒)
	this.aiData=[
	    	{'start':0,'interval':3},
	    	{'start':1,'interval':4},
	    	{'start':5,'interval':5},
	    	{'start':15,'interval':6},
	    	{'start':30,'interval':10},
	    	{'start':60,'interval':30},
	    	{'start':120,'interval':60},
	    	{'start':240,'interval':90},
	    	{'start':480,'interval':120},
	    	];

	///デフォルトプロパティ（起動時にpropをクローンコピー）
	this.defProp;
	
	///タイマースレッドハンドラのリスト
	this.handlers=new Array();
	
	///タイマースレッドのカウンター
	this.counter=0;
	
	///ローカルストレージへのキー
	this.propKey='';
	
	///チャット一覧
	this.listData={};
	
	
	/**
	 * SHCHゲストチャットを起動する
	 * @param myself 自分自身のインスタンス
	 * @param info_room_id 案内ルームID
	 * @param hash		ハッシュキー
	 * @param host		ホスト（例： 「/shch/」、「http://192.168.11.199/shch/」
	 * @param debug_mode		デバッグモード 0:OFF 1:リロード数などを表示   2:システムエラーのダンプを表示
	 * @param debug_slc	デバッグ出力要素名
	 */
	this.run=function(myself,info_room_id,hash,host,debug_mode,debug_slc){
		
		//デフォルトプロパティにメンバプロパティをクローンコピーする。
		this.defProp = $.extend(true, {}, this.prop);
		
		//プロパティへローカルストレージや引数の値をセットする。
		this.prop=this._setProp(this.prop,info_room_id,hash,host,debug_mode,debug_slc);
		
		//ドラッグ移動を組み込み、でチャット画面を動かせるようにする。
		var draggableDiv = $('#shch_guest_chat').draggable();
		
		//ドラッグ移動を組み込むとテキスト選択ができなくなるので、チャットメッセージ区分をテキスト選択可能にする。
		$('#shch_chat_div', draggableDiv).mousedown(function(ev) {
		  draggableDiv.draggable('disable');
		}).mouseup(function(ev) {
		  draggableDiv.draggable('enable');
		});
		
		//画面のリサイズ
		$( '#shch_guest_chat' ) . resizable({
			maxHeight: 700,
			maxWidth: 700,
			minHeight: 200,
			minWidth: 250,
			stop: function( event, ui ) {
				//リサイズ操作から手を放した瞬間のイベント
				var h=ui.size.height - shchX.prop.chat_list_height;
				$( "#shch_chat_div" ).height(h);
				
				//プロパティにサイズをセット
				shchX.prop.width=$('#shch_guest_chat').width();
				shchX.prop.height=$('#shch_guest_chat').height();
			}
		});
		
		
		
		//初期はコンパクトモードであるため、画面サイズ変更を無効にする。（オープン時に有効）
		$( "#shch_guest_chat" ).resizable( "disable" );
		
		//shchコンパクト区分のクリックイベント
		$('#shch_guest_chat').click(function(e){
			
			myself.aiInfo.base_ut=0;//自動インターバル制御のリセット
			
		});

		//shchコンパクト区分のクリックイベント
		$('#shch_compact').click(function(e){
			
			var d=$('#shch_body').css('display');
			if(d==undefined || d=='none'){
				myself.compactDivToggle();
			}
			
		});

		//隠しデバッグモードのダブルクリックイベント
		$('#shch_debug_mode_swiche').dblclick(function(e){
			$('.shch_debug').toggle();
			
		});
		this._setKakusi();//隠しデバッグモードへの値セット
		
		//新メッセージ画像アイコン
		var imgUrl=this.prop.host + 'img/shch_guest_chat/new_icon.gif';
		$('#shch_new_icon_img').attr('src',imgUrl);
		

		
		//チャット画面のタイトルに、Ajaxを通して取得した案内ルーム名を表示する。
		this._ajaxInfoRoomName(myself);
		
		//1回目のリロード
		this.reload(myself);
		
		//タイマースレッドによる定期リロード開始
		this.startReload();
	};
	
	//プロパティへローカルストレージや引数の値をセットする。
	this._setProp=function(prop,info_room_id,hash,host,debug_mode,debug_slc){
		
		//ローカルストレージに保存してあるプロパティが存在するなら、メンバプロパティにマージする。
		var key="shch_guest_prop_" + info_room_id;
		var json=localStorage.getItem(key);
		if(json!=null){
			var lsProp=$.parseJSON( json );
			$.extend(prop, lsProp);//メンバプロパティへマージする。
		}

		//キーはセットや削除で使うのでメンバで保持する。
		this.propKey=key;
		
		//プロパティに引数群をセットする
		prop['info_room_id'] = info_room_id;
		prop['hash'] = hash;
		prop['host'] = host;
		prop['debug_mode'] = debug_mode;
		prop['debug_slc']=debug_slc;
		
		prop['last_dt']=null;//初回のチャットデータ表示のため、最終日時をクリア。
		

		
		return prop;
	};
	
	//隠しデバッグモードへの値セット
	this._setKakusi=function(){
		
		//デバッグモードの表示
		var msg=null;
		if(this.prop.debug_mode==0){
			msg='デバッグモード　0:OFF'
		}else if(this.prop.debug_mode==1){
			msg='デバッグモード　1:ON';
		}else if(this.prop.debug_mode==2){
			msg='デバッグモード　2:ON';
		}else{
			msg='デバッグモード　' + this.prop.debug_mode;
		}
		$('#shch_debug_mode').html(msg);
		
	};
	
	
	/**
	 * コンパクト化、オープン化の切替
	 */
	this.compactDivToggle=function(){

		//モードを取得する。   0:コンパクトモード,1:オープンモード,2：設定モード
		var mode=this._getMode();

		//コンパクト→オープン or 設定
		if(mode==0){
			
			//設定表示フラグを取得
			var configModeFlg=this.getConfigMode();

			$('#shch_body').show();
			$('#shch_guest_chat_msg_sends').show();
			$('#shch_compact').hide();
			
			$('#shch_compact_btn').show();
			$('#shch_open_btn').hide();
			$('#shch_config_toggle_btn').show();

			//大枠にプロパティのサイズをセットする。
			$('#shch_guest_chat').width(this.prop.width);
			if(configModeFlg==true){
				$('#shch_guest_chat').width(this.prop.config_mode_width);
				$('#shch_guest_chat').height(this.prop.config_mode_height);
			}else{
				$('#shch_guest_chat').width(this.prop.width);
				$('#shch_guest_chat').height(this.prop.height);
			}
			
			
			//チャット一覧のサイズにもセットする
			$("#shch_chat_div").height(this.prop.height - this.prop.chat_list_height);
			
			//画面サイズ変更を有効にする。
			$( "#shch_guest_chat" ).resizable( "enable" );
			
		}
		
		//オープンor設定 →コンパクト
		else if(mode==1 || mode==2){
			
			$('#shch_body').hide();
			$('#shch_guest_chat_msg_sends').hide();
			$('#shch_compact').show();
			
			$('#shch_compact_btn').hide();
			$('#shch_open_btn').show();
			$('#shch_config_toggle_btn').hide();
			

			//大枠にプロパティのコンパクトサイズをセットする。
			$('#shch_guest_chat').css('width',this.prop.compact_width);
			$('#shch_guest_chat').css('height',this.prop.compact_height);
			
			//画面サイズ変更を無効にする。
			$("#shch_guest_chat").resizable("disable");
			
			//隠しモードを隠す
			$("#kakusi_mode").hide();
			
		}
		
		
	};
	
	
	/**
	 * 設定表示フラグを取得
	 * 
	 * @return 設定表示フラグ  true:設定表示中, false:設定は非表示
	 */
	this.getConfigMode = function(){
		
		var sh12=$('#shch_config').css('display');//オープン or 設定
		var flg=true;
		if(sh12==undefined || sh12=='none'){
			flg=false;
		}
		
		return flg;
	}
	
	
	/**
	 * モードを取得する
	 * 
	 * @return モード  0:コンパクトモード,1:オープンモード,2：設定モード
	 */
	this._getMode=function(){
		
		var shlg01=$('#shch_body').css('display');//コンパクト or オープン
		var sh12=$('#shch_config').css('display');//オープン or 設定
		var mode=0;
		
		//モード判定
		if(shlg01==undefined || shlg01=='none'){
			mode = 0;//## コンパクトモード

		}else{
			if(sh12==undefined || sh12=='none'){
				mode = 1;//## オープンモード
			}else{
				mode = 2;//## 設定モード
			}
			
		}
		
		return mode;
		
	};

	/**
	 * 定期リロードを停止する
	 */
	this.stopReload=function(){
		for(var i=0;i<this.handlers.length;i++){
			var h=this.handlers[i];//ハンドラを指定してスレッドを停止する。
			clearInterval(h);
		}

		$('#shch_btn_stop').hide();
		$('#shch_btn_restart').show();
		
		console.log('定期リロードを一時停止しています。');
	};
	
	/**
	 * 定期リロードを開始する
	 */
	this.startReload=function(){
		var h=setInterval("shchReload()",this.aiInfo.interval);//スレッド開始。スレッドにする関数と間隔（ミリ秒）を指定する。
		this.handlers.push(h);//ハンドラをリストに追加
		
		$('#shch_btn_stop').show();
		$('#shch_btn_restart').hide();
		$('#shch_error').html('');
		
		console.log('定期リロードを開始しました。');
	};
	
	/**
	 * ★定期リロードを実行する
	 */
	this.reload=function(myself){
		this.counter++;
		
		//隠しモードのリロード件数と、リロード間隔に表示する。
		$('#shch_counter').html(this.counter);
		$('#shch_interval').html(this.aiInfo.interval/1000);
		
		this._autoInterval();//自動インターバル制御(タイマースレッド間隔の自動制御）
		
		var data={
				'info_room_id':this.prop.info_room_id ,
				'teller_window_id':this.prop.teller_window_id,
				'last_dt':this.prop.last_dt,
				'hash':this.prop.hash,
				'show_limit':this.prop.show_limit,
				};

		var json_str = JSON.stringify(data);//データをJSON文字列にする。
		
		var url=this.prop.host + 'guest_chat/reload';
		
		

		//☆AJAX非同期通信
		$.ajax({
			type: "POST",
			url: url,
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
			success: function(str_json, type) {
	
				try{
					
					var res=$.parseJSON(str_json);//パース
					
					console.log(res.res_flg);//■■■□□□■■■□□□■■■□□□)

					//「変化なし」である場合
					if(res.res_flg=='unchanged'){
						
						shchX.prop.try_counter=0;//試行回数をリセット
						
					}
					
					//「最新メッセージあり」である場合
					else if(res.res_flg=='new_message'){
						console.log('最新メッセージあり');
						
						//最新メッセージアイコンを数秒間表示する。
						$('#shch_new_icon').show();
						$('#shch_new_icon').fadeOut(5000);
	
						//プロパティに最終メッセージ日時と窓口IDをセットする。
						myself.prop.last_dt=res.last_dt;
						myself.prop.teller_window_id=res.teller_window_id;
						
						myself._createChatList(res.chatData);//チャットテーブルを作成する
						myself.listData=res.chatData;//メンバのチャット一覧データにセットしておく。
						
						// コンパクト区分に最新メッセージを表示する。
						$('#shch_compact').html(res.chatData[0].chat_msg);
						
						shchX.prop.try_counter=0;//試行回数をリセット
					}
					
					//締切である場合
					else if(res.res_flg=='closed'){
						console.log('締め切られました。');
						
						//最新メッセージアイコンを数秒間表示する。
						$('#shch_new_icon').show();
						$('#shch_new_icon').fadeOut(5000);
	
						//プロパティの最終メッセージ日時と窓口IDをクリアする。
						myself.prop.last_dt=null;
						myself.prop.teller_window_id=null;
				
						myself._createChatList(res.chatData);//チャットテーブルを作成する
						myself.listData=res.chatData;//メンバのチャット一覧データにセットしておく。
						
						// コンパクト区分に最新メッセージを表示する。
						$('#shch_compact').html(res.chatData[0].chat_msg);
					}
					
					//エラーである場合
					else if(res.res_flg=='error'){
						
						shchX._errorEx(
								'システムエラー：E001',
								str_json);

						
					}
					
					
				}catch(e){

					shchX._errorEx(
							'システムエラー：E002',
							str_json);
				}

			},
			error: function(xmlHttpRequest, textStatus, errorThrown){
				
				shchX._errorEx(
						'通信エラー：E003',
						xmlHttpRequest.responseText);

			}
		});
		
	};
	
	
	

	

	
	//チャット画面のタイトルに、Ajaxを通して取得した案内ルーム名を表示する。
	this._ajaxInfoRoomName=function(myself){
		//プロパティの案内ルーム名が空でない場合は、何もしない。
		if(this.prop.info_room_name!= null && this.prop.info_room_name!=''){
			return 
		}
		
		var data={
				'info_room_id':this.prop.info_room_id,
				'hash':this.prop.hash,
				};
		var json_str = JSON.stringify(data);//データをJSON文字列にする。
		var url=this.prop.host + 'guest_chat/ajax_info_room_name';

		//☆AJAX非同期通信
		$.ajax({
			type: "POST",
			url: url,
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
			success: function(str_json, type) {
				//☆AJAX非同期通信
				try{
					
					if(str_json=='error'){
						myself._errorA('info room name validation',str_json);
					}else{
						console.log('Ajaxにて案内ルーム名を取得しました。');
						
						var res=$.parseJSON(str_json);//パース
						$('#shch_room_info_name').html(res.info_room_name);
					}
					
				}catch(e){
					myself._errorA('info room name:try',str_json);
				}
			},
			error: function(xmlHttpRequest, textStatus, errorThrown){
				myself._errorA(textStatus,xmlHttpRequest.responseText);
			}
		});

	};
	
	
	//自動インターバル制御(タイマースレッド間隔の自動制御）
	this._autoInterval=function(){
		
		//初回、またはインターバルリセットを行った場合の処理。
		if(this.aiInfo.base_ut==0){
			this.aiInfo.base_ut=Math.floor($.now() / 1000);//基準UNIXタイムスタンプに現在UNIXタイムスタンプをセット
			this.aiInfo.index=0;
			this.aiInfo.interval=this.aiData[0].interval * 1000;//初期のインターバルをセット
			this.aiInfo.last_index=this.aiData.length-1;
			return;
		}
		
		//最終インデックスでない場合に、以下のインターバル変更処理を行う。
		if(this.aiInfo.index < this.aiInfo.last_index){
			//次開始時間を取得する。
			var next_i=this.aiInfo.index + 1;
			var next_start=this.aiData[next_i]['start'];//次開始時間
			next_start=next_start * 60;//分→秒

			var now_ut=Math.floor($.now() / 1000);//現在日時のUNIXタイムスタンプ
			var elapsed_time=now_ut - this.aiInfo.base_ut;//経過時間 = 現在日時 - 基準UNIXタイムスタンプ
			
			//経過時間が次開始時間を超えた場合、インターバルの変更処理を行う。
			if(elapsed_time >= next_start){
			
				this.aiInfo.interval=this.aiData[next_i].interval * 1000;//次のインターバルをセット
				this.aiInfo.index=next_i;//インデックスを進める
				
				this.stopReload();//タイマースレッドを一度停止（タイマースレッドが複数立ち上がることの防止）
				this.startReload();//タイマースレッドの再開
				
				console.log('リロード間隔を変更（秒）：' + this.aiData[next_i].interval);
			}

		}

	};


	
	/**
	 * ★チャットメッセージを送信する
	 */
	this.sendMsg=function(myself){

		$('#shch_guest_chat_send_btn').hide();//送信ボタンを一時的に隠す
		
		//チャットメッセージの取得とバリデーションを行う。
		var chat_msg=$('#shch_guest_chat_msg_ta').val();
		chat_msg=chat_msg.trim();
		if(this._isMaxLength(chat_msg,1000,true)==false){
			alert('メッセージを入力してください。(1000文字未満)');
			$('#shch_guest_chat_send_btn').show();//送信ボタンを再表示
			return;
		}
		
		var data={
				'info_room_id':this.prop.info_room_id,
				'teller_window_id':this.prop.teller_window_id,
				'last_dt':this.prop.last_dt,
				'chat_msg':chat_msg,
				'chat_name':this.prop.chat_name,
				'expiration':this.prop.expiration,
				'hash':this.prop.hash,
				};

		var json_str = JSON.stringify(data);//データをJSON文字列にする。
		var url=this.prop.host + 'guest_chat/send_msg';
		
		//☆AJAX非同期通信
		$.ajax({
			type: "POST",
			url: url,
			data: "key1="+json_str,
			cache: false,
			dataType: "text",
			success: function(str_json, type) {
				
				try{
					//送信エラー
					if(str_json=='error'){
						myself._errorA('send msg validation',str_json);
						
					}
					
					//送信成功
					else{
						$('#shch_guest_chat_msg_ta').val('');
						
						//プロパティにAjaxレスポンスの窓口IDなどのパラメータをセットする。
						var res=$.parseJSON(str_json);//パース
						myself.prop.teller_window_id=res.teller_window_id;//窓口ID
						myself.prop.expiration=res.expiration;//有効時間

						myself.saveChatEnt();//プロパティをローカルに保存する
						myself.reload(myself);//リロード呼出し
		
						$('#shch_error').html('');//エラーメッセージをクリア
						
					}
					
				}catch(e){
					myself._errorA('send msg:try',str_json);
					
				}
				
				$('#shch_guest_chat_send_btn').show();//送信ボタンを再表示
				
			},
			
			error: function(xmlHttpRequest, textStatus, errorThrown){
				myself._errorA(textStatus,xmlHttpRequest.responseText);
				myself.stopReload();//チェックリロード停止
			}
		});
	};
	
	
	

	
	
	
	//チャットテーブルを作成する
	this._createChatList=function(data){

		var hinagata="<div class='shch_chat_header'><span class=\"%chat_nm_class\">%chat_name</span><span class='shch_li_dt'>　　%created</span><br>%chat_msg</div>";
		
		var html='';
		
		for(var i in data){
			var ent=data[i];
			var row=hinagata;
			
			//ユーザー区分(1:ゲスト 2:オペレータ)
			if(ent.user_flg==2){
				row=row.replace('%chat_nm_class','shch_chat_name_ope');
				row=row.replace('%chat_name','オペレータ＜' + ent.chat_name + '＞');
			}else if(ent.user_flg==1){
				row=row.replace('%chat_nm_class','shch_chat_name_guest');
				row=row.replace('%chat_name',ent.chat_name);
			}else{
				row=row.replace('%chat_nm_class','shch_chat_name_system');
				row=row.replace('%chat_name','＜自動＞');
				ent.chat_msg = "<span style='color:#de5246'>" + ent.chat_msg + "</span>";
			}
			
			
			row=row.replace('%chat_msg',ent.chat_msg);
			row=row.replace('%created',ent.created);
			
			html+=row;
			
		}
		
		$('#shch_chat_div').html(html);

	};
	
	//プロパティをローカルに保存する
	this.saveChatEnt=function(){
		
		var jsonChatEnt = JSON.stringify(this.prop);//★JSON文字列にする。
		localStorage.setItem(this.propKey,jsonChatEnt);
	};
	
	//設計モードの表示切替
	this.configToggle=function(){
		
		//モードを取得する。   0:コンパクトモード,1:オープンモード,2：設定モード
		var mode=this._getMode();

		//設定区分：表示→非表示
		if(mode==2){
			$('#shch_config').hide();
			$('#shch_chat_div').show();
			$('#shch_guest_chat_send_btn').show();
			$('#shch_guest_chat_msg_ta').show();
			
			//画面横サイズをセット
			$('#shch_guest_chat').width(this.prop.width);

			//画面の縦サイズおよび最低縦サイズを指定する。
			$('#shch_guest_chat').height(this.prop.height);
			$('#shch_guest_chat').resizable({'minHeight':200});
			
			//チャット一覧のサイズにもセットする
			$("#shch_chat_div").height(this.prop.height - this.prop.chat_list_height);
			
			//隠しモードを隠す
			$("#kakusi_mode").hide();
			
		}
		
		//設定区分：非表示→表示
		else{
			$('#shch_config').show();
			$('#shch_chat_div').hide();
			$('#shch_guest_chat_send_btn').hide();
			$('#shch_guest_chat_msg_ta').hide();
			
			this._setConfigForm();//プロパティを設定フォームに表示
			
			//画面横サイズをセット
			$('#shch_guest_chat').width(this.prop.config_mode_width);

			//画面の縦サイズおよび最低縦サイズを指定する。
			$('#shch_guest_chat').height(this.prop.config_mode_height);
			$( '#shch_guest_chat' ).resizable({'minHeight':this.prop.config_mode_height});
		}
		
		
	};
	
	
	
	/**
	 * 設定を適用する
	 */
	this.configOk=function(){

		//名前の取得と入力チェック
		var chat_name=$('#shch_config_chat_name').val();
		if(chat_name.match(/[!"#$%&'()\*\+\.,\/;<>?@\[\\\]^`{|}~]/g)){
			alert('名前に記号を使わないでください。\nハイフン(-)など一部の記号は入力可能です。');
			return;
		}
		chat_name=chat_name.trim();
		if(this._isMaxLength(chat_name,20,true)==false){
			alert('名前は20文字以内で入力してください。【必須入力】');
			return;
		}
		this.prop.chat_name=chat_name;
		
		//日時表示フラグ
		if($('#shch_config_dt_show_flg').prop('checked')==true){
			this.prop.dt_show_flg=1;
			$('.shch_li_dt').show();//チャット一覧の日時を表示
			
		}else{
			this.prop.dt_show_flg=0;
			$('.shch_li_dt').hide();//チャット一覧の日時を非表示
			
		}
		
		//表示件数に変更があった場合、セットと一覧の再取得通知をする。
		var show_limit_a=$('#shch_config_show_limit').val();
		if(this.prop.show_limit != show_limit_a){
			this.prop.show_limit=show_limit_a;
			
			//最終日時にnullをセットすることで、reloadメソッドへ一覧再取得を通知する。
			this.prop.last_dt=null;
		}

		
		
		

		this.saveChatEnt();//ローカルホストに保存する

		this.configToggle();//チャットモードに切り替える
	};
	
	//プロパティを設定フォームに表示
	this._setConfigForm=function(){
		
		//名前
		$('#shch_config_chat_name').val(this.prop.chat_name);
		
		//チャット名前
		if(this.prop.dt_show_flg==1){
			$('#shch_config_dt_show_flg').prop('checked','checked');
			
		}else{
			$('#shch_config_dt_show_flg').prop('checked','');
		}

		//表示件数
		$('#shch_config_show_limit').val(this.prop.show_limit);
		
		


	};
	
	/**
	 * 設定を初期化
	 */
	this.clearConfig=function(){
	
		//デフォルトプロパティの値でリセットする。
		this.prop['last_dt']=this.defProp['last_dt'];
		this.prop['show_limit']=this.defProp['show_limit'];
		this.prop['dt_show_flg']=this.defProp['dt_show_flg'];
		this.prop['width']=this.defProp['width'];
		this.prop['height']=this.defProp['height'];
		this.prop['compact_width']=this.defProp['compact_width'];
		this.prop['compact_height']=this.defProp['compact_height'];
		this.prop['try_limit']=this.defProp['try_limit'];
		this.prop['try_counter']=this.defProp['try_counter'];

		//プロパティを設定フォームに表示
		this._setConfigForm();

	};
	

	
	/**
	 * 文字数チェックのバリデーション
	 * @param v			対象文字列
	 * @param maxLen	制限文字数
	 * @param req		trueは必須入力。0と半角SPは入力ありとみなす。引数省略時はfalse
	 * @return true:正常  false:異常
	 */
	this._isMaxLength=function(v,maxLen,req){

		//必須入力チェック
		if(req==true){
			if(v == null || v === '' || v === false){
				return false;
			}
		}

		//最大文字数チェックをする。
		var n=v.length;
		if (n > maxLen){
			return false;

		}

		return true;
	};
	
	/**
	 * エラー出力
	 * @param alert_msg アラートメッセージ
	 * @param dump AJAXレスポンスなどダンプコード
	 */
	this._errorA=function(alert_msg,dump){
		$('#shch_error').html('サーバーエラーが発生したため、リロードを一時停止します。再開ボタンでリロードを開始します。');
		this.stopReload();//タイマースレッド停止
		
		console.log(this.prop.host + ':' + alert_msg);
		
		if(this.prop.debug_mode != 0){
			alert(alert_msg);
			if(this.prop.debug_mode == 2){
				$(this.prop.debug_slc).html(dump);
			}
		}
	};
	
	
	/**
	 * エラー表示
	 * @param errMsg ユーザーに通知するエラーメッセージ
	 * @param dump デバッグモードが2である場合に、画面表示する。主にダンプなどを指定する。
	 */
	this._errorEx=function(errMsg,dump){
		
		

		//試行回数が上限に達したら、エラーコールバックを呼び出す。
		shchX.prop.try_counter++;//試行回数をインプリメント
		if(shchX.prop.try_counter >= shchX.prop.try_limit){
		
			shchX.prop.try_counter=0;//試行回数をリセット
			this._errorA(errMsg,dump);
			shchX.stopReload();
		}else{
			console.log(errMsg);
		}
		
		
	};
	
	
	
}





















//----------------埋め込みコード----------------------------------


//SHCHゲストチャット画面のHTMLを書きだす。
function shchWriteHtml(){
	var htmlStr=
		"		<div id='shch_header' class=\"panel-heading\">" +
		"			<div class=\"row\">" +
		"				<span id=\"shch_new_icon\"><img id=\"shch_new_icon_img\" src=\"../img/shch_guest_chat/new_icon.gif\" /></span>" +
		"				<span id=\"shch_room_info_name\" >-</span>" +
		"				<button id=\"shch_config_toggle_btn\" type=\"button\" class=\"btn btn-primary btn-xs pull-right\" onclick='shchConfigToggle()'><span class=\"glyphicon glyphicon-align-justify\"></span></button>" +
		"				<button id=\"shch_open_btn\" type=\"button\" class=\"btn btn-primary btn-xs pull-right\" onclick='shchCompactDivToggle()'><span class=\"glyphicon glyphicon-new-window\"></span></button>" +
		"				<button id=\"shch_compact_btn\" type=\"button\" class=\"btn btn-primary btn-xs pull-right\" onclick='shchCompactDivToggle()'><span class=\"glyphicon glyphicon-minus\"></span></button>" +
		"			</div>" +
		"		</div>" +
		"		<div id='shch_compact'>" +
		"			<span style=\"color:#808080\"> - SHCH チャット - </span>" +
		"		</div>" +
		"		<div id='shch_body'>" +
		"			<div id=\"shch_guest_chat_msg_sends\" style=\"padding:3px\">" +
		"				<textarea id=\"shch_guest_chat_msg_ta\" class=\"form-control\" rows=\"3\" placeholder=\"メッセージを入力してください。\"></textarea>" +
		"				<div id=\"shch_btns1\" >" +
		"					<button id=\"shch_guest_chat_send_btn\" type='button'  class='btn btn-success btn-xs ' onclick='shchSendMsg()'>" +
		"						<i class=\"glyphicon glyphicon-send\" title=\"メッセージ送信\"></i></button>" +
		"				</div>" +
		"			</div>" +
		"			<div id=\"shch_error\" style=\"color:red\"></div>" +
		"			<div id=\"shch_chat_div\">" +
		"				<div class=\"shch_chat_guest\">" +
		"					<span></span>" +
		"					メッセージを入力してください。" +
		"				</div>" +
		"			</div>" +
		"			<div id='shch_config'>" +
		"				<table id=\"shch_config_tbl\" class=\"table\">" +
		"					<tr>" +
		"						<td>名前</td>" +
		"						<td>" +
		"							<input id=\"shch_config_chat_name\" type=\"text\" maxlength=\"20\" class=\"form-control\" placeholder=\"名前を入力してください\" />" +
		"						</td>" +
		"					</tr>" +
		"					<tr>" +
		"						<td>日時表示</td>" +
		"						<td>     " +
		"							<label><input id=\"shch_config_dt_show_flg\" type=\"checkbox\" /></label>" +
		"      					</td>" +
		"      				</tr>" +
		"					<tr>" +
		"						<td>表示件数</td>" +
		"						<td>" +
		"							<select id=\"shch_config_show_limit\" >" +
		"								<option value=\"5\">5件</option>" +
		"								<option value=\"10\">10件</option>" +
		"								<option value=\"20\">20件</option>" +
		"								<option value=\"50\">50件</option>" +
		"								<option value=\"100\">100件</option>" +
		"								<option value=\"200\">200件</option>" +
		"							</select>" +
		"      					</td>" +
		"      				</tr>" +
		"					<tr>" +
		"						<td>リロード<span id=\"shch_debug_mode_swiche\">　</span></td>" +
		"						<td>" +
		"							<input id=\"shch_btn_stop\" type='button' value='停止' class='btn btn-primary btn-xs' onclick='shchStopReload()'/>" +
		"							<input id=\"shch_btn_restart\" type='button' value='再開' class='btn btn-danger btn-xs' onclick='shchStartReload()' style=\"display:none\" />" +
		"      					</td>" +
		"      				</tr>" +
		"					<tr>" +
		"						<td>" +
		"							<button id=\"shch_btn_config_ok\" type='button' class='btn btn-success ' onclick='shchConfigOk()' ><i class=\"glyphicon glyphicon-ok\"></i></button>" +
		"						</td>" +
		"						<td style=\"text-align:right\">" +
		"							<input id=\"shch_btn_clear_config\" type='button' value='初期設定' class='btn btn-primary btn-xs' onclick='shchClearConfig()'/>" +
		"      					</td>" +
		"      				</tr>" +
		"				</table>" +
		"				<div id='kakusi_mode' class=\"shch_debug\" style=\"display:none\">" +
		"				<span id='shch_debug_mode'>デバッグモード :OFF</span>　　" +
		"				<input id=\"shch_test_c\" type='button' value='導通テスト' class='btn btn-danger btn-xs' onclick='test_c()'/>" +
		"					<div>リロード数：<span id=\"shch_counter\"></span>　　リロード間隔:<span id=\"shch_interval\"></span>秒</div>" +
		"				</div>" +
		"			</div>" +
		"		</div>";
	
	$('#shch_guest_chat').html(htmlStr);
};


//----------------実装----------------------------------

///SHCHオブジェクト
var shchX;





/**
 * SHCHゲストチャットを起動する
 * @param info_room_id 案内ルームID
 * @param hash		ハッシュキー
 * @param host		ホスト（例： 「/shch/」、「http://192.168.11.199/shch/」
 * @param debug_mode		デバッグモード 0:OFF 1:リロード数などを表示   2:システムエラーのダンプを表示
 * @param debug_slc	デバッグ出力要素名
 */
function shchGuestChat(info_room_id,hash,host,debug_mode,debug_slc){
	shchWriteHtml();//SHCHゲストチャット画面のHTMLを書きだす。

	shchX=new ShchX();
	shchX.run(shchX,info_room_id,hash,host,debug_mode,debug_slc);

}








/**
 * チャットメッセージ送信
 */
function shchSendMsg(){
	shchX.sendMsg(shchX);
}

/**
 * 定期リロードを停止する。
 */
function shchStopReload(){
	shchX.stopReload();
}

/**
 * コンパクト化、オープン化を切り替える。
 */
function shchCompactDivToggle(){
	shchX.compactDivToggle();
}

/**
 * 定期リロードを再開する
 */
function shchStartReload(){
	shchX.startReload();
}

/**
 * 定期リロード
 */
function shchReload(){
	shchX.reload(shchX);
}

/**
 * 設計モードの表示切替
 */
function shchConfigToggle(){
	shchX.configToggle();
}

/**
 * 設定を適用する
 */
function shchConfigOk(){
	shchX.configOk();
}

/**
 * 設定を初期化する。
 */
function shchClearConfig(){
	shchX.clearConfig();
}





/**
 * 導通テスト用です。
 */
function test_c(){
	var data={'test':'test-abc'};
	var json_str = JSON.stringify(data);//データをJSON文字列にする。
	
	var url=shchX.prop.host + 'guest_chat/test_c';
	
	//☆AJAX非同期通信
	$.ajax({
		type: "POST",
		url: url,
		data: "key1="+json_str,
		cache: false,
		dataType: "text",
		success: function(str_json, type) {
			alert('AJAXテスト：導通しています。');
			console.log(str_json);
			
		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			alert('AJAXエラー:サーバー側とのアクセスが異常です。');
			shchX.stopReload();
		}
	});
}


