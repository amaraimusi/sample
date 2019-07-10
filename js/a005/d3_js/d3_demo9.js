/**
 * 
 */

$(function(){
	
		// エンティティ配列のデータ
		var dataset = [
			{'x':100 , 'name':'ネコ'},
			{'x':200 , 'name':'山羊'},
			{'x':300 , 'name':'ケガニ'},
			{'x':400 , 'name':'ホホジロザメ'},
		];
		
		// SVGタグを作成する
		var svg = d3.select("#demo").append("svg");
		
		// SVGの幅を設定する
		svg.attr("width", 500)
			.attr("height", 450);
		

		// テキストメジャー： テキストの幅を取得するためのテキスト要素
		var text_measure = svg.append("text")
			.attr("id", 'text_measure');
		
		
		for(var i in dataset){
			var d = dataset[i];

			text_measure.text(d.name);
			var textSizeInfo = text_measure.node().getBBox();
			console.log(textSizeInfo);
			
		}
		

		
		
});