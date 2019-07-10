

function dom2img(){
	
	var element = $('#div1')[0];
	var html1 = element.outerHTML;
	console.log(html1);//■■■□□□■■■□□□■■■□□□)
	var elm2 = $("#div2");
	elm2.append(html1 + '<br>' + html1);

	html2canvas(elm2[0], { onrendered: function(canvas) {

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