
/**
 * リサイズ　（オリジナルコード版）
 * ★概要
 * 要素のサイズを変更する。
 * ★参照
 * JQuery
 * ★使い方
 * onloadイベント等でinitメソッドにclass名を渡す。
 * ★履歴
 * 2011/09/09 新規作成
 * 
 */
var Resize =function(){

	
	
	/**
	 * 対象をリサイズできるようにする。
	 * @param className class名
	 */
	this.init=function(className){
		
		var jqElms=$('.'+className);
		var elms=this.convertArray(jqElms);//テーブル配列情報に変換
		
		for (var i=0;i<elms.length;i++){
			var rsz1=new Resize2();
			rsz1.init(elms[i]);
			
		}
		
	};
	
	//要素集合を配列化する。
	this.convertArray=function(jqElm){
		var ary=new Array();
		jqElm.each(function(){
			ary.push($(this));
		});
		
		return ary;
	};
	
	
};



var Resize2 =function(){

	var m_dragRng=8;//ドラッグ範囲幅
	var m_dragFlg=false;
	var m_actTar;

	/**
	 *汎用タイプリサイズ
	 * 初期化を処理。イベントのセットなど
	 * @param tars 対象要素オブジェクト群
	 * 
	 */
	this.init=function(tars) {

		//▼リサイズ対象要素オブジェクトの件数分、マウス移動イベントを作成します。
		tars.each(
			function(){
				$(this).mousemove(function(event){
					//▼以下はマウス移動のイベント処理です。

					//絶対座標を取得
			        var x=event.pageX;
			        var y=event.pageY;
			        
			        //要素の左上位置を取得
			        var px=$(this).offset().left;
			        var py=$(this).offset().top;

		        	//相対座標を算出
			        var rx=x-px;
			        var ry=y-py;

			        //要素の幅を取得
			        var w=$(this).width();
			        var h=$(this).height();
			        
			        //カーソル変化
			        if(m_dragFlg==false){
				        if(rx+m_dragRng>w && ry+m_dragRng>h){
				        	$(this).css("cursor","se-resize");
				        }else{
				        	$(this).css("cursor","auto");
				        
				        }
			        }
		
				});
			}
		);
		
		//▼リサイズ対象要素オブジェクトの件数分、マウスダウンイベントを作成します。
		tars.each(
			function(){
				$(this).mousedown(function(event){
					

					//▼以下はマウスダウン時に実行される処理
					
					//絶対座標を取得
			        var x=event.pageX;
			        var y=event.pageY;
			        
			        //要素の左上位置を取得
			        var px=$(this).offset().left;
			        var py=$(this).offset().top;
			        
		        	//相対座標を算出
			        var rx=x-px;
			        var ry=y-py;

			        //要素の幅を取得
			        var w=$(this).width();
			        var h=$(this).height();

			        //ドラッグ開始設定
			        if(rx+m_dragRng>w && ry+m_dragRng>h){
			        	m_dragFlg=true;
			        	m_actTar=$(this);
			        

			        }

				});
			}
		);
		

		//▼bodyマウスムーブ
		$('body').mousemove(function(event){

			//ドラッグする。
			if(m_dragFlg==true){
		
				//横方向
		        var x=event.pageX;//絶対座標を取得
		        var px=m_actTar.offset().left;//要素の左上位置を取得
		        var rx=x-px;//相対座標を算出
		        m_actTar.width(rx);

		        //縦方向
		        var y=event.pageY;//絶対座標を取得
		        var py=m_actTar.offset().top;//要素の左上位置を取得
		        var ry=y-py;//相対座標を算出
		        m_actTar.height(ry);
			        
				return false;//画像ドラッグによる禁止マークを出ないようにする
		        
			}

		});


		//▼bodyマウスアップイベント
		$('body').mouseup(function(event){
			//ドラッグ解除
			if(m_dragFlg==true){
				m_dragFlg=false;
			}

		});

	};
	
};

