
let g_popupLion;
$(()=>{

	g_popupLion = new PopupLion();
	
	g_popupLion.releasePopup();
	
});

// ポップアップを追加する
function addPopupCat(cat_name, cat_age){
	let data = [
		{'jq_slt':'#cat_name','value':cat_name},
		{'jq_slt':'#cat_age','value':cat_age},
	];
	g_popupLion.addPopup('example1', data);
}


function addPopupDog(dog_name, smell){
	let data = [
		{'jq_slt':'#dog_name','value':dog_name},
		{'jq_slt':'.smell','value':smell},
	];

	g_popupLion.addPopup('example2', data);
}

// ポップアップをリリースする
function releasePopup(){
	g_popupLion.releasePopup();
	
}