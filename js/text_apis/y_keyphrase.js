/**
 * Yahooキーフレーズ
 * 
 * @date 2016-5-30
 */

function test1(){

	var text1 = $('#text1').val();
	
    var data = {
        "appid":"dj0zaiZpPWd6eTVxV2pPS0xwTSZzPWNvbnN1bWVyc2VjcmV0Jng9YjQ-",
        "sentence":text1,
        "output":"json",
        "max-result":10,
      };
	
    var url="http://jlp.yahooapis.jp/KeyphraseService/V1/extract";

	//☆AJAX非同期通信
	$.ajax({
		url: url,
		data: data,
		cache: false,
		dataType: "jsonp",
		success: function(str_json, type) {
			console.log(str_json);
			
		},
		error: function(xmlHttpRequest, textStatus, errorThrown){
			$('#res').html(xmlHttpRequest.responseText);
			
		}
	});
}