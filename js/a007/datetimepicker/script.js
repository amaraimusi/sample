$(()=>{
	
	$.datetimepicker.setLocale('ja');// 日本語化
	$('#test_date').datetimepicker({
		format:'Y-m-d H:i',
	});

});