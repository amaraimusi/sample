/**
 * テキストエリア内でタブを入力する
 * @date 2016-4-7 新規作成
 * @link http://scrap.php.xdomain.jp/textarea_insert_tab/
 */




$(function(){
	

	// フォーカス時のイベント
	 $("#ta1").focus(function(){
		
		// キーダウンイベント
		window.document.onkeydown = function(e){
			
			// Tabキーが押された場合
			if(e.keyCode == 9 && e.shiftKey == false) {   // 9 = Tab
				
				// タブを挿入する
				insertTab("#ta1");
				e.preventDefault(); // デフォルト動作停止
			}
			
			// Shift + Tabキーが押された場合
			if(e.keyCode == 9 && e.shiftKey == true) {
				
				// タブを除去する（アンシフト）
				unshiftTab("#ta1");
				e.preventDefault(); // デフォルト動作停止
				
				
			}
			

		}
		
	})

	// フォーカスが外れた時のイベント
	.blur(function(){
		
		// Tabキーの挙動を通常に戻す。
		window.document.onkeydown = function(e){
			return true;
		}
	});
});




/**
 * タブを挿入する
 * 
 * 複数行選択に対するタブ入力も可能
 * 
 * @param taSlt テキストエリアのセレクタ
 */
function insertTab(taSlt){
	
	var tabStr =  "\t";
	var ta = $(taSlt);
	var sPos = ta[0].selectionStart; // 文字入力最初位置取得
	var ePos = ta[0].selectionEnd; // 文字入力最後位置取得
	
	
	// 選択中の文字列を取得する
	var res = $('#ta1').selection();
	
	// 文字選択されていない場合
	if(res == null || res == ''){

		var line = ta.val(); //文字列を取得
		
		//文字列にタブを挿入し、テキストエリアに再セットする。
		var line2 = line.substr(0,sPos) + tabStr + line.substr(ePos);
		ta.val(line2);
		
		// 文字選択位置を戻す
		var cPos = sPos + tabStr.length;
		ta[0].setSelectionRange(cPos, cPos); 
		
	}
	
	// 文字選択中である場合
	else{

		

		var len_bef = res.length;
		
		// 改行を「改行＋Tab」に置換する。
		res = res.replace(/\r\n|\r|\n/g,'\n\t');
		res = '\t' + res;
		
		var len_aft = res.length;
		
		// 選択範囲を書き換える
		$('#ta1').selection('replace', {text: res});
		
		
		// 文字選択位置を戻す
		var cPos = ePos + len_aft - len_bef;
		ta[0].setSelectionRange(sPos, cPos); 
	}
}




/**
 * タブを除去する（アンシフト）
 * 
 * 複数行選択に対するアンシフトも可能
 * 
 * @param taSlt テキストエリアのセレクタ
 */
function unshiftTab(taSlt){
	var tabStr =  "\t";
	
	// 選択中の文字列を取得する
	var res = $('#ta1').selection();
	
	// 文字選択されていない場合
	if(res == null || res == ''){

		var ta = $(taSlt);
		var sPos = ta[0].selectionStart; // 文字入力最初位置取得
		var ePos = ta[0].selectionEnd; // 文字入力最後位置取得
		
		// 文字列の一番左側を選択中の場合、アンシフトは行わない。
		if (sPos == 0){
			return;
		}

		var line = ta.val(); //文字列を取得
		
		// 選択位置から一つ左側の文字がタブであるか?
		var chkStr = line.substr(sPos-1,1);
		if(chkStr == tabStr){
			// 文字列をアンシフトし、テキストエリアに再セットする
			line =  line.substr(0,sPos-1) + line.substr(ePos);
			ta.val(line);
			
			// 文字選択位置を戻す
			var cPos = sPos - 1;
			ta[0].setSelectionRange(cPos, cPos); 
		}

	}
	
	// 文字選択中である場合
	else{
		
		res = res.replace(/\r\n\t|\r\t|\n\t/g,'\n');
		
		if(res.substr(0,1).match(/\t/)){
			res = res.substr(1,res.length);
		}
		
		// 選択範囲を書き換える
		$('#ta1').selection('replace', {text: res});
		
	}
}

















