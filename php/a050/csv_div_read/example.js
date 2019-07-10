

var fileUploadK; // ファイルアップロードの拡張クラス


$(() => {
	
	fileUploadK = new FileUploadK({
		'ajax_url':'upload.php',
		'prog_slt':'#prog1',
		'err_slt':'#err',
		'valid_ext':'image',
		});
	fileUploadK.addEvent('file1',{'pacb':callback1,'img_width':120,'img_height':120});
	fileUploadK.addEvent('file2',{'valid_ext':'audio'});
	fileUploadK.addEvent('file3',{'valid_ext':'txt','pacb':callback3});
	
});

function callback1(res){
	console.log('callback1');
	jQuery("#res1").append('コールバックテスト1');
}

function callback3(res){
	console.log('callback1');
	jQuery("#res1").append('コールバックテスト3');
}

function ajaxReg(){
	
	// ファイル情報と一緒に送信するデータ
	var withData = {
			'category1':'汽水・淡水魚',
			'category2':'サケ',
			};
	
	fileUploadK.uploadByAjax(resOutput,withData);
}


//レスポンス出力
function resOutput(res){
	var resElm = jQuery('#res1');
	resElm.html(res.msg + '<br>');
	
	resElm.append('<p>ファイル名の出力</p>');
	var str_fns = res.fileNames.join('<br>');
	resElm.append(str_fns);
	
	// エンティティの出力
	var ent_str = '<br><p>エンティティの出力</p>';
	var ent = res.ent;
	for(field in ent){
		var value = ent[field];
		ent_str += field + ' = ' + value + '<br>';
	}
	resElm.append(ent_str);
	
}


function getFileParams(){
	var data = fileUploadK.getFileParams();
	var tbody = '';

	for(var i in data){
		var ent = data[i];
		tbody += "<tr>" +
				"<td>" + ent.fu_id + "</td>" +
				"<td>" + ent.name + "</td>" +
				"<td>" + ent.size + "</td>" +
				"<td>" + ent.mime + "</td>" +
				"<td>" + ent.modified + "</td>" +
				"</tr>";
	}
	jQuery("#f_param_tbl tbody").html(tbody);
}
