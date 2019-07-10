/**
 * サンプル：jQuery；要素の種類を問わずに値をセットする | _setValueEx
 * @date 2017-3-6
 */

$(function(){
	
	
	// テキストボックス
	var tbElm = $('#text1');
	_setValueEx(tbElm,'いろは')
	
	
	// チェックボックス
	var checkbox1 = $('#checkbox1');
	_setValueEx(checkbox1,1); // 1以上の数値や、trueを指定可能
	var checkbox2 = $('#checkbox2');
	_setValueEx(checkbox2,0);// falseやnullでも指定可能
	
	// ラジオボタン
	var radio1 = $("[name='radio1']");
	_setValueEx(radio1,2);
	
	// テキストアリア
	var textarea1 = $('#textarea1');
	var msg = "ネコ\n<input />\nヤギ\nカニ<br>サメ\rシカ\r\nゴリラ";
	_setValueEx(textarea1,msg);
	
	// セレクトボックス
	var select1 = $('#select1');
	_setValueEx(select1,2);// nullや空文字をセットすると未選択になる。 
	
	// IMG
	var img1 = $('#img1');
	_setValueEx(img1,'imori.png');
	
	// AUDIO
	var audio1 = $('#audio1');
	_setValueEx(audio1,'audio1.mp3');
	
	// ブロック
	var div1 = $('#div1');
	var msg = "ネコ\n<input />\nヤギ\nカニ<br>サメ\rシカ\r\nゴリラ";
	_setValueEx(div1,msg);
	
	
	
});

/**
 * 要素の種類を問わずに値をセットする
 * @param elm 要素(jQueryオブジェクト）
 * @pramm v 値
 * @version 1.0
 */
function _setValueEx(elm,v){
	
	var tagName = elm.get(0).tagName; // 入力要素のタグ名を取得する
	
	// 値を入力フォームにセットする。
	if(tagName == 'INPUT' || tagName == 'SELECT'){
		
		// type属性を取得
		var typ = elm.attr('type');
		
		if(typ=='checkbox'){
			if(v ==0 || v==null || v==''){
				elm.prop("checked",false);
			}else{
				elm.prop("checked",true);
			}
			
		}
		
		else if(typ=='radio'){
			var f = elm.attr('name');
			var parElm = elm.parent();
			var opElm = parElm.find("[name='" + f + "'][value='" + v + "']");
			if(opElm[0]){
				opElm.prop("checked",true);
			}

		}
		
		else{
			
			if(typeof v == 'string'){
				v = v.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
			}
			
			elm.val(v);
		}

		
	}
	
	// テキストエリア用のセット
	else if(tagName == 'TEXTAREA'){

		if(v!="" && v!=undefined){
			v=v.replace(/<br>/g,"\r");
			
			if(typeof v == 'string'){
				v = v.replace(/&lt;/g, '<').replace(/&gt;/g, '>');
			}
		}

		elm.val(v);
		
	}
	
	// IMGタグへのセット
	else if(tagName == 'IMG'){
		// IMG要素用の入力フォームセッター
		elm.attr('src',v);
		
	}
	
	// audioタグへのセット
	else if(tagName == 'AUDIO'){
		elm.attr('src',v);
		
		
	}else{
		if(v!="" && v!=undefined){
			v=v.replace(/<br>/g,"\r");
			if(typeof v == 'string'){
				v = v.replace(/</g, '&lt;').replace(/>/g, '&gt;');
			}
			v = v.replace(/\r\n|\n\r|\r|\n/g,'<br>');// 改行コートをBRタグに変換する
		}
		
		elm.html(v);
	}

	
}