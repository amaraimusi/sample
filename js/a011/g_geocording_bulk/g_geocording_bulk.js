
var map; // Mapsオブジェクト
var geocoder; //Google ジオコーディング
var reqBatch; // ReqBatch.js | リクエストを1件ずつ、実行するバッチ処理
var data; // データ


$(()=>{
	
	// 地図を作成
	var mapElm = jQuery('#map1');
	map = new google.maps.Map( mapElm[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: 10 ,
	});
	
	geocoder = new google.maps.Geocoder();  //ジオコーディングのインスタンスの生成
	
	reqBatch = new ReqBatch();
	reqBatch.init({
		div_xid:'req_batch_div',
		interval:300,
		fail_limit:5,
		asyn_cb:asyn_test1,
		asyn_res_cb:response1,
		complete_cb:allEnd
	})
	
});

function start(){
	
	data = _getSampleData(); // サンプルデータを取得する
	
	// バッチ処理開始
	reqBatch.start(data);
}

function _getSampleData(){
	var data = [
		{id:'1', address:'沖縄県名護市字源河１３０５ 内 源河地区会館' },
		{id:'2', address:'沖縄県名護市源河 字源河208' },
		{id:'3', address:'東京都千代田区九段南１丁目５ 九段南1－5－6 りそな九段ビル5F KSフロア' },
		];

	return data;
}



function allEnd(){
	jQuery('#res').append("<div class='text-success'>処理が終わった</div>");
	
}

/**
 * 外・非同期処理
 * @param index インデックス
 * @param ent エンティティ
 */
function asyn_test1(index, ent){
	var address = ent.address; // 住所

	geocoder.geocode({address: address}, (results, status) => {
			if (status === 'OK' && results[0]){
				var result = results[0];
				
				ent['full_address'] = result.formatted_address; // 正規住所

				ent['place_id'] = result.place_id; // プレースID
				
				// 緯度経度
				ent['lat'] = result.geometry.location.lat();
				ent['lng'] = result.geometry.location.lng();

				reqBatch.asynSuccess(ent); // 非同期処理・成功
				
			}else{
				var fail_msg = `「${address}」の緯度経度は見つかりませんでした。:` + status;
				reqBatch.asynFail(fail_msg); // 非同期処理・失敗

			}
		});
	
}


function response1(index, ent){
console.log('test=' + index);//■■■□□□■■■□□□■■■□□□)
	var tr_html = `
		<tr>
			<td>${ent.id}</td>
			<td>${ent.address}</td>
			<td>${ent.lat}</td>
			<td>${ent.lng}</td>
			<td><input type="button" onclick="showMarker(${index})" value="マーカー表示" class="btn btn-info btn-xs"></td>
		</tr>
	`;
	jQuery('#res_tbl tbody').append(tr_html);
}

/**
 * マーカーを表示する
 * @param index データのインデックス
 */
function showMarker(index){
	var ent = data[index];
	
	 var marker = new google.maps.Marker( {
		map: map ,
		position: new google.maps.LatLng( ent.lat, ent.lng ) ,
	}) ;
	
}