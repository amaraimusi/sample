

function save(){
	var text = $('#text1').val();
	localStorage.setItem("key1", text);
	$('#res').append('ローカルストレージに保存しました。<br>');
}

function read(){
	var text = localStorage.getItem("key1");
	$('#text1').val(text);
	$('#res').append('ローカルストレージから読み取りました。<br>');
}

function save2(){
	var text = $('#text1').val();
	var url = location.href; // 現在ページのURLを取得
	var url = url.split(/[?#]/)[0]; // クエリ部分を除去
	localStorage.setItem(url, text);
	$('#res').append('ローカルストレージに保存しました。【検証2】<br>');
}

function read2(){
	var url = location.href; // 現在ページのURLを取得
	var url = url.split(/[?#]/)[0]; // クエリ部分を除去
	var text = localStorage.getItem(url);
	$('#text1').val(text);
	$('#res').append('ローカルストレージから読み取りました。【検証2】<br>');
}