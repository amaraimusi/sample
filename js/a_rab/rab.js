/**
 * 実験場
 */

$(()=>{
	test1();
})

function test1(){
	console.log('test=');//■■■□□□■■■□□□■■■□□□)
	

	
	

	var rect = $('#rect1');
	var padding_left = rect.css('padding-left');
	console.log(padding_left);//■■■□□□■■■□□□■■■□□□)
	console.log('--rect1--');//■■■□□□■■■□□□■■■□□□)
	console.log(rect.width());	// 88	width(100px) - padding(5px × 2) - border(1px × 2)
	console.log(rect.height());	// 88	height(100px) - padding(5px × 2) - border(1px × 2)
	console.log(rect.outerWidth());	// 100	width(100px)
	console.log(rect.outerHeight());	// 100	height(100px)
	console.log(rect[0].clientWidth);	// 81	width(100px) - スクロールバーの太さ（Chrome,FFは17px)  - border(1px × 2)
	console.log(rect[0].clientHeight);	// 81	height(100px) - スクロールバーの太さ（Chrome,FFは17px)  - border(1px × 2)
	console.log(rect[0].scrollWidth);	// 168	rect2のouterWidth(160px) + rect2のmargin-left(3px) + padding(5px) 
	console.log(rect[0].scrollHeight);	// 176	rect2のouterWidth(160px) + rect2のmargin-top(6px) + padding(5px × 2) 
	
	$('#res1-1').html(rect.width());
	$('#res1-2').html(rect.height());
	$('#res1-3').html(rect.outerWidth());
	$('#res1-4').html(rect.outerHeight());
	$('#res1-5').html(rect[0].clientWidth);
	$('#res1-6').html(rect[0].clientHeight);
	$('#res1-7').html(rect[0].scrollWidth);
	$('#res1-8').html(rect[0].scrollHeight);

	rect = $('#rect2');
	console.log('--rect2--');//■■■□□□■■■□□□■■■□□□)
	console.log(rect.width());	// 150
	console.log(rect.height());	// 150
	console.log(rect.outerWidth());	// 160
	console.log(rect.outerHeight());	// 160
	console.log(rect[0].clientWidth);	// 158
	console.log(rect[0].clientHeight);	// 158
	console.log(rect[0].scrollWidth);	// 158
	console.log(rect[0].scrollHeight);	// 158
	
	$('#res2-1').html(rect.width());
	$('#res2-2').html(rect.height());
	$('#res2-3').html(rect.outerWidth());
	$('#res2-4').html(rect.outerHeight());
	$('#res2-5').html(rect[0].clientWidth);
	$('#res2-6').html(rect[0].clientHeight);
	$('#res2-7').html(rect[0].scrollWidth);
	$('#res2-8').html(rect[0].scrollHeight);
	
	
	
	
	
}