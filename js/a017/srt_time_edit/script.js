/**
 * ひな形と行列データからコード群を生成
 * 
 * @version 1.1
 * @date 2016-1-8	改行にすきまを開けないようにする
 * @date 2015-11-24	新規作成
 */

function test(){
	
	let text1 = `
	3
00:00:32,200 --> 00:00:36,500
サツマイモを収穫します。
We will harvest the sweet potatoes.

1
00:01:15,200 --> 00:01:19,500
私の自然農畑
My natural farm

2
00:01:19,700 --> 00:01:24,000
カメを飼育している場所です。
The place where I raise turtles.

3
00:01:24,200 --> 00:01:28,500
すっかり草だらけになりましたので草を整理します。
The grass has grown thick, so we will clear it.
	`;
	
	$('#pasting_csv').html(text1);
	
	
	let regex = /\b([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]\b/g;

	let jqRes = $('#res');
	let match;
	let times = [];
	while ((match = regex.exec(text1)) !== null) {
	   // times.push(match[0]);
jqRes.append(match[0]);
	}
		
}



function execution1(){

	var text = $('#pasting_csv').val();

	var ary = text.split(/\r\n|\r|\n/);
	
	
	var data=[];//埋め込みデータ
	for (var i=0;i<ary.length;i++){
		var row=ary[i];
		var dd=row.split(/\t/);
		data.push(dd);
		
	}
	

	var hina = $('#hina').val();
	var codes=[];
	for(var i=0;i<data.length;i++){
		var ent=data[i];
		var code=hina;
		for(var d=0;d<ent.length;d++){
			var str1=ent[d];
			var regexp = new RegExp('%' + d , 'g');
			code=code.replace(regexp,str1);
		}
		code=sanitize_str(code);//サニタイズ
		codes.push(code);
		
	}
	
	var res=codes.join('<br>');
	$('#res').html(res);

}


/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {


	//記号「;&<>",」をサニタイズ
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/\t/g, '&#x0009;');
    str = str.replace(/\r\n|\r|\n/g, '<br>');

    return str;
}
