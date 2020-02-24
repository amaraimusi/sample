<style>
	.box1{
		border:4px solid #90C05C;
		border-radius:4px;
		padding:10px;
	}
.tbl2{
	border-collapse:collapse;
}

.tbl2 th{
	border: 1px solid #bdbfdf;
	color:#393656;
}
.tbl2 td{
	border: 1px solid #bdbfdf;
	color:#34353f;
}
</style>
<h2>TCPDF DEMO2</h2>
Hello World!

<br>
<div style="background-color:red">背景色のテスト</div>
<br>
hrタグのテスト(黒線のみ。線の色、太さ、種類は一切指定できず。）
<hr style="border-top: 3px double red">
&nbsp;<br>
<div style="padding:20px;margin:30px;border-top:4px solid #8080FF">
	border-topのテスト。上罫線のテスト（青色の線）<br>
	padding,marginは一切効かない。<br>
</div>
&nbsp;<br>
画像テスト。imgのwidth属性とheight属性は効果あり。<br>
<img src="test.png" alt="" width="30px" height="50px" /><br>
&nbsp;<br>
テーブルのテスト<br>
<table class="tbl2">
	<thead><tr><th style="width:25%">名前</th><th style="width:25%">生息地</th><th style="width:50%">説明</th></tr></thead>
	<tbody>
		<tr>
			<td style="width:25%">アブラコウモリ</td>
			<td style="width:25%">日本/台湾</td>
			<td style="width:50%">アブラコウモリ（油蝙蝠、学名: Pipistrellus abramus）は、コウモリ亜目ヒナコウモリ科に属するコウモリの一種。日本に棲息する中では唯一の、住家性、すなわち、家屋のみをすみかとするコウモリである。したがって、日本では人間にとって最も身近なコウモリであると言える。その習性から、イエコウモリ（家蝙蝠）の別名がある。史前帰化動物とする説もある。</td></tr>
		<tr style="background-color:#AAAAAA">
			<td>AA</td>
			<td>BB</td>
			<td>CC</td>
		</tr>
	</tbody>
	
</table>

&nbsp;<br>

ブロックレイアウトはtableを活用しなければならない。colspanは何とか効いている。<br>
<table>
	<tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
	</tr>
	<tr>
		<td colspan="2"><div style="border-bottom:2px solid blue">colspan="2"テストテスト</div></td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
	</tr>
</table>

&nbsp;<br>

<div class="box1" >
	アブラコウモリ（油蝙蝠、学名: Pipistrellus abramus）は、コウモリ亜目ヒナコウモリ科に属するコウモリの一種。日本に棲息する中では唯一の、住家性、すなわち、家屋のみをすみかとするコウモリである。したがって、日本では人間にとって最も身近なコウモリであると言える。その習性から、イエコウモリ（家蝙蝠）の別名がある。史前帰化動物とする説もある。
</div>


&nbsp;<br><br><br><br><br><br><br>
<h3>長文と改ページのテスト</h3>
市街地を中心として、平野部に広く分布する。東京都心をはじめとする都市部の市街地にも数多く棲息し、夕刻の空に普通に見られる。人家のない山間部などには棲息せず、自然洞窟などでの記録は、まれにしかない。1.5cm ほどの隙間があれば出入りすることができ、家屋の瓦の下、羽目板と壁の間、戸袋の中、天井裏、換気口など建物の隙間などを主な棲息場所（ねぐら）とする。都市部では、高層ビルの非常口裏などのほか、道路・鉄道等の高架や橋の下、大型倉庫内などもねぐらとなる。

数頭の家族単位（雌と幼獣）で暮らすことが多いが、幼獣を含む雌の繁殖集団では、50-60頭、時には200頭にもなる。成獣の雄は1頭で暮らすことが比較的多い。

夜行性で、昼間はねぐらで休み、日没近くから夜間に飛び回る。カ、ユスリカ、ヨコバイなどの小型昆虫類を主食とし、ウンカ、甲虫なども捕食する。活動は日没後2時間程度が最も活発。河川などの水面上や田畑・駐車場などのオープンスペース、あるいは街灯の近くなどを、ヒラヒラと不規則に飛び回り、飛翔昆虫を捕食する。都市部では、有機物量の多い汚濁河川から大量に発生するユスリカが重要な食物となっていることが多い。

日本では、11月の中ごろから冬眠に入る。暖かい場所に多数が集まって冬越しをする。3月中下旬に冬眠から覚め、活動を開始する。冬眠期間中でも、暖かい日には飛翔する姿が見られることもある。近年、都市部では冬眠しないものも現れている。

雌は満1歳から出産し、7月初旬に1-4頭（通常は2-3頭）の仔を産む。30日程度で離乳して巣立つ。10月に入ると交尾を行う。精子は雌の生殖器官に貯えられたまま冬を越す。冬眠あけの4月下旬になってから排卵が起こり、受精・妊娠する。寿命は雄で3年、雌で5年ほどと、他のコウモリと比べると短い。雄は1年以内に死んでしまうことが多い。




&nbsp;<br>

<div style="display:inline-block;border:2px solid blue;" >
	インラインブロックは効かない
</div>

&nbsp;<br>
<div style="width:100px;height:40px;border:2px solid blue;" >
	widthとheightは効かない
</div>

&nbsp;<br>
<div style="text-align:center;border:1px solid blue;" >
	text-align:centerによる中央寄
</div>
<div style="text-align:right;border:1px solid blue;" >
	右寄
</div>

&nbsp;<br>
<div style="font-size:2em;color:#A36F3F;border:2px solid blue;" >
	文字に色を付ける。文字を大きくする。
</div>

&nbsp;<br>
<div style="font-weight:bold;border:1px solid blue;" >
	文字を太くする。
</div>
&nbsp;<br>
<span style="text-decoration: underline dotted red;" >
	文字の下に線を引いてみる。一種類の線しか引けず、線色も効かない。
</span>

&nbsp;<br>
<div style=";border:1px solid blue;" >
	<strong>strongタグ</strong>と<small>smallタグ</small>
</div>

&nbsp;<br>
<ul>
	<li>アメリカザリガニ</li>
	<li>ブラックバス</li>
	<li>カミツキガメ</li>
	<li>ガーパイク</li>
</ul>
<br>

