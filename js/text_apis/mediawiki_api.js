/**
 * WikipediaのAPI | MediaWiki API
 * 
 * @date 2016-5-31
 */
function test1(){

	var text1 = $('#text1').val();
	
	$('#btn1').hide();
	
	var data = {
			"titles":text1,
			"format":"json",
		};
	
    var url="http://ja.wikipedia.org/w/api.php?action=query&export";

	//☆AJAX非同期通信
	$.ajax({
		url: url,
		data: data,
		cache: false,
		dataType: "jsonp",
		success: function(json, type) {
			$('#res').html('NULL');
			
			var xmlDoc = json['query']['export']['*'];
			console.log(xmlDoc);
			
			var xml = $(xmlDoc);

			var page = xml.find('text').html();
			$('#res').html(page);
			
			$('#btn1').show();

		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			$('#res').html(xmlHttpRequest.responseText);
			
		}
	});
}
