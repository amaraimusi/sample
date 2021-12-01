<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>テキストからおすすめ商品を取得するアルゴリズム | #レコメンド #レーベンシュタイン | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">
	<script src="/note_prg/js/jquery.min.js"></script>
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/vue.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>
	<script src="/note_prg/js/livipage.js"></script>
	<script src="/note_prg/js/ImgCompactK.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>テキストからおすすめ商品を取得するアルゴリズム | #レコメンド #レーベンシュタイン | ワクガンス</h1></div>
<div class="container">


<p>Demo</p>

<p>アルゴリズムの概要</p>
<table class="tbl2">
	<thead><tr><th>おすすめへの影響</th><th>アルゴリズム</th></tr></thead>
	<tbody>
		<tr><td>大</td><td>商品名のハッシュとテキストのハッシュが一致するほど、その商品は上位のレコメンド（おすすめ）になる。</td></tr>
		<tr><td>中</td><td>商品名のハッシュがテキストの文に含まれると、その商品は上位のレコメンドになる。</td></tr>
		<tr><td>小</td><td>商品名とテキストのレーベンシュタイン距離レートが大きいとレコメンドの上位にくる。</td></tr>
	</tbody>
</table>
<hr>

<h3>検証</h3>
<?php 
$texts = [];
$texts[] = "
『チャイルドブック』1960年10月号で、迷路遊びの曲として中尾彰の迷路挿絵とともに発表された[3]。同誌別売のソノシートが初録音である[3]。この挿絵に描かれている「犬のおまわりさん」の犬種はコリーであり、また歌詞とは異なり子猫は泣いていない[4]。当時の子供の歌としては歌詞が長過ぎると、編集長が歌詞の修正を求めたが、作詞者の佐藤が拒否したためそのまま掲載されたというエピソードがある[3]。
1961年（昭和36年）10月10日に初めてNHKの『うたのえほん』で流され、この曲はさらに広まった[5]。後継番組の『おかあさんといっしょ』でも定番曲として流れている[5]。
佐藤義美記念館名誉館長で童話作家の稗田宰子によると、この曲が多くの人に知られるようになったのは、作詞者の佐藤が亡くなった1968年（昭和43年）以後である[6]。
1977年以後、小学校の音楽の教科書にも掲載されている[2]。 #犬 #童謡 #楽器";

$texts[] = "
化け猫同様にネコの怪異として知られる猫又が、尻尾が二つに分かれるほど年を経たネコといわれることと同様に、老いたネコが化け猫になるという俗信が日本全国に見られる。
茨城県や長野県では12年、沖縄県国頭郡では13年飼われたネコが化け猫になるといい、
広島県山県郡では7年以上飼われたネコは飼い主を殺すといわれる。ネコの飼い始めに、あらかじめ飼う年数を定めておいたという地方も多い[11]。
また地方によっては、人間に残忍な殺され方をしたネコが怨みを晴らすため、化け猫になってその人間を呪うなど、老いたネコに限らない化け猫の話もある[12]。
#絵本  #歴史　#民族
";

$texts[] = "
太古のペットは、野生動物を捕獲したものである。
人間が太古からペットを飼っていた証拠は、いずれの大陸からも発見される。
最古の痕跡は、3万前の石器時代の遺跡にあるホラアナグマの飼育跡（洞窟の檻）である。
ただし、狩猟で捕獲したものを一時的に生きたまま保管したのか、継続的に餌を与えて飼っていたのかは不明である。ペットとして手当たり次第に飼い始めた野生動物の中から、家畜として有用なものが見いだされたと考えられる[4]。

オオカミ（イヌ）の家畜化が3万年 - 1万5000年前から行われ、狩猟の際の助けとして用いられた。以下、トナカイ、ヒツジ、イノシシ（ブタ）、ヤギ、ウシ、ニワトリ、ハト、ウマ、ラクダなどが家畜として飼育されるようになった。また農耕の始まりとともに、害獣となるネズミなどを駆除してくれるネコやイタチのような小型肉食獣が珍重されるようになった。
#ペット #歴史 
";

$texts[] = "
　1870年頃のベルギー・フランダース地方に、絵を描くのが得意な少年ネロと祖父ジェハンが貧しいながらも人々の好意に助けられながら暮らしていた。
ある日、ネロは金物屋の主人に捨てられた荷車引きの犬パトラッシュを道端で助け、家に連れて帰り一緒に暮らすことにする。元気になったパトラッシュは牛乳運びの仕事を手伝い、いつもネロと一緒に過ごすようになった。しかしジェハンは無理がたたり亡くなってしまい、ネロはたった一人きりになってしまう。
貧しいネロに世間の風当たりは厳しく、願いだった絵のコンクールにも落選してしまい、とうとうネロはパトラッシュと訪れた教会のルーベンスの絵の前で静かに天に召されていくのだった。
#絵画 #犬
";

$texts[] = "
沖縄へ旅行に出かけました。海は青く、なぜだが空も青い。 #沖縄 #旅行
";

$texts[] = "
私はウミネコに会いに行きましたと言ったところ、バードウォッチングですかと聞かれた。ハッシュタグなしのテスト。
";

$texts[] = "
太鼓をたたきながら踊る猫。 #楽器
";

$texts[] = "
    ペットフードと音楽。わたしはペットフードで音楽を成らすのが好きだ。そしてそのまま旅行にでかける。犬も一緒に。
";

$texts[] = "
    毎日の睡眠は大切だ。しかし若い人は睡眠を削る傾向にある。旅行にでもいきたいな #睡眠
";

