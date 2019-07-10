/**
 * 複数の非同期通信を制御する $.Deferred
 */


function test1(){
	$('#res').append('TEST<br>');
	
	$.when(
		async1(),
		async2(),
		async3()
	).done(
		function(){
			$('#res').append('すべての非同期処理を実行しました。');
		}
	).fail(function(){
		alert('非同期処理の失敗');
	})
}


function async1(){
	var dfd = $.Deferred();
	window.setTimeout(function(){
		$('#res').append("<div class='text-success'>①ネコ</div>");
		dfd.resolve();
	}, 1000);
	return dfd.promise();
}


function async2(){
	var dfd = $.Deferred();
	window.setTimeout(function(){
		$('#res').append("<div class='text-warning'>②ヤギ</div>");
		dfd.resolve();
	}, 300);
	return dfd.promise();
}


function async3(){
	var dfd = $.Deferred();
	window.setTimeout(function(){
		$('#res').append("<div class='text-danger'>③カニ</div>");
		dfd.resolve();
	}, 1200);
	return dfd.promise();
}