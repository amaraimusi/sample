


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

// 基礎的なオブジェクト
var canvas;
var ctx;

// フレーム速度関連のパラメータ
var fps = 30;
var now;
var then = Date.now();
var interval = 1000/fps;
var delta;

var game = {}; // ゲームデータ: マウスクリック位置や画面サイズなど各クラスで共通して利用するデータを格納している。

var m_clickX=0;//マウスのクリック位置X
var m_clickY=0;//マウスのクリック位置Y

var m_box;//メインコンテナ
var m_d;//デバッグクラス


//座標系の定数
////open GLの場合、原点を左下とした右手座標系。逆時計周り
//var ZAHYO_MAWARI=1;//角度方向 0:時計周り    1:逆時計周り
//var ZAHYO_T_ANG=Math.PI;//角度差(システムの0°との角度差）
//var ZAHYO_O_X=200;//原点座標X
//var ZAHYO_O_Y=200;//原点座標Y


// 角度系の定数
var RAD_A=2*Math.PI/360;//ラジアン係数。ラジアンから360°表記への変換に利用。
var RAD360=Math.PI*2;//360°
var RAD180=Math.PI;
var RAD90=Math.PI/2;

// その他定数
var BASE_COLOR_='#1b3b75';


var X_=0;
var Y_=1;

// コントローラーリスト
var controlls = {};

var activeControll; // アクティブコントローラ

var charas = {}; // キャラクターリスト


//初期イベント（DOM読込後のイベント）
$(function(){

	init();
	canvas.addEventListener('click', onClick, false);//クリックイベントを登録
	run();

});

function init(){
	  /* canvas要素のノードオブジェクト */
	  canvas = document.getElementById('canvas1');
	  /* canvas要素の存在チェックとCanvas未対応ブラウザの対処 */
	  if ( ! canvas || ! canvas.getContext ) {
	    return false;
	  }
	  /* 2Dコンテキスト */
	  ctx = canvas.getContext('2d');


	  ctx.strokeStyle = BASE_COLOR_;//線の色を基本色にする。


	  var width = canvas.width;
	  var height = canvas.height;
	  game['main_width'] = canvas.width;
	  game['main_height'] = canvas.height;
	  game['click_x'] = 0;
	  game['click_y'] = 0;
	  
	  
	  m_d=new ADebug(ctx);//デバッグクラス

	  
	  controlls['test1'] = new Test1Controller();
	  
	  charas['neko'] = new Neko();
	  
	  // アクティブコントローラーを切り替える
	  changeControll('test1');
	  
	  activeControll = controlls['test1'];//■■■□□□■■■□□□■■■□□□
	  
//■■■□□□■■■□□□■■■□□□
//	  //メインコンテナを作成
//	  var bf=new BoxFactory();
//	  m_box=bf.init();



}

//クリックイベント
function onClick(e){
	
	// ■■■□□□■■■□□□■■■□□□
	m_clickX = e.clientX - canvas.offsetLeft;
	m_clickY = e.clientY - canvas.offsetTop;
	console.log('click='+m_clickX+','+m_clickY);//■■■□□□■■■□□□■■■□□□)
	
	game.click_x = e.clientX - canvas.offsetLeft;
	game.click_y = e.clientY - canvas.offsetTop;
	
	
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
	
//	var af=m_box['ActorFunc'];
//	var act=m_box['act'];
//	var mtt=m_box['MoveToTarget'];

	if(ctx==null){return null;}

	activeControll.thread();
	
	
//	act.ang=Math.PI / 4;
//
//	act=af.calcVertexs(act);
//	af.calcFront(act);
//
//	m_d.debugRad(act.ang,'ang');//■■■□□□■■■□□□■■■□□□
//
//
//  /* 四角を描く */
//  ctx.beginPath();//描画宣言
	ctx.clearRect(0,0,game.main_width,game.main_height);//一度canvasをクリア
//
//  //クリックポイントを描画
//  ctx.moveTo(m_clickX, m_clickY);// 始点
//  ctx.arc(m_clickX, m_clickY, 3, 0, RAD360, true);
//  ctx.closePath();//線を閉じる
//
//  af.drawCenter(ctx,act);
//  af.drawFrame(ctx,act);

  m_d.draw();


  ctx.stroke();//描画する
}



/**
 * アクティブコントローラーを切り替える
 * @param ctrl_key コントロールキー
 */
function changeControll(ctrl_key){
	activeControll = controlls[ctrl_key];
	activeControll.activate();
}

/**
 * デバッグ出力
 *
 * @param v		デバッグ文字列
 * @param key	キー
 *
 */
function debug(v,key){
	m_d.debug(v,key);
}














