/**
 * 別ページである外部HTMLからDOMを取得
 * @date 2016-7-12
 */

function test(){

	var url = "sample1.html";
	
	$.ajax({
		type: "GET",
		url: url,
		cache: false,
		dataType: "text",
		success: function(text, type) {

			var obj = $.parseHTML(text);

			var res = $(obj).find('#test2').html();
			
			console.log(res);
			$('#res').html(res);

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			
			alert(textStatus);
		}
	});
}

