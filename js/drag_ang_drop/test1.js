

$( function() {


	$('#test_drag').bind('drop', function(e){

		// デフォルトの挙動を停止
		e.preventDefault();

		// ファイル情報を取得
		var files = e.originalEvent.dataTransfer.files;

		uploadFiles(files);

		}).bind('dragenter', function(){
			// デフォルトの挙動を停止
			return false;
		}).bind('dragover', function(){
			// デフォルトの挙動を停止
			return false;
		});


		//ファイルアップロードボタンイベント
		$('input[type="file"]').change(function(){
			var files = this.files;
			uploadFiles(files);
		});

});





function uploadFiles(files) {
	var html=createTbl_hash(files);
	$("#res").html(html);


	var fd = new FormData();
	var filesLength = files.length;


	for (var i = 0; i < filesLength; i++) {

		console.log( files[i]);

		fd.append("files[]", files[i]);
	}


	$.ajax({
		url: 'test1.php',
		type: 'POST',
		data: fd,
		processData: false,
		contentType: false,
		success: function(data) {

			$("#res2").html(data);
			console.log('アップロード完了');
		}
	});
}



/**
 * 連想配列オブジェクトからテーブルHTMLを生成する。
 * キーをヘッダーの名前に利用する。
 * @param hash 連想配列オブジェクト
 * @return テーブルHTML
 */
function createTbl_hash(hash){


	//1行目のエンティティからヘッダー部分を組み立て
	var html="<table border='1'><thead><tr>"
	for(var k in hash[0]){
		html+="<th>" + k + "</th>";
	}
	html+="</th></thead>\n";
	html+="<tbody>\n";



	//連想配列をループ。
	for(var i in hash){
		html+="<tr>";
		var ent=hash[i];
		for(var k in ent){
			var v=ent[k];
			html+="<td>" + v + "</td>";
		}
		html+="</tr>\n";
	}

	html+="</tbody></table>\n";

	return html;
}