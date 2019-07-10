/**
 * 役者クラス
 * 
 * @version 1.0
 * @date 2017-9-23
 */
class Actor{
	
	constructor(ctx){
		
		this.actList = []; // 役者リスト
	}
	
	/**
	 * IDで指定した役者を生成する。
	 * @param id 役者ID
	 * @return 役者
	 */
	get(id){
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
	

	/**
	 * 役者を生成する。
	 * @param id	役者ID
	 * @param x		初期位置X
	 * @param y		初期位置Y
	 * @param ang	初期角度
	 *
	 */
	create(id,x,y,ang){
		

		// 無効になっている役者を再利用するため取得する
		var act = _getDelAct();
		
		// 無効になっている役者を取得できなければ、新作成と登録を行う。
		if(act==null){
			act = {};
			var index = this.actList.length;
			act['index'] = index;
			this.actList.push(act);
		}
		
		
		
		act.x=0;
		act.y=0;
		act.width;
		act.height;
		act.h;
		act.ang=0;//向き角度
		act.ang_spd=1;//方向転換速度
		act.speed=1;//移動速度
		act.theta;
		act.c_angs=[0,0,0,0];//矩形の4隅に対応した中心角
		act.vertexs=[ [ 0, 0 ],[ 0, 0 ],[ 0, 0 ],[ 0, 0 ] ];//矩形の4隅にある頂点情報　vertexs["頂点番号"]["座標XY"]
		act.frontX=0;//前方座標X
		act.frontY=0;//前方座標Y

		
		
		//var act=this.m_actLib.get(id); //■■■□□□■■■□□□■■■□□□
		act.x=x;
		act.y=y;
		act.ang=ang;
		act.h=(act.width^2 + act.height^2)^0.5;
		
		// 矩形4隅の頂点情報を算出する
		act = calcVertexs(act);

		//中心角リストの算出
		var c_ang= Math.atan(x/y) * RAD360 / (2 * Math.PI);//中心角を算出
		act.c_angs[0]=c_ang;
		act.c_angs[1]=(RAD90-c_ang)*2 + act.c_angs[0];
		act.c_angs[2]=c_ang*2 + act.c_angs[1];
		act.c_angs[3]=(RAD90-c_ang)*2 + act.c_angs[2];


		return act;
	}
	
	/**
	 * 無効になっている役者を再利用するため取得する
	 * @return 役者
	 */
	_getDelAct(){
		
		var act2 = null; // 再利用役者
		
		// 無効ありなら、役者リストから無効役者を探す
		if(this.invalid == true){
			var flg=false; // 無効役者存在フラグ　true:無効者が存在している。　
			var actList = this.actList;
			for(var i in actList){
				var act = actList[i];
				
				if(act.delete_flg == 1){
					act2 = act;
					act2.delete_flg = 1;
					flg = true;
					break;
				}
			}
		}
		
		if(flg==false){
			this.invalid == false;
		}
		
		return act2;
	}

	/**
	 * 矩形4隅の頂点情報を算出する。
	 * @param Actor(頂点情報算出前）
	 * @return Actor(頂点情報算出後）
	 */
	calcVertexs(act){
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

	}

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
	calcXY_Vector(r_p,rad,h,x,y){

		r_p[X_]=Math.sin(rad)*h + x;
		r_p[Y_]=Math.cos(rad)*h + y;

	}


	/**
	 * 役者をフレームで描画する。
	 * @param ctx	2Dコンテキスト
	 * @param act	役者
	 *
	 */
	drawFrame(ctx,act){

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


	drawCenter(ctx,act){



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
	calcFront(act){


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