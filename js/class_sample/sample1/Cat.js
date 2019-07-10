
var Cat =function(p_params){
	
	// クラス継承
	this.base = new Animal(p_params);
	for(key in this.base){
		this[key] = this.base[key];
	}
	
	
	this.res_slt = p_params.res_slt;
	
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
	 * @param string place 場所
	 */
	this.run=function(place){
		
		var str = place + 'を猫が走る<br>';
		
		$(this.res_slt).append(str);
		
		return str;
	};
	
	
	
	

	


	this.constract();//コンストラクタ呼出し(クラス末尾にて定義すること）
	
};






