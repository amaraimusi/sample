
<h1>他のCTPをレンダリング</h1>

<br><br><br>
ビューに別のctpファイルを埋め込む場合「$this->element(ctpファイル)」を使う。<br>
「$this->element」はapp&yenView&yenElements内のctpファイルにしか適用できなさそうだが、
別ディレクトリのctpにも適用できる。

<div style="margin:20px">
	<h2>別のctpファイルを埋め込む</h2>
	下記ctpファイルを埋め込む場合<br>
	app&yenview&yentest1&yenother_ctp_neko.ctp<br>
	<pre>echo $this->element('../test1/other_ctp_neko');</pre>

	<div><?php echo $this->element('../test1/other_ctp_neko');?></div>

</div>
<hr>

<div style="margin:20px">


	<h2>応用：メール用テンプレートを表示</h2>
	メール送信しなくてもメール本文の内容を画面に表示できる。
	下記のテンプレート（ctpファイル）を埋め込む場合<br>
	app&yenview&yenEmails&yentext&yenmail_test1.ctp<br>
	<pre>echo $this->element('../emails/text/mail_test1');</pre>
	<div style="background-color:#dee7fa">
		<?php echo $this->element('../emails/text/mail_test1'); ?>
	</div>

</div>