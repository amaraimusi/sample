

jQuery(()=>{
	
	automateTextareaHeight('#textarea1');
});

// テキストエリアの高さを自動調整する。
function automateTextareaHeight(slt){

	$(slt).attr("rows", 1).on("input", e => {
		$(e.target).height(0).innerHeight(e.target.scrollHeight);
	});
}