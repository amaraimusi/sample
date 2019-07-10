/**
 * 
 */
var m_id = 1000;

function test1(){
	
	var tbl_slt = "#tbl1";
	var row_index = $("#row_index").val();
	var new_tr_html = '<tr><td>' + m_id + '</td><td>kamakiri</td><td>カマキリ</td></tr>';
	m_id ++;
	
	// TR要素をテーブルの指定行に挿入する
	var newTr = insertTr(tbl_slt,row_index,new_tr_html);
	
	console.log(newTr.html());
}

/**
 * TR要素をテーブルの指定行に挿入する
 * @note
 * tbodyは必須
 * 
 * @param string tbl_slt テーブル要素のセレクタ
 * @param int row_index 挿入行インデックス (1行目に挿入する場合は0を指定する。末尾に追加する場合は行数以上の数字を指定）
 * @param string tr_html 挿入TR要素
 * @returns 新規追加TR要素
 */
function insertTr(tbl_slt,row_index,tr_html){
	
	var tbody = $(tbl_slt + " tbody");
	var trs = tbody.find("tr");
	var tr_len = trs.length;
	var new_index = null;

	// 行数が1件以上である場合
	if(tr_len > 0){
		
		// 追加行番が行数未満である場合
		if(row_index < tr_len){
			// 行番にひもづくTR要素を取得
			var tr = trs[row_index];
			
			// TR要素の上に新TR要素を追加
			$(tr).before(tr_html);// × → tr.before(tr_html);
			new_index = row_index;
		}
		// 追加行番が行数以上である場合
		else{
			// 最後のTR要素を取得
			var tr = trs[tr_len-1];
			
			// TR要素の下に新TR要素を追加する
			$(tr).after(tr_html);
			new_index = tr_len;
		}
	}
	// 行数が0件である場合,tbody要素にtr要素を追加する。
	else{
		tbody.append(tr_html);
		new_index = 0;
	}
	
	trs = tbody.find("tr");
	var newTr = trs[new_index];
	
	return $(newTr); 
}

