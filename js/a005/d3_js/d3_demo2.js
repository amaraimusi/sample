/**
 * 
 */

$(function(){
	
		// データ
		var dataset = [ 100, 200, 300, 400 ];
		
		// SVGタグを作成する
		var svg = d3.select("#demo").append("svg");
		
		// SVGの幅を設定する
		svg.attr("width", 500)
			.attr("height", 450);
		
		// 矩形の基礎(rect)とデータをSVGにセットする。
		var rect = svg.selectAll(".rect1")
			.data(dataset)
			.enter()
			.append("rect");

		// 矩形へデータの値を元に位置および半径を設定していく。
		rect
			.attr('class','rect1')
			.attr("x", function(d, i) {
				return d;
			})
			.attr("y", 90)
			.attr("width", 80)
			.attr("height", 60)
			.attr("rx", 5)
			.attr("fill", 'none')
			.attr("stroke", '#8ca934')
			.attr("stroke-width", 4)
			;
		
		
		
		// 矩形の基礎(rect)とデータをSVGにセットする。
		rect = svg.selectAll(".rect2")
			.data(dataset)
			.enter()
			.append("rect");

		// 矩形へデータの値を元に位置および半径を設定していく。
		rect
			.attr('class','rect2')
			.attr("x", function(d, i) {
				return d;
			})
			.attr("y", 180)
			.attr("width", 80)
			.attr("height", 60)
			.attr("rx", 5)
			.attr("fill", 'none')
			.attr("stroke", '#8ca934')
			.attr("stroke-width", 4)
			;
		
		
		   
		   

		
});