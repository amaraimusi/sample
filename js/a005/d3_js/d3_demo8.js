/**
 * 
 */

$(function(){

	// エンティティ配列のデータ
	var dataset = [
		{'lineData':[[100,100],[200,100],[300,150]] ,'color':'red'},
		{'lineData':[[100,120],[200,120],[300,170]] ,'color':'green'},
		{'lineData':[[100,140],[200,140],[300,190]] ,'color':'yellow'},
		{'lineData':[[100,160],[200,50],[300,150]] ,'color':'rgba(0,0,255,0.5)'},
	];
	

	// SVGタグを作成する
	var svg = d3.select("#demo").append("svg");
	
	// SVGの幅を設定する
	svg.attr("width", 640)
		.attr("height", 280);


	// line変換関数： 線の配列をpathのd属性形式に変換する
	var lineArrToD = d3.line()
		.curve(d3.curveBasis)
		.x(function(d) {return d[0];})
		.y(function(d) {return d[1];});
	
	// 線（path)を追加する
	var line1 = svg.selectAll(".path1")
		.data(dataset)
		.enter()
		.append("path");
	
	// 線にデータを適用する
	line1
		.attr('d',function(d, i) {
			d = lineArrToD(d.lineData);
			return d;
		})
		.attr('stroke',function(d, i) {
			return d.color;
		})
		.attr('stroke-width',10)
		.attr('fill','none')
	;
		
		
});