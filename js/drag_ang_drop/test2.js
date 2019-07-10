

$( function() {

	//進捗バーの初期化
	$('#progress').progressbar({
		value: 0,
		max: 100
		});

	$('#test_drag').bind('drop', function(e){

		// デフォルトの挙動を停止
		e.preventDefault();

		// ファイル情報を取得
		var files = e.originalEvent.dataTransfer.files;

		//ファイルアップロード
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
		uploadFiles(files);//ファイルアップロード
	});

});



//ファイルアップロード
function uploadFiles(files) {

	//ファイル情報をHTMLテーブルとして出力。
	var html=createTbl_hash(files);
	$("#res").html(html);


	var fd = new FormData();

	for (var i = 0; i < files.length; i++) {
		fd.append("files[]", files[i]);
	}

	$.ajax({
		async: true,
		xhr : function(){
			XHR = $.ajaxSettings.xhr();
			if(XHR.upload){
				XHR.upload.addEventListener('progress',function(e){

					//進捗率の計算
					progre = parseInt(e.loaded/e.total*10000)/100 ;
					console.log(progre+"%") ;

					//進捗バーの進捗を進める。
					$('#progress').progressbar({
						value: Math.round(progre)
					});

				}, false);

			}
			return XHR;
		 },
         url:  "test2.php",
         type: "post",
         data:fd,//formdataのオブジェクト
         contentType: false,
         processData: false
     }).done(function( msg ) {

    	 console.log( 'アップロード完了しました。' );
    	 $("#res2").html(msg);
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