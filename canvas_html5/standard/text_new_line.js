/**
 * 改行を含むテキストを描画する
 * 
 * @date 2016-12-6
 */



$(function(){
	// デモ1:改行を含むテキストを描画する
	
	
	// キャンバスの要素オブジェクトとコンテキストを取得する。
	var cvs = $('#canvas1');
	var ctx = cvs[0].getContext('2d');

	// 描画開始
	ctx.beginPath();
	
	// フォントの設定（例：イタリック 太字 22px MSPゴシック)
	ctx.font = "italic bold 22px 'ＭＳ Ｐゴシック'";

	// 文字の色を指定
	ctx.fillStyle = '#dd4d40';
	
	var text1 = "こんにちは。\n今日の天気はいかがでしょう。\n晴れです。";
	
	// 改行を含むテキストを出力する
	fillTextWithNewLine(ctx,text1,100,80,200);
	
	ctx.stroke(); 
	
});

/**
 * 改行を含むテキストを出力する
 * 
 * @param ctx Canvasコンテキスト
 * @param text 改行を含むテキスト
 * @param x 位置X
 * @param y 位置Y
 * @param width 有効幅 有効幅を超えると改行する
 * @param [fontSize] フォントサイズ
 * @param [lineSpace] 行間隔(px)
 * 
 */
function fillTextWithNewLine(ctx,text,x,y,width,fontSize,lineSpace){
	
	// フォントサイズが空なら文字「あ」の横幅をセットする。
	if(!fontSize){
		var metrics = ctx.measureText('あ');
		fontSize = metrics.width;
	}
	
	// 行間隔が空ならフォントサイズの50%の幅をセットする。
	if(!lineSpace){
		lineSpace = fontSize * 0.5;
	}
	
	// 行縦幅を算出
	var line_height = fontSize + lineSpace;
	
	// テキストを改行で分割する
	var lines = splitByNewLine(ctx,text,width)
	
	// 分割したテキストを描画する
	for(var i in lines){
		var line = lines[i];
		y2 = y + (line_height * i);
		ctx.fillText(line,x,y2);
	}
}

/**
 * 有効幅および改行でテキストを分割する。
 * @param ctx Canvasコンテキスト
 * @param text テキスト
 * @param 有効幅
 * @return 分割により作成されたテキストの配列
 */
function splitByNewLine(ctx,text,width){
	if(!text){
		return [];
	}
	
	var lines = [];
	var line = '';
	var last_index = text.length-1;
	
	for (var i = 0; i < text.length; i++) {
		var char = text.charAt(i);

		if(char == "\n"){
			lines.push(line);
			line = '';
		}else if(ctx.measureText(line + char).width > width){
			if(i < last_index){
				lines.push(line);
				line = char;
			}else{
				lines.push(line + char);
			}
		}else if(i == last_index){
			lines.push(line + char);
		}else{
			line += char;
		}
	}
	
	return lines;
	
}
