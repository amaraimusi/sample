
function test1(){
	var date1 = $('#text1').val();
	
	var dateObj = new Date(date1);
	var w_day = dateObj.getDay();
	
	$('#output1').html(w_day);
}