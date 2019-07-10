/**
 * 外部SVGファイルをjQueryで扱う
 * @date 2016-9-14
 * 
 */
function test1(){
	$("#sample3").load("sample3.svg", function(){
		 

	});
}

function test2(){
	var rect = $('#rect1');
	
	if(rect[0] == undefined){
		alert('外部SVGを読み込んでないので、SVG要素を取得できませんでした。');
		return;
	}

	// 位置を取得  (1乗算は暗黙の数値変換)
	var x = rect.attr('x') * 1;
	var y = rect.attr('y') * 1;
	console.log(x);//■■■□□□■■■□□□■■■□□□)
	console.log(y);//■■■□□□■■■□□□■■■□□□)

	// 位置を変えてみる。
	rect.attr('y',y+10);
	
	// アニメーションさせて動かかしてみる。
	rect.animate({"x": "+=10"}, "slow");

}
