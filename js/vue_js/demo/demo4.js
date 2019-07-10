/**
 * デモ1:簡素な位置表示 | v-forの使い方
 */

window.onload = function() {

	var clms = {
			id: 'ID',
			name: '動物名',
			code: 'コード',
		};
		
	var cities = [
		{id:100,name:'リュウキュウコノハズク',code:'test_a'},
		{id:101,name:'ヤンバルクイナ',code:'test_b'},
		{id:102,name:'リュウキュウアオバト',code:'test_c'},
		{id:103,name:'オオコウモリ',code:'test_d'},
	];
	
	var addData = {name:'',code:''}; // 新規追加データの初期化
	
	var sortOrders = [];// 順序データ
	for(var key in clms){
		sortOrders[key] = 1;
	}

	var app2 = new Vue({
			el: '#app-2',
			data: {
				clms:clms,
				cities: cities,// 一覧データ
				addData:addData,
				sortOrders: sortOrders,
				search_word: '', // 検索ワード
				edit_index:0, // 編集インデックス
			},
			methods: {
				
				// 列名クリックイベント：一覧をソートする
				sort: function(sortKey) {
					sortData(this,sortKey); // 一覧ソート機能:データを並べ替える
				},
				
				// 編集ボックスを表示する
				editShow: function(event,edit_index){
					
					event.stopPropagation(); // 外側クリックイベントを止める（windowクリックイベントを止める）
					
					// 編集ボタンの下に編集ボックスを表示する
					showBox(event,"edit_box",{'margin_left':-40});
					
					// 編集ボックスのパラメータと一覧データを関連づける。
					this.edit_index = edit_index;
				},
				
				// 新規追加ボックスを表示する
				showAdd: function(event){
					
					event.stopPropagation(); // 外側クリックイベントを止める（windowクリックイベントを止める）

					// 追加ボタンの下に新規入力ボックスを表示する
					showBox(event,"add_box",{'margin_left':-40});
					
				},
				
				// 新規追加ボックスの登録ボタン
				addReg: function(){
					
					var addData = this.addData;
					this.cities.push({id:99,name:addData.name,code:addData.code});
				},
				
				// 削除アクション
				deleteAction: function(index){
					this.cities.splice(index,1);
				}
			},
			
			computed: {
				// 簡易検索
				filteredData: function () {
					return filterData(this); // 簡易検索機能 | データのフィルタリングを行う
				}
			}
			
		});
	
	
	var add_box = document.getElementById('add_box');
	add_box.addEventListener('click',function(){
		event.stopPropagation(); // 外側クリックイベントを止める（windowクリックイベントを止める）
	});
	var edit_box = document.getElementById('edit_box');
	edit_box.addEventListener('click',function(){
		event.stopPropagation(); // 外側クリックイベントを止める（windowクリックイベントを止める）
	});
	
	// 外側クリックイベント | 外側クリックでラベル表示状態に戻す
	window.addEventListener('click',function(){
		
		var add_box = document.getElementById('add_box');
		if(add_box.style.display != 'none'){
			add_box.style.display = 'none';
		}
		
		var edit_box = document.getElementById('edit_box');
		if(edit_box.style.display != 'none'){
			edit_box.style.display = 'none';
		}
	});
}



/**
 * トリガー要素の下にボックスを表示する
 * @param trgEvent トリガー要素のイベント
 * @param box_id ボックス要素のid属性名
 * @param option
 * - margin_left ボックス要素の左調整幅
 * - margin_top ボックス要素の上調整幅
 * 
 */
function showBox(trgEvent,box_id,option){
	
	// オプションに未指定プロパティがあれば、デフォルトをセットする
	if(option == null) option = {};
	if(option['margin_left'] == null) option['margin_left'] = 40;
	if(option['margin_top'] == null) option['margin_top'] = 0;
	
	// 位置矩形情報を取得する
	var trgElm = trgEvent.target;
	var offset = getOffset(trgElm);
	
	// ボックスの位置を算出
	var left = offset.left + option.margin_left;
	var top = offset.top + offset.height + option.margin_top;

	// ボックスに位置などの各種パラメータをセットする
	var box = document.getElementById(box_id);
	box.style.display='inline-block';
	box.style.position='absolute';
	box.style.left = left + 'px';
	box.style.top = top + 'px';
}


/**
 * 位置矩形情報を取得する
 */
function getOffset(elm){

	var rect = elm.getBoundingClientRect();
	
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	var myTop = rect.top + scrollTop;
	
	var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
	var myLeft = rect.left + scrollLeft;
	
	return {
		top:myTop,
		left:myLeft,
		width:rect.width,
		height:rect.height,
	}
}

/**
 * 一覧ソート機能:データを並べ替える
 * @param vue vueオブジェクト
 * @param sortKey ソートキー
 */
function sortData(vue,sortKey){
	// 並び順の切替（昇順、降順を切り替える）
	vue.sortOrders[sortKey] = vue.sortOrders[sortKey] * -1;

	var data = vue.cities;
	var order = vue.sortOrders[sortKey];

	// 並べ替え処理
	data = data.slice().sort(function(a, b){
		a = a[sortKey];
		b = b[sortKey];
		return (a === b ? 0 : a > b ? 1 : -1) * order;
	});
	
	vue.cities = data; // データを更新。更新しないと一覧に反映されない。
}

/**
 * 簡易検索機能 | データのフィルタリングを行う
 * @param vue vueオブジェクト
 */
function filterData(vue){
	var data = vue.cities; // 元データに影響を与えないようdataにクローンコピーする。
	var filterWord = vue.search_word.toLowerCase(); // 検索ワードを取得する。（テキストボックスと連動されている）
	if(filterWord) {
		// dataに対し、検索ワードで絞り込みを行う。全列が検索対象。
		data = data.filter(function (row) {
			return Object.keys(row).some(function (key) {
				return String(row[key]).toLowerCase().indexOf(filterWord) > -1
			})
		})
	}
	return data;
}

