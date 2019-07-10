/**
 * デバッグクラス
 * 
 * @version 20
 * 2014-6-4	| 2017-9-16
 */
class ADebug{
	
    constructor(ctx){
    	this.ctx = ctx;
    	this.m_map=new Array();//デバッグデータ連想配列
    	this.iniX=10;//デバッグ初期位置X
    	this.iniY=10;//デバッグ初期位置Y
    	this.maxCnt=100;//最大デバッグデータ数。

    }
    
    
    
	/**
	 * デバッグ出力
	 *
	 * @param v		デバッグ文字列
	 * @param key	キー
	 *
	 */
	debug(v,key){

		//キーが省略されている場合、キーを自動生成する。
		if(key==null){
			key=this.m_map.length;
		}

		//デバッグデータ数が最大を超えたら、一旦リセットする。
		if(this.m_map.length>this.maxCnt){
			this.m_map=void 0;
			this.m_map=new Array();
		};
		this.m_map[key]=v;

	}


	/**
	 * デバッグデータを描画する。
	 */
	draw(){
		var i=0;
		for (var k in this.m_map){
			var v=k+' = '+this.m_map[k];
			this.ctx.fillText(v, this.iniX, this.iniY+(i*8));
			i++;
		}
	}


	/**
	 * 桁固定数値デバッグ
	 *
	 * @param v		デバッグ文字列
	 * @param key	キー
	 * @param keta	固定桁数
	 *
	 */
	debugNumK(v,key,keta){

		//キーが省略されている場合、キーを自動生成する。
		if(key==null){
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

	}

	/**
	 * ラジアンを360°形式に変換してデバッグ
	 * @param rad ラジアン
	 *
	 */
	debugRad(rad,key){

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
	ketaKotei(num, n){
		var ret=""+num;
		while(ret.length < n){
			ret = "0" + ret;
		}
		return (ret);
	}
    
}