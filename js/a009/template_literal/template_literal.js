$(() => {
	
	var test = 'ネコ';
	var str = `
			大きな
			${test}と
			リスと\nハムスターにエサを与える。
			"'\`
	`;
	
	$('#res').html(str);
	$('#res2').html(str);
	
	
});