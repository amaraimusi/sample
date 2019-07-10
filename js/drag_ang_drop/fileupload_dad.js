


var m_faData={};//添付ファイルデータ(file attach data)

//状態フラグ(status_id)の定数
var STT_UPLOADING=1;//アップロード中
var STT_UPLOADED=2;//仮アップロード済




$( function() {


	//進捗バーの初期化
	$('#progress').progressbar({
		value: 0,
		max: 100
		});

	$('#dad_area').bind('drop', function(e){

		// デフォルトの挙動を停止
		e.preventDefault();

		// ファイル情報を取得
		var files = e.originalEvent.dataTransfer.files;


		//拡張子によるファイル名バリデーション
		var err=validByExt_fudad(files);
		if(err!=null){
			alert(err);
			return;
		}


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


		//拡張子によるファイル名バリデーション
		var err=validByExt_fudad(files);
		if(err!=null){
			alert(err);
			return;
		}


		uploadFiles(files);//ファイルアップロード
	});

});



//ファイルアップロード
function uploadFiles(files) {


	var uData={};//アップロード中データ

	var fd = new FormData();//ajax送信データ


	for (var i = 0; i < files.length; i++) {

		//var fa_index=fa_cnt + i;//添付ファイルデータのインデックス

		//添付ファイルデータからファイル名に一致する行のインデックスを取得する。なければ新インデックスを発行。
		var fa_index=getFaIndex(m_faData,files[i].name);

		var file_datetime=dateFormat_fudad(files[i].lastModifiedDate,'yyyy-mm-dd hh:ii:ss');

		//添付ファイルデータにファイル情報を追加
		m_faData[fa_index]={
				'file_name':files[i].name,
				'file_size':files[i].size,
				'file_datetime':file_datetime,
				'mime_type':files[i].type,
				'tmp_name':null,
				'error':null,
				'status_flg':STT_UPLOADING,
		};

		//ajax送信データにファイル情報を追加
		fd.append("files[]", files[i]);
	}


	//添付ファイルデータの表示およびJSON埋込を行う。
	faDataToTheView(m_faData);


	$.ajax({
		async: true,
		xhr : function(){
			XHR = $.ajaxSettings.xhr();
			if(XHR.upload){
				//進捗中
				XHR.upload.addEventListener('progress',function(e){

					//進捗率の計算
					progre = parseInt(e.loaded/e.total*10000)/100 ;
					//console.log(progre+"%") ;

					//進捗バーの進捗を進める。
					$('#progress').progressbar({
						value: Math.round(progre)
					});

				}, false);

				//エラー
				XHR.upload.addEventListener('error',function(e){
					console.log('xhr error');
			    	uploadFilesFail();

				}, false);

				//取り消し
				XHR.upload.addEventListener('abort',function(e){

					console.log('xhr abort');
			    	uploadFilesFail();

				}, false);


			}

			return XHR;
		 },
         url:  "fileupload_dad.php",
         type: "post",
         data:fd,//formdataのオブジェクト
         contentType: false,
         processData: false
     }).done(function( res ) {

    	 //ファイルアップロードが不許可もしくは失敗時の処理。
    	 if(res=='fail' || res==''){
    		 uploadFilesFail();
    	 }

    	 //ファイルアップロード成功時の処理。
    	 else{
    		 uploadFilesSuccess(res);
    	 }


    	 //添付ファイルデータの表示およびJSON埋込を行う。
    	 faDataToTheView(m_faData);


    }).fail(function( jqXHR, textStatus, errorThrown ) {
    	uploadFilesFail();
    	alert('サーバーエラー');
    });;


}


//ファイルアップロード成功時の処理。
function uploadFilesSuccess(res){

	 var resData=$.parseJSON(res);

	 //添付ファイルデータへマージ
	 for(var rd_i in resData){

			//添付ファイルデータからファイル名に一致する行のインデックスを取得する。なければ新インデックスを発行。
			var fa_index=getFaIndex(m_faData,resData[rd_i].file_name);

			//添付ファイルデータにセット
			m_faData[fa_index].tmp_name=resData[rd_i].tmp_name;
			m_faData[fa_index].error=resData[rd_i].error;
			m_faData[fa_index].status_flg=2;

	 }

}

