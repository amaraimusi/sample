
$(function(){

	var tree = 
		{'x':1,'y':1,'childs':[
			{'x':2,'y':1,'childs':[
				{'x':3,'y':1,'childs':[]},
			]},
			{'x':2,'y':2,'childs':[
				{'x':3,'y':1,'childs':[]},
				{'x':3,'y':2,'childs':[]},
				{'x':3,'y':3,'childs':[
					{'x':4,'y':1,'childs':[]},
				]},
			]},
		]};
	
	// ツリーデータの各ノードの子孫数を数えて、ツリーデータにセットする。
	_countDescendantsOfEachNode(tree);
	
	$('#res1').html(JSON.stringify(tree));// ダンプ出力

});


/**
 * ツリーデータの各ノードの子孫数を数えて、ツリーデータにセットする。
 * 
 * @param ツリーデータ（ノード） 参照型引数であり返り値も兼ねる。
 * @returns 内部で使うので実装側は仕様禁止
 */
function _countDescendantsOfEachNode(node){
	var childs = node['childs'];
	
	if (childs.length == 0){
		node['descend'] = 0;
		return 1;
	}else{
		var descend = 1;
		for (var i in childs){
			var cNode = childs[i];
			var c_descend = _countDescendantsOfEachNode(cNode);
			descend += c_descend;
			
		}
		node['descend'] = descend - 1;
		return descend;
	}
}
