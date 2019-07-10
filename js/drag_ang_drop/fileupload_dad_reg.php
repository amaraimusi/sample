<?php


require_once 'CopyEx.php';
require_once 'DirClear.php';

if(empty($_POST['fa_json'])){
	die();
}


$copyEx=new CopyEx();
$dirClear=new DirClear();

$faData=json_decode($_POST['fa_json'],true);









$tmp2_dir='tmp2';// 2次置場パス

// 本置場パス(添付ファイルの配置場所）
$fa_dir='file_attach';


// faDataをループ
foreach($faData as $faEnt){

	//echo var_dump($faEnt);
	$fn=$faEnt['file_name'];// ファイル名を取得する


	$tmp2_fn=$tmp2_dir.'/'.$fn;// 2次置場パス付ファイル名を組み立て

	$fa_fn=$fa_dir.'/'.$fn;// 本置場パス付ファイル名を組み立て

	$copyEx->copy($tmp2_fn, $fa_fn);// 2次置場から本置場にファイルコピー


}

// 2次置場フォルダ内のファイルをクリアする。
$dirClear->clear($tmp2_dir);


echo "<div>end upload</div>>";