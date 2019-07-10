/**
 * 
 */

$(function(){
	
	// エンティティ配列のデータ
	var dataset = [
		{'x':100 , 'name':'ネコ'},
		{'x':200 , 'name':'ヤギ'},
		{'x':300 , 'name':'カニ'},
		{'x':400 , 'name':'サメ'},
	];
	
	// SVGタグを作成する
	var svg = d3.select("#demo").append("svg");
	
	// SVGの幅を設定する
	svg.attr("width", 500)
		.attr("height", 450);
	
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
		.attr("width", 80)
		.attr("height", 60)
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
			return d.name;
		})
		;
		
		
});