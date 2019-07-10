
var map; // Mapsオブジェクト
var infoWindow1; // 吹き出しウィンドウ
var marker; // マーカーオブジェクト
var param = {};
var ranges = {}; // 範囲データ

jQuery(()=>{
	
	param['base_zoom'] = 15;
	param['zoom'] = param.base_zoom;
	
	var zoomSelectElm = jQuery('#zoom_select');
	zoomSelectElm.val(param.zoom);
	zoomSelectElm.change((evt)=>{
		var elm = jQuery(evt.currentTarget);
		var zoom = elm.val();
		param['zoom'] = zoom * 1;
		_changeZoomSelect(param);
	});

	var mapElm = jQuery('#map1');

	// 地図を作成
	map = new google.maps.Map( mapElm[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: param.zoom ,
	});
	
	// 地図表示後に1回だけ呼び出されるイベント
	google.maps.event.addListenerOnce(map, 'idle', ()=>{
		ranges[param.zoom] = _getRange(); // 座標範囲情報を取得する
		showRanges(); // 座標範囲情報を表示
	});
	
	
});

/**
 * ズームSELECTのチェンジイベント
 * @param object param
 * @returns
 */
function _changeZoomSelect(param){

	map.setZoom( param.zoom ) ;
	ranges[param.zoom] = _getRange();
	
	showRanges(); // 座標範囲情報を表示
}

/**
 * 座標範囲情報を取得する
 * @returns 座標範囲情報
 */
function _getRange(){
	
	var range = {};// 座標範囲情報
	
	// 北東座標を取得する
	var ne = map.getBounds().getNorthEast();
	range['ne'] = {
			lat:ne.lat(),
			lng:ne.lng(),
	}
	
	// 南西座標を取得する
	var sw = map.getBounds().getSouthWest();
	range['sw'] = {
			lat:sw.lat(),
			lng:sw.lng(),
	}
	
	// 北西座標を取得する
	range['nw'] = {
			lat:range.ne.lat,
			lng:range.sw.lng,
	}
	
	// 南東座標を取得する
	range['se'] = {
			lat:range.sw.lat,
			lng:range.ne.lng,
	}
	
	// 緯度範囲を取得
	range['lat_range'] = range.ne.lat - range.se.lat;
	
	// 経度範囲を取得
	range['lng_range'] = range.ne.lng - range.nw.lng;
	
	// 倍率を算出
	if(ranges[param.base_zoom] == null){
		range['lat_rate'] = 1;
		range['lng_rate'] = 1;
	}else{
		var baseRange = ranges[param.base_zoom]
		range['lat_rate'] = range.lat_range / baseRange.lat_range;
		range['lng_rate'] = range.lng_range / baseRange.lng_range;
	}

	return range;
	
}

function showRanges(){
	var html = `
		<table class='tbl2'>
			<thead><tr>
				<th>ズーム</th>
				<th>緯度範囲</th>
				<th>経度範囲</th>
				<th>緯度倍率</th>
				<th>経度倍率</th>
			</tr></thead><tbory>
		`;
	
	for(var zoom in ranges){
		var range = ranges[zoom];
		html += `
			<tr>
				<td>${zoom}</td>
				<td>${range.lat_range}</td>
				<td>${range.lng_range}</td>
				<td>${range.lat_rate}</td>
				<td>${range.lng_rate}</td>
			</tr>
		`;
	}
	
	html += "</tbody></table>";
	jQuery('#ranges_table').html(html);
}










