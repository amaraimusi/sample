$(()=>{
	// リストに追加
	$('#animal_dlist').append("<option value='赤猫'>");
});

function clickBtn1(){
	let animal_name = $('#animal_name').val();
	$('#res').html(animal_name);
}


function test1(str){
	$('#res2').append(str + '<br>');
}