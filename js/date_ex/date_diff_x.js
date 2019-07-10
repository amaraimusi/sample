/**
 * 日数差を適切な単位（年月日時分秒のいずれか）で返す
 * 
 * 日数差を求める時、小数や大きな値で日数が出力される。
 * 分かりやすいように、適切な単位（年月日時分秒のいずれか）を付加して出力する。
 * @date 2016-4-20 新規作成
 */

$(function(){
	
	var str_date1 = '2016/4/18 00:00:00';
	var str_date2 = '2016/4/15 00:00:00';
	
	var data = [
		{'d1':'2016/4/18','d2':'2014/5/18'},
		{'d1':'2016/4/18','d2':'2016/2/20'},
		{'d1':'2016/4/18 00:00:00','d2':'2016/4/15 10:30:00'},
		
		{'d1':'2016/4/18 16:00:00','d2':'2016/4/18 10:40:00'},
		{'d1':'2016/4/18 16:00:00','d2':'2016/4/18 15:25:00'},
		{'d1':'2016/4/18 16:00:00','d2':'2016/4/18 15:59:20'},
	];
	
	for(var i=0 ; i < data.length ; i++){
		var ent = data[i];
		var d1 = ent.d1;
		var d2 = ent.d2;
		var date_str = diffDateX(d1,d2);
		
		var str = '<tr><td>' + d1 + '</td><td>' + d2 + '</td><td>' + date_str + '</td></tr>'
		$('#res tbody').append(str);
	}

	
	
});

/**
 * 日数差を適切な単位（年月日時分秒のいずれか）で返す
 * 
 * 文字列型日付、日付オブジェクトの両方に対応
 * 
 * @param date1 比較日付1
 * @param date2 比較日付2
 * @returns number 日数
 */
function diffDateX(date1,date2){
	var d1 = date1;
	var d2 = date2;
	
	// 引数が文字列型の日付なら日付オブジェクトに変換
	if(typeof String(d1) === "string"){
		var d1 = new Date(d1);
	}
	if(typeof String(d2) === "string"){
		var d2 = new Date(d2);
	}
	
	var u1 = Math.floor(d1);// UNIXタイムスタンプに変換
	var u2 = Math.floor(d2);
	
	// 日数差を適切な単位（年月日時分秒のいずれか）で返すを算出
	var diff_u = u1 - u2;
	
	
	//	31556952000 

	//	2629746000 
	//	86400000 
	//	3600000 
	//	60000 
	//	1000 


	
	var date_str = '';
	var v = 0;
	if(diff_u >= 31556952000){
		v = Math.round(diff_u / 31556952000);
		date_str = '約' + v + '年間';
	}else if(diff_u >= 2629746000){
		v = Math.round(diff_u / 2629746000);
		date_str = '約' + v + 'ヶ月間';
	}else if(diff_u >= 86400000){
		v = Math.round(diff_u / 86400000);
		date_str = '約' + v + '日間';
	}else if(diff_u >= 3600000){
		v = Math.round(diff_u / 3600000);
		date_str = '約' + v + '時間';
	}else if(diff_u >= 60000){
		v = Math.round(diff_u / 60000);
		date_str = '約' + v + '分間';
	}else if(diff_u >= 1000){
		v = Math.round(diff_u / 1000);
		date_str = '約' + v + '秒';
	}else{
		date_str = '約' + v + 'ミリ秒';
	}

	return date_str;

}