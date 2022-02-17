
var modalCat;
$(()=>{
	
	modalCat = new ModalCat();
	modalCat.modalize('sample_modal', {
		width_rate:85,
		openCallback:()=>{
			$('#res1').append('モーダルオープン・コールバック実行<br>');
		},
		closeBackCallback:()=>{
			$('#res1').append('背景クリックコールバック：背景クリックでモーダルが閉じられました。<br>');
		},
		closeCallback:()=>{
			$('#res1').append('閉じるコールバック実行<br>');
		},
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
	
