
/*
 * 開発メモ

○デバッグクラスを作る。
デバッグクラスを実装する。使いやすいグローバルメソッドも用意。
色の値をデバッグ出力する。
色を変更するロジック。現在の色と比較してから色をセット

*/

///////////////////////  基本部分 ///////////////////////////////////////

		//基本ループの設定
		var canvas;
		var ctx;
		//var i=0;
		var fps = 30;
		var now;
		var then = Date.now();
		var interval = 1000/fps;
		var delta;


		var m_box;//メインコンテナ

		var RAD_A=2*Math.PI/360;//ラジアン係数。ラジアインから360°表記への変換に利用。
		var PI2_=Math.PI*2;
		var BASE_COLOR_='#1b3b75';
		var X_=0;
		var Y_=1;



		//初期イベント（DOM読込後のイベント）
		$(document).ready(function(){

			init();
			run();
		});

		function init(){
			  /* canvas要素のノードオブジェクト */
			  canvas = document.getElementById('canvassample');
			  /* canvas要素の存在チェックとCanvas未対応ブラウザの対処 */
			  if ( ! canvas || ! canvas.getContext ) {
			    return false;
			  }
			  /* 2Dコンテキスト */
			  ctx = canvas.getContext('2d');


			  ctx.strokeStyle = BASE_COLOR_;//線の色を基本色にする。

			  //メインコンテナを作成
			  var bf=new BoxFactory();
			  m_box=bf.init();



		}

		//マルチスレッドを動かす。
		//fps間隔でメインとなるループを行っている。
		function run() {

		    requestAnimationFrame(run);

		    now = Date.now();
		    delta = now - then;

		    if (delta > interval) {

		    	thread();


		        then = now - (delta % interval);
		    }
		}

		//メインスレッド
		function thread() {
			var af=m_box['ActorFunc'];
			var act=m_box['act'];

			if(ctx==null){return null;}


			act.ang=act.ang+1;
			if(act.ang == 360){
				act.ang=0;
			}
			act=af.calcVertexs(act);

		  /* 四角を描く */
		  ctx.beginPath();//描画宣言
		  ctx.clearRect(0,0,640,480);//一度canvasをクリア


		  //ctx.arc(150,75,60,0,Math.PI*2,true);

		  //ctx.arc(70, 70, 60, 0, Math.PI*2, true);
//		  ctx.moveTo(10, 10);//始点
//		  ctx.lineTo(150, i);//次の線の点
//		  ctx.lineTo(5, 160);
//		  ctx.closePath();//線を閉じる
		  ctx.fillText("hello world! 日本"+i, 15, 50);

		  af.drawCenter(ctx,act);
		  af.drawFrame(ctx,act);

		  ctx.stroke();//描画する
		}





//////////////////

/**
 * デバッグクラス
 * ★履歴
 * 2014/6/4	新規作成
 */
var ADebug=function(){

	this.m_map=new Array();//デバッグデータ連想配列
	this.iniX=10;//デバッグ初期位置X
	this.iniY=10;//デバッグ初期位置Y
	this.maxCnt=100;//最大デバッグデータ数。

	/**
	 * デバッグ出力
	 *
	 * @param v		デバッグ文字列
	 * @param key	キー
	 *
	 */
	this.debug=function(v,key){

		//キーが省略されている場合、キーを自動生成する。
		if(key==undefined){
			key=this.m_map.length;
		}

		//デバッグデータ数が最大を超えたら、一旦リセットする。
		if(this.m_map.length>this.maxCnt){
			this.m_map=void 0;
			this.m_map=new Array();
		};
		this.m_map[key]=v;

	};


	/**
	 * デバッグデータを描画する。
	 */
	this.draw=function(){
		var i=0;
		for (var k in this.m_map){
			var v=k+' = '+this.m_map[k];
			ctx.fillText(v, iniX, iniY+i);
			i++;
		}
	};

};

/**
 * BOXファクトリー
 * 各種オブジェクトをセットしている。
 */
