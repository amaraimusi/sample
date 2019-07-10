
$(function(){
	var fileuploadsX = new FileuploadsX({
		'wrap_slt':'#file1_wrap',
		'fu_slt':'#file1',
		'prog_slt':'#prog1',
		'ajax_url':'upload_demo2.php',
		'fu_show_flg':1,
		'callback':(res) => {
					$('#res1').html(res);
				}
	});
});
