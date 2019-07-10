/**
 * 
 */

$(function(){

	
	
	// エンティティ配列のデータ
	var dataset = [
		{'cp_x':0 , 'cp_y':0 , 'q_text':'アグーを知っていますか'},
		{'cp_x':1 , 'cp_y':0 , 'q_text':'アグーを食べたことはありますか？'},
		{'cp_x':1 , 'cp_y':1 , 'q_text':'アグーは何だと思いますか？'},
		{'cp_x':2 , 'cp_y':0 , 'q_text':'ご意見はありますか？'},
	];
	
	// SVGタグを作成する
	var svg = d3.select("#demo").append("svg");
	
	// SVGの幅を設定する
	svg.attr("width", 800)
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
			return d.cp_x * 200 + 100;
		})
		.attr("y", function(d, i) {
			return d.cp_y * 120 + 100;
		})
		.attr("width", 160)
		.attr("height", 80)
		.attr("rx", 5)
		.attr("fill", 'none')
		.attr("stroke", '#8ca934')
		.attr("stroke-width", 4)
		;
	

	
	
	
	// グループにテキストを追加する。
	var text1 = group1.append("text")
		.attr('class','text1')
		.attr("x", function(d, i) {
			return d.cp_x * 200 + 110;
		})
		.attr("y", function(d, i) {
			return d.cp_y * 120 + 120;
		})
		;
	
	var a1 = text1.append("a")
		.attr('xlink:href', function(d, i) {
			return 'javascript:void(0)';
		})
		.attr("onclick", "alert('test=');")
		.attr("class", "btn btn-info")
		.attr("fill", 'green')
		.text(function(d, i) {
			return d.q_text;
		})
		;
	
	
	
	
	// line変換関数： 線の配列をpathのd属性形式に変換する
	var lineArrToD = d3.line()
		.curve(d3.curveBasis)
		.x(function(d) {return d[0];})
		.y(function(d) {return d[1];});
	
	// 線（path)を追加する
	var line1 = group1.append("path")
		.attr('d',function(d, i) {
			
			var lineData = [[100,100],[200,100],[300,150]];
			d = lineArrToD(lineData);
			return d;
		})
		.attr('stroke',function(d, i) {
			return 'blue';
		})
		.attr('stroke-width',3)
		.attr('fill','none')
	;
//	
//	// エンティティ配列のデータ
//	var dataset = [
//		{'lineData':[[100,100],[200,100],[300,150]] ,'color':'red'},
//		{'lineData':[[100,120],[200,120],[300,170]] ,'color':'green'},
//		{'lineData':[[100,140],[200,140],[300,190]] ,'color':'yellow'},
//		{'lineData':[[100,160],[200,50],[300,150]] ,'color':'rgba(0,0,255,0.5)'},
//	];
//	
//
//	// SVGタグを作成する
//	var svg = d3.select("#demo").append("svg");
//	
//	// SVGの幅を設定する
//	svg.attr("width", 640)
//		.attr("height", 280);
//
//
//	// line変換関数： 線の配列をpathのd属性形式に変換する
//	var lineArrToD = d3.line()
//		.curve(d3.curveBasis)
//		.x(function(d) {return d[0];})
//		.y(function(d) {return d[1];});
//	
//	// 線（path)を追加する
//	var line1 = svg.selectAll(".path1")
//		.data(dataset)
//		.enter()
//		.append("path");
//	
//	// 線にデータを適用する
//	line1
//		.attr('d',function(d, i) {
//			d = lineArrToD(d.lineData);
//			return d;
//		})
//		.attr('stroke',function(d, i) {
//			return d.color;
//		})
//		.attr('stroke-width',10)
//		.attr('fill','none')
//	;
		
		
});