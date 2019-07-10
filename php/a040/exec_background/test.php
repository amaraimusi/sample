<?php
$a=0;
for($i=0;$i<10000000;$i++){
	$a++;
}
echo 'Hello World! こんにちは世界';

$file = 'test.txt';
$text = 'バックグラウンド処理成功=' . $a;
file_put_contents( $file, $text );