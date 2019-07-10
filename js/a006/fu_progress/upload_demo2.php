<?php

foreach($_FILES as $key=> $file){
	if($_SERVER['SERVER_NAME']=='localhost'){
		move_uploaded_file($file["tmp_name"], 'xxx/'.$file["name"]);
	}
	echo 'success';
}

?>