
//			m_d.debug('test','key1');//■■■□□□■■■□□□■■■□□□
//			m_d.debugNumK(5,'xxx',4);//■■■□□□■■■□□□■■■□□□
//m_d.debugRad(act.ang,'ang');//■■■□□□■■■□□□■■■□□□


/*
 * 開発メモ

○ラインがつながらないようにする
×前方座標の算出
基本的な座標系の設定・考察

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
		var m_clickX=0;//マウスのクリック位置X
		var m_clickY=0;//マウスのクリック位置Y

		var m_box;//メインコンテナ
		var m_d;//デバッグクラス


		//座標系の設定。
		//open GLの場合、原点を左下とした右手座標系。逆時計周り
		var ZAHYO_MAWARI=1;//角度方向 0:時計周り    1:逆時計周り
		var ZAHYO_T_ANG=Math.PI;//角度差(システムの0°との角度差）
		var ZAHYO_O_X=200;//原点座標X
		var ZAHYO_O_Y=200;//原点座標Y



		var RAD_A=2*Math.PI/360;//ラジアン係数。ラジアンから360°表記への変換に利用。
		var RAD360=Math.PI*2;//360°
		var RAD180=Math.PI;
		var RAD90=Math.PI/2;
		var BASE_COLOR_='#1b3b75';
		var X_=0;
		var Y_=1;






		//初期イベント（DOM読込後のイベント）
		$(document).ready(function(){

			init();
			canvas.addEventListener('click', onClick, false);//クリックイベントを登録
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

			  m_d=new ADebug();//デバッグクラス


			  //メインコンテナを作成
			  var bf=new BoxFactory();
			  m_box=bf.init();



		}

		//クリックイベント
		function onClick(e){
			m_clickX = e.clientX - canvas.offsetLeft;
			m_clickY = e.clientY - canvas.offsetTop;
			console.log('click='+m_clickX+','+m_clickY);//■■■□□□■■■□□□■■■□□□)
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
			var mtt=m_box['MoveToTarget'];

			if(ctx==null){return null;}



//			act.ang=act.ang+0.1;
//			if(act.ang > RAD360){
//				act.ang=0;
//			}

			act.ang=Math.PI / 4;

			act=af.calcVertexs(act);
			af.calcFront(act);

			m_d.debugRad(act.ang,'ang');//■■■□□□■■■□□□■■■□□□



			//役者をマウスクリックの位置に向かわせる。
//			mtt.move(act,m_clickX,m_clickY);
//			act=af.calcVertexs(act);
			//act=af.calcVertexs(act);

		  /* 四角を描く */
		  ctx.beginPath();//描画宣言
		  ctx.clearRect(0,0,640,480);//一度canvasをクリア

		  //クリックポイントを描画
		  ctx.moveTo(m_clickX, m_clickY);// 始点
		  ctx.arc(m_clickX, m_clickY, 3, 0, RAD360, true);
		  ctx.closePath();//線を閉じる

		  af.drawCenter(ctx,act);
		  af.drawFrame(ctx,act);

		  m_d.draw();


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
			ctx.fillText(v, this.iniX, this.iniY+(i*8));
			i++;
		}
	};


	/**
	 * 桁固定数値デバッグ
	 *
	 * @param v		デバッグ文字列
	 * @param key	キー
	 * @param keta	固定桁数
	 *
	 */
	this.debugNumK=function(v,key,keta){

		//キーが省略されている場合、キーを自動生成する。
		if(key==undefined){
			key=this.m_map.length;
		}

		//デバッグデータ数が最大を超えたら、一旦リセットする。
		if(this.m_map.length>this.maxCnt){
			this.m_map=void 0;
			this.m_map=new Array();
		};

		//桁数固定する。
		v=this.ketaKotei(v,keta);

		this.m_map[key]=v;

	};

	/**
	 * ラジアンを360°形式に変換してデバッグ
	 * @param rad ラジアン
	 *
	 */
	this.debugRad=function(rad,key){

		var ang=rad * 360 / (Math.PI * 2)
		ang=Math.round(ang);

		this.debugNumK(ang,key,3);
	}


	/**
	 * 数値の桁を固定する。例「3」→「003」
	 * @param num 	数値
	 * @param n		桁数
	 * @param 桁固定化した数値（文字列扱い）
	 *
	 */
	this.ketaKotei =function (num, n){
		var ret=""+num;
		while(ret.length < n){
			ret = "0" + ret;
		}
		return (ret);
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


		var moveToTarget=new MoveToTarget();
		box['MoveToTarget']=moveToTarget;


		return box;
	};


};

