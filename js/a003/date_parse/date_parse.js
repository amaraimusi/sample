/**
 * 文字列を日時にパース
 * @date 2016-10-18
 */


function test1(){

	var str_dtm = $('#test1_text').val();
	if(str_dtm.indexOf('-') > -1){
		str_dtm = str_dtm.replace('-','/');// IEは「-」の区分に対応していないので「/」に置換
	}
	
	var d = new Date(str_dtm);
	console.log(typeof d);
	
	$('#test1_res').append(d.toLocaleString() + '<br>');
	console.log(d.toLocaleString());
	

	
}



