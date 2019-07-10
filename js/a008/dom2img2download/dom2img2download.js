

function dom2img(){
	
	var element = $('#div1')[0];
	
	//DOM要素をcanvasに変換してからダウンロード
	html2canvas(element, { onrendered: function(canvas) {

		var imgData= canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
		$('#img1')[0].src = imgData;
	}});
}

function img2download(){

    var a = document.createElement('a');
    a.href = $('#img1')[0].src;;
    a.download = 'test.png';
    a.click();
}