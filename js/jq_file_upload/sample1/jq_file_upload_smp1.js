/**
 * jQuery File Upload | サンプル1
 * @date 2016-4-13
 * @auther kng_uehara
 */


	$(function () {

		var url = 'php/index.php'; // 要url変更
		$('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					$('<p/>').text(file.name).appendTo('#files');
					var msg = file.name + ':アップロード済み<br>';
					$('#res').append(msg);
				});
				
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#res').append(progress + '%<br>');
//				$('#progress .progress-bar').css(
//						'width',
//						progress + '%'
//				);
			}
		}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});