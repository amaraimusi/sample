

function test1(){
	var data = {'ise-ebi':'イセエビ'};
	var json_str = JSON.stringify(data);
	
	let params = new URLSearchParams();
	params.append('key1', json_str);
	
	axios.post('server.php', params)
	.then(function (res) {
		var output = document.getElementById('res');
		if(typeof res.data == 'object'){
			output.innerHTML = JSON.stringify(res.data);
		}else{
			output.innerHTML = res.data;
		}
	})
	.catch(function (err) {
		console.log(err);
	});
}

