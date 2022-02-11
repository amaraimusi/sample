
var modalCat;
$(()=>{
	
	modalCat = new ModalCat();
	modalCat.modalize('sample_modal', {
		width_rate:85,
		closeBackCallback:closeBack,
		});
	
});

function openModal(){
	modalCat.open();
}

function closeModal(){
	modalCat.close();
}

/**
* 背景が閉じられたときに実行するコールバック関数
*　Callback function to execute when the background is closed
*/
function closeBack(){
	$('#res1').append('背景クリックでモーダルが閉じられました。');
}
	

res1