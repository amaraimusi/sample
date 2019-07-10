/**
 *
 */

var m_ic;//入力チェック
var m_editMode;//0:編集モードOFF    1:編集モードON

$(document).ready(function(){

	m_ic=new InputCheckA();//入力チェッククラスを生成





	//ダイアログに関するコード
	$( '#new_reg_dlg' ) . dialog( {
	        autoOpen: false,
	        width: 400,
	        show: 'explode',
	        hide: 'explode',
	        modal: true,
	        buttons: {
	            '更新': function() {

	            	var ret=new_reg2();

	            	if(ret != 'err'){
	            		$( this ) . dialog( 'close' );
	            	}
	            },
	            'キャンセル': function() {
	                $( this ) . dialog( 'close' );
	            },
	        }
	    });



	//☆AJAX非同期通信
	$.ajax({
		type: "POST",
		url: "server.php",
		data: "key1=neko&key2=あいうえお",
		cache: false,
		dataType: "text",
		success: function(data, type) {

			data=data.trim();

			show_table(data);

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			alert(textStatus);
		}
	});





});


/**
 * 最初のデータ表示
 * @param data
 */
function show_table(data){

	var jdata=$.parseJSON(data);
	var html="";
    var cnt=jdata.length;

    for(var i=0;i<cnt;i++){

    	var ent=jdata[i];
    	html+=create_row(ent,i);//テーブルの行を生成


    }


	$("#tbl1 tbody").html(html);


}



//テーブルの行を生成。
function create_row(ent,y){


	var x=0;

	var row="<tr id='row_" + y + "'>";
	row+=_td(ent.id,x,y,false);
	row+=_td(ent.test_name,x+1,y,true);
	row+=_td(ent.test_num,x+2,y,true);
	row+=_td(ent.test_dbl,x+3,y,true);
	row+=_td(ent.test_date,x+4,y,true);
	row+="</tr>";

	return row;
}

function _td(v,x,y,edit){
	var td="<td><div id='cell_" + x + "_" + y + "' class='cell' edit=' " + edit + " ' x='"+ x +"' y='"+ y +"' >" +
	"<label id='lbl_cell_" + x + "_" + y + "' for='inp_cell_" + x + "_" + y + "' class='lbl_cell'>" + v + "</label>" +
	"<input type='text' id='inp_cell_" + x + "_" + y + "' class='inp_cell' value='" + v + "' style='display:none' onchange='cell_change(" + x + "," + y + ")' />" +
	"</div></td>";
	return td;
}




/**
 * セルの値が変更されたときに呼び出される処理
 * @param x	セルの位置X
 * @param x	セルの位置Y
 */
function cell_change(x,y){

	var inp_id="#inp_cell_" + x + "_" + y;
	var lbl_id="#lbl_cell_" + x + "_" + y;
	var tr_id="#row_" + y;

	$(tr_id).attr({'changed':'true'});//修正フラグを立てる。(更新ボタンの処理の際、修正行のみ更新処理をかけるようにするため）

	//ラベルにも変更値をセット。
	var v=$(inp_id).val();
	$(lbl_id).html(v);
}

/**
 * 編集モードチェックボックスをクリック
 */
function on_edit_mode(){
	var v=$('#chk_edit_mode:checked').val();
	if(v=='on'){
		m_editMode=1;//編集モードON
		$(".lbl_cell").hide();
		$(".inp_cell").show();

		$("#new_reg_btn").hide();
		$("#update_btn").show();

	}else{
		m_editMode=1;//編集モードOFF
		$(".lbl_cell").show();
		$(".inp_cell").hide();


		$("#new_reg_btn").show();
		$("#update_btn").hide();
	}


}

/**
 * 新規登録
 */
function new_reg(){


	$( '#new_reg_dlg' ) . dialog( 'open' );//ダイアログオープン


}

function new_reg2(){


	//パラメータにフォームの値をセット
	var prms={
			test_name:$("#new_test_name").val(),
			test_num:$("#new_test_num").val(),
			test_dbl:$("#new_test_dbl").val(),
			test_date:$("#new_test_date").val(),
			};


	var vld=getValidate();

	var err=m_ic.checkEntity(prms, vld);

	$("#new_reg_btn").prop({'disabled':'disabled'});//無効にする。
	$("#chk_edit_mode").prop({'disabled':'disabled'});//無効にする。


	if(err==null){

		//連想配列から送信文字列を作成する。
		var send=createSendStr(prms);


		//☆AJAX非同期通信
		$.ajax({
			type: "POST",
			url: "new_reg.php",
			data: send,
			cache: false,
			dataType: "text",
			success: function(res, type) {

				var json=$.parseJSON(res);
				if(json.rs=='success'){
					prms.id=json.new_id;//登録したIDをセット
					new_reg3(prms);
				}
				$("#new_reg_btn").prop({'disabled':false});//有効に戻す
				$("#chk_edit_mode").prop({'disabled':false});//有効に戻す

			},
			error: function(xmlHttpRequest, textStatus, errorThrown){
				alert(textStatus);
				$("#new_reg_btn").prop({'disabled':false});//有効に戻す
				$("#chk_edit_mode").prop({'disabled':false});//有効に戻す
			}
		});
	}else{

		$("#new_err").html(err.join(','));
		return 'err';
	}

}

function new_reg3(prms){

	//パラメータからテーブルの行を作成する。
	var row=create_row(prms);
	$("#tbl1 tbody").append(row);
}


/**
 * 連想配列から送信文字列を作成する。
 * @param prms 連想配列
 * @return     Ajax用の送信文字列
 *
 */
function createSendStr(prms){
	var ary=new Array();
	for(var k in prms){
		var str=k + "=" + prms[k];
		ary.push(str);
	}

	return ary.join('&');
}



/**
 * バリデーション情報を作成
 */
function getValidate(){
	var validates={



			0 :{//列番号:名
				'maxLength':{
					'maxLen':7,
					'req':false,
					'msg':'名は7文字以内で入力してください。'}
				},




			1 :{//列番号:数値
				'naturalNumber':{
					'req':false,
					'msg':'数値を入力してください。'}
				},


			2 :{//列番号:自然数
				'numeric':{
					'req':false,
					'msg':'自然数を入力してください。'}
				},

			3 :{//列番号:日付
				'date':{
					'req':false,
					'msg':'日付で入力してください。'}
				}
		};

	return validates;
}


/**
 * 更新
 */
function on_update(){

	var data=getDataFromTbl();//HTMLからデータを取得。

	var url='update.php';


	$.post(
	url ,
	{"data" : data} ,
		function(res){

			if(res=='success'){
				$('#tbl1 tbody tr').attr('changed','false');
				alert('success');//■■■□□□■■■□□□■■■□□□)

			}else{
				alert('更新失敗しました。');//■■■□□□■■■□□□■■■□□□)
			}





		}
	);

}


//テーブルからデータを取得。
//changedがtrueになっている行のみ。（修正された行のみ取得）
function getDataFromTbl(){

    var data = [];
    var i2=0;
    $('#tbl1 tbody tr').each(function(i) {

    	var chd=$(this).attr('changed');

    	if (chd=='true'){
	        data[i2] = [];
	        $('td', $(this)).each(function(j) {
	        	var v=$('input', $(this)).val();
	            data[i2][j] = v;
	        });
	        i2++;
    	}

    });


    return data;

}

