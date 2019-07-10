/**
 * izumi1.htmlのJS
 */

var m_mode=0; //1:手動モード , 2:自動モード
var m_data;
var big_map;//大地図
var m_map;//主地図
var m_old_rect=null;//スクウェア
var latLngUnitDist={17:{'lat_dist':0.004794471307061343,'lng_dist':0.005364418029785156}};
var m_moveDireLists;//移動方向リスト 1:下 2:右 3:左
var m_move_index;	//移動インデックス
var m_move_cnt;		//移動数：

var Marker;
var m_latLngs={};
var m_latLngIndex=0

$( function() {

	init_m_data();//m_dataの初期化

	init_big_map();//大地図を初期化



	notify_base_form();////基本フォームへm_dataを反映


});

//m_dataの初期化
function init_m_data(){


	//ローカルストレージからm_dataを取り出す。空であるならデフォルト
	var j_m_data=localStorage.getItem("m_data_izumi1");
	if(j_m_data == null){
		m_data=get_def_m_data();//デフォルトを取得
	}else{
		m_data = JSON.parse(j_m_data);

	}




}

//デフォルトm_dataを取得
function get_def_m_data(){
	var m_data={};
	m_data['mm_width']=500;
	m_data['mm_height']=500;
	m_data['mm_lat']=26.651139717347082;
	m_data['mm_lng']=127.94837594032288;
	m_data['cc_cnt_x']=5;
	m_data['cc_cnt_y']=5;
	m_data['cc_rate']=0.5;
	m_data['i_x']=0;
	m_data['i_y']=0;

	return m_data;
}



//基本フォームへm_dataを反映
function notify_base_form(){



	$("#v_mm_width").html(m_data.mm_width);
	$("#v_mm_height").html(m_data.mm_height);
	$("#v_mm_lat").html(m_data.mm_lat);
	$("#v_mm_lng").html(m_data.mm_lng);
	$("#v_cc_cnt_x").html(m_data.cc_cnt_x);
	$("#v_cc_cnt_y").html(m_data.cc_cnt_y);
	$("#v_cc_rate").html(m_data.cc_rate);

	$("#i_cc_cnt_x").val(m_data.cc_cnt_x);
	$("#i_cc_cnt_y").val(m_data.cc_cnt_y);
	$("#i_cc_rate").val(m_data.cc_rate);

}





//大地図を初期化
function init_big_map(){
	var latlng = new google.maps.LatLng(m_data.mm_lat,m_data.mm_lng);
	var opts = {
		zoom: 14,//ズーム
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scaleControl: true,//スケール表示
	};
	big_map = new google.maps.Map(document.getElementById("big_map"), opts);

	google.maps.event.addListener(big_map, 'click',
		function(event) {


			drawSquare(event.latLng);//大地図上にスクウェアを描画

			notify_base_form();//基本フォームへm_dataを反映


	});




}



//主地図を初期化
function init_m_map(){
	var latlng = new google.maps.LatLng(m_data.mm_lat,m_data.mm_lng);
	var MY_MAPTYPE_ID="local_load_style";
	var opts = {
		zoom: 17,//ズーム
		center: latlng,
		scaleControl: false,//スケール無効化
		scrollwheel: false,		//マウスホイールによる拡大縮小を無効化
		draggable: false,//ドラッグ移動を無効化
		disableDoubleClickZoom:true,//ダブルクリックズームを無効
		panControl:false,//移動コントロールを無効化
		zoomControl:false,//拡大縮小バーを無効化
		mapTypeControl:false,//航空写真切替を無効化
		streetViewControl:false,//ストリートビューを無効化
		//mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeId: MY_MAPTYPE_ID,
		mapTypeControlOptions: {
		      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
		    },
	};
	m_map = new google.maps.Map(document.getElementById("gmap"), opts);

	//道路に色を付ける設定
	var featureOpts=[
				        {
				            "featureType": "road.local",
				            "stylers": [
				              { "color": "#408080" }
				            ]
				          },
				        {
				            "featureType": "road.arterial",
				            "stylers": [
				              { "color": "#0030ff" }
				            ]
				          },

				        ];


//	Feature type:	road.arterial
//	Element type:	all
//	Color:	#0030ff
//	Hue:	#1900ff

	var customMapType = new google.maps.StyledMapType(featureOpts, null);
	m_map.mapTypes.set(MY_MAPTYPE_ID, customMapType);


	//主地図・読込完了イベント
	google.maps.event.addListener(m_map, 'idle', function(){

		readMMapForAuto();//自動生成用の主地図・読込完了処理


	});


}


