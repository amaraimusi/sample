

jQuery(()=>{
	
	$('#textarea1').val("いろはにほへと\nちりぬのを");
	automateTextareaHeight('#textarea1');
	automateTextareaHeight('#textarea2');
	
	// ページロード時に自動フィット
    adjustTextareaHeightOnLoad('#textarea1');
    adjustTextareaHeightOnLoad('#textarea2');

});

// テキストエリアの高さを自動調整する。
function automateTextareaHeight(slt){

		let taElm = $(slt);
		
		// 文字入力した時に高さ自動調整
		taElm.attr("rows", 1).on("input", e => {
			$(e.target).height(0).innerHeight(e.target.scrollHeight);
		});
		
		// クリックしたときに自動調整
		taElm.attr("rows", 1).click("input", e => {
			$(e.target).height(0).innerHeight(e.target.scrollHeight);
		});
}

// ページロード時に高さを調整する関数
function adjustTextareaHeightOnLoad(slt) {
    let taElm = $(slt);
    taElm.height(0).innerHeight(taElm[0].scrollHeight);
}


function test1(){
		  
    adjustTextareaHeightOnLoad('#textarea1');
    adjustTextareaHeightOnLoad('#textarea2');
}