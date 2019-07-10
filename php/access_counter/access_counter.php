<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ホームページ・アクセスカウンター</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script>

			
		</script>
		
		<style type="text/css">
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<h1 id="header">ホームページ・アクセスカウンター</h1>
		<div id="content" >
			<form name="form1"  action="#" method="post" enctype="multipart/form-data" >
				<div class="sec1">

					カウント：
					<?php
					$data=file('data.txt');//テキストファイルを開いて1行ずつ配列で返す
					$data[0]++;//1行目（カウンタの数字）の値に1を加える
					$fp=@fopen('data.txt','w');//テキストファイルを書き込み形式で開く
					flock($fp,LOCK_EX);//開いたファイルを排他的ロック
					fputs($fp,$data[0]);//開いたファイルに数値を書き込む
					fclose($fp);//ファイルを閉じる
					echo($data[0]);
					?>

					<br /><br />
					同一IPをカウントしない。
	<?php 
		$log="data2.txt"; 
		$fig=8; //桁数 
		$ipcheck=1; //連続IPカウントしない？yes=1,no=0
		  
		$ip=$_SERVER['REMOTE_ADDR'];//ipアドレスの取得
		$data=file($log);//テキストファイルを1行読み込んで配列に。
		  
		list($count,$addr)=explode("|",$data[0]);//explodeで$data（例：5200｜192.162.11.1）を分割後配列にする。その配列を順番に$countと$addrに入れる。
		if(($ipcheck==1 && $ip!=$addr)||$ipcheck==0){ //連続IP×モードでIPが重複していない（初回アクセス）、または、ipカウントがOFFなら
		    $count++;
		    $aaa=implode("|",array($count,$ip));//カウンタとIPを|でつなげて変数に代入
		    $fp=@fopen($log,'w');//書き込み形式でファイルを開く。
		    flock($fp,LOCK_EX);
		    fputs($fp,$aaa);
		    fclose($fp);
}
    $bbb = sprintf('%0'.$fig.'d', $count) . '人目';
    echo($bbb);

?>
					
				</div><!-- sec1 -->
			</form>
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/09/03</div>
		</div><!-- page1 -->
	</body>
</html>