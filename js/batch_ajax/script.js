/**
 * AJAXによるバッチ処理
 * ★履歴
 * 2014/9/5 新規作成
 *
 */

var m_index=0;

$(document).ready(function(){

});


function test(){
	var url='sample1.php';

	//サンプルデータ
	var ary=new Array();
	ary[0]="a";
	ary[1]="b";
	ary[2]=5;
	ary[3]="hello world";

	//★Arrayを非同期通信POSTで送る。
	$.post(
	url ,
	{"ary" : ary} ,
		function(msg){
			var ret=thread(msg);
			if(ret==true){
				test();
			}else{
				$("#res").append("バッチ終了<br>");
			}

		}
	).error(
		function() {//PHP側で何らかのバグ発生。存在しないURLを指定したりすると発生。

		alert('サーバーサイドのエラー');
	});
}


function thread(msg){

	m_index++;
	$("#res").append(m_index+"回目<br>");

	if(m_index > 4){
		return false;
	}else{
		return true;
	}

}