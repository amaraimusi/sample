/**
 *
 */
function test_run(){


	var xssList=[
	 		"https://example.com/?neko=1&yagi=2",
			"http://example.com/\"onmouseover=\"alert(1)\"",
			"http://example.com/?<script>alert('XSSテスト');</script>",
			"javascript:alert('XSS')",
			"jav	ascript:alert('XSS');",
			"color:expression(alert('XSS'));",
			"behavior:url(test.sct)",
		];

	for(var i=0;i<xssList.length;i++){
		var xss=xssList[i];
		var url=urlSanitize(xss);

		var res="<tr><td>" + sanitize_str(xss) + "</td><td>" + sanitize_str(url) + "</td></tr>";
		$("#res tbody").append(res);
	}


}

/**
 * URL用のサニタイズ
 */
function urlSanitize(str) {


	//記号「;&<>"'」をサニタイズ
	str = str.replace(/;/g, '&#059;');
    //str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, '&#39;');

    //「http:」のコロンを除く、すべてコロンをサニタイズ
    str = str.replace('http:', 'http>');
    str = str.replace('https:', 'https>');
    str = str.replace(/:/g, '&#058;');
    str = str.replace('http>', 'http:');
    str = str.replace('https>', 'https:');

    return str;
}


/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {


	//記号「;&<>",」をサニタイズ
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, '&#39;');



    return str;
}