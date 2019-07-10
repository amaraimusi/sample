/**
 * Image file upload in BASE64 format
 * 
 * @date 2016-9-20
 */
var m_file_name;
$( function() {

	//ファイルアップロードイベント
	$('#file1').change(function(e) {
		
		var files = e.target.files;
		var oFile = files[0];
		m_file_name = oFile.name;
		
		var reader = new FileReader();
		reader.readAsDataURL(oFile);

		
		//ファイル読込成功イベント
		reader.onload = function(e) {

			// データURLスキームを取得
			var data_url_scheme = reader.result;

			// データURLスキームからbase64形式のバイナリデータに変換する
			var base64 = btoa(data_url_scheme);
			base64 = base64.replace(/^.*,/, '');
			
			// URLエンコード
			var file_name = encodeURIComponent(m_file_name);
			

			$.ajax({
				type: "POST",
				url: "file_upload_base64.php",
				data: 'base64=' + base64 + '&file_name=' + file_name,
				cache: false,
				dataType: "text",

				success: function(res, type) {
					
					$('#res').html(res);

		
				},
				
				error: function(xmlHttpRequest, textStatus, errorThrown){
					console.log(xmlHttpRequest.responseText);
					alert(textStatus);
				}
				
			});// ajax
			
			

		}// reader.onload
		

	});// $('#file1').change
	
	
});