//ファイルアップロードが不許可もしくは失敗時の処理。
function uploadFilesFail(){

	fail_file_names=[];

	 //添付ファイルデータからtmp_nameが空の行を削除する。
	for(var i in m_faData){

		if(m_faData[i].tmp_name==null){
			fail_file_names.push(m_faData[i].file_name)
			delete m_faData[i];
		}
	 }

	$str_err=fail_file_names.join('\n');

	alert("アップロードに失敗しました。\n" + $str_err);

}



//添付ファイルデータからファイル名に一致する行のインデックスを取得する。なければ新インデックスを発行。
function getFaIndex(m_faData,file_name){

	var index=-1;
	for(var i in m_faData){
		if(m_faData[i].file_name==file_name){
			index=i;
		}
	}

	//ファイル名に一致する行がなければ、データ要素数を新インデックスとして発行。
	if(index == -1){
		index=Object.keys(m_faData).length;//添付ファイルデータの要素数
	}

	return index;

}


//添付ファイルデータの表示およびJSON埋込を行う。
function faDataToTheView(m_faData){

	var fa_json=JSON.stringify(m_faData);

	$("#fa_json").val(fa_json);

	var fa_html=createTbl_hash(m_faData);
	$("#fa_html").html(fa_html);

}


function createTbl_hash(hash){

	if(hash==null || Object.keys(hash).length==0){
		return '';
	}

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


//拡張子によるファイル名バリデーション
function validByExt_fudad(files){

	//許可拡張子マップ
	var perExtMap={'doc':1,'docx':1,'xls':1,'xlsx':1,'xlsm':1,'ppt':1,'pptx':1,'pptm':1,'mdb':1,
			'accdb':1,'txt':1,'jpg':1,'jpeg':1,'png':1,'bmp':1,'gif':1,'pdf':1,'epub':1,'book':1,
			'zbf':1,'azw':1,'acsm':1,'xml':1,'mp3':1,'mpg':1,'mpeg':1,'vls':1,'csv':1,'wav':1,
			'm4a':1,'tiff':1,'tif':1,'bpg':1,};


	var errFns=[];//エラーファイル名リスト

	for (var i = 0; i < files.length; i++) {

		var file_name=files[i].name;//ファイル名を取得する

		//ファイル名から拡張子を抜き出す。ついでに拡張子は小文字可する。
		var ext=getExtension_fudad(file_name);

		//許可拡張子マップに拡張子は存在しない場合
		if(!perExtMap[ext]){
			errFns.push(file_name);//ファイル名を不許可リストに追加する。
		}


	}



	//retの初期化
	var ret=null;

	//不許可リストの件数が1件以上である場合。
	if(errFns.length >= 1){
		//エラーメッセージを組み立てて、retにセット
		var str_fns=errFns.join('\n');
		ret="以下のファイルはアップロード禁止です。\n" + str_fns;
	}


	return ret;
}


//ファイル名から拡張子を取得する。
function getExtension_fudad(fn){
	if(fn==null){
		return '';
	}

	var ary=fn.split(".");
	var ext=ary[ary.length-1];

	ext=ext.toLowerCase();//小文字化する

	return ext;
}


function dateFormat_fudad(date, format){

	var result = format;

	var f;
	var rep;

	var yobi = new Array('日', '月', '火', '水', '木', '金', '土');

	f = 'yyyy';
	if ( result.indexOf(f) > -1 ) {
		rep = date.getFullYear();
		result = result.replace(/yyyy/, rep);
	}

	f = 'mm';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getMonth() + 1, 2);
		result = result.replace(/mm/, rep);
	}

	f = 'ddd';
	if ( result.indexOf(f) > -1 ) {
		rep = yobi[date.getDay()];
		result = result.replace(/ddd/, rep);
	}

	f = 'dd';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getDate(), 2);
		result = result.replace(/dd/, rep);
	}

	f = 'hh';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getHours(), 2);
		result = result.replace(/hh/, rep);
	}

	f = 'ii';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getMinutes(), 2);
		result = result.replace(/ii/, rep);
	}

	f = 'ss';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getSeconds(), 2);
		result = result.replace(/ss/, rep);
	}

	f = 'fff';
	if ( result.indexOf(f) > -1 ) {
		rep = PadZero(date.getMilliseconds(), 3);
		result = result.replace(/fff/, rep);
	}

	return result;

}




/**************************************************
 * [機能]	ゼロパディングを行います
 * [引数]	value	対象の文字列
 * 			length	長さ
 * [戻値]	結果文字列
 **************************************************/
function PadZero(value, length){
    return new Array(length - ('' + value).length + 1).join('0') + value;
}