var BoxFactory =function(){

	/**
	 * 初期化。
	 * 各種オブジェクトをセット
	 */
	this.init=function(){



		var box=new Array();


		var actLib=new ActorLib();
		box['ActorLib']=af;

		var af=new ActorFunc(actLib);
		box['ActorFunc']=af;

		var act=af.create(1,100, 50,30);
		box['act']=act;




		return box;
	};


};





/**
 * 役者用の汎用メソッド集。
 *
 * @param actLib	役者ライブラリ
 */
var ActorFunc =function(actLib){

	this.m_actLib=actLib;


	/**
	 * 役者を生成する。
	 * @param id	役者ID
	 * @param x		初期位置X
	 * @param y		初期位置Y
	 * @param ang	初期角度
	 *
	 */
	this.create=function(id,x,y,ang){

		var act=this.m_actLib.get(id);
		act.x=x;
		act.y=y;
		act.ang=ang;
		act.h=(act.width^2 + act.height^2)^0.5;
		act=this.calcVertexs(act);

		//中心角リストの算出
		var c_ang= Math.atan(x/y) * 360 / (2 * Math.PI);//中心角を算出
		act.c_angs[0]=c_ang;
		act.c_angs[1]=(90-c_ang)*2 + act.c_angs[0];
		act.c_angs[2]=c_ang*2 + act.c_angs[1];
		act.c_angs[3]=(90-c_ang)*2 + act.c_angs[2];


		return act;
	};

	/**
	 * 矩形4隅の頂点情報を算出する。
	 * @param Actor(頂点情報算出前）
	 * @return Actor(頂点情報算出後）
	 */
	this.calcVertexs=function(act){
		//*** 右手座標系	0～360


		var ang=act.ang+act.c_ang;


		for (i=0;i<4;i++){
			var ang=act.ang+act.c_angs[i];
			if(ang >= 360){
				ang=ang-360;
			}

			var rad=ang * RAD_A;

			//ベクトルの終点座標を取得。
			this.calcXY_Vector(act.vertexs[i],rad,act.h,act.x,act.y);

		}

		return act;

	};

	/**
	 * ベクトルの終点座標を取得。
	 * 終点座標は始点を(0,0)とした場合の相対座標である。
	 * @param r_p	この引数に終点座標をセット
	 * @param ang	ベクトルの角度（360°）
	 * @param rad	ベクトルのラジアン
	 * @param h		ベクトルの長さ
	 * @param x		メイン座標
	 * @param y		メイン座標
	 */
	this.calcXY_Vector=function(r_p,rad,h,x,y){

		r_p[X_]=Math.sin(rad)*h + x;
		r_p[Y_]=Math.cos(rad)*h + y;

	}


	/**
	 * 役者をフレームで描画する。
	 * @param ctx	2Dコンテキスト
	 * @param act	役者
	 *
	 */
	this.drawFrame=function(ctx,act){

		v=act.vertexs;
		ctx.moveTo(v[0][X_], v[0][Y_]);
		ctx.lineTo(v[1][X_], v[1][Y_]);
		ctx.lineTo(v[2][X_], v[2][Y_]);
		ctx.lineTo(v[3][X_], v[3][Y_]);
		ctx.closePath();//線を閉じる
	}


	this.drawCenter=function(ctx,act){



		var x=act.x;
		var y=act.y;
		var r=2;

		ctx.arc(x, y, r, 0, PI2_, true);
	}

};

/**
 * 役者クラス
 */
var Actor =function(){

	this.x;
	this.y;
	this.width;
	this.height;
	this.h;
	this.ang;
	this.theta;
	this.c_angs=[0,0,0,0];//矩形の4隅に対応した中心角
	this.vertexs=[ [ 0, 0 ],[ 0, 0 ],[ 0, 0 ],[ 0, 0 ] ];//矩形の4隅にある頂点情報　vertexs["頂点番号"]["座標XY"]





};


/**
 * 役者ライブラリ
 */
var ActorLib=function(){

	/**
	 * IDで指定した役者を生成する。
	 * @param id 役者ID
	 * @return 役者
	 */
	this.get=function(id){
		var act=new Actor();
		switch (id){
		case 1:
			act.width=20;
			act.height=40;

		case 2:
			act.width=10;
			act.height=30;

		}

		return act;

	}
};




















