<h1>h()関数の使い方</h1>
h()関数はサニタイズするときに使う。（XSS攻撃対策）<br>
<br><br><br>
<hr>
<?php

echo "h()を使わない場合<br>";
$str1="→テスト<a href='#' onclick='alert(\"XSS攻撃のテスト\");'  > Hello</a>";
echo $str1;

echo '<br><br><br>';

echo "h()を使った場合<br>";
echo h($str1);



?>