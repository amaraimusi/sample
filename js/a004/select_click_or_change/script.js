



$(function(){
	
	console.log('test=');//■■■□□□■■■□□□■■■□□□
	
	$('#select1').click(function(e){
		$('#res').append("<span class='text-primary'>click event</span><br>");
	});
	
	$('#select1').change(function(e){
		$('#res').append("<span class='text-danger'>change event</span><br>");
	});
});




function change_by_btn(){
	$('#select1').val(1);
}