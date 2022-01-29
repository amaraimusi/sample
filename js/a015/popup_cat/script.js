
$(()=>{
	
	$('#example1').hide();
	
	
});

function test1(){
	$('#example1').hide();
	$('#example1').fadeIn(1000, function() {
		window.setTimeout(()=>{
			console.log('xxx');//■■■□□□■■■□□□
			$('#example1').hide();
		},1000);
	});
}