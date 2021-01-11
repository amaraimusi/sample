<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>アイコン生成ツールの検証 | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery-3.5.1.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	
	<script src="chr_icon_generater.js"></script>
	<script src="script.js"></script>
	
	<style>
	   #inps_tbl td{
	       padding-left:10px;
	   }
	</style>

</head>
<body>
<div id="header" ><h1>アイコン生成ツールの検証 | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<div id="vueApp">
<input type="button" value="詳細" class="btn btn-private btn-sm" onclick="jQuery('#config_div').toggle(300);"/>
<div id="config_div" style="padding:10px;background-color:#f5fdfe;display:none">
	<p>詳細</p>
	<div>画像幅（横×縦）:
		<input type="text"  v-model="param.img_w" maxlength="3" style="width:60px">×
		<input type="text"  v-model="param.img_h" maxlength="3" style="width:60px">
	</div>
	<input type="button" value="閉じる" class="btn btn-private btn-sm" onclick="jQuery('#config_div').toggle(300);"/>
	<button type="button" v-on:click="defaultParam" class="btn btn-default btn-xs">入力を初期に戻す</button>
</div>
<form action="#" method="post">
	<table id="inps_tbl"><tbody>
		<tr>
			<td>
				略称・法人名
				<input type="text"  v-model="param.corp_text" maxlength="3" style="width:60px" title="全角2文字＋半角1文字まで">
			</td>
			<td>
				背景色
				<input type="color" v-model="param.corp_backcolor" >
				<input type="text" v-model="param.corp_backcolor" style="width:90px" >
			</td>
			<td>
				文字色
				<input type="color" v-model="param.corp_fontcolor" >
				<input type="text" v-model="param.corp_fontcolor" style="width:90px" >
			</td>
		</tr>
		<tr>
			<td>
				略称・グループ名
				<input type="text" v-model="param.group_text"  maxlength="3" style="width:60px">
			</td>
			<td>
				背景色
				<input type="color" v-model="param.group_backcolor" >
				<input type="text" v-model="param.group_backcolor" style="width:90px" >
			</td>
			<td>
				文字色
				<input type="color" v-model="param.group_fontcolor" >
				<input type="text" v-model="param.group_fontcolor" style="width:90px" >
			</td>
		</tr>
	</tbody></table>
	<div>
		<button type="button" v-on:click="makeIcon" class="btn btn-success">アイコン作成</button>
	</div>
</form>
<div id="err" class="text-danger"></div>
<hr>

<div style="margin-bottom:20px"><img id="img_main" src="icon.png" style="width:32px;height:32px" /></div>
<div><img id="img_orig" src="icon.png"  /></div>

</div><!-- #vueApp -->

<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/js">JavaScript ｜ サンプル</a></li>
	<li>アイコン生成ツールの検証</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2020-11-20</div>
</body>
</html>