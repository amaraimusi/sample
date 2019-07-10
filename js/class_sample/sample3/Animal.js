
/**
 * 動物クラス
 */
var Animal =function(p_params){
	
	this.res_slt = p_params.res_slt;//出力要素
	
	/**
	 * タイトルを表示する
	 */
	this.showTitle = function(){
		var str = '動物のタイトル<br>';
		$(this.res_slt).append(str);
	};

	/**
	 * 走る
	 * @param string place 場所
	 */
	this.run=function(place){
		var str = place + 'を動物が走る<br>';
		$(this.res_slt).append(str);
		return str;
	};
};






