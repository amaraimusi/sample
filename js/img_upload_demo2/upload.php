<?php
 
//前にアップロードされた写真のファイル名
$postPhotoName = $_POST["postPhotoName"];
 
//古いファイルの削除
if($postPhotoName){
 
    unlink("./img/".$postPhotoName);
    unlink("./img/thumb-".$postPhotoName);
}
 
//アップロードされたファイルの情報を取得
$fileName = basename(date("U")."-".$_FILES['img']['name']);
$fileType = $_FILES['img']['type'];
$fileTmpName = $_FILES['img']['tmp_name'];
 
$result = false;
if(preg_match("/jpg/",$fileType)){
    if (move_uploaded_file($fileTmpName, './img/' . $fileName)) {
        include('class.image.php');
        //サムネイル作成
        list($width, $height, $type, $attr) = getimagesize('img/'.$fileName);
        $thumb = new Image('img/'.$fileName);
        $thumb->name('thumb-'.basename($fileName,".jpg"));
        if($width>$height){
            if($width > 200) $thumb->width(200);
        }else{
            if($height > 200) $thumb->height(200);
        }
        $thumb->save();
        $result = true;
    } else {
        echo  '保存にしっぱいしたぜよ。';
    }
 
}else{
    unlink($fileTmpName);
    echo "jpegじゃないぜよ。";
}
 
if($result == true){
?>
<img src="<?php echo './img/thumb-'.$fileName;?>">
<input type="hidden" value="<?php echo $fileName?>" name="postPhotoName" id="postPhotoName">
<?php
}