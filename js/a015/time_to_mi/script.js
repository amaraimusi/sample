
function test1(){
	
	let his_text = $('#his_text').val();
	let date1 = convHisToDate(his_text);
	$('#res1').html(date1.toLocaleString());
	
	let hi = convHisToHi(his_text);
	$('#res2').html(hi);
	
}

/**
 * H:i:s形式の時分秒から時分文字列を取得する
 *@param his H:i:s形式の文字列。 H:i形式でも良い。
 *@return string 時分文字列
 */
function convHisToHi(his){
	if(his==null) return '';
	his = his.trim();
	let ary = his.split(':');
	let h = 0;
	let i = 0;
	let len = ary.length;
	if(len == 3 || len == 2){
		h = ary[0];
		i = ary[1];
	}else{
		throw new Error('Not in "H: i: s" format!');
	}
	
	let hi = h + ':' + i;
	return hi;
	
}


/**
 * H:i:s形式の時分秒からDateオブジェクトを取得する
 *@param his H:i:s形式の文字列。 H:i形式でも良い。
 *@return Dateオブジェクト
 */
function convHisToDate(his){
	if(his==null) return '';
	his = his.trim();
	let ary = his.split(':');
	
	let len = ary.length;
	let h = 0;
	let i = 0;
	let s = 0;
	if(len == 3){
		h = ary[0];
		i = ary[1];
		s = ary[2];
	}else if(len == 2){
		h = ary[0];
		i = ary[1];
		s =0;
	}else{
		throw new Error('Not in "H: i: s" format!');
	}

	let d1 = new Date();
	d1.setHours(h);
	d1.setMinutes(i);
	d1.setSeconds(s);
	
	if(d1 =='Invalid Date' ) throw new Error('Not in "H: i: s" format!');

	return d1;
	
}


