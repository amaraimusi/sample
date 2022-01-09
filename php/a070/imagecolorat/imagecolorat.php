<?php 
$im = imagecreatefrompng("test.png");
$rgb = imagecolorat($im, 0, 3);
var_dump($rgb);//■■■□□□■■■□□□)
$rgb = imagecolorat($im, 5, 5);
var_dump($rgb);//■■■□□□■■■□□□)
$rgb = imagecolorat($im, 3, 0);
var_dump($rgb);//■■■□□□■■■□□□)
$rgb = imagecolorat($im, 0, 0);
var_dump($rgb);//■■■□□□■■■□□□)
$rgb = imagecolorat($im, 0, 1);
var_dump($rgb);//■■■□□□■■■□□□)
$rgb = imagecolorat($im, 1, 0);
var_dump($rgb);//■■■□□□■■■□□□)