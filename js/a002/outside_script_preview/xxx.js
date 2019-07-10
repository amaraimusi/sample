/**
 * 
 */

	/**
	 * preview a outside script
	 * 
	 * @note 
	 * Get a Source code such as HTML and JavaScript.
	 * Then, view the got source code.
	 * 
	 * @param slt  jQuery's selector
	 * @param src  script path
	 */
	function scriptPreview(slt,src){

		$.ajax({
			url: src,
			cache: false,
			dataType: "text",
			success: function(text, type) {
				text=text.replace(/</g,'&lt;');
				text=text.replace(/>/g,'&gt;');
				$(slt).html(text);

			},
			error: function(xmlHttpRequest, textStatus, errorThrown){
				throw new Error(xmlHttpRequest.responseText);
				alert(textStatus);
			}
		});
	}