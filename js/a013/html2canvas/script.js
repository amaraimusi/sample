

function test0(){
	window.scrollTo(0, 0); // スクロールをリセット
	html2canvas(document.querySelector("#div1")).then(canvas => {
		document.body.appendChild(canvas)
	});
	
}

function test1(){
	window.scrollTo(0, 0); // スクロールをリセットする必要がある。
	let targetElm = jQuery("#div1");
	let w = targetElm.outerWidth();
	let h =  targetElm.outerHeight();
	
	html2canvas(targetElm[0],{width:w,height:h,scrollX:-8.5,scrollY:0}).then(canvas => {
		
		let imgElm = jQuery('#img1');
		imgElm.width(w);
		imgElm.height(h);
		imgElm[0].src = canvas.toDataURL("image/png");
		
	});

}

