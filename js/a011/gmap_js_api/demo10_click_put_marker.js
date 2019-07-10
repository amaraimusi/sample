
var map; // Mapsオブジェクト
var infoWindow1; // 吹き出しウィンドウ
var marker; // マーカーオブジェクト

jQuery(()=>{
	var mapElm = jQuery('#map1')

	// 地図を作成
	map = new google.maps.Map( mapElm[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: 15 ,
	});
	
	// マーカーの作成
	marker = new google.maps.Marker( {
		map: map ,
		position: new google.maps.LatLng( 26.69740142087048, 127.9333379497375 ) ,
	}) ;
	
	// アイコンを変更する
	marker.setOptions({
		icon: {
			url: 'icon/arrow_blue.png',
			scaledSize: new google.maps.Size(32, 32) // サイズ
		}
	});
	
	// 吹き出しオブジェクトの作成
	infoWindow1 = new google.maps.InfoWindow({ 
		content: '<div class="text-success">テスト<br>畑</div>'
	});
	
	// マーカーのクリックイベント
	marker.addListener('click', ()=> {
		infoWindow1.open(map, marker); // 吹き出し表示
		
	});
	
	// 地図上をクリックしたらマーカーを移動させる
	map.addListener( "click", function ( argument ) {
		
		marker.setPosition(argument.latLng);

//		var latLng = argument.latLng;
//		var lat = latLng.lat();
//		var lng = latLng.lng();
//
//		var latLng = new google.maps.LatLng( lat, lng);
//		marker.setPosition(latLng);

	}) ;
	
});