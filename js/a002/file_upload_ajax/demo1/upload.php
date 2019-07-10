<?php
if($_SERVER['SERVER_NAME']=='localhost'){
	// 一時ファイルをコピー
	move_uploaded_file($_FILES["fu_file1"]["tmp_name"], 'xxx/'.$_FILES["fu_file1"]["name"]);
}
echo $_FILES["fu_file1"]["name"];

?>