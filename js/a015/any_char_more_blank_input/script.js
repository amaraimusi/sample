
function test(){
		let err_msg = 'エラーなし';
		if(!$('#pw1')[0].checkValidity()){
			err_msg = 'パスワードは8～24文字の半角英数字で入力してください。';
		}
		$('#res').html(err_msg);
}