/**
 * Img upload  after  the thumbnail display
 * サムネイルを表示してから画像アップロード
 * @date 2016-9-20
 */


$( function() {
	
	// アップロードファイルのバリデーションクラスを生成する。
	var upFileValid = new UploadFileValidation();
	
	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		
		var files = e.target.files;
		var oFile = files[0];
		
		// アップロードファイルのバリデーション
		var valid_res = upFileValid.checkFileObject(oFile,['png','jpg','jpeg'],['image/png']);
		if(valid_res){
			alert(valid_res);
			return;
		}

		var reader = new FileReader();
		reader.readAsDataURL(oFile);
	
		//ファイル読込成功イベント
		reader.onload = function(evt) {
			
		    var fd = new FormData();
		    fd.append( "upload_file", $("#file1").prop("files")[0] );
			
			$.ajax({
				type: "POST",
				url: "upload.php",
				data: fd,
				cache: false,
				dataType: "text",
				processData : false,
				contentType : false,
				success: function(res, type) {
					
					$('#res').html(res);
		
				},
				error: function(xmlHttpRequest, textStatus, errorThrown){
					console.log(xmlHttpRequest.responseText);
					
					alert(textStatus);
				}

			});
			
		}
		
	});
	
	
});




/**
 * アップロードファイルのバリデーション
 * @param object oFile 「 e.target.files[0] 」で取得するファイル情報
 * @param array permit_exts 許可拡張子リスト
 * @param array permitMimes 許可MIMEリスト
 * @return エラー情報。 正常である場合はnullを返す
 */
function fileValidation(oFile,permitExts,permitMimes){
	
	// ファイル名を取得する
	var fn = oFile['name'];
	
	// ファイル名が空でないか？
	if(fn == "" || fn == null){
		return "ファイル名が空です。";
	}
	
	// ファイル名に不正文字が含まれていないかチェックする
	var reg_exp_res = fn.match(';|<|>|%|$|./|\\\\');
	if(reg_exp_res != ""){
		return "ファイル名に不正記号が含まれています。";
	}
	
	// ファイル名から拡張子を取得する。
	var ext1 = stringRightRev(fn,'.');
	
	// 拡張子が空でないか？
	if(ext1 == "" || ext1 == null){
		return "ファイル名に拡張子がありません。ファイル名【" + fn + "】";
	}
	
	// ファイルサイズが0であるかチェックする。
	if(oFile['size'] == undefined || oFile['size']==0){
		return "ファイルサイズが0です。ファイル名【" + fn + "】";
	}
	
	ext1 = ext1.toLowerCase();
	
	// 許可拡張子リストに存在する拡張子であるか？
	var flg = permitExts.indexOf(ext1);
	if(flg == -1){
		return "無効の拡張子です。【" + fn + "】";
	}
	
	// MIMEを取得する
	var mime_type = oFile['type'];
	
	// MIMEが空でないか？
	if(mime_type == "" || mime_type == null){
		return "MIMEタイプが空です。";
	}
	
	// 許可拡張子リストに存在する拡張子であるか？
	var flg = permitMimes.indexOf(mime_type);
	
	if(flg == -1){
		
		return "無効のMIMEタイプです。【" + mime_type + "】";
	}
	
	return null;
	
};


/**
 * 文字列を右側から印文字を検索し、右側の文字を切り出す。
 * @param s 対象文字列
 * @param mark 印文字
 * @return 印文字から右側の文字列
 */
function stringRightRev(s,mark){
	if (s==null || s==""){
		return s;
	}
	
	var a=s.lastIndexOf(mark);
	var s2=s.substring(a+mark.length,s.length);
	return s2;
}


