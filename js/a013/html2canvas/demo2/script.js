
$(()=>{
	
			app = new Vue({
				el: '#vue_app',
				data: {
					msg1: 'もはや死はなくなり，悲しみも嘆きも苦痛もなくなります。以前のものは過ぎ去ったのです。 - 聖書より',
				}
			})
})


function test1(){

	window.scrollTo(0, 0); // スクロールをリセットする必要がある。
	let targetElm = jQuery("#vue_app");
	let w = targetElm.outerWidth();
	let h =  targetElm.outerHeight();
	
			// 画像を重ねて表示しているDIV要素を取得する。
		var element = $('#div1')[0];
	
		//DOM要素を画像のバイナリデータに変換する。
		html2canvas(element,{width:w,height:h,scrollX:-8.5,scrollY:0}).then(canvas => {
			// 変換後に呼び出されるコールバック
		
			// MIMEタイプ
			var type = 'image/png';
			
			// DOM要素からバイナリの一種であるデータURLスキームに変換する
			var data_url_scheme= canvas.toDataURL(type).replace("image/png", "image/octet-stream");
	
			// データURLスキームからbase64形式のバイナリデータに変換する
			var base64 = btoa(data_url_scheme);
			base64 = base64.replace(/^.*,/, '');
			
			// ファイル名を指定
			var file_name = "demo2.png";
			file_name = encodeURIComponent(file_name);// URLエンコード
			
			// base64形式のバイナリデータをAjaxでサーバーに送信する。
			$.ajax({
				type: "POST",
				url: "upload.php",
				data: 'base64=' + base64 + '&file_name=' + file_name,
				cache: false,
				dataType: "text",
				success: function(res, type) {
					$('#res').html('サーバーへファイルを保存しました。→ '+res);
					location.reload(true);
				},
				
				error: function(xmlHttpRequest, textStatus, errorThrown){
					console.log(xmlHttpRequest.responseText);
					alert(textStatus);
				}
				
			});// ajax
	
		});
	


}