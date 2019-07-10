
/**
 * 動物クラス
 * @param p_params 生成するときの渡される引数
 */
var Animal =function(p_params){
	
	// 出力要素
	this.res_slt = p_params.res_slt;
	
	// 動物名
	this.animal_name = p_params.animal_name;

	// 自分自身のインスタンス。  プライベートメソッドやコールバック関数で利用するときに使う。
	var myself=this;

	/**
	 * コンストラクタ
	 */
	this.constract=function(){
		var str = "コンストラクタが呼び出されました。<br>";
		$(this.res_slt).append(str);
		

	};
	
	/**
	 * 当クラスのインスタンスを取得する
	 */
	this.getInstance = function(){
		return this;
	};
	
	/**
	 * タイトルを表示する
	 */
	this.showTitle = function(){
		var str = '動物のタイトル<br>';
		$(this.res_slt).append(str);
		

	};

	
	/**
	 * 動物名を表示させる。
	 * 
	 * コールバック系の関数であるsetTimeoutを使い、2秒後に動物名を表示させる。
	 * @param string place 場所
	 */
	this.showAnimalName=function(place){
	    setTimeout(function(){
	    	var str = place + 'の' + myself.animal_name + 'について。【2秒後に表示】<br>';
	    	$(myself.res_slt).append(str);

			privateName();//プライベートメソッドを呼び出せる
	    	
	    },2000);
	};
	
	
	/**
	 * プライベートなメソッド
	 * メンバにアクセスするときはthisではなくmyselfを使ってアクセスすること。
	 */
	function privateName(){
		var str = 'プライベートな' + myself.animal_name;;
		$(myself.res_slt).append(str);
	};
	
	//コンストラクタ呼出し(クラス末尾にて定義すること）
	this.constract();
	
};





