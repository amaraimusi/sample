/**
 * 自動連番ツール
 * 
 * @version 1.0.0
 * @since 2021-8-22
 */



function execution1(){
	
	var start_num = $('#start_num').val() * 1;
	var step = $('#step').val() * 1;
	var end_num = $('#end_num').val() * 1;
	

	var hina = $('#hina').val();
	var codes=[];
	for(var i=start_num;i<=end_num;i=i+step){

		var code=hina;
		
		str1=i;
		var regexp = new RegExp('%0'  , 'g');
		code=code.replace(regexp,str1);

		code=sanitize_str(code);//サニタイズ
		codes.push(code);
		
	}
	
	var res=codes.join('<br>');
	$('#res').html(res);

}


/**
 * 一般用のサニタイズ
 */
function sanitize_str(str) {


	//記号「;&<>",」をサニタイズ
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/\t/g, '&#x0009;');
    str = str.replace(/\r\n|\r|\n/g, '<br>');

    return str;
}
