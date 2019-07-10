



function test1(fp){
	is_file(fp,function(res){
		if(res==true){
			alert('ファイルは存在します');
		}else{
			alert('ファイルは存在しません');
		}
	});
}


/**
 * ファイル存在チェック
 * @param fp ファイルパス
 * @param callback チェック後に呼び出されるコールバック
 */
function is_file(fp,callback){
	
	$.ajax({
		url: fp,
		cache: false
	}).done(function(data) {
		callback(true);
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		callback(false);
	});

}

function test2(fp){
	var flg = is_file2(fp);
	if(flg==true){
		alert('ファイルは存在します');
	}else{
		alert('ファイルは存在しません');
	}
}

/**
 * ファイル存在チェック
 * @param fp ファイルパス
 */
function is_file2(fp){
	
	var flg=null;
	
	$.ajax({
		url: fp,
		cache: false,
		async:false
	}).done(function(data) {
		flg=true;
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		flg=false;
	});
	
	return flg;

}