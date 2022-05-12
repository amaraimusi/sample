
function test1(){
	$('#res').html('abc');
	fetch("./backend.php")
	  .then(response => {
		console.log('response');
		console.log(response);
		return response.json();
	  })
	  .then(data => {
		console.log('data');
		console.log(data);
		$('#res').html(JSON.stringify(data));
	  })
	  .catch(error => {
		console.log(error);
		console.log("失敗しました");
	});

}