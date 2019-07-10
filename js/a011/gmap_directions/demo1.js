
var map; // Mapsオブジェクト
var infoWindow1; // 吹き出しウィンドウ
var marker; // マーカーオブジェクト
var marker2; // マーカーオブジェクト
var linePath; // ラインオブジェクト

jQuery(()=>{
	var mapElm = jQuery('#map1')

	// 地図を作成
	map = new google.maps.Map( mapElm[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: 13 ,
	});
	
	// マーカーの作成
	marker = new google.maps.Marker( {
		map: map ,
		position: new google.maps.LatLng( 26.69740142087048, 127.9333379497375 ) ,
	}) ;
	
	marker2 = new google.maps.Marker( {
		map: map ,
		position: new google.maps.LatLng( 26.698666640945667, 127.92767312429805 ) ,
	}) ;
	
	// アイコンを変更する
	marker.setOptions({
		icon: {
			url: 'icon/sakana.png',
			scaledSize: new google.maps.Size(32, 32) // サイズ
		}
	});
	marker2.setOptions({
		icon: {
			url: 'icon/inu.png',
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
	
	// ▼ 地図上をクリックしたらマーカーを移動、および距離、所要時間、ルートを描画する
	map.addListener( "click", function ( argument ) {
		
		jQuery('#err').html('');
		
		// マーカーの位置をクリック位置に移動する。
		marker2.setPosition(argument.latLng);

		// 開始位置を取得
		var origLatLng = marker.getPosition();
		var origin = origLatLng.lat() + ',' + origLatLng.lng();

		// 終了位置（クリック位置）を取得
		var destLatLng = marker2.getPosition();
		var destination = destLatLng.lat() + ',' + destLatLng.lng();

		// 移動方法を取得
		var travel_mode = jQuery('#travel_mode').val();
		if(travel_mode == null) return;

		// 距離やルート情報を取得する
		var directionsService = new google.maps.DirectionsService();
		var directionsRequest = {
			origin: origin,
			destination: destination,
			travelMode: google.maps.DirectionsTravelMode[travel_mode],
			unitSystem: google.maps.UnitSystem.METRIC
		};
		directionsService.route(directionsRequest, function (response, status) {
			
			if (status == google.maps.DirectionsStatus.OK) {					

				console.log('routes_count=' + response.routes.length);
				if(response.routes[0] == null){
					jQuery('#err').append('No root');
					return;
				}
				
				var route = response.routes[0];
				
				var legs = route['legs'];
				console.log('legs_count=' + legs.length);
				
				if(legs[0] == null){
					jQuery('#err').append('No root 2');
					return;
				}
				var leg = legs[0];
				
				
				// 距離：distance: {text: "3.7 km", value: 3693}
				// 時間：duration: {text: "6分", value: 342}
				var dist1 = leg.distance.text;
				var dist2 = leg.distance.value;
				var time1 = leg.duration.text;
				var time2 = leg.duration.value;
				jQuery('#dist1').html(dist1);
				jQuery('#dist2').html(dist2);
				jQuery('#time1').html(time1);
				jQuery('#time2').html(time2);
	
				// 開始住所、終了住所
				jQuery('#start_address').html(leg.start_address);
				jQuery('#end_address').html(leg.end_address);
				
				// ライン（ルート）をクリアする
				if(linePath) linePath.setMap(null);
				
				// ラインを描画する
				linePath = new google.maps.Polyline({
					path: route.overview_path,
					geodesic: true,
					strokeColor: '#FF0000',
					strokeOpacity: 0.5,
					strokeWeight: 6
				 });
				linePath.setMap(map);
				
			}
			else{
				//Error has occured
				alert(status);
				jQuery('#err').append('アクセスエラー');
				jQuery('#err').append(status);
				
			}
		});
		
	}) ;
	
});