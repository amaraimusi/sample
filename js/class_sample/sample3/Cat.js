
/**
 * 猫クラス
 */
var Cat =function(p_params){
	
	// ★動物クラス継承
	this.base = new Animal(p_params);
	for(key in this.base){
		this[key] = this.base[key];
	}
	
	this.res_slt = p_params.res_slt;//出力要素

	/**
	 * 走る
	 * @param string place 場所
	 */
	this.run=function(place){
		var str = place + 'を猫が走る<br>';
		$(this.res_slt).append(str);
		return str;
	};
	
	
};






