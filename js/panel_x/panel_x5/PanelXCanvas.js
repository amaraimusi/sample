/**
 * 移動パネル ＆ Canvas
 * 
 * @note
 * ドラッグ移動、拡大縮小、そしてcanvasに対応したパネルのクラス。
 * 
 * 
 * @version 0.7
 * @date 2016-12-2
 * 
 * @param param
 * - frame_div_slt フレーム区分のセレクタ	ゲームプレビュー機能の全体をラップする区分要素
 * - canvas_slt canvasのセレクタ
 */
var PanelXCanvas =function(param){
	
	
	this.param = param;
	
	this.data = {}; // ゲームテキストデータ
	
	this.cvs; // キャンバスの要素オブジェクト
	
	this.ctx; // キャンバスのコンテキスト
	
	var myself=this; // Instance of myself.

	/**
	 * initialized.
	 */
	this.constract=function(){
		
		// If Option property is empty, set a value.
		this.param = setOptionIfEmpty(this.param);
		
		// キャンバスの要素オブジェクトとコンテキストを取得する。
		myself.cvs = $(this.param.canvas_slt);
		myself.ctx = myself.cvs[0].getContext('2d');

		var context = myself.ctx;
		
	    context.beginPath();
	    //パスの開始座標を指定する
	    context.moveTo(100,20);
	    //座標を指定してラインを引いていく
	    context.lineTo(150,100);
	    context.lineTo(50,100);
	    //パスを閉じる（最後の座標から開始座標に向けてラインを引く）
	    context.closePath();
	    //現在のパスを輪郭表示する
	    context.stroke();
	    
	    
		// パネルの初期化
		initPanel();
		
		
	};
	
	// If Option property is empty, set a value.
	function setOptionIfEmpty(param){
		
		if(param == undefined){
			param = {};
		}
		
		// 幅のセット
		param['sp_w'] = 16; // パネルとキャンバスのすきま（横）
		param['sp_h'] = 16; // パネルとキャンバスのすきま（縦）
		param['head_h'] = 50; // ヘッダーの縦幅
		
		
		// フレーム区分のセレクタ
		if(param['frame_div_slt'] == undefined){
			throw new Error(" 'frame_div_slt' is nothing");
		}
		
//		// パネルボディのセレクタ
//		if(param['panel_body_slt'] == undefined){
//			param['panel_body_slt'] = "#game_preview_panel_body";
//		}
		
		// canvasのセレクタ
		if(param['canvas_slt'] == undefined){
			param['canvas_slt'] = "#game_preview_canvas";
		}
		
		return param;
	};
	
	
	
	/**
	 * データを再セットしてゲームプレビューをリロードする。
	 * 
	 * @param data ゲームテキストデータ
	 */
	this.reload = function(data){
		console.log('execute');
	};

	
	/**
	 * パネルの初期化
	 */
	function initPanel(){
		
		// フレーム区分要素の横幅から縦幅を算出して、同要素にセットする。
		var frameDivElm = $(myself.param.frame_div_slt);
		var frame_width = frameDivElm.width();
		var frame_height = frame_width * (16 /9); // iPhoneの平均的な縦横比を適用する。
		frameDivElm.height(frame_height);
		myself.param['frame_width'] = frame_width;
		myself.param['frame_height'] = frame_height;
		


		// パネルを埋込状態にする（ドラッグ機能を無効化する。）
		myself.onDraggable();

		
		$('#game_preview_panel').resizable({
			maxHeight:1800,
			maxWidth:1000,
			minHeight:180,
			minWidth:100,
			stop: function( event, ui ) {
				//リサイズ操作から手を放した瞬間のイベント
				var h=ui.size.height;
				var w=ui.size.width;
		
				// キャンバスのサイズを算出して、キャンバスとパラメータにセットする。
				setSizeToCanvas(w,h);

				
			}
		});
	};
	
	
	
	
	//ドラッグ機能を有効化する。
	this.onDraggable = function(){

		var draggableDiv = $('#game_preview_panel').draggable();
		
		//ドラッグ移動を組み込むとテキスト選択ができなくなるので、パネルボディ部分をテキスト選択可能にする。
		$('.panel-body',draggableDiv).mousedown(function(ev) {
			  draggableDiv.draggable('disable');
			}).mouseup(function(ev) {
			  draggableDiv.draggable('enable');
			});
		

		var frame_width = 300;
		var frame_height = 500;
		
		
		$('#game_preview_panel').css({
			'top':'50px',
			'left':'50px',
			'width':frame_width + 'px',
			'height':frame_height + 'px',
		});

		// キャンバスのサイズを算出して、キャンバスとパラメータにセットする。
		setSizeToCanvas(frame_width,frame_height);
		

		$('#pnl1_fullscreen').show();
		$('#pnl1_window').hide();
	}
	
	
	this.offDraggable = function(){

		var draggableDiv = $('#game_preview_panel').draggable();
		draggableDiv.draggable('destroy');

		$('#game_preview_panel').css({
			'position':'none',
			'top':'0px',
			'left':'0px',
			'width':'100%',
			'height':'100%',
		});

		$('#pnl1_fullscreen').hide();
		$('#pnl1_window').show();
		
		// キャンバスのサイズを算出して、キャンバスとパラメータにセットする。
		setSizeToCanvas(myself.param.frame_width,myself.param.frame_height);
	
	}
	
	
	/**
	 * キャンバスのサイズを算出して、キャンバスとパラメータにセットする。
	 * @param frame_width フレーム横幅
	 * @param frame_height フレーム縦幅
	 */
	function setSizeToCanvas(frame_width,frame_height){
		var sp_w = myself.param.sp_w;
		var sp_h = myself.param.sp_h;
		var head_h = myself.param.head_h;
		var canvas_width = frame_width - (sp_w * 2);
		var canvas_height = frame_height - (sp_h * 2) - head_h;
		
		myself.param['canvas_width'] = canvas_width;
		myself.param['canvas_height'] = canvas_height;
		
		myself.cvs.width(canvas_width);
		myself.cvs.height(canvas_height);
		

		
	}
	
	//　■■■□□□■■■□□□■■■□□□
//	// パネルを閉じる
//	function closePanel(){
//		$('#game_preview_panel').hide();
//	}
//	
//	// パネルを表示する
//	function showPanel(){
//		$('#game_preview_panel').show();
//	}
	
	

	
	
	
	
	
	
	
	
	
	
	// call constractor method.
	this.constract();
};