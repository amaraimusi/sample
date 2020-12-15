
var map; // Mapsオブジェクト
var infoWindow1; // 吹き出しウィンドウ
var marker; // マーカーオブジェクト
var markerSizeElm; // アイコンサイズ・スライダ要素
var anchorPxElm; // 相対位置X・スライダ要素
var anchorPyElm; // 相対位置Y・スライダ要素

jQuery(()=>{
	var mapElm = jQuery('#map1');
	
	var markerSizeElm = jQuery('#marker_size'); // アイコンサイズ・スライダ要素
	var anchorPxElm = jQuery('#anchor_px'); // 相対位置X・スライダ要素
	var anchorPyElm = jQuery('#anchor_py'); // 相対位置Y・スライダ要素


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
			url: 'icon/sakana.png',
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
	
	
	markerSizeElm.change((evt)=>{
		changeIconOption(); // アイコンオプション変更
	});
	
	anchorPxElm.change((evt)=>{
		changeIconOption(); // アイコンオプション変更
	});
	
	anchorPyElm.change((evt)=>{
		changeIconOption(); // アイコンオプション変更
	});
	
	/**
	 * アイコンオプション変更
	 */
	function changeIconOption(){
		let marker_size = markerSizeElm.val(); // アイコンサイズ
		let anchor_px = anchorPxElm.val(); // 相対位置X
		let anchor_py = anchorPyElm.val(); // 相対位置Y
		
		marker.setIcon({
			url: 'icon/sakana.png',
			scaledSize:new google.maps.Size(marker_size, marker_size),
			anchor:new google.maps.Point(anchor_px, anchor_py),
		});
		
		jQuery('#marker_size_text').text(marker_size);
		jQuery('#anchor_px_text').text(anchor_px);
		jQuery('#anchor_py_text').text(anchor_py);
	}
	
});