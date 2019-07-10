
var m_map; // Mapsオブジェクト
var m_infoWindows = []; // 吹き出しウィンドウ
var m_markers = []; // マーカーオブジェクト

jQuery(()=>{
	var mapElm = jQuery('#map1')

	// 地図を作成
	m_map = new google.maps.Map( mapElm[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: 15 ,
	});
	
	// データ
	var data = [
		{icon:'sakana.png', hukidasi_html:"<span>テスト1</span>", lat:26.69740142, lng:127.9333379},
		{icon:'book.png', hukidasi_html:"<span>テスト2</span>", lat:26.7011587, lng:127.938874},
		{icon:'inu.png', hukidasi_html:"<span>テスト3</span>", lat:26.70100534, lng:127.9283598},
		{icon:'tatunootosigo.png', hukidasi_html:"<span>テスト4</span>", lat:26.69640457, lng:127.927244},
		{icon:'tougyu.png', hukidasi_html:"<span>テスト5</span>", lat:26.69723524, lng:127.9286671},
	];
	
	for(var i in data){
		var ent = data[i];
		
		// マーカーを作成
		var marker = new google.maps.Marker( {
			map: m_map ,
			position: new google.maps.LatLng( ent.lat, ent.lng ) ,
		}) ;
		
		// アイコンを変更する
		marker.setOptions({
			icon: {
				url: 'icon/' + ent.icon,
				scaledSize: new google.maps.Size(32, 32) // サイズ
			}
		});
		
		// 吹き出しオブジェクトの作成
		var infoWindows = new google.maps.InfoWindow({ 
			content: ent.hukidasi_html
		});
		
		m_infoWindows.push(infoWindows);
		
		m_markers.push(marker);
	}
	
	// マーカーにクリックイベントを追加
	for(var i in data){
		markerEvent(i);
	}

});


/**
 * マーカーにクリックイベントを追加
 * @param i インデックス
 */
function markerEvent(i) {
	m_markers[i].addListener('click', ()=> {
		m_infoWindows[i].open(m_map, m_markers[i]); // 吹き出しの表示
	});
}


/**
 * チェックボックスのクリックイベント
 * @param elm チェックボックス要素
 * @param i インデックス
 */
function check1(elm, i){
	var elm = jQuery(elm);
	if(elm.prop('checked')){
		m_markers[i].setVisible(true);
	}else{
		m_markers[i].setVisible(false);
	}
	
}