/**
 * BASE64をテキストファイルとしてダウンロードする
 * @date 2016-6-3
 */

$(function(){
	// canvas要素から描画コンテキストを取得する
	var canvas = document.getElementById('canvas1');
	var ctx = canvas.getContext('2d');
	
	// canvasへ適当に描画する
	ctx.beginPath();
    ctx.moveTo(10,150);
    ctx.lineTo(70,10);
    ctx.lineTo(150,150);
    ctx.lineTo(10,40);
    ctx.lineTo(140,50);
    ctx.closePath();
    ctx.stroke();
    
    // canvasからデータURLスキームを経由し、BASE64を取得する
    var mime_type = "jpeg/image";
    var data_url = canvas.toDataURL(mime_type);
    var base64 = window.btoa(data_url);
    
    console.log(base64);

})


// canvasから取得したデータURLからimg要素やダウンロードリンクが作成できるか検証する
function test1(){
	
	var canvas = document.getElementById('canvas1');
	
    // canvasからデータURLスキームを経由し、BASE64を取得する
    var mime_type = "jpeg/image";
    var data_url = canvas.toDataURL(mime_type);
    var base64 = window.btoa(data_url);
    
    // img要素にデータURLスキームをセットして、画像が表示されるか検証する。
    $('#img1').attr('src',data_url);
    
    // a要素にデータURLスキームをセットして、ダウンロードリンクが作成されるか検証する。
    $('#canvas_dl').attr('href',data_url);
    
    // BASE64を出力してみる。
    $('#base64_dump').html(base64);
    
    $('#res').show();
    

}




