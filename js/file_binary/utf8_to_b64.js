/**
 * UTF-8文字列からbase64に変換する
 * @date 2016-5-31
 */


function test1(){

	
	var text1 = $('#text1').val();
	var b64 = utf8_to_b64(text1);// utf8からbase64に変換する
	var text2 = b64_to_utf8(b64);// base64からutf8に変換する
	
	$('#test3-1').html(b64);
	$('#test3-2').html(text2);
	
	
	// エスケープ系関数の検証出力
	test1_2();

	
	
}

// utf8からbase64に変換する
function utf8_to_b64(str) {
	return window.btoa( unescape(encodeURIComponent( str )) );
}

// base64からutf8に変換する
function b64_to_utf8(str) {
	return decodeURIComponent( escape(window.atob( str )) );
}


//エスケープ系関数の検証出力
function  test1_2(){
	
	var text1 = $('#text1').val();

	// エスケープ系関数の検証出力
	var res1 = unescape( text1 );
	var res2 = encodeURIComponent( text1 );
	var res3 = unescape(encodeURIComponent( text1 ));
	
	$('#test1-1').html(res1);
	$('#test1-2').html(res2);
	$('#test1-3').html(res3);
	
	
	
	
	// エスケープ後さらにbase64に変換
	
	var res_b1='';
	try{
		res_b1 = btoa(unescape( text1 ));//←エラーになる
	}catch(e){
		res_b1 ='エラー';
	}
	
	var res_b2 = btoa(encodeURIComponent( text1 ));
	var res_b3 = btoa(unescape(encodeURIComponent( text1 )));
	
	$('#test2-1').html(res_b1);
	$('#test2-2').html(res_b2);
	$('#test2-3').html(res_b3);
}


