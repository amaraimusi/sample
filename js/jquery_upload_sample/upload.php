<?php
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], "img/" . $_FILES["upload_file"]["name"]);
    echo "img/" .$_FILES["upload_file"]["name"];
?>