<?php
foreach($_FILES as $key=> $fileData){
	if($_SERVER['SERVER_NAME']=='localhost'){
		// 一時ファイルをコピー
		move_uploaded_file($fileData["tmp_name"], 'xxx/'.$fileData["name"]);
	}
	echo $fileData["name"] .'<br>';
}

?>