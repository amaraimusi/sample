/**
 * 文章をJSコードに変換する
 * ★履歴
 * 2015-10-15	新規作成
 * 
 */


function ttjConvert(){
	
	var t=$('#text_a').val();
	
	//ダブルクォークをバックスラッシュ付に置換する。
	var t=t.replace(/\"/g,'\\"');
	
	//	改行コード置換 \n→" + \n"
	var t=t.replace(/\n/g,'\" +\n\"');
	
	//	文字列の両端をダブルクォートではさむ。
	var t='\"' + t + '\";';
	
	$('#text_b').val(t);
}


function ttjConvertRev(){
	
	var t=$('#text_b').val();
	

	
	//右端を戻す
	var t=t.replace(/\s\+\n/g,'\n');
	var t=t.replace(/\+\n/g,'\n');
	
	var t=t.replace(/\\"/g,'%xhg%');
	var t=t.replace(/\"/g,'');
	var t=t.replace(/%xhg%/g,'\"');
	
	$('#text_a').val(t);

}

