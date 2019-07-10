
var xxx_data;//×××データ
var xxx_def_ent;//×××デフォルトエンティティ（行情報）
var xxx_heads;//×××テーブルのヘッダー情報
var xxx_cefs;//×××入力フォームフォーマット情報
var xxx_cets;//×××入力フォームの種類
var xxx_tbl_name;//×××テーブル名
var xxx_tbl_option;//×××テーブルオプション
var xxx_validates;//×××バリデーション情報
var xxx_inpChk;//×××入力チェック

//×××の列情報
var XXX_ROW_ID=0;//ID
var XXX_ROW_KEMONO=1;//ID
var XXX_ROW_NUM1=2;//ID
var XXX_ROW_TEST_DATE=3;//ID
var XXX_ROW_STT=4;//行状態

//▽行状態
var XXX_STT_DEF=0;//初期表示状態
var XXX_STT_NEW=1;//新規追加状態
var XXX_STT_EDIT=2;//変更状態
var XXX_STT_DEL=3;//削除状態
var XXX_STT_CANCEL=4;//キャンセル状態


/**
 * ×××初期化
 */
function xxx_init(){


		var str_json=$("#xxx_json").html();

	 	xxx_data=JSON.parse(str_json);

	 	//デフォルトエンティティ
	 	xxx_def_ent=[-1,'usi','','',XXX_STT_NEW];

	 	xxx_heads=new Array();
	 	xxx_heads[0]="ID";
	 	xxx_heads[1]="ケモノ";
	 	xxx_heads[2]="数値1";
	 	xxx_heads[3]="テスト日付";
	 	xxx_heads[4]="削除";

	 	xxx_cefs=new Array();//列要素フォーマット (column element format)
	 	xxx_cefs[0]="<span id='%id' class='xid'>%v</span>";
	 	var selOptions={'neko':'ネコ','nezumi':'ネズミ','usi':'ウシ','tora':'トラ','u':'鵜','kani':'カニ',};
	 	xxx_cefs[1]=xxx_createSelect(selOptions,"class='kemono'");
	 	xxx_cefs[2]="<input type='text' id='%id' class='num1' value='%v'>";
	 	xxx_cefs[3]="<input type='text' id='%id' class='test_date' value='%v'>";
	 	xxx_cefs[4]="<input type='button' id='%id' class='del_btn' value='%del_name' onclick='xxx_del(this)'>";

	 	xxx_cets=new Array();
	 	xxx_cets[0]='';
	 	xxx_cets[1]='select';
	 	xxx_cets[2]='text';
	 	xxx_cets[3]='text';
	 	xxx_cets[4]='button';


	 	xxx_tbl_name='xxx';
	 	xxx_tbl_option="border='1'";


	 	xxx_validates={

	 			2 :{//列番号:数値1
	 				'numeric':{
	 					'req':false,
	 					'msg':'数値1には数値を入力してください。'}
	 				},

	 			3 :{//列番号:テスト日付
	 				'date':{
	 					'req':false,
	 					'msg':'テスト日付は日付で入力してください。'}
	 				},

	 		};
	 	xxx_inpChk=new InputCheckA();

	 	//テーブルを作成
	 	var tblHtml=xxx_createTableHtml(xxx_data,xxx_tbl_name,xxx_tbl_option,xxx_heads,xxx_cefs,xxx_cets);



	 	tblHtml+="<br><input type='button' value='新規' onclick='xxx_new_add()' />\n";

	 	$("#div_xxx").html(tblHtml);



	 	xxx_event_put();//テーブルイベントをセット
}



/**
 * ×××入力チェック（行のみ）
 * @param row_no 行番号
 * @returns エラー情報
 */
function xxx_validate_for_row(row_no){
	var ent=xxx_data[row_no];
	var errs=xxx_inpChk.checkEntity(ent,xxx_validates);

	var err='';
	if(errs!=undefined){
		err=errs.join(':');
	}

	$("#xxx_err").html(err);


	return errs;
}

/**
 * 数値1のonblurイベント
 * @param elm
 */
function xxx_num1_onblur(elm){
	var obj=$(elm);

	var v=obj.val();
	var row_no=obj.parent().parent().attr('row_no');//行番号を取得する。

	var old_v=xxx_data[row_no][XXX_ROW_NUM1];

	if(v!=old_v){

		//変更した値をセット
		xxx_data[row_no][XXX_ROW_NUM1]=v;

		var stt=xxx_data[row_no][XXX_ROW_STT];

		//行状態が初期なら更新にする。
		if(stt==XXX_STT_DEF){
			xxx_data[row_no][XXX_ROW_STT]=XXX_STT_EDIT;
		}

		//現在行の入力チェック
		xxx_validate_for_row(row_no);


	}

}

/**
 *
 * テスト日付のonblurイベント
 * @param elm
 */
function xxx_test_date_onblur(elm){
	var obj=$(elm);

	var v=obj.val();
	var row_no=obj.parent().parent().attr('row_no');//行番号を取得する。

	var old_v=xxx_data[row_no][XXX_ROW_TEST_DATE];

	if(v!=old_v){

		//変更した値をセット
		xxx_data[row_no][XXX_ROW_TEST_DATE]=v;

		var stt=xxx_data[row_no][XXX_ROW_STT];

		//行状態が初期なら更新にする。
		if(stt==XXX_STT_DEF){
			xxx_data[row_no][XXX_ROW_STT]=XXX_STT_EDIT;
		}

		//現在行の入力チェック
		xxx_validate_for_row(row_no);


	}

}





