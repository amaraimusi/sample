///////////////////////  基本部分 ///////////////////////////////////////

//基本ループの設定
var ctx;
var PI2_=Math.PI*2;

// 初期イベント（DOM読込後のイベント）
$(document).ready(function() {

	run();
});

// マルチスレッドを動かす。
// fps間隔でメインとなるループを行っている。
function run() {

	/* canvas要素のノードオブジェクト */
	var canvas = document.getElementById('canvassample');
	/* canvas要素の存在チェックとCanvas未対応ブラウザの対処 */
	if (!canvas || !canvas.getContext) {
		return false;
	}

	var lineA = {
		v1 : {
			x : 3,
			y : 4
		},
		v2 : {
			x : 100,
			y : 300
		}
	};
//	var lineB = {
//		v1 : {
//			x : 100,
//			y : 4
//		},
//		v2 : {
//			x : 20,
//			y : 200
//		}
//	};

	var lineB = {
			v1 : {
				x : 40,
				y : 70
			},
			v2 : {
				x : 300,
				y : 300
			}
		};

	// 直線情報（a,b)を算出する。
	lineA = calcLineData(lineA);
	lineB = calcLineData(lineB);
	console.dir(lineA);//■■■□□□■■■□□□■■■□□□
	console.dir(lineB);//■■■□□□■■■□□□■■■□□□

	//var frac=fracSub(lineA.ac,lineA.am,lineB.ac,lineB.am);
	//console.dir(frac);//■■■□□□■■■□□□■■■□□□


	//■■■□□□■■■□□□■次回
	//交差点計算:Yの算出方法
	var p=calcClossPt(lineA,lineB);
	//交差地点の算出
	//	◇交差計算
	//	y=a1.x+b1
	//	y=a2.x+b2
	//	a1.x+b1=a2.x+b2
	//	a1.x - a2.x = b2 - b1
	//	x(a1-a2)= b2 - b1
	//	x=(b2 - b1) / (a1 - a2)
	//	※xは分数データ
	//
	//	y=a2.x+b2
	//	y=a2.(b2 - b1) / (a1 - a2)+b2
	//	※yは分数データ
	//

	//x=(b2 - b1) / (a1 - a2)




	//交差地点を描画

	/* 2Dコンテキスト */
	ctx = canvas.getContext('2d');

	ctx.beginPath();// 描画宣言
	ctx.clearRect(0, 0, 480, 640);// 一度canvasをクリア

	ctx.strokeStyle = '#133572';// 線の色を基本色にする。
	drawLine(ctx, lineA);// 線分Aを描画
	drawLine(ctx, lineB);// 線分Bを描画

	drawArc(ctx,p.x,p.y,3);
	// ctx.moveTo(10, 10);//始点
	// ctx.lineTo(150, 50);//次の線の点
	// ctx.lineTo(5, 160);
	// ctx.closePath();//線を閉じる
	ctx.fillText("hello world! 日本", 15, 50);

	ctx.stroke();// 描画する

}


//■■■□□□■■■□□□■■■□□□
function calcClossPt(lineA,lineB){
	//x=(b2 - b1) / (a1 - a2)
	// a =ac / am
	// b =bc / bm


	//x=((bc2 / bm2)-(bc1 / bm1)) / ((ac1 / am1) - (ac2 / am2))
	//x=((bc2.bm1-bc1.bm2) / bm2.bm2) / ( (ac1.am2 - ac2.am1) / am1.am2 )
	//x=(bc2.bm1-bc1.bm2).am1.am2 / (ac1.am2 - ac2.am1).bm2.bm2
	//x=bc2.bm1.am1.am2 - bc1.bm2.am1.am2 / ac1.am2.bm2.bm2 - ac2.am1.bm2.bm2

	//x=(b1-b2) / (a2-a1)
	//xc=(b2 - b1);
	//xm=(a1 - a2);
	var xc=fracSub(lineB.b,lineA.b);
	var xm=fracSub(lineA.a,lineB.a);



	console.dir(xc);//■■■□□□■■■□□□■■■□□□)
	console.dir(xm);//■■■□□□■■■□□□■■■□□□)


	var c=xc.c * xm.m;
	var m=xc.m * xm.c;
	var x=c/m;



	//y= (b1.a2-a1.b2) / (a2-a1)

	var a2b1=fracMul(lineB.a,lineA.b);
	var a1b2=fracMul(lineA.a,lineB.b);
	var yc=fracSub(a2b1,a1b2);
	var ym=fracSub(lineB.a,lineA.a);
	//■■■□□□■■■□□□■■■□□□保留：分数の割り算を作成中

	var fr_y=fracDiv(yc,ym);

	console.log('fr_y.c='+ fr_y.c);//■■■□□□■■■□□□■■■□□□)
	console.log('fr_y.m='+ fr_y.m);//■■■□□□■■■□□□■■■□□□)


	var y=fr_y.c/fr_y.m;


//
	console.log('x='+x);//■■■□□□■■■□□□■■■□□□)
	console.log('y='+y);//■■■□□□■■■□□□■■■□□□)

	var p={x:x,y:y};

	return p;
}

function drawLine(ctx, line) {
	ctx.moveTo(line.v1.x, line.v1.y);// 始点
	ctx.lineTo(line.v2.x, line.v2.y);// 次の線の点
	ctx.closePath();// 線を閉じる


}

