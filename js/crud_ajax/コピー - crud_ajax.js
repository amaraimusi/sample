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
    	html+=create_row(ent);//テーブルの行を生成


    }


	$("#tbl1 tbody").html(html);


	tbl_refrash();//テーブルのギミックイベントを再セット

}



//テーブルの行を生成。
function create_row(ent){
	var row="<tr>" +
	"<td><div class='no_edit'>" + ent.id + "</div></td>" +
	"<td><div class='edit'>" + ent.test_name + "</div></td>" +
	"<td><div class='edit'>" + ent.test_num + "</div></td>" +
	"<td><div class='edit'>" + ent.test_dbl + "</div></td>" +
	"<td><div class='edit'>" + ent.test_date + "</div></td>" +
	"</tr>";

	return row;
}

//テーブルのギミックイベントを再セット
function tbl_refrash(){

	//編集モードがONの場合に、入力項目をクリックすると、この行の修正フラグをONにする。
	$(".edit").click(function(event){
		if(m_editMode==1){

			var tr=$(this).parent().parent();
			alert(tr.html());//■■■□□□■■■□□□■■■□□□)
			tr.attr({'changed':'true'});

		}
	});
}



/**
 * 編集モードチェックボックスをクリック
 */
function on_edit_mode(){
	var v=$('#chk_edit_mode:checked').val();
	if(v=='on'){
		m_editMode=1;//編集モードON
		$(".edit").attr('contentEditable','true');
		$(".edit").parent().attr('style','border: 1px #d66134 solid;background-color:#fbefe62;');

		$("#new_reg_btn").hide();
		$("#update_btn").show();

	}else{
		m_editMode=1;//編集モードOFF
		$(".edit").attr('contentEditable','false');
		$(".edit").parent().attr('style','');
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

	//■■■□□□■■■□□□■■■□□□
	//	new_test_name
	//	new_test_num
	//	new_test_dbl
	//	new_test_date

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

	console.dir(data);//■■■□□□■■■□□□■■■□□□)


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
	            data[i2][j] = $(this).text();
	        });
	        i2++;
    	}

    });

    return data;

}

