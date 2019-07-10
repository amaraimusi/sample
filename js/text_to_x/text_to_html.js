/**
 * 文章をHTMLコードに変換する
 * 
 * @date 2015-12-7 新規作成
 * 
 */
function ttjConvert(){
	
	var t=$('#text_a').val();
	
	//「&」の変換
	var t=t.replace(/&/g,'&amp;');
	
	//「\」の変換
	var t=t.replace(/\\/g,'&yen;');
	
	//「<」の変換
	var t=t.replace(/</g,'&lt;');
	
	//「>」の変換
	var t=t.replace(/>/g,'&gt;');
	

	
	$('#text_b').val(t);
}

/**
 * HTMLコードから文章に戻す
 */
function ttjConvertRev(){
	
	var t=$('#text_b').val();

	
	//「>」の変換
	var t=t.replace(/&gt;/g,'>');
	
	//「<」の変換
	var t=t.replace(/&lt;/g,'<');
	
	//「\」の変換
	var t=t.replace(/&yen;/g,'\\');
	
	//「&」の変換
	var t=t.replace(/&amp;/g,'&');
	

	
	$('#text_a').val(t);

}