/**
 * 目標へ役者を向かわせるクラス。
 */
var MoveToTarget=function(){

	/**
	 * 目標へ役者を向かわせる
	 * @param act	役者
	 * @param mtt_x	目標座標X
	 * @param mtt_y	目標座標Y
	 *
	 */
	this.move=function(act,mtt_x,mtt_y){

		m_d.debug(ta,'ta');
		//目標角度を算出
		var ta=this.calcTargetAng(act.x,act.y,mtt_x,mtt_y);

		//ta=ta *  360 / RAD360

		//m_d.debug(ta,'ta');
		//■■■□□□■■■□□□■■■□□□次回
		//		this.ang;//向き角度
		//		this.ang_spd;//方向転換速度
		//		this.speed;//移動速度
		//m_d.debug(act.ang,'act.ang');

		//比較角度＝目標角度-自向き角度
		var cmpAng=ta-act.ang;


		//比較角度が０より小さければ360を加算
		if(cmpAng < 0){
			cmpAng+=RAD360;
		}

		m_d.debug(Math.round(cmpAng),'cmpAng');

		//比較角度が180より小さければ右回り、大きければ左周り
		//m_d.debug(act.ang_spd,'ang_spd');
		if(cmpAng < RAD180){

			act.ang+=act.ang_spd;
			if(act.ang >= RAD360){
				act.ang-=RAD360;
			}
		}else{

			act.ang-=act.ang_spd;
			if(act.ang < 0){
				act.ang+=RAD360;
			}
		}

		m_d.debug(Math.round(act.ang),'act.ang');
	};

	//目標角度を算出
	this.calcTargetAng=function(x1,y1,x2,y2){
		//atan((y2-y1) / (x2-x1))
		var a=Math.atan((y2-y1) / (x2-x1));
		return a;
	};

}


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
		var c_ang= Math.atan(x/y) * RAD360 / (2 * Math.PI);//中心角を算出
		act.c_angs[0]=c_ang;
		act.c_angs[1]=(RAD90-c_ang)*2 + act.c_angs[0];
		act.c_angs[2]=c_ang*2 + act.c_angs[1];
		act.c_angs[3]=(RAD90-c_ang)*2 + act.c_angs[2];


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
			if(ang >= RAD360){
				ang=ang-RAD360;
			}

			//var rad=ang * RAD_A;

			//ベクトルの終点座標を取得。
			this.calcXY_Vector(act.vertexs[i],ang,act.h,act.x,act.y);

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

		//前方座標を描画
		ctx.moveTo(act.frontX, act.frontY+3);
		ctx.arc(act.frontX, act.frontY, 3, 0, RAD360, true);
		ctx.closePath();


	}


	this.drawCenter=function(ctx,act){



		var x=act.x;
		var y=act.y;
		var r=2;
		ctx.moveTo(x, y+r);// 始点
		ctx.arc(x, y, r, 0, RAD360, true);
		ctx.closePath();//線を閉じる
	}

	/**
	 * 前方座標を算出する。
	 */
	this.calcFront=function(act){


		var y=act.height * Math.cos(act.ang);
		var x=act.width * Math.sin(act.ang);



		act.frontX=act.x+x;
		act.frontY=act.y+y;

//		m_d.debugNumK(Math.cos(act.ang),'cos',4);//■■■□□□■■■□□□■■■□□□
//		m_d.debugNumK(Math.sin(act.ang),'sin',4);//■■■□□□■■■□□□■■■□□□
		m_d.debug(Math.cos(act.ang),'cos');//■■■□□□■■■□□□■■■□□□
		m_d.debug(Math.sin(act.ang),'sin');//■■■□□□■■■□□□■■■□□□

	}

};

/**
 * 役者クラス
 */
var Actor =function(){

	this.x=0;
	this.y=0;
	this.width;
	this.height;
	this.h;
	this.ang=0;//向き角度
	this.ang_spd=1;//方向転換速度
	this.speed=1;//移動速度
	this.theta;
	this.c_angs=[0,0,0,0];//矩形の4隅に対応した中心角
	this.vertexs=[ [ 0, 0 ],[ 0, 0 ],[ 0, 0 ],[ 0, 0 ] ];//矩形の4隅にある頂点情報　vertexs["頂点番号"]["座標XY"]
	this.frontX=0;//前方座標X
	this.frontY=0;//前方座標Y




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
			act.width=30;
			act.height=40;

		case 2:
			act.width=10;
			act.height=30;

		}

		return act;

	}
};




















