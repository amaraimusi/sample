
function test1(){
	var date1 = $('#text1').val();
	var date2 = $('#text2').val();
	
	var day_cnt = _subtractionDate(date1, date2);
	
	$('#output1').html(day_cnt);
	
}


/**
 * 日付の引き算（日付の差分を求める）
 * @note
 * 日時形式も受け付けるが、時刻部分は無視される。
 * @param mixed date1 対象日付1
 * @param mixed date2 対象日付2
 * @return int 差分日数
 */
function _subtractionDate(date1, date2) {

	if(date1 == null || date1 == '') return null;
	if(date2 == null || date2 == '') return null;
	
	// 文字列型日付なら日付オブジェクトに変換する
	if((typeof date1) == 'string') date1 = new Date(date1);
	if((typeof date2) == 'string') date2 = new Date(date2);

	// 差分をミリ秒で求める
	var diff_ms =  date1.getTime() - date2.getTime();
 
	// 日数差分をミリ秒差分から算出
	var diff_day = Math.floor(diff_ms / (1000 * 60 * 60 *24)) + 1;
 
	return diff_day;
}