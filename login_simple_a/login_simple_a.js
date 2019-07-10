/**
 * シンプルログインA
 * ★履歴
 * 2015-8-5	新規作成
 *
 * ★仕様
 * 対象ページにシンプルなログイン機能を埋め込むことができる。
 * webstrageをログイン状態を保持しているので、ブラウザを閉じるまでは何度もログインをする必要はない。
 * ログイン情報のログはlogin_simple_a.logに記録される。
 *
 * ★使い方
 *  ログインシンプルAのインクルード
 * <script src="../../login_simple_a/login_simple_a.js"></script>
 *
 * 読込イベントに以下のコードを埋め込む。引数はlogin_simple_a.jsへのパス。
 * loginSimpleA('/sample/login_simple_a');
 *
 * 例
 * $( function() {
 *
 * 	//ログインシンプル
 * 	loginSimpleA('/sample/login_simple_a');
 * });
 *
 *
 *
 */


function loginSimpleA(location_url){

	var p_str="";
	if(sessionStorage['login_simple_a_access']==1){
		return;
	}else{
		 p_str = prompt("パスワードを入力して下さい:","");
	}




	var data={'p_str':p_str,};

	var json_str = JSON.stringify(data);//データをJSON文字列にする。

	//☆AJAX非同期通信
	$.ajax({
		type: "POST",
		url: location_url + "/login_simple_a.php",
		data: "p_str="+p_str,
		cache: false,
		dataType: "text",
		success: function(res, type) {
			console.log(res);

			if(res=='success'){

				sessionStorage['login_simple_a_access']=1;
			}else{

				location.href="../";
				
			}

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			alert('サーバーエラー');
			location.href="../";
		}
	});

}


