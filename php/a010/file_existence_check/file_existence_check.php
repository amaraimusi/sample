<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ファイル存在チェック関数、file_existsとis_fileを検証</title>
	
	<link href="/note_prg/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/jquery-ui.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>


</head>
<body>
<div id="header" ><h1>ファイル存在チェック関数、file_existsとis_fileを検証</h1></div>
<div class="container">












<h2>検証</h2>
<table class="tbl2">
<thead><tr><th>ファイル/フォルダ</th><th>is_file()</th><th>file_exists()</th><th>備考</th></tr></thead>
<tbody>
	<tr>
		<td>sample/test1.png</td>
		<td>
			<?php 
			echo is_file('sample/test1.png');
			?>
		</td>
		<td>
			<?php 
			echo file_exists('sample/test1.png');
			?>
		</td>
		<td>
			is_file,file_exists,いずれの方法でもファイルチェックは可能である。<br>
			ただし、is_fileの方が処理速度が速い。<br>
			なお、ファイルが存在しない場合はいずれも空を返す。
			
		</td>
	</tr>
	<tr>
		<td>sample/日本語.png</td>
		<td>
			<?php 
// 			$fn=mb_convert_encoding('sample/日本語.png', 'sjis', 'utf-8');
// 			echo is_file($fn);
			echo is_file('sample/日本語.png');
			?>
		</td>
		<td>
			<?php 
// 			$fn=mb_convert_encoding('sample/日本語2.png', 'sjis', 'utf-8');
// 			echo file_exists($fn);
			
			echo file_exists('sample/日本語.png');
			?>
		</td>
		<td>
			いずれの関数でも日本語ファイル名はファイルチェックできない。<br>
			ただし、mb_convert_encodingでエンコードすれば、正常にファイルチェックは作動する。<br>
			<pre>
			$fn=mb_convert_encoding('sample/日本語.png', 'sjis', 'utf-8');
			echo is_file($fn);
			</pre>
		</td>
	</tr>
	<tr>
		<td>sample/test2/</td>
		<td>
			<?php 
			echo is_file('sample/test2/');
			?>
		</td>
		<td>
			<?php 
			echo file_exists('sample/test2/');
			?>
		</td>
		<td>
			file_existsはフォルダの存在チェックも可能である。<br>
			is_fileはフォルダの存在チェックはできない。<br>
			
		</td>
	</tr>
	<tr>
		<td>sample/日本語フォルダ/</td>
		<td>
			<?php 
			//$fn=mb_convert_encoding('sample/日本語フォルダ/', 'sjis', 'utf-8');
			//echo is_file($fn);
			echo is_file('sample/日本語フォルダ/');
			?>
		</td>
		<td>
			<?php 
			//$fn=mb_convert_encoding('sample/日本語フォルダ', 'sjis', 'utf-8');
			//echo file_exists($fn);
			
			echo file_exists('sample/日本語フォルダ/');
			?>
		</td>
		<td>
			file_existsは日本語名のフォルダを存在チェックできない。<br>
			ただし、mb_convert_encodingでエンコードすれば、正常にフォルダ存在チェックは作動する。<br>
			<pre>
			$fn=mb_convert_encoding('sample/日本語フォルダ/', 'sjis', 'utf-8');
			echo is_file($fn);
			</pre>
			当然ながら、is_fileはフォルダ存在チェックすることはできない。
		</td>
	</tr>
	
</tbody>
</table>









<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>ファイル存在チェック関数、file_existsとis_fileを検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2017-2-22</div>
</body>
</html>