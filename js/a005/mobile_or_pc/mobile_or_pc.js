/**
 * 
 */

$(function(){
	
	// タイプ１
	var device = 'pc';
	if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
		device = 'mobile';
	}
	$('#res1').html(device);
	
	// タイプ2
	var device = 'pc';
	if (screen.width <= 480) {
		device = 'mobile';
	}
	$('#res2').html(device);
});