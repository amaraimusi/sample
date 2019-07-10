<?php
// Access Key ID と Secret Access Key は必須です
$access_key_id = 'AKIAJ2EO6YDAN5HRF4RQ';
$secret_access_key = 'DyQG30sZv+xoq7VoJecdqcfIZ9cXcSUNaTJpzUtX';

// RFC3986 形式で URL エンコードする関数
function urlencode_rfc3986($str)
{
    return str_replace('%7E', '~', rawurlencode($str));
}

// 基本的なリクエストを作成します
// - この部分は今まで通り
$baseurl = 'http://ecs.amazonaws.jp/onca/xml';
$params = array();
$params['Service']        = 'AWSECommerceService';
$params['AWSAccessKeyId'] = $access_key_id;
$params['Version']        = '2009-03-31';
$params['Operation']      = 'ItemSearch'; // ← ItemSearch オペレーションの例
$params['SearchIndex']    = 'Books';
$params['Keywords']       = 'もやし';     // ← 文字コードは UTF-8

// Timestamp パラメータを追加します
// - 時間の表記は ISO8601 形式、タイムゾーンは UTC(GMT)
$params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');

// パラメータの順序を昇順に並び替えます
ksort($params);

// canonical string を作成します
$canonical_string = '';
foreach ($params as $k => $v) {
    $canonical_string .= '&'.urlencode_rfc3986($k).'='.urlencode_rfc3986($v);
}
$canonical_string = substr($canonical_string, 1);

// 署名を作成します
// - 規定の文字列フォーマットを作成
// - HMAC-SHA256 を計算
// - BASE64 エンコード
$parsed_url = parse_url($baseurl);
$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";
$signature = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_access_key, true));

// URL を作成します
// - リクエストの末尾に署名を追加
$url = $baseurl.'?'.$canonical_string.'&Signature='.urlencode_rfc3986($signature);

echo $url; // ← この URL にアクセスすれば、API リクエストができます
?>