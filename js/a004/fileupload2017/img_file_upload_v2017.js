
/**
 * 画像ファイルアップロード【ver2017】
 * @date 2017-1-27
 */
$(function(){
	var fuElm = $('#test1');

	fuElm[0].addEventListener('drop',function(evt){
		evt.stopPropagation();
		evt.preventDefault();

		var files = evt.dataTransfer.files; 

		var fns = [];
		for (var i = 0; i < files.length; i++) {
			fns.push(files[i].name);
		}
		
		// ファイル名を出力する
		var strFns = fns.join("<br>");
		$('#res').html(strFns);
		
		
		img_preview(files);

	},false);
	
	
	fuElm[0].addEventListener('dragover',function(evt){
		// evt.stopPropagation();
		evt.preventDefault();
	},false);
	
	
	
	
	
	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
		var files = e.target.files;
		img_preview(files);

	});
	
	
	
	
	
	
});


function img_preview(files){
	//ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
	var oFile = files[0];

	var reader = new FileReader();
	reader.readAsDataURL(oFile); // データURLスキーム取得処理を非同期で開始する

	// データURLスキームを取得後に実行される処理
	reader.onload = function(evt) {
		// img要素にデータURLスキームをセットし、画像表示する。
		$('#img1').attr('src',reader.result);
	}
}
