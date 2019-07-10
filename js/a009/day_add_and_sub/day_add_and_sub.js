
function test1(){
	
	var date1 = $('#text1').val();
	var day1 = $('#text2').val();

	date1 = new Date(date1);
	date1.setDate(date1.getDate() + day1);
	
	var date_str = convDateToYMD(date1); // 日付オブジェクトを「y-m-d」形式の日付書式に変換する
	
	$('#output1').html(date_str);
}

function test2(){
	
	var date1 = $('#text1').val();
	var day1 = $('#text2').val();
	
	date1 = new Date(date1);
	date1.setDate(date1.getDate() - day1);
	
	var date_str = convDateToYMD(date1); // 日付オブジェクトを「y-m-d」形式の日付書式に変換する
	
	$('#output1').html(date_str);
}

/**
 * 日付オブジェクトを「y-m-d」形式の日付書式に変換する
 * @param Date date1 日付オブジェクト
 * @returns string 「y-m-d」形式の日付文字列
 */
function convDateToYMD(date1){
	var year = date1.getFullYear();
	var month = date1.getMonth() + 1;
	var day = date1.getDate();
	var date_str = year + '-' + month + '-' + day;
	return date_str;
}