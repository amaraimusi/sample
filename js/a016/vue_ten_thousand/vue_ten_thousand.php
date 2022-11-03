<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vue.js 1万件データの検証 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>	
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="script.js"></script>

</head>
<body>
<div id="header" ><h1>Vue.js 1万件データの検証 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>

データ一万件検証を先に結論。<br>
表にテキストボックスが含まれている場合はどうにか動くレベルであり重い。1000件くらいが理想だ。<br>
しかし、表にテキストボックスが含まれていないのであれば意外と軽い。1万件でも大丈夫。それでも10万件ともなると使い物にならない。<br>
<br>

下記はVue.jsで作成した1万件データの表<br>
<?php 

$data = [];
$data_count=10000; // データ一万件
for($i=0; $i<$data_count; $i++){
    $id = $i + 1;
    $name = "銀河鉄道{$i}号";
    $value_a = $i * 100;
    $data[] = [
        'id'=>$id,
        'name'=>$name,
        'value_a'=>$value_a,
    ];
}

$data_json = json_encode($data,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);


?>

<div id="app1">
  <div>
  <input type="text" v-model="message1" />
  {{ message1 }}
  </div>

	<table class="table">
		<thead><tr><th>id</th><th>名前</th><th>値</th><th></th></tr></thead>
		<tbody>
			<tr v-for="ent in data">
				<td>{{ent.id}}</td>
				<td><span>{{ent.name}}</span> </td>
				<td><span>{{ent.value_a}}</span> </td>
			</tr>
		</tbody>
	</table>
</div>

<input id="data_json" type="hidden" value='<?php echo $data_json; ?>' />

<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>Vue.js 1万件データの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2022-11-2</div>
</body>
</html>