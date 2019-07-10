/**
 * 実験場
 */

$(()=>{
	test1();
})

function test1(){

	var rect = $('#rect1');
	$('#res1-1').html(rect.width());
	$('#res1-2').html(rect.height());
	$('#res1-3').html(rect.outerWidth());
	$('#res1-4').html(rect.outerHeight());
	$('#res1-5').html(rect[0].clientWidth);
	$('#res1-6').html(rect[0].clientHeight);
	$('#res1-7').html(rect[0].scrollWidth);
	$('#res1-8').html(rect[0].scrollHeight);

	rect = $('#rect2');
	$('#res2-1').html(rect.width());
	$('#res2-2').html(rect.height());
	$('#res2-3').html(rect.outerWidth());
	$('#res2-4').html(rect.outerHeight());
	$('#res2-5').html(rect[0].clientWidth);
	$('#res2-6').html(rect[0].clientHeight);
	$('#res2-7').html(rect[0].scrollWidth);
	$('#res2-8').html(rect[0].scrollHeight);

}