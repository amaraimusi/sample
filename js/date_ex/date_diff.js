/**
 * 2つの日付の日数差
 * @date 2016-4-15 新規作成
 */

function test1(){
	var str_date1 = $('#t1').val();
	var str_date2 = $('#t2').val();
	
	var date_count =diffDate(str_date1,str_date2);
	$('#res').append(date_count + '<br>');
}
	



/**
 * 2つの日付の日数差を算出
 * 
 * 文字列型日付、日付オブジェクトの両方に対応
 * 
 * @param d1 比較日付1
 * @param d2 比較日付2
 * @returns number 日数
 */
function diffDate(d1,d2){
	
	// 引数が文字列型の日付なら日付オブジェクトに変換
	if(typeof d1 == "string"){
		
		if(d1.indexOf('-') > -1){
			d1 = d1.replace('-','/');// IEは「-」の区分に対応していないので「/」に置換
		}
		var d1 = new Date(d1);
	}
	if(typeof d2 == "string"){
		if(d2.indexOf('-') > -1){
			d2 = d2.replace('-','/');
		}
		var d2 = new Date(d2);
	}
	
	var u1 = Math.floor(d1);// UNIXタイムスタンプに変換
	var u2 = Math.floor(d2);
	
	// 2つの日付の日数差を算出
	var diff_u = u1 - u2;
	var date_count = diff_u / 86400000 ;
	
	return date_count;

}