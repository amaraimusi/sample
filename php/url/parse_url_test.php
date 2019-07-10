<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="utf-8">

		<title>URLからドメイン、パス、クエリ、ポート番号などを取得する | parse_url</title>

	</head>

<body>

<h1 >URLからドメイン、パス、クエリ、ポート番号などを取得する | parse_url</h1>

サンプルURL:
<?php 

$url_a='http://user_name99:pass_word99@www.example.com:8080/animals/neko?id=99&xx=88#kani';

$url_scheme=parse_url($url_a,PHP_URL_SCHEME);
$url_path=parse_url($url_a,PHP_URL_PATH);
$url_host=parse_url($url_a,PHP_URL_HOST);
$url_query=parse_url($url_a,PHP_URL_QUERY);
$url_port=parse_url($url_a,PHP_URL_PORT);
$url_fragment=parse_url($url_a,PHP_URL_FRAGMENT);
$url_user=parse_url($url_a,PHP_URL_USER);
$url_pass=parse_url($url_a,PHP_URL_PASS);


echo $url_a.'<br>';

?>

<table border="1">
	<thead><tr><th>URLの部位名</th><th>コード</th><th>取得例</th></tr></thead>
	<tbody>
		<tr><td>プロトコル名</td><td>$url_scheme=parse_url($url_a,PHP_URL_SCHEME);</td><td><?php echo $url_scheme ?></td></tr>
		<tr><td>FQDN(ホスト.ドメイン)</td><td>$url_host=parse_url($url_a,PHP_URL_HOST);</td><td><?php echo $url_host ?></td></tr>
		<tr><td>パス</td><td>$url_path=parse_url($url_a,PHP_URL_PATH);</td><td><?php echo $url_path ?></td></tr>
		<tr><td>クエリ</td><td>$url_query=parse_url($url_a,PHP_URL_QUERY);</td><td><?php echo $url_query ?></td></tr>
		
		<tr><td>ポート番号</td><td>$url_port=parse_url($url_a,PHP_URL_PORT);</td><td><?php echo $url_port ?></td></tr>
		<tr><td>フラグメント識別子</td><td>$url_fragment=parse_url($url_a,PHP_URL_FRAGMENT);</td><td><?php echo $url_fragment ?></td></tr>
		<tr><td>ユーザー</td><td>$url_user=parse_url($url_a,PHP_URL_USER);</td><td><?php echo $url_user ?></td></tr>
		<tr><td>パスワード</td><td>$url_pass=parse_url($url_a,PHP_URL_PASS);</td><td><?php echo $url_pass ?></td></tr>
	</tbody>
</table>



<p style="font-size:0.8em;color:#bc99fd">(c)wacgance 2015-10-13</p>
</body>
</html>