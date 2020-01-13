/**
 * 
 */



function test(){
	
	let latlng_str = jQuery('#test_tb').val();
	let res = _strToLatLng(latlng_str);
	if(res==null) {
		console.log('エラー');
		return;
	}
	let lat = res.lat;
	let lng = res.lng;

	_getAddrFromLatLng(lat, lng, callback1);
}

/**
 * 緯度経度文字列を緯度と経度に分割する
 * @param latlng_str 緯度経度文字列
 * @returns object 緯度経度
 */
function _strToLatLng(latlng_str){
	latlng_str=latlng_str.replace('@', '');
	let ary = latlng_str.split(',');
	if(ary.length != 2) return null;
	let lat = ary[0] + '';
	let lng = ary[1] + '';
	lat = lat.trim();
	lng = lng.trim();
	return {lat:lat, lng:lng};
	
}

function callback1(res){
	let addr = res.formatted_address;
	jQuery('#res').html(addr);
}

/**
 * 緯度経度から住所を取得する
 * 
 * @param function callback コールバック(緯度経度など）
 */
function _getAddrFromLatLng(lat, lng, callback){

	// ジオコーダーオブジェクトの生成
	if(this.geocoder == null){
		this.geocoder = new google.maps.Geocoder();  //ジオコーディングのインスタンスの生成
	}
	var geocoder = this.geocoder;
	
	let latLng = new google.maps.LatLng( lat, lng );

	// 住所から緯度経度などの情報を取得する
	geocoder.geocode({latLng: latLng}, (results, status) => {
		if (status === 'OK' && results[0]){
				var result = results[0];
	
				// 正規住所
				var formatted_address = result.formatted_address;
				
				// プレースID
				var place_id = result.place_id;
				
				// 緯度経度
				var lat = result.geometry.location.lat();
				var lng = result.geometry.location.lng();

				// レスポンスに値をセットし、レスポンスをコールバックに渡す
				var res = {
						formatted_address:formatted_address,
						place_id:place_id,
						lat:lat,
						lng:lng,
				};
				callback(res);

			}else{
				var res = {
						err:'見つかりませんでした。',
						err_status:status
				}
				callback(res);
			}
		}); 
	
}