/**
 * CSV貼付から行列データを作成する
 * 2015-11-20	新規作成
 * 
 */


function execution1(){

	var text = $('#pasting_csv').val();

	var ary = text.split(/\r\n|\r|\n/);
	
	var data=[];
	for (var i=0;i<ary.length;i++){
		var row=ary[i];
		var dd=row.split(/\t/);
		data.push(dd);
		
	}
	
	var jsonStr = JSON.stringify(data);
	$('#res').html(jsonStr);
	
	console.log(data);//■■■□□□■■■□□□■■■□□□)
}

