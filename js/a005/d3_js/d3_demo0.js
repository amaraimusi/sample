/**
 * 
 */

$(function(){
	
		// データ
		var dataset = [ 30, 60, 90, 120 ];
		
		// SVGタグを作成する
		var svg = d3.select("#demo").append("svg");
		
		// SVGの幅を設定する
		svg.attr("width", 500)
			.attr("height", 450);
		
		// 円の基礎(circle)とデータをSVGにセットする。
		var circles = svg.selectAll("circle")
			.data(dataset)
			.enter()
			.append("circle");

		// 円へデータの値を元に位置および半径を設定していく。
		circles.attr("cx", function(d, i) {
				return d;
			})
			.attr("cy", 90)
			.attr("r", 8);

		
});