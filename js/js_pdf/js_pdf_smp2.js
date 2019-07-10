/**
 * jsPDF サンプル1
 */


/**
 * プレビューを表示する
 */
function showPreview(){
	
	var text = $('#ta1').val();
	
	text = text.replace(/\r\n|\r|\n/g,'<br>');
	
	
	$('#preview1').html(text);
	
	
	$('#edit_btn').show();
	$('#pdf_btn').show();
	$('#preview1').show();
	$('#prv_btn').hide();
	$('#edit1').hide();
	
}

/**
 * エディタを表示する
 */
function showEditor(){
	$('#edit_btn').hide();
	$('#pdf_btn').hide();
	$('#preview1').hide();
	$('#prv_btn').show();
	$('#edit1').show();
}


function showPdf(){
	

	html2canvas(document.getElementById("preview1"), {
        onrendered: function (canvas) {
            var dataURI = canvas.toDataURL("image/jpeg");
 
            var pdf = new jsPDF();
            pdf.addImage(dataURI, 'JPEG', 0, 0);
            var renderString = pdf.output("datauristring");
            $("iframe").attr("src", renderString);
        }
    });   
	
}