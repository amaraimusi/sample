
var Cat =function(p_params){
	
	// クラス継承
	this.base = new Animal();
	for(key in this.base){
		this[key] = this.base[key];
	}
	
	
	
	var params = p_params;
	
	
	// 自分自身のインスタンス  コールバック関数で利用するため
	var mySelf=this;
	
	/**
	 * コンストラクタ
	 */
	this.constract=function(){
		
		console.log('cat constract');
		
	};
	
	/**
	 * 走る
	 * @param string str 文字
	 */
	this.run=function(str){
		
		str = '走る：' + str;
		return str;
	};
	
	
	
	

	


	this.constract();//コンストラクタ呼出し(クラス末尾にて定義すること）
	
};