/**
 * ×××行削除アクション
 * @param elm　this
 */
function xxx_del(elm){

	var obj=$(elm);

	//行番号を取得する。
	var row_no=obj.parent().parent().attr('row_no');

	//行状態を取得
	var stt=xxx_data[row_no][XXX_ROW_STT];


	//行状態が新規追加ならキャンセルにする。
	if(stt==XXX_STT_NEW){
		xxx_data[row_no][XXX_ROW_STT]=XXX_STT_CANCEL;

	//行状態が初期および編集であるなら削除にする。
	}else{
		xxx_data[row_no][XXX_ROW_STT]=XXX_STT_DEL;
	}

	//テーブルからこの行を削除。
	obj.parent().parent().remove();


}

/**
 * ×××新規追加アクション
 */
function xxx_new_add(){

	//データ数から、新しい連番を作成
	var i=xxx_data.length;

	xxx_def_ent[0]=i;//IDをセット
	xxx_def_ent[3]=new Date();

	xxx_data[i]=xxx_def_ent.slice(0);//デフォルトのクローンをセット

	//行を作成
	var tds=xxx_createRow(xxx_def_ent,i,xxx_cefs,xxx_cets,xxx_tbl_name);

	$("#" + xxx_tbl_name + " tbody").append(tds);



	xxx_event_put();//テーブルイベントをセット
}



/**
 * 各種イベントをセット
 */
function xxx_event_put(){
	$(".num1").blur(function(event){
		xxx_num1_onblur(this);//まとめ変更

	});

 	$(".test_date").blur(function(event){
 		xxx_test_date_onblur(this);//まとめ変更

 	});
}

/**
 * セレクト入力のHMTL文字列を作成
 * @param selOptions　選択肢リスト（連想配列）
 * @param option　セレクト入力の属性
 * @returns セレクト入力のHMTL文字列
 */
function xxx_createSelect(selOptions,option){

	var h="<select id='%id' %option>\n";
	h=h.replace('%option',option);



	for(var i in selOptions){
		var label=selOptions[i];

		var option="<option value='%v'>%label</option>\n";
		option=option.replace('%v',i);
		option=option.replace('%label',label);

		h+=option;
	}


	h+="</select>\n";

	return h;
}




/**
 * テーブルHTMLを作成
 * @param data　データ
 * @param tbl_name　テーブル名
 * @param tbl_option　テーブルの属性文字列
 * @param heads　テーブルの列名情報
 * @param cefs　入力フォームのフォーマットリスト
 * @param cets　入力フォームの種類リスト
 * @returns テーブルHTML
 */
function xxx_createTableHtml(data,tbl_name,tbl_option,heads,cefs,cets){


	var html='';

	var str_tbl="<table id='%tbl_name' %option><thead>\n";
	str_tbl=str_tbl.replace('%tbl_name',tbl_name);
	str_tbl=str_tbl.replace('%option',tbl_option);
	html+=str_tbl;

	var ths='<tr><th>'+heads.join('</th><th>')+'</th></tr></thead>\n';
	html+=ths;
	html+='<tbody>\n';


	for(var i in data){
		var ent=data[i];

		//行を作成
		var tds=xxx_createRow(ent,i,cefs,cets,tbl_name);

		html+=tds;
	}

	html+='</tbody></table>\n';

	return html;

}


/**
 * 行を生成
 * @param ent　エンティティ
 * @param row_no　行番号
 * @param cefs　入力フォームのフォーマットリスト
 * @param cets　入力フォームの種類リスト
 * @param tbl_name　テーブル名
 * @returns 行HTML
 */
function xxx_createRow(ent,row_no,cefs,cets,tbl_name){

	var tds="<tr row_no='" + row_no + "'>";

	for(var x in ent){
		var v='';
		if(ent[x]!=null){
			v=ent[x];
		}

		var td=cefs[x];

		//一番右側の列（削除ボタン等）
		if(x==XXX_ROW_STT){

			//行状態が新規追加ならキャンセルを表示
			if(v==XXX_STT_NEW){
				td=td.replace('%del_name','キャンセル');

			//行状態が初期および編集なら削除を表示
			}else{
				td=td.replace('%del_name','削除');
			}

		}else{
			if(cets[x]=='select'){
				td=td.replace("option value='" + v + "'","option value='" + v + "' selected");
			}else{
				td=td.replace('%v',v);
			}
		}

		var xid=tbl_name + '_' + row_no + '_' + x;
		td=td.replace('%id',xid);

		tds+='<td>' + td + '</td>\n';

	}

	tds+="</tr>\n";

	return tds;


}

/**
 * データをJSON文字列にしてJSONエレメントに出力
 */
function xxx_update_json(){
	var str_json = JSON.stringify(xxx_data);//★JSON文字列にする。
	$("#xxx_json").html(str_json);

}


/**
 * データ全体のバリデーション
 * @return エラー配列
 */
function xxx_validate(){

	var errs=xxx_inpChk.checkData(xxx_data,xxx_validates);


	var err='';
	if(errs!=undefined){
		err=errs.join(':');
	}

	$("#xxx_err").html(err);

	return errs;
}

/**
 * データをJSON文字列にしてJSONエレメントに出力。また入力チェックも行い、結果を返す。
 * @return 入力エラー配列
 */
function xxx_update(){
	xxx_update_json();//データをJSON文字列にしてJSONエレメントに出力
	var errs=xxx_validate();

	return errs;
}


