
var zipSubdiv;

$(function(){
	zipSubdiv = new ZipSubdiv({
		'cmp_ajax_url':'test.php',
		'prog_bar_slt':'#prog1',
		'size_limit':8000, // 容量制限
		'subroot':'photos/travel/yonaha_2017', // サブルートパス
		'zip_tmp_fn':'dummy/zip_test', // ZIPひな型ファイル名
		'zip_subroot':'/sample/js/a005/zip_subdiv/zip_test', // ZIPサブルートパス
	});
});



function test1(){
	var fns = [
		'thum/2017-05-02_095050_DSC_0001.jpg',
		'thum/2017-05-02_103605_DSC_0002.jpg',
		'thum/2017-05-02_121437_DSC_0004.jpg',
		'thum/2017-05-02_124335_DSC_0005.jpg',
		'thum/2017-05-02_125548_DSC_0007.jpg',
	];
	

	zipSubdiv.compression(fns,callbackInter,callbackEnd);
	
}

function callbackInter(dataset){
	console.log('中間コールバック');
}

function callbackEnd(dataset){
	console.log('終了コールバック');
}