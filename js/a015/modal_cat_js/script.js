
var modalCat;
$(()=>{
	
	modalCat = new ModalCat();
	modalCat.modalize('sample_modal');
	
});

function openModal(){
	modalCat.open();
}

function closeModal(){
	modalCat.close();
}