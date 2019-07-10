<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>実験場</title>
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery-1.11.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>
	<script src="rab.js"></script>


	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>実験場</h1></div>
<div class="container">












<h2>実験</h2>
<input id="btn1" type="button" value="test1"  class="btn btn-success" onclick="test1()" />


<style>
	#rect1 {
		width:100px;
		height:100px;
		margin:5px;
		border: solid 1px Crimson;
		padding:5px;
		overflow:auto;
		background-color:LightCoral;
	}
	#rect2 {
		width:160px;
		height:160px;
		padding:4px;
		margin-left:3px;
		margin-right:4px;
		margin-top:6px;
		margin-bottome:7px;
		border: solid 1px LimeGreen;
		overflow:auto;
		background-color:LightGreen;
	}
</style>

<div id="rect1">
	<div id="rect2"></div>
</div>


<p>HTML</p>
<pre><code>
	&lt;div id="rect1"&gt;
		&lt;div id="rect2"&gt;&lt;/div&gt;
	&lt;/div&gt;
</code></pre>

<p>CSS</p>
<pre><code>
&lt;style&gt;
	#rect1 {
		width:100px;
		height:100px;
		margin:5px;
		border: solid 1px Crimson;
		padding:5px;
		overflow:auto;
		background-color:LightCoral;
	}
	#rect2 {
		width:160px;
		height:160px;
		padding:4px;
		margin-left:3px;
		margin-right:4px;
		margin-top:6px;
		margin-bottome:7px;
		border: solid 1px LimeGreen;
		overflow:auto;
		background-color:LightGreen;
	}
&lt;/style&gt;
</code></pre>

<p>rect1</p>
<table class="tbl2">
	<thead><tr><th>メソッド</th><th>記述例</th><th>値</th><th>検証</th><th>備考</th></tr></thead>
	<tbody>
		<tr>
			<td>width()</td>
			<td>$('#rect1').width();</td>
			<td id='res1-1'></td><td>width(100px) - padding(5px × 2) - border(1px × 2)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>height()</td>
			<td>$('#rect1').height();</td>
			<td id='res1-2'></td>
			<td>height(100px) - padding(5px × 2) - border(1px × 2)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>outerWidth()</td>
			<td>$('#rect1').outerWidth();</td>
			<td id='res1-3'></td>
			<td>width(100px)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>outerHeight()</td>
			<td>$('#rect1').outerHeight();</td>
			<td id='res1-4'></td>
			<td>height(100px)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>clientWidth</td>
			<td>$('#rect1')[0].clientWidth;</td>
			<td id='res1-5'></td>
			<td>
				Chrome,FireFoxの場合<br>
				width(100px) - スクロールバーの太さ（<strong>17</strong>px※)  - border(1px × 2)<br>
				※スクロールバーの太さはOpera 15px,Edge 16pxである。<br>
			</td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>clientHeight</td>
			<td>$('#rect1')[0].clientHeight;</td>
			<td id='res1-6'></td>
			<td>
				Chrome,FireFoxの場合<br>
				height(100px) - スクロールバーの太さ（<strong>17</strong>px※)  - border(1px × 2)<br>
				※スクロールバーの太さはOpera 15px,Edge 16pxである。<br>
			</td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>scrollWidth</td>
			<td>$('#rect1')[0].scrollWidth;</td>
			<td id='res1-7'></td>
			<td>rect2のouterWidth(160px) + rect2のmargin-left(3px) + padding(5px) </td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>scrollHeight</td>
			<td>$('#rect1')[0].scrollHeight;</td>
			<td id='res1-8'></td>
			<td>
				ChromeとOperaの場合→ 
				rect2のouterWidth(160px) + rect2のmargin-top(6px) + padding(5px × <strong>2</strong>) <br>
				<br>
				
				FireFoxとEdgeの場合→ 
				rect2のouterWidth(160px) + rect2のmargin-top(6px) + padding(5px) 
			</td>
			<td>標準関数</td>
		</tr>
	</tbody>
</table>

<p>rect2</p>
<table class="tbl2">
	<thead><tr><th>メソッド</th><th>記述例</th><th>値</th><th>検証</th><th>備考</th></tr></thead>
	<tbody>
		<tr>
			<td>width()</td>
			<td>$('#rect2').width();</td>
			<td id='res2-1'></td>
			<td>width(160x) - padding(4px × 2) - border(1px × 2)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>height()</td>
			<td>$('#rect2').height();</td>
			<td id='res2-2'></td>
			<td>height(160px) - padding(4px × 2) - border(1px × 2)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>outerWidth()</td>
			<td>$('#rect2').outerWidth();</td>
			<td id='res2-3'></td>
			<td>width(160px)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>outerHeight()</td>
			<td>$('#rect2').outerHeight();</td>
			<td id='res2-4'></td>
			<td>height(160px)</td>
			<td>jQueryの関数</td>
		</tr>
		<tr>
			<td>clientWidth</td>
			<td>$('#rect2')[0].clientWidth;</td>
			<td id='res2-5'></td>
			<td>
				width(100px) - スクロールバーの太さ（Chrome,FFは17px)  - border(1px × 2)</td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>clientHeight</td>
			<td>$('#rect2')[0].clientHeight;</td>
			<td id='res2-6'></td>
			<td>
				Chromeの場合→ height(100px) - スクロールバーの太さ（Chromeは17px)  - border(1px × 2)<br>
				FireFoxの場合→ height(100px) - スクロールバーの太さ（FireFoxは16px)  - border(1px × 2)<br>
				
			</td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>scrollWidth</td>
			<td>$('#rect2')[0].scrollWidth;</td>
			<td id='res2-7'></td>
			<td>xxx </td>
			<td>標準関数</td>
		</tr>
		<tr>
			<td>scrollHeight</td>
			<td>$('#rect2')[0].scrollHeight;</td>
			<td id='res2-8'></td>
			<td>xxx </td>
			<td>標準関数</td>
		</tr>
	</tbody>
</table>




<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>実験場</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2018-1-10</div>
</body>
</html>