/**
 * 直線情報（a,b)を算出する。 傾きa,とbは無限小、無限大の数値になるので分数としてデータを持つ。 a=ac/am b=bc/bm
 *
 * @param line
 *            直線
 * @returns 直線
 */
function calcLineData(line) {
	// y =a.x + b
	//a=(y-b)/x
	//b=y-a.x

	// a =ac / am
	// b =bc / bm

	// c=y2-y1
	// m=x2-x1


	//a=(y1-y2) / (x1-x2)

	var ac = line.v2.y - line.v1.y;
	var am = line.v2.x - line.v1.x;

	var a={c:ac,m:am};

	//b=(y1.x2-x1.y2)/(x2 - x1)
	// bc=x1.y2-x2.y1
	// bm=x1-x2
	var bc = (line.v1.x * line.v2.y) - (line.v2.x * line.v1.y);
	var bm = line.v1.x - line.v2.x;

	var b={c:bc,m:bm};

	line.a = a;
	line.b = b;

	return line;

}

//◇aの算出
//y1=a.x1+b
//y2=a.x2+b
//
//b=y2-a.x2
//
//y1=a.x1+b
//y1=a.x1+(y2-a.x2)
//y1=a.x1+y2-a.x2
//y1-y2=a.x1-a.x2
//y1-y2=a(x1-x2)
//a=(y1-y2) / (x1-x2)


//◇bの算出
//y1=a.x1+b
//y2=a.x2+b
//
//a=(y2-b)/x2
//y1=((y2-b)/x2).x1+b
//y1=x1.(y2-b)/x2+b
//y1=(x1.y2-x1.b)/x2+b
//y1.x2=(x1.y2-x1.b)+b.x2
//y1.x2=x1.y2-x1.b+b.x2
//y1.x2-x1.y2=-x1.b+b.x2
//y1.x2-x1.y2=b.x2 - x1.b
//y1.x2-x1.y2=(x2 - x1).b
//b=(y1.x2-x1.y2)/(x2 - x1)


//◇交差点算出 X
//y=a1.x+b1
//y=a2.x+b2
//a2.x+b2=a1.x+b1
//a2.x-a1.x=b1-b2
//x(a2-a1)=b1-b2
//x=(b1-b2) / (a2-a1)

//◇交差点算出 Y
//y=a1.x+b1
//y=a2.x+b2
//a2.x=y-b2
//x=(y-b2) / a2
//y=a1.((y-b2) / a2)+b1
//y=(a1.y-a1.b2) / a2)+b1
//y.a2=a1.y-a1.b2 +b1.a2
//y.a2-a1.y= b1.a2-a1.b2
//y.(a2-a1)= b1.a2-a1.b2
//y= (b1.a2-a1.b2) / (a2-a1)


//y=((bc1/bm1).(ac2/am2)-(ac1/am1).(bc2/bm2)) / ((=ac2/am2)-(ac1/am1))
//y=((bc1.ac2/bm1.am2) - (ac1.bc2/am1.bm2)) / ((ac2/am2)-(ac1/am1))
//y=((bc1.ac2.am1.bm2-ac1.bc2.bm1.am2) / bm1.am2.am1.bm2) ) / ((ac2/am2)-(ac1/am1))
//y=((bc1.ac2.am1.bm2-ac1.bc2.bm1.am2) / bm1.am2.am1.bm2) ) / ((ac2.am1-ac1.am2) / am2.am1))
//y=((bc1.ac2.am1.bm2-ac1.bc2.bm1.am2) / bm1.am2.am1.bm2) ) / ((ac2.am1-ac1.am2) / am2.am1))
//y=((bc1.ac2.am1.bm2-ac1.bc2.bm1.am2).am2.am1) / ((bm1.am2.am1.bm2).(ac2.am1-ac1.am2))
//y=(bc1.ac2.am1.bm2-ac1.bc2.bm1.am2) / ((bm1.bm2).(ac2.am1-ac1.am2))

function drawArc(ctx,x,y,r){

	ctx.moveTo(x+r,y);// 始点。線がつながるのを防ぐ
	ctx.arc(x, y, r, 0, PI2_, true);

}

/**
 * 分数引き算
 * @param fr1　分数1
 * @param fr2　分数2
 */
function fracSub(fr1,fr2){

	var c0=(fr1.c * fr2.m) - (fr2.c * fr1.m);
	var m0=fr1.m * fr2.m;

	var frac = {
		c:c0,
		m:m0
	}

	return frac;

}

/**
 * 分数引き算
 * @param c1　分数１の分子
 * @param m1　分数１の分母
 * @param c2　分数２の分子
 * @param m2　分数２の分母
 */
function fracSub2(c1,m1,c2,m2){
	//	A=(c1.m2 - c2.m1) / m1.m2
	//	Aa=c1.m2 - c2.m1
	//	Am=m1.m2

	var c0=(c1 * m2) - (c2 * m1);
	var m0=m1 * m2;

	var frac = {
		c:c0,
		m:m0
	}

	return frac;

}

/**
 * 分数乗算
 * @param fr1　分数1
 * @param fr2　分数2
 * @return 乗(分数）
 */
function fracMul(fr1,fr2){

	var c=fr1.c * fr2.c;
	var m=fr1.m * fr2.m;

	var fr0={c:c,m:m};
	return fr0;
}

//：分数の割り算
function fracDiv(fr1,fr2){

	var c=fr1.c * fr2.m;
	var m=fr1.m * fr2.c;

	var fr0={c:c,m:m};
	return fr0;


}

// ////////////////

