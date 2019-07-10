<?php



//echo var_dump($_FILES);

if(!empty($_FILES)){

	$data=array();

	//一時フォルダ2にコピー
	$lenth=count($_FILES["files"]["name"]);
	for($i=0;$i<$lenth;$i++){

		//日本語ファイル名の文字化け対策
		$file_name = mb_convert_encoding($_FILES['files']['name'][$i], "SJIS", "auto");

		move_uploaded_file($_FILES["files"]["tmp_name"][$i], "tmp2/" . $file_name);//画像を保存。

		$data[$i]['file_name']=$_FILES['files']['name'][$i];
		$data[$i]['tmp_name']=$_FILES['files']['tmp_name'][$i];
		$data[$i]['error']=$_FILES['files']['error'][$i];

	}



	$json=json_encode($data,true);//JSON出力

	echo $json;
}else{
	echo 'fail';
}


