
let g_popupCat;
$(()=>{

	g_popupCat = new PopupCat();
	g_popupCat.popupize('example1');
	
});

function test1(){
	
	g_popupCat.pop(()=>{
		alert('事後コールバック発動');
	});

}