/**
 * 行列データからHTMLテーブルコードを生成を生成
 * 2015-12-29	新規作成
 */



function execution1(){

	var text = $('#pasting_csv').val();

	var ary = text.split(/\r\n|\r|\n/);

	var heads=[];//ヘッドデリスト
	var data=[];//データ
	
	
	for (var i=0;i<ary.length;i++){
		var row=ary[i];
		var dd=row.split(/\t/);
		
		//先頭はヘッドリストにセット、2番目以降はデータへ追加
		if(i==0){
			heads = dd;
		}else{
			data.push(dd);
		}
		
		
	}

	//HTMLテーブルのひな形
	var html_code = 
		"<table>\n" +
		"	<thead>\n" +
		"		%thead\n" +
		"	</thead>\n" +
		"	<tbody>\n" +
		"%tbody\n" +
		"	</tbody>\n" +
		"</table>\n";
	

	//ヘッダー部分を作成
	var headCode= "<tr><th>" + heads.join("</th><th>") + "</th></tr>";
	var html_code=html_code.replace('%thead',headCode);
	

	//データ部分を作成
	var tbody='';
	for(var i=0;i<data.length;i++){
		var ent=data[i];
		
		var tbody = tbody + '\t\t<tr><td>' + ent.join('</td><td>') + '</td></tr>\n';

	}
	
	var html_code=html_code.replace('%tbody',tbody);
	

	
	var res=sanitize_str(html_code);//サニタイズ
	
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
    //str = str.replace(/&/g, '&amp;');



    return str;
}
