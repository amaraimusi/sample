
var class1;//自分自身のインスタンス
var Class1 =function(){

	this.m_test='hello world';

	this.init=function(instanse){
		class1=instanse;
	}

	this.execution=function(){
		
		//一秒後に関数をコールバックする。
		setTimeout(function(){
			var test=class1.m_test;
			alert(test);
		}, 1000);
	};
};

