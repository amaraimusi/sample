/**
 * デモ1:簡素な位置表示 | v-forの使い方
 */

window.onload = function() {

	var clms = {
			id: 'ID',
			name: '市町村名',
			code: 'コード',
		};
		
	var animals = [
		{id:5,name:'ゴリラ',code:'gorira'},
		{id:6,name:'ローランドニシゴリラ',code:'l_west_gorira'},
		{id:7,name:'ナウマンゾウ',code:'nauman-elephant'},
		{id:8,name:'ハダカネズミ',code:'hadaka-nezumi'},
	];
	
	var sortOrders = [];// 順序データ
	for(var key in clms){
		sortOrders[key] = 1;
	}

	var app2 = new Vue({
			el: '#app-2',
			data: {
				clms:clms,
				animals: animals,
				sortOrders: sortOrders,
				search_word: '', // 簡易検索
			},
			methods: {
				sort: function(sortKey) { // 列名クリックイベント：一覧をソートする
					
					// 並び順の切替（昇順、降順を切り替える）
					this.sortOrders[sortKey] = this.sortOrders[sortKey] * -1;
			
					var data = this.animals;
					var order = this.sortOrders[sortKey];
			 
					// 並べ替え処理
					data = data.slice().sort(function(a, b){
						a = a[sortKey];
						b = b[sortKey];
						return (a === b ? 0 : a > b ? 1 : -1) * order;
					});
					
					this.animals = data; // データを更新。更新しないと一覧に反映されない。
				}
			},
			
			computed: {
				filteredData: function () {
					var data = this.animals; // 元データに影響を与えないようdataにクローンコピーする。
					var filterWord = this.search_word.toLowerCase(); // 簡易検索を取得する。（テキストボックスと連動されている）
					if(filterWord) {
						// dataに対し、簡易検索で絞り込みを行う。全列が検索対象。
						data = data.filter(function (row) {
							return Object.keys(row).some(function (key) {
								return String(row[key]).toLowerCase().indexOf(filterWord) > -1
							})
						})
					}
					return data;
				}
			}
			
		});
}

