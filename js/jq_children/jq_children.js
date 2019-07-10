/**
 * 子要素を取得する | jQuery
 * @date 2016-6-17
 */


$(function(){
	
	//要素オブジェクトから子要素を取得する
	var elm1 = $('#animal');
	var siam_cat = elm1.find('#siam-cat').html();
	$('#res').append(siam_cat);
	console.log(siam_cat);//■■■□□□■■■□□□■■■□□□)
	
	
	// childrenの検証
	var elm2 = $('#animal');
	var dog = elm1.children('.dog');// 直下の子要素のみ取得可能
	console.log(dog);
	$('#res2').append(dog);
	
});