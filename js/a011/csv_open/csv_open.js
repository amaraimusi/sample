
var m_str_code; // 文字コード
$(()=> {
	
	// ▼ 文字コードラジオボタンのクリックイベント
	$("input[name='str_code']").click((evt)=>{
		
		var btnElm = $(evt.currentTarget);
		m_str_code = btnElm.val();
		
		$('#file1').prop('disabled', false);
		
	});
	
	// ▼ CSVファイルのアップロードイベント
	$('#file1').change(function(e) {
		
		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		var fileObj = files[0];
		
		//ファイルリーダーにファイルオブジェクトを渡すと、ファイル読込完了イベントなどをセットする。
		var reader = new FileReader();
		
		//reader.readAsText(fileObj);
		reader.readAsText(fileObj, m_str_code);
		
		//ファイル読込完了イベント
		reader.onload = function(evt) {

			// CSVテキストを取得する
			var text = evt.target.result;
			
			// CSVテキストを2次元配列に変換する
			var data = csvTextToData(text);
			
			// XSSサニタイズ
			data = _xss_sanitize(data);
			
			// HTMLテーブルを組み立て表示
			var table_html = makeTableHtml(data);
			$("#res").html(table_html);
		}
	});
});

/**
 * CSVテキストを2次元配列に変換する
 * @note
 * ExcelのCSVに対応
 * ダブルクォート内の改行に対応
 * 「""」エスケープに対応
 * 
 * @param string csv_text CSVテキスト
 * @returns array 2次元配列
 */
function csvTextToData(csv_text){
	
	if(csv_text=='' || csv_text==null) return null;
	
	// CSVテキストの末尾が改行でないければ改行を付け足す。
	var last = csv_text[csv_text.length - 1];
	if(!last.match(/\r|\n/)){
		csv_text += "\n";
	}
	
	var data = [];
	var len = csv_text.length;
	var enclose = 0; // ダブルクォート囲み状態フラグ  0:囲まれていない , 1:囲まれている
	var cell = '';
	var row = [];
	
	for(var i=0; i<len; i++){
		
		var one = csv_text[i];
		
		// ダブルクォートで囲まれていない
		if(enclose == 0){
			if(one == '"'){
				enclose = 1; // 囲み状態にする
			}
			else if(one == ','){
				row.push(cell);
				cell = '';
			}
			else if(one.match(/\r|\n/)){
				row.push(cell);
				data.push(row);
				cell = '';
				row = [];
				
				// 次も改行文字ならインデックスを飛ばす
				if(i < len - 1){
					var ns = csv_text[i+1];
					if(ns.match(/\r|\n/)){
						i++;
					}
				}
			}else{
				cell += one;
			}
		}
		
		// ダブルクォートで囲まれている
		else{
			if(one == '"'){
				if(i < len - 1){
					var s2 = one + csv_text[i + 1]; // 2文字分を取得
					// 2文字が「""」であるなら、一つの「"」とみなす。
					if(s2 == '""'){
						cell += '"';
						i++;
					}else{
						enclose = 0; // 囲み状態を解除する
					}
				}
				
			}
			else{
				cell += one;
			}
		}
		
	}
	return data;
}


function makeTableHtml(data){
	var html = "<table class='tbl2'><tbody>";
	for(var i in data){
		var ent = data[i];
		html += "<tr>";
		for(var e_i in ent){
			var value = ent[e_i];
			value = value.replace(/\r\n|\r|\n/g, '<br>');
			html += '<td>' + value + '</td>';
		}
		html += "</tr>";
		
	}
	html += "</tbody></table>";
	return html;
}



 
/**
 * XSSサニタイズ
 * 
 * @note
 * 「<」と「>」のみサニタイズする
 * 
 * @param any data サニタイズ対象データ | 値および配列を指定
 * @returns サニタイズ後のデータ
 */
function _xss_sanitize(data){
	if(typeof data == 'object'){
		for(var i in data){
			data[i] = _xss_sanitize(data[i]);
		}
		return data;
	}
	
	else if(typeof data == 'string'){
		return data.replace(/</g, '&lt;').replace(/>/g, '&gt;');
	}
	
	else{
		return data;
	}
}