//大地図上にスクウェアを描画
function drawSquare(clickLatLng){


	var leftTopLat=clickLatLng.lat();
	var leftTopLng=clickLatLng.lng();



	var latLngDist=latLngUnitDist[17];//単位距離 スケール:17,サイズ：500×500
	var rightBottomLat=leftTopLat - (latLngDist.lat_dist * m_data.cc_cnt_y);
	var rightBottomLng=leftTopLng + (latLngDist.lng_dist * m_data.cc_cnt_x);


    // 四角の左上・右下の座標
    var leftTopPos = new google.maps.LatLng(leftTopLat, leftTopLng);
    var rightBottomPos = new google.maps.LatLng(rightBottomLat, rightBottomLng);


    // 四角の座標
    var rectPos = new google.maps.LatLngBounds(leftTopPos, rightBottomPos);

    // 四角のオプションを設定
    var rectOptions = {
        bounds: rectPos,
        strokeWeight: 3,
        strokeColor: "#000055",
        strokeOpacity: 0.5,
        fillColor: "#c7d8fa",
        fillOpacity: 0.5
    };

    if(m_old_rect!=null){
    	m_old_rect.setMap(null);
    }
    var rect = new google.maps.Rectangle(rectOptions);
    rect.setMap(big_map);
    m_old_rect=rect;


    //m_dataを更新。主地図と連動用
	m_data.mm_lat=leftTopLat -  (latLngDist.lat_dist / 2);
	m_data.mm_lng=leftTopLng +  (latLngDist.lng_dist / 2);




}




//横数変更イベント
function chg_cc_cnt_x(){

	var v=$("#i_cc_cnt_x").val();

	$("#v_cc_cnt_x").html(v);//ラベルに表示
	m_data.cc_cnt_x=v;
}

//縦数変更イベント
function chg_cc_cnt_y(){

	var v=$("#i_cc_cnt_y").val();

	$("#v_cc_cnt_y").html(v);//ラベルに表示
	m_data.cc_cnt_y=v;
}

//倍率変更イベント
function chg_cc_rate(){

	var v=$("#i_cc_rate").val();

	$("#v_cc_rate").html(v);//ラベルに表示
	m_data.cc_rate=v;
}

//設定保存ボタン
function save_form(){

	//m_dataをJSON文字列に変換してから、ローカルストレージに保存する。
	var j_m_data = JSON.stringify(m_data);
	localStorage.setItem("m_data_izumi1",j_m_data);

}

//設定を初期に戻すボタン
function default_form(){

	m_data=get_def_m_data();//デフォルトを取得

	init_big_map();//大地図を初期化

	notify_base_form();//基本フォームへm_dataを反映

	localStorage.removeItem("m_data_izumi1");//ローカルストレージをクリア
}






function geoDistance(lat1, lng1, lat2, lng2, precision) {
	  // 引数　precision は小数点以下の桁数（距離の精度）
	  var distance = 0;
	  if ((Math.abs(lat1 - lat2) < 0.00001) && (Math.abs(lng1 - lng2) < 0.00001)) {
	    distance = 0;
	  } else {
	    lat1 = lat1 * Math.PI / 180;
	    lng1 = lng1 * Math.PI / 180;
	    lat2 = lat2 * Math.PI / 180;
	    lng2 = lng2 * Math.PI / 180;

	    var A = 6378140;
	    var B = 6356755;
	    var F = (A - B) / A;

	    var P1 = Math.atan((B / A) * Math.tan(lat1));
	    var P2 = Math.atan((B / A) * Math.tan(lat2));

	    var X = Math.acos(Math.sin(P1) * Math.sin(P2) + Math.cos(P1) * Math.cos(P2) * Math.cos(lng1 - lng2));
	    var L = (F / 8) * ((Math.sin(X) - X) * Math.pow((Math.sin(P1) + Math.sin(P2)), 2) / Math.pow(Math.cos(X / 2), 2) - (Math.sin(X) - X) * Math.pow(Math.sin(P1) - Math.sin(P2), 2) / Math.pow(Math.sin(X), 2));

	    distance = A * (X + L);
	    var decimal_no = Math.pow(10, precision);
	    distance = Math.round(decimal_no * distance / 1) / decimal_no;   // kmに変換するときは(1000で割る)
	  }
	  return distance;
}


