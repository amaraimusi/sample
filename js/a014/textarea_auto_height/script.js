

jQuery(()=>{
	
	automateTextareaHeight('#textarea1');
	automateTextareaHeight('#textarea2');
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