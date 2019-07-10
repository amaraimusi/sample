<?php

//$dir = $_POST["dir"];
if($_FILES["file1"]["tem_name"]){
	
	$tmp = $_FILES["file1"]["tem_name"];
	$imgFn=$_FILES["file1"]["name"];
	$result = @move_uploaded_file($tmp, $imgFn);
	echo 'success';
	
	
//   list($file_name,$file_type) = explode(".",$_FILES['file']['name']);
//   //ファイル名を日付と時刻にしている。
//   $name = date("YmdHis").".".$file_type;
//   $file = "img/".$dir;
//   //ディレクトリを作成してその中にアップロードしている。
//   if(!file_exists($file)){
//     mkdir($file,0755);
//   }
//   if (move_uploaded_file($_FILES['file']['tmp_name'], $file."/".$name)) {
//     chmod($file."/".$name, 0644);
//     var_dump($dir."/".$name);
//   }
}