/**
 * 連想配列オブジェクトからテーブルHTMLを生成する。
 * キーをヘッダーの名前に利用する。
 * @param hash 連想配列オブジェクト
 * @return テーブルHTML
 */
function createTbl_hash(hash){


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


function top_move(){


	var latlngBounds = m_map.getBounds();//北東座標を取得
	var neLatlng = latlngBounds.getNorthEast();
	var ne_lat = neLatlng.lat();

	var latLng = m_map.getCenter();//現在の中心座標を取得。
	var c_lat = latLng.lat();

	var lng = latLng.lng();

	var lat=c_lat + (ne_lat-c_lat) * 2;

	var latlng =new google.maps.LatLng(lat,lng)

	m_map.panTo(latlng);

	m_data.mm_lat=lat;
	m_data.mm_lng=lng;
	m_data.i_y--;

	allow_btn_disabled()//矢印の有無切替
}

function right_move(){

	var latlngBounds = m_map.getBounds();//北東座標を取得
	var neLatlng = latlngBounds.getNorthEast();
	var ne_lng = neLatlng.lng();

	var latLng = m_map.getCenter();//現在の中心座標を取得。
	var lat = latLng.lat();
	var c_lng = latLng.lng();



	var lng=c_lng + (ne_lng-c_lng) * 2;

	var latlng =new google.maps.LatLng(lat,lng)

	m_map.panTo(latlng);


	m_data.mm_lat=lat;
	m_data.mm_lng=lng;
	m_data.i_x++;

	allow_btn_disabled()//矢印の有無切替
}

function bottom_move(){


	var latlngBounds = m_map.getBounds();//南西座標を取得
	var swLatlng = latlngBounds.getSouthWest();
	var sw_lat = swLatlng.lat();



	var latLng = m_map.getCenter();//現在の中心座標を取得。
	var c_lat = latLng.lat();


	var lng = latLng.lng();

	var lat=c_lat + (sw_lat - c_lat) * 2;

	var latlng =new google.maps.LatLng(lat,lng)

	m_map.panTo(latlng);


	m_data.mm_lat=lat;
	m_data.mm_lng=lng;
	m_data.i_y++;

	allow_btn_disabled()//矢印の有無切替
}

function left_move(){


	var latlngBounds = m_map.getBounds();//南西座標を取得
	var swLatlng = latlngBounds.getSouthWest();
	var sw_lng = swLatlng.lng();

	var latLng = m_map.getCenter();//現在の中心座標を取得。
	var lat = latLng.lat();
	var c_lng = latLng.lng();

	var lng=c_lng + (sw_lng-c_lng) * 2;

	var latlng =new google.maps.LatLng(lat,lng)

	m_map.panTo(latlng);


	m_data.mm_lat=lat;
	m_data.mm_lng=lng;
	m_data.i_x--;

	allow_btn_disabled()//矢印の有無切替
}

//矢印の有無切替
function allow_btn_disabled(){

	$("#arrow_top").prop('disabled','');
	$("#arrow_right").prop('disabled','');
	$("#arrow_bottom").prop('disabled','');
	$("#arrow_left").prop('disabled','');


	if(m_data.i_x==0){
		$("#arrow_left").prop('disabled','disabled');
	}
	if(m_data.i_x==m_data.cc_cnt_x){
		$("#arrow_right").prop('disabled','disabled');
	}
	if(m_data.i_y==0){
		$("#arrow_top").prop('disabled','disabled');
	}
	if(m_data.i_y==m_data.cc_cnt_y){
		$("#arrow_bottom").prop('disabled','disabled');
	}


}


function download_btn(){


	var latLng = m_map.getCenter();//現在の中心座標を取得。
	var lat = latLng.lat();
	var lng = latLng.lng();



	var gmap_url = GMaps.staticMapURL({
		  size: [500, 500],
		  zoom: 17,
		  lat: lat,
		  lng: lng,

		});


//	console.log(url);//■■■□□□■■■□□□■■■□□□)
//	//$('<img/>').attr('src', url).appendTo('#gmap_static');
//	$("#img1").attr('src', url);
//
//	var cvs = $('#cvs1')[0];
//	var ctx = cvs.getContext('2d');
//
//
////	var img1 = new Image();
////	img1.src=$("#img1").attr('src');
////	img1.src=url;
//
//	var img1=$("#img1")[0];
//
//	//var x=m_cnt_x * 200;
//
//	ctx.drawImage(img1, 0, 0);

	//alert(url);//■■■□□□■■■□□□■■■□□□)

	//m_cnt_x++;

	//$('<img/>').attr('src', url).appendTo('#gmap_static');


	//サーバーサイドURL
	var url='php/save_gmap_to_myserver.php';

	//サンプルデータ
	var ary=new Array();
	ary[0]=gmap_url;


	$.post(
	url ,
	{"ary" : ary} ,
		function(msg){


			var date = new Date();
			var ms=date.getTime();

			console.log(ms);//■■■□□□■■■□□□■■■□□□)
			//一時イメージを表示
			$("#img1").attr('src',"php/img/temp.png?ms=" + ms);


			//キャンバスからコンテキストを作成
			var cvs = $('#cvs1')[0];
			var ctx = cvs.getContext('2d');


			//イメージオブジェクトを取得
			//			var img1 = new Image();
			//			img1.src=$("#img1").attr('src');
			//			img1.src=url;
			var img1=$("#img1")[0];


			//コンテキストにイメージオブジェクトの画像をコピー
			ctx.drawImage(img1, 0, 0);


		}
	).error(function() {//PHP側で何らかのバグ発生。存在しないURLを指定したりすると発生。

		alert('サーバーサイドのエラー');
	});




}







function test1(){

	//一時イメージを表示
	$("#img1").attr('src',"php/img/temp.png");


	//キャンバスからコンテキストを作成
	var cvs = $('#cvs1')[0];
	var ctx = cvs.getContext('2d');


	//イメージオブジェクトを取得
	//			var img1 = new Image();
	//			img1.src=$("#img1").attr('src');
	//			img1.src=url;
	var img1=$("#img1")[0];

	//コンテキストにイメージオブジェクトの画像をコピー
	ctx.drawImage(img1, 0, 0);
}


//初期化
function init(){

	m_data['cc_cnt_x']=$("#i_cc_cnt_x").val();
	m_data['cc_cnt_y']=$("#i_cc_cnt_y").val();
	m_data['cc_rate']=$("#i_cc_rate").val();
	m_data['i_x']=0;
	m_data['i_y']=0;

	//キャンバスサイズを変更
	var cvs_width=m_data.mm_width * m_data.cc_rate * m_data.cc_cnt_x;
	var cvs_height=m_data.mm_height * m_data.cc_rate * m_data.cc_cnt_y;
	$("#cvs1").attr('width',cvs_width);
	$("#cvs1").attr('height',cvs_height);

	init_m_map();// 主地図を初期化

}



//手動ボタン
function manual_btn(){

	$("#gmap").show();// 主地図を表示する。

	init();//初期化

	allow_btn_disabled()//矢印の有無切替

	$("#funcs").hide();				// 機能項目を非表示
	$("#base_form input").hide();	// 基本フォームのinput系を非表示
	$("#manual").show();			// 手動項目を表示する。


	m_mode=1;// モードフラグを手動にする。

	testLatLngDist();//■■■□□□■■■□□□■■■□□□

}

//手動・地図写しボタン
function manual_map_copy_btn(){
	$("#manual").hide();	// 手動項目を隠す
	$("#loading").show();	// ロード画像を表示

	//地図写関数をコールバック関数を指定して呼び出す。
	mapCopy(function(){

		$("#manual").show();	// 手動項目を表示
		$("#loading").hide();	// ロード画像を隠す

	});


}

//地図をキャンバスに写す。
function mapCopy(callback){

	var lat = m_data.mm_lat;
	var lng = m_data.mm_lng;



	var gmap_url = GMaps.staticMapURL({
		  size: [m_data.mm_width, m_data.mm_height],
		  zoom: 17,
		  lat: lat,
		  lng: lng,

		  //道路に色を付ける設定
		  styles:[
			        {
			            "featureType": "road.local",
			            "stylers": [
			              { "color": "#408080" }
			            ]
			          },
			        {
			            "featureType": "road.arterial",
			            "stylers": [
			              { "color": "#0030ff" }
			            ]
			          },

			        ],

		});

	//サーバーサイドURL
	var url='php/save_gmap_to_myserver.php';

	//サンプルデータ
	var ary=new Array();
	ary[0]=gmap_url;


	$.post(
	url ,
	{"ary" : ary} ,
		function(msg){

			//キャンバスからコンテキストを作成
			var cvs = $('#cvs1')[0];
			var ctx = cvs.getContext('2d');

			//位置とコピー幅の算出
			var w=m_data.mm_width * m_data.cc_rate;
			var h=m_data.mm_height * m_data.cc_rate;
			var x=w * m_data.i_x;
			var y=h * m_data.i_y;

			//キャンバスへ写す処理。
			var date = new Date();
			var ms=date.getTime();
			var img1=new Image();
			img1.src="php/img/temp.png?ms=" + ms;
			img1.onload=function(){

				ctx.drawImage(img1, x, y,w,h);//コンテキストにイメージオブジェクトの画像をコピー
			}



			callback();//コールバック関数を実行

		}
	).error(function() {

		alert('サーバーサイドのエラー');
	});





}

//手動閉じるボタン
function manual_close(){

	$("#funcs").show();				// 機能項目を表示
	$("#base_form input").show();	// 基本フォームのinput系を表示
	$("#manual").hide();			//	手動項目を閉じる
	$("#gmap").hide();				// 主地図を隠す
}


//閉じるボタン
function close_btn(){

	$("#funcs").show();				// 機能項目を表示
	$("#base_form input").show();	// 基本フォームのinput系を表示
	$("#manual").hide();			//	手動項目を閉じる
	$("#gmap").hide();				// 主地図を隠す
}

function testLatLngDist(){
	var latlngBounds = m_map.getBounds();
	var neLatlng = latlngBounds.getNorthEast();
	var swLatlng = latlngBounds.getSouthWest();

	var latDist=swLatlng.lat()-neLatlng.lat();
	var lngDist=swLatlng.lng()-neLatlng.lng();


}

//自動ボタン
function auto_btn(){

	$("#gmap").show();// 主地図を表示する。

	init();//初期化

	m_move_index=0;	//移動インデックスの初期化

	//移動方向リストを生成
	m_moveDireLists=createMoveDireLists();
	m_move_cnt=m_moveDireLists.length;

	$("#funcs").hide();				// 機能項目を非表示
	$("#base_form input").hide();	// 基本フォームのinput系を非表示

	m_mode=2;// モードフラグを自動にする。



}

//移動方向リストを生成
function createMoveDireLists(){
	var list=[];

	var cc_cnt_x=m_data.cc_cnt_x;//横数
	var cc_cnt_y=m_data.cc_cnt_y;//縦数

	for(var i_y=0;i_y < cc_cnt_y;i_y++){
		for(var i_x=0;i_x < cc_cnt_x;i_x++){
			if(i_x==cc_cnt_x-1){
				if(i_y!=cc_cnt_y-1){//ラストループの移動は不要
					list.push(1);//下をセット
				}
			}else{
				if(i_y % 2 == 0){
					list.push(2);//右をセット
				}
				else{
					list.push(3);//左をセット
				}
			}
		}
	}

	return list;

}

//主地図の移動
function moveMMapForAuto(){
	if(m_move_index < m_move_cnt){

		var move_v=m_moveDireLists[m_move_index];
		m_move_index++;

		switch (move_v) {
		case 1://主地図を下へ移動
			bottom_move();
			break;

		case 2://主地図を右へ移動
			right_move();
			break;

		case 3://主地図を左へ移動
			left_move();
			break;

		default:
			alert('想定外の移動値です。move_v= '.move_v);
			break;
		}

	}else{


		endAuto();//自動処理終了
	}

}

//自動生成用の主地図・読込完了処理
function readMMapForAuto(){
	if(m_mode==2){

		//キャンバスへ主地図を書き写す。
		mapCopy(function(){
			//書き写し完了後。

			moveMMapForAuto();//主地図の移動
		});




	}

}

//自動処理終了
function endAuto(){
	$("#funcs").show();				// 機能項目を表示
	$("#base_form input").show();	// 基本フォームのinput系を表示
	$("#manual").hide();			//	手動項目を閉じる
	$("#gmap").hide();				// 主地図を隠す
	alert('広域詳細地図の作成完了');
}


