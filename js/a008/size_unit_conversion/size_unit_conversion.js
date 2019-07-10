/**
 * 
 */

$(() => {
	
	
	var ary = [0.01,0,1,5,10,11,100,123,1000,1999,10000,
		55555,666666,7777777,88888888,999999999,1010101010,11111111111,
		12121212121212121212,-100];
	
	var trs_html = '';
	for (var i in ary){
		var val1 = ary[i];
		var val2 = convSizeUnit(val1);
		trs_html += "<tr><td>" + val1 + "</td><td>" + val2 + "</td></tr>";
		
	}
	
	$('#tbl1 tbody').html(trs_html);
	
	var keta = getDigit(12345);
	console.log(keta); // → 5
});

/**
 * 容量サイズの数値を適切な単位表示に変換する（Byte,KB,MB,GB,TB)
 * @param int value1 入力数値
 * @param int n 小数点以下の桁（四捨五入）
 * @returns string 単位表示
 */
function convSizeUnit(value1,n){
	
	if(n == null) n=1;

	var res = '';
	if(value1 < 1000){
		res = value1 + 'Byte';
	}else if(value1 < Math.pow(10,6)){
		value1 = Math.round( value1  * Math.pow(10,n - 3) ) / Math.pow(10,n); // 四捨五入
		res = value1 + 'KB';
	}else if(value1 < Math.pow(10,9)){
		value1 = Math.round( value1  * Math.pow(10,n - 6) ) / Math.pow(10,n);
		res = value1 + 'MB';
	}else if(value1 < Math.pow(10,12)){
		value1 = Math.round( value1  * Math.pow(10,n - 9) ) / Math.pow(10,n);
		res = value1 + 'GB';
	}else{
		value1 = Math.round( value1  * Math.pow(10,n - 12) ) / Math.pow(10,n);
		res = value1 + 'TB';
	}
	return res;
}

/**
 * 数値の桁数を取得する
 * @note
 * 0,小数値,負値は、桁数0になる。
 * 小数点以下の桁数は数えない。
 * 
 * @param num 入力数値
 * @param sinsu 進数（デフォルト:10進数）
 * @returns 桁数
 */
function getDigit(num, sinsu) {
	if (sinsu == null) sinsu = 10;
	return Math.log(num) / Math.log(sinsu) + 1 | 0;
};