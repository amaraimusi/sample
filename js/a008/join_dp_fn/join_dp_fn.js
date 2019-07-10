$(()=>{

	var data = [
		{'dp':'/animal/neko' , 'fn':'mike.jpg'},
		{'dp':'/animal/neko/' , 'fn':'kiji-tora.jpg'},
		{'dp':'\\animal\\neko' , 'fn':'kuro.jpg'},
		{'dp':'animal\\neko\\' , 'fn':'kiji-siro-tora.jpg'},
		{'dp':'/' , 'fn':'shamu.jpg'},
		{'dp':'\\' , 'fn':'shamu.jpg'},
		{'dp':'' , 'fn':'buti.jpg'},
		{'dp':null , 'fn':'aka-neko.jpg'},
		{'dp':0 , 'fn':'shamu-tora.jpg'},
		{'dp':'0' , 'fn':'cha-tora.jpg'},
		{'dp':'/animal\\neko\\' , 'fn':'bengal.jpg'},
		{'dp':'/animal\\neko' , 'fn':'bengal.jpg'},
	];
	
	
	var tbody_html = '';
	for(var i in data){
		var ent = data[i];
		var fp = joinDpFn(ent.dp , ent.fn); // ディレクトリとファイル名を連結してファイルパスを作成
		tbody_html += '<tr><td>' + ent.dp + '</td><td>' + ent.fn + '</td><td>' + fp + '</td><tr>';
	}
	

	var tbody = $('#res_tbl tbody').html(tbody_html);
		
	
});


/**
 * ディレクトリとファイル名を連結してファイルパスを作成
 * @param dp ディレクトリパス
 * @param fn ファイル名
 * @returns string ファイルパス
 */
function joinDpFn(dp,fn){
	
	var fp = ''; // ファイルパス
	
	// ディレクトリパスが空であるならファイル名をファイルパスとして返す。
	if(dp == null || dp == '' || dp == 0) return fn;

	var end_str = dp.slice(-1); // ディレクトリパスから末尾の一文字を取得する。
	
	// 末尾の一文字がセパレータである場合
	if(end_str == '/' || end_str == '\\'){
		fp = dp + fn;
	}
	
	// 末尾の一文字がセパレータでない場合
	else{
		
		// セパレータを取得
		var sep = '/';
		var i = dp.lastIndexOf('\\');
		if(i >= 0) sep = '\\';
		
		fp = dp + sep + fn;
	}
	

	return fp;
}

