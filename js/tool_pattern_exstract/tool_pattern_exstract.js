/**
 * ひな形と行列データからコード群を生成
 * 
 * @version 1.1
 * @date 2016-1-8	改行にすきまを開けないようにする
 * @date 2015-11-24	新規作成
 */



function execution1(){


	
	//ひな形を取得する
	var hina = $('#hina').val();
	
	//ひな形をワイルドカード文字列「%%」で分割し、マーク1とマーク2を取得する
	var marks = hina.split('%%');
	var marks = $.grep(marks, function(e){return e !== "";});//空白除去
	if(marks.length < 1){
		alert('抜型の文字列中に「%%」を１つ入れてください');
		return;
	}
	var mark1 = marks[0];
	var mark2 = marks[1];

	//テキストを取得する
	var text = $('#pasting_csv').val();
	text = text.replace(/[\n\r]/g,"\\\\n");
	
	//抜出リスト
	var list = [];
	
	var flg = 0; // マークフラグ    0:「切取始」    1:「切取終」

	//ループ
	for(var i=0;i<100000;i++){

		//フラグが「切取始」である場合、以下の処理を行う。
		if(flg == 0){

			//テキストにマーク1が存在する場合、以下の処理を行う。
			if(text.indexOf(mark1) >= 0){

				//テキストのマーク1から右側文字列を切り取り、テキストに再セットする。
				text = stringRight(text,mark1);

				//フラグを「切取終」にする。
				flg = 1;
				
			}
			
			//テキストにマーク1が存在しない場合、ループを抜ける
			else{
				break;
			}
		}
		
		
		//フラグが「切取終」である場合、以下の処理を行う。
		else{
			//テキストにマーク2が存在する場合、以下の処理を行う。
			if(text.indexOf(mark2) >= 0){

				//テキストのマーク2から左側の文字を切り取り、抜出リストに追加する。
				var str = stringLeft(text,mark2);
				str = sanitize_str(str);//サニタイズ
				list.push(str);
				
				//テキストのマーク2から右側を切り取り、テキストに再セットする。
				text = stringRight(text,mark2);
				
				//フラグを「切取始」にする。
				flg = 0;
			}
			
			//テキストにマーク2が存在しない場合、ループを抜ける。
			else{
				break;
			}
		}
		
		//テキストが空文字になっている場合、ループを抜ける。
		if(text == ''){
			break;
		}
		

	}

	//抜出リストを出力する。
	var res=list.join('<br>');
	$('#res').html(res);

	
}



///文字列を左側から印文字を検索し、左側の文字を切り出す。
function stringLeft(s,mark){
	if (s==null || s==""){
		return s;
	}
	var a=s.indexOf(mark);
	var s2=s.substring(0,a);
	return s2;
}

///文字列を左側から印文字を検索し、右側の文字を切り出す。
function stringRight(s,mark){
	if (s==null || s==""){
		return s;
	}
	
	var a=s.indexOf(mark);
	var s2=s.substring(a+mark.length,s.length);
	return s2;

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
