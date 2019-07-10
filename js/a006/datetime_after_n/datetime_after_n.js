/**
 * 
 */


function test1(){
	
	// 現在日時が「2017-10-23 11:55:00」の30秒後であるかチェックする
	var flg = checkAfterSeconds('2017-10-23 11:55:00',30);
	$('#res1').append(flg + '<br>');

}


/**
 * 現在日時が指定日時のn秒後であるかチェックする
 * 
 * @note
 * 文字列型日付、日付オブジェクトの両方に対応
 * 
 * @param d1 指定日時
 * @param n n秒後
 * @returns 結果 0:n秒前  ,  1:n秒後
 * 
 */
function checkAfterSeconds(d1,n){
	
	// 引数が文字列型の日付なら日付オブジェクトに変換
	if(typeof d1 == "string"){
		
		if(d1.indexOf('-') > -1){
			d1 = d1.replace('-','/');// IEは「-」の区分に対応していないので「/」に置換
		}
		d1 = new Date(d1);
	}
	var d_u = Math.floor(d1);
	
	var now_u =  Math.floor(new Date());

	if(now_u > d_u + n * 1000){
		return 1;
	}else{
		return 0;
	}

}