
var modalCat;
$(()=>{
	
	modalCat = new ModalCat();
	modalCat.modalize('sample_modal', {width_rate:85});
	
});

function openModal(){
	modalCat.open();
}

function closeModal(){
	modalCat.close();
}