$items = [
    "ヒルズ サイエンス・ダイエット〈プロ〉 キャットフード 健康ガード 活力 1~6歳 成猫用 3キログラム (x 1) #ネコ #猫 #ねこ #ペットフード #キャットフード",
    "ピュリナ ワン キャットフード 成猫用(1歳以上) 室内飼い猫用 インドアキャット ターキー&チキン 2.2kg(550g×4袋) #ネコ #猫 #ねこ #ペットフード #キャットフード",
    "ねこちゃんまっしぐら #ネコ #猫 #ねこ #ペットフード #キャットフード", 
    'DOG FOOD THE ONE #イヌ #犬 "いぬ #ドッグフード #ペットフード',
    'トランペット #楽器 #演奏 #トランペット', 
    'Naupaka アコースティックギター 初心者 セット びっくりするほど上手になる12週間動画講座ギター編つき フォークギター バッグ ストラップ #楽器 #ギター',
    'アイマスク #睡眠 #健康',
    '琉球の泡盛 #酒 #アルコール #泡盛 #沖縄',
    '旅行バッグ #トラベル #旅',
    '【モダン油絵工房】 油絵 現代絵画 手書きモダン油絵 ナチュラルライン 花A 2FAE-104 120×60cm #絵画 #油絵',
    '知識ゼロからの戦争史入門 (幻冬舎単行本) #歴史 #単行本',
    'LEEFE トラベルポーチ 8点セット アレンジケース パッキング 旅行用 #バッグ #旅行 #トラベル'
];


echo '<p>商品一覧</p>';
echo '<ol>';
foreach($items as $item){
    echo "<li>{$item}</li>";
}
echo '</ol>';
echo '<hr>';

foreach($texts as $i=> $text){
    echo "<div style='margin-top:20px'>";
    $no = $i + 1;
    echo "<p>テキスト{$no}</p>";
    echo "<pre>{$text}</pre>";

    $data = [];
    
//     $hashs = getHashtags($text);
//     var_dump($hashs);//■■■□□□■■■□□□($hashs);//■■■□□□■■■□□□)
    
    
//     $text_hashs_str = $text;
//     if(!empty($hashs)){
//         $text_hashs_str = implode(',', $hashs);
//     }
    
    foreach($items as  $item){
       
        $score = calcScore($text, $item);
//         $item_hashs = getHashtags($item);
//         $item_hashs_str = $item;
//         if(!empty($item_hashs)){
//             $item_hashs_str = implode(',', $item_hashs);
//         }
        
        
//         $cnt = mb_substr_count("これはてすとです。", "す"); // 一致数
        
//         $percent=null;
//         //similar_text($text, $item, $percent);//一致率ポインタを渡す。
//         similar_text($text_hashs_str, $item_hashs_str, $percent);//一致率ポインタを渡す。
//         //$percent = levenshtein($text, $item);
       
        $ent = [
            'item' => $item,
            'score' => $score,
        ];
        
        $data[] = $ent;
//         echo "<div>{$percent}</div>";
//         if($max_per < $percent){
//             $max_per = $percent;
//             $recmend_index = $item_index;
//         }

    }
    $data2 = sortByKey('score', SORT_DESC, $data);
    
    echo "
        <table class='tbl2'>
            <thead><tr><th>おすすめ順位</th><th>商品名</th><th>スコア</th></th></thead>
            <tbody>
    ";
    
    foreach($data2 as $i =>  $ent){
        $no2 = $i + 1;
        echo "
            <tr>
                <td>{$no2}</td>
                <td>{$ent['item']}</td>
                <td>{$ent['score']}</td>
            </tr>
        ";
    }
    
    echo "
            <tbody>
        </table>
    ";
    
//     $rec_item = $items[$recmend_index];
//     echo "おすすめ商品→<strong style='color:red'>{$rec_item}</strong>";
    echo "</div>";
    echo "<hr>";
}


function calcScore($text, $item){
    
    
    $score = 0;
    
    $textHash = getHashtags($text);
    
    $itemHashA = getHashtags($item);
    $itemHash = [];
    foreach($itemHashA as $hash_a){
        $itemHash[] = str_replace('#', '', $hash_a);
    }

    $percent=null;
    
    similar_text($text, $item, $percent);//一致率ポインタを渡す。
    $score += $percent;
    
    foreach($itemHash as $i_hash){
        $cnt = mb_substr_count($text, $i_hash); // 一致数
        if($cnt > 3) $cnt = 3;
        $score0 = $cnt * 7;
        $score += $score0;
    }

    foreach($textHash as $t_hash){
        foreach($itemHashA as $i_hash_a){
            if($t_hash == $i_hash_a){
                $score += 50;
            }
        }
    }
    
//     foreach($itemHashA as $i_hash){
//         $cnt = mb_substr_count($text, $i_hash); // 一致数
//         $score0 = $cnt * 6;
//         $score += $score0;
//     }
    
    return $score;
}


// 指定したキーに対応する値を基準に、配列をソートする
function sortByKey($key_name, $sort_order, $array) {
    foreach ($array as $key => $value) {
        $standard_key_array[$key] = $value[$key_name];
    }
    
    array_multisort($standard_key_array, $sort_order, $array);
    
    return $array;
}

function getHashtags($string) {
    $hashtags= FALSE;
    preg_match_all("/(#\w+)/u", $string, $matches);
    if ($matches) {
        $hashtagsArray = array_count_values($matches[0]);
        $hashtags = array_keys($hashtagsArray);
    }
    return $hashtags;
}
?>


<div class="yohaku"></div>

<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>テキストからおすすめ商品を取得するアルゴリズム | #レコメンド #レーベンシュタイン</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2021-11-30</div>
</body>
</html>