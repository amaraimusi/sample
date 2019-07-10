/**
 * サンプル：任意の要素でファイルアップロードができるようにする
 * @date 2017-1-26
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
		
	},false);
	
	
	fuElm[0].addEventListener('dragover',function(evt){
		// evt.stopPropagation();
		evt.preventDefault();
	},false);
	
	
});

