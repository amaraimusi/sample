<?php
if($_SERVER['SERVER_NAME']=='localhost'){
	move_uploaded_file($_FILES["fu_file1"]["tmp_name"], 'xxx/'.$_FILES["fu_file1"]["name"]);
}
echo $_FILES["fu_file1"]["name"].'<br>';
echo htmlspecialchars($_POST['animal_name'],ENT_QUOTES).'<br>';// XSSサニタイズしてから出力

?>