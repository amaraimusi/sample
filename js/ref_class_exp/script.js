/**
 * クラスオブジェクトの参照渡し実験
 */

$(document).ready(function(){

	//読込イベント処理を書く
	var act=new Actor();
	act.x=5;

	console.log("前act："+act.x);

	act2=func1(act);


	console.log("後act："+act.x);
	console.log("後act2："+act2.x);


});




//サンプルクラス
var Actor =function(){

	this.x;
	this.y;
	this.width;
	this.height;
	this.ang;


};

function func1(act){
	act.x=6;
	return act;
}