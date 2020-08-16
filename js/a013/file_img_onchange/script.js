
function changeImgFn(e){
	let fuElm = jQuery(e);
	
	let files = e.files;
	let oFile = files[0];
	
	// Converting from a file object to a data url scheme.Conversion process by the asynchronous.
	let reader = new FileReader();
	reader.readAsDataURL(oFile);

	// After conversion of the event.
	reader.onload = (evt) => {

		// accept属性を取得する
		let accept = fuElm.attr('accept');

		// accept属性が空もしくは画像系であるかチェックする
		if (accept == '' || accept.indexOf('image') >= 0){
			let data_url = reader.result;
			this.data_url = data_url;
			
			// IMG要素に画像を表示する
			let imgElm = jQuery("#img_fn");
			//imgElm.attr('src',reader.result);
			imgElm.attr('src', data_url);

		} 
	}
}