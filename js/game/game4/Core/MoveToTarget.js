/**
 * 目標へ役者を向かわせるクラス。
 * 
 * @version 1.1
 * @date 2017-9-23
 * 
 */
class MoveToTarget{

	/**
	 * 目標へ役者を向かわせる
	 * @param act	役者
	 * @param mtt_x	目標座標X
	 * @param mtt_y	目標座標Y
	 *
	 */
	move(act,mtt_x,mtt_y){

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
	}

	//目標角度を算出
	calcTargetAng(x1,y1,x2,y2){
		//atan((y2-y1) / (x2-x1))
		var a=Math.atan((y2-y1) / (x2-x1));
		return a;
	}

}