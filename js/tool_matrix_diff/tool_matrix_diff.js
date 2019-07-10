/**
 * 行列データの比較ツールを生成
 * 2016-2-9	新規作成
 */



function execution1(){

	//2つのテキストエリアから、それぞれ行列データ1,行列データ2を取得する
	var data1 = getData('#pasting_csv1');
	var data2 = getData('#pasting_csv2');

	var x = data1[10];

	//行列データ1と行列データ2から最大行数を取得する。
	var cntY = getMaxYCnt(data1,data2);

	//行列データ1と行列データ2から最大列数を取得する。
	var cntX = getMaxXCnt(data1,data2);

	//ループしながらそれぞれの値を比較し、結果を比較データにセットする。
	var mismatchCnt = 0;//不一致数
	var diffs = [];
	for(var y=0 ; y < cntY ; y++){
		var row = [];
		for(var x=0 ; x < cntX ; x++){
			
			//値1と値2を取得
			var v1 = getValue(data1,y,x);
			var v2 = getValue(data2,y,x);
			
			//値1と値2が空（undefined)である場合、なしフラグをONにする。
			var none = 0;
			if(v1 === undefined && v2 === undefined){
				none = 1;
			}
			
			//値1と値2が一致する場合、比較フラグをONにする。
			var diff = 0;
			if(v1 == v2){
				diff = 1;
			}else{
				mismatchCnt++;//不一致数をカウント
			}
			
			var prop ={
				'diff':diff,
				'value1':v1,
				'value2':v2,
				'none':none,
			}
			
			row.push(prop);
		}
		diffs.push(row);
	}

	//比較データを出力する
	printDiffs(diffs,cntX,cntY);
	
	
	//不一致件数の出力
	printMismatchCnt(mismatchCnt);

}



/**
 * テキストエリアから行列データを取得する
 * 
 * @param slt テキストエリアのセレクタ
 */
function getData(slt){
	var text = $(slt).val();

	var ary = text.split(/\r\n|\r|\n/);

	var heads=[];//ヘッドデリスト
	var data=[];//データ
	
	
	for (var i=0;i<ary.length;i++){
		var row=ary[i];
		var dd=row.split(/\t/);
		
		data.push(dd);

		
	}
	
	return data;
}


/**
 * 行列データ1と行列データ2から最大行数を取得する。
 * @param data1 行列データ1
 * @param data2 行列データ2
 * @return 最大行数
 */
function getMaxYCnt(data1,data2){
	
	var len1=Object.keys(data1).length;
	var len2=Object.keys(data2).length;
	
	if(len1 > len2){
		return len1;
	}else{
		return len2;
	}
	
}


/**
 * 行列データ1と行列データ2から最大列数を取得する
 * @param data1 行列データ1
 * @param data2 行列データ2
 * @return 最大列数
 */
function getMaxXCnt(data1,data2){
	
	var maxLen=0;
	
	//行列データ1から最大列数を取得
	for(var i in data1){
		var len=Object.keys(data1[i]).length;
		if(len > maxLen){
			maxLen = len;
		}
	}
	
	
	//行列データ2から最大列数を取得
	for(var i in data2){
		var len=Object.keys(data2[i]).length;
		if(len > maxLen){
			maxLen = len;
		}
	}
	
	return maxLen;
	
}

/**
 * 行列データから２つの次元要素Y,Xに紐づく値を取得する
 * @param data 行列データ
 * @param y
 * @param x
 * @returns 値
 */
function getValue(data,y,x){
	
	var v = undefined;
	var ent = data[y];
	if(ent != undefined){
		v = ent[x];
	}
	
	return v;
}


/**
 * 比較データをテーブルとして出力する
 * @param diffs 比較データ
 * @param cntX 列数
 * @param cntY 行数
 */
function printDiffs(diffs,cntX,cntY){
	var tbody='';
	for(var y=0 ; y<cntY ; y++){
		var tr = '<tr>';
		for(var x=0 ; x<cntX ; x++){
			var prop = diffs[y][x];
			var str = '';
			
			//サニタイズしながら値1と値2を取得する
			var v1 = sanitize_str(prop.value1);
			var v2 = sanitize_str(prop.value2);
			
			//なしフラグがOFFである場合、以下の処理を行う。
			if(prop.none == 0){
				//一致フラグがONである場合、以下の処理を行う。
				if(prop.diff == 1){
					str = "<span style='color:#21c0a5'>" + v1 + "</span>";
				}
				
				//一致フラグがOFFである場合、以下の処理を行う。
				else{
					var str2 = v1 + '←→' + v2;
					str = "<span style='color:red'>× " + str2 + "</span>";
				}
			}
			
			var td = '<td>' + str + '</td>';
	
			tr += td;
			
		}
		tr += '</tr>';
		tbody += tr;
	}
	
	var tbl = "<table class='table table-bordered'><tbody>" + tbody + "</tbody></table>";
	$('#res').html(tbl);
	
}


/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {

	if(str == null){
		return str;
	}

	//記号「;&<>",」をサニタイズ
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/\t/g, '&#x0009;');
    str = str.replace(/\r\n|\r|\n/g, '<br>');
    //str = str.replace(/&/g, '&amp;');



    return str;
}



//不一致件数の出力
function printMismatchCnt(mismatchCnt){
	var str='';
	if(mismatchCnt == 0){
		str = "<span style='color:#21c0a5'>すべて一致してます。</span>";
	}else{
		str = "<span style='color:red'>不一致件数：" + mismatchCnt + "</span>";
	}
	$('#mismatchCnt').html(str);
}
