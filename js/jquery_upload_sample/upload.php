<?php

if($_SERVER["REMOTE_ADDR"] !='localhost'){
    echo 'This sample is localhost only';
    die();
}
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], "img/" . $_FILES["upload_file"]["name"]);
    echo "img/" .$_FILES["upload_file"]["name"];
?> 	