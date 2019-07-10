
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
	
});


function test1(){
	jQuery('#err').html('');
	
	// 住所、地名、ランドマークなどを入力
	var address_text = jQuery('#address_text').val();

	// 住所、地名、ランドマークなどから正規住所、プレースID、緯度経度を取得する
	var geocoder = new google.maps.Geocoder();  //ジオコーディングのインスタンスの生成
	geocoder.geocode({address: address_text}, (results, status) => {
		if (status === 'OK' && results[0]){
				var result = results[0];
	
				// 地図を住所の位置へ移動させる
				map.setCenter(result.geometry.location);
				
				// マーカーを住所の位置へ移動させる
				marker.setPosition(result.geometry.location)
				
				// 正規住所
				jQuery('#full_address').html(result.formatted_address);
				
				// プレースID
				jQuery('#place_id').html('プレースID:' + result.place_id);
				
				// 緯度経度
				var lat = result.geometry.location.lat();
				var lng = result.geometry.location.lng();
				jQuery('#lat_lng').html(lat + ', ' + lng);
				

			}else{
				jQuery('#err').html('失敗:' + status);
			}
		}); 
	
}