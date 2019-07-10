

var m_files;

/**
 * 画像ファイルアップロード | プレビュー,DnD,Ajax
 * @date 2017-1-30
 */
$(function(){
	var fuElm = $('#test1');

	fuElm[0].addEventListener('drop',function(evt){
		evt.stopPropagation();
		evt.preventDefault();

		var files = evt.dataTransfer.files; 
		m_files = files;

		var fns = [];
		for (var i = 0; i < files.length; i++) {
			fns.push(files[i].name);
		}
		
		// ファイル名を出力する
		var strFns = fns.join("<br>");
		$('#res').html(strFns);
		
		imgListPreviews(files); // 画像プレビューを表示する

	},false);
	
	fuElm[0].addEventListener('dragover',function(evt){
		// evt.stopPropagation();
		evt.preventDefault();
	},false);
	
	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		m_files = files;
		imgListPreviews(files);

	});

});

/**
 * プレビュー画像を表示する
 * @param files
 */
function imgListPreviews(files){

	$('#test1_init').hide();
	
	var len = files.length;
	for(var i=0;i<len;i++){
		console.log('i=' + i);//■■■□□□■■■□□□■■■□□□)
		imgPreview(files[i]);
		
	}
	//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）

//	var oFile = files[0];
//
//	var reader = new FileReader();
//	reader.readAsDataURL(oFile); // データURLスキーム取得処理を非同期で開始する
//
//	// データURLスキームを取得後に実行される処理
//	reader.onload = function(evt) {
//		// img要素にデータURLスキームをセットし、画像表示する。
//		$('#img1').attr('src',reader.result);
//		
//		// 枠区分を画像にフィットさせる
//		var img = new Image;
//		img.src = reader.result;
//		img.onload = function() { 
//			 $('#test1').css({
//				'width':img.width,
//				'height':img.height});
//		 };
//
//	}

}

function imgPreview(oFile){
	//var oFile = files[0];
	
	var reader = new FileReader();
	reader.readAsDataURL(oFile); // データURLスキーム取得処理を非同期で開始する

	// データURLスキームを取得後に実行される処理
	reader.onload = function(evt) {
		// img要素にデータURLスキームをセットし、画像表示する。
		$('#img1').attr('src',reader.result);
		
		// 枠区分を画像にフィットさせる
		var img = new Image;
		img.src = reader.result;
		img.onload = function() { 
			 $('#test1').css({
				'width':img.width,
				'height':img.height});
		 };

	}
}



/**
 * Ajaxを利用しサーバーへファイルアップロードする
 */
function upload1(){
	console.log('test=');//■■■□□□■■■□□□■■■□□□)
//	var fileElm = $("#file1");
//	var len = $("#file1").prop("files").length;
//	if(len==0){
//		return;
//	}
//	var fd = new FormData();
//	for (var i=0 ; i<len ; i++){
//		var key = 'fu_' + i;
//		 fd.append( key, fileElm.prop("files")[i] );
//
//	}
	

	
	//var fileElm = $("#file1");
	var len = m_files.length;
	if(len==0){
		return;
	}
	var fd = new FormData();
	for (var i=0 ; i<len ; i++){
		var key = 'fu_' + i;
		 fd.append( key, m_files[i] );

	}


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





