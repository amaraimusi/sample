/**
 * 
 */

$(function(){
	
	// エンティティ配列のデータ
	var dataset = [
		{'x':100 , 'kind':'哺乳類',
			'subData':[
				{'index1':0 , 'animal_name':'マヤー'},
				{'index1':0 , 'animal_name':'アグー'},
				{'index1':0 , 'animal_name':'マングース'},
			],
		},
		{'x':200 , 'kind':'魚類',
			'subData':[
				{'index1':1 , 'animal_name':'グルクン'},
				{'index1':1 , 'animal_name':'アカジン'},
			],
		},
		{'x':300 , 'kind':'両生類',
			'subData':[
				{'index1':2 , 'animal_name':'イボイモリ'},
				{'index1':2 , 'animal_name':'ハナサキガエル'},
				{'index1':2 , 'animal_name':'イシカワガエル'},
				{'index1':2 , 'animal_name':'シリケンイモリ'},
			],
		},
	];
	
	// SVGタグを作成する
	var svg = d3.select("#demo").append("svg");
	
	// SVGの幅を設定する
	svg.attr("width", 500)
		.attr("height", 600);
	
	// グループ要素を作成し、データをひもづける。
	var group1 = svg.selectAll(".group1")
		.data(dataset)
		.enter()
		.append("g");
	
	// グループに矩形を追加する。
	var rect = group1.append("rect");
	
	// 矩形を設定、およびデータを適用する。
	rect
		.attr('class','rect1')
		.attr("x", function(d, i) {
			return d.x;
		})
		.attr("y", 90)
		.attr("width", 90)
		.attr("height", 120)
		.attr("rx", 5)
		.attr("fill", 'none')
		.attr("stroke", '#8ca934')
		.attr("stroke-width", 4)
		;
	
	// グループにテキストを追加する。
	var text1 = group1.append("text");
	
	// テキストの設定、およびデータを適用する。
	text1
		.attr('class','text1')
		.attr("x", function(d, i) {

			return d.x + 20;
		})
		.attr("y", 110)
		.attr("fill", 'red')
		.text(function(d, i) {
			return d.kind;
		})
		;
	
	
	// 2次元要素であるsubDataの出力
	var sub_text = group1.selectAll(".animal_name")
		.data(function(d) {return d.subData}) 
		.enter()
		.append('text');
	
	sub_text
		.attr("fill", 'blue')
		.attr("font-size", 11)
		.attr("x", function(d, i) {
			
			var row = dataset[d.index1];
			
			return row.x + 20;
		})
		.attr("y", function(d, i) {

			return (i * 20) + 140;
			
		})
		.text(function(d, i) {
			return d.animal_name;
		})
		;
			
});