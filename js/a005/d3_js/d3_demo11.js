/**
 * 
 */

$(function(){
	createSvg(1);
});


function range_test(){
	var scale_rate = $('#range1').val();
	console.log('scale_rate=' + scale_rate);
	$('#demo').html('');
	createSvg(scale_rate);
	
}



function createSvg(scale_rate){

	var xScale = d3.scaleLinear()
		.domain([0, 640])
		.range([0, 640 * scale_rate]);
	
	var yScale = d3.scaleLinear()
	.domain([0, 280])
	.range([0, 280 * scale_rate]);
	
	console.log(xScale(12));
	
	
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
	svg.attr("width", xScale(640))
		.attr("height", yScale(280));


	// line変換関数： 線の配列をpathのd属性形式に変換する
	var lineArrToD = d3.line()
		.curve(d3.curveBasis)
		.x(function(d) {return xScale(d[0]);})
		.y(function(d) {return yScale(d[1]);});
	
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
		.attr('stroke-width',xScale(10))
		.attr('fill','none')
	;
		
		
}