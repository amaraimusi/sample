<?php
 
//-------------------------------------------------------------------
// Define your id.
//-------------------------------------------------------------------
// user id information
define("ACCESS_KEY_ID"     , 'AKIAJ2EO6YDAN5HRF4RQ'                    );
define("SECRET_ACCESS_KEY" , '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');
define("ASSOCIATE_TAG"     , 'amaraimusi-22'                     );
 
// access url(Japan)
define("ACCESS_URL"        , 'http://ecs.amazonaws.jp/onca/xml'        );
//  define("ACCESS_URL", 'https://aws.amazonaws.jp/onca/xml');
//-------------------------------------------------------------------
 
 
//-------------------------------------------------------------------
// this function is encode with RFC3986 format.
//-------------------------------------------------------------------
function urlencode_RFC3986($str)
{
    return str_replace('%7E', '~', rawurlencode($str));
}
 
function aks_make_query_prototype()
{
    $params = array();
 
    $params['Service']        = 'AWSECommerceService';
    $params['Version']        = '2009-10-01';
    $params['AssociateTag']   = ASSOCIATE_TAG;
 
    $params['SignatureMethod']  = 'HmacSHA256';   // signature format name.
    $params['SignatureVersion'] = 2;              // signature version.
 
    // time zone (ISO8601 format)
    $params['Timestamp']      = gmdate('Y-m-d\TH:i:s\Z');
 
    return $params;
}
 
// ASIN を指定してサーチ
function aks_make_asin_query($asin)
{
    $params = aks_make_query_prototype();
 
    $params['Operation']      = 'ItemLookup';
    $params['ItemId']       = $asin;
 
    $params['ResponseGroup']  = 'ItemAttributes,Offers,Images';
 
    // sort $param by asc.
    ksort($params);
 
    return $params;
}
 
// キーワードサーチ
function aks_make_keyword_query($kw, $product_type)
{
    $params = aks_make_query_prototype();
 
    $params['Operation']      = 'ItemSearch';
    $params['SearchIndex']    = $product_type;
    $params['Sort']           = 'salesrank';
 
    $params['Keywords']       = $kw;        // search key ( UTF-8 )
 
    $params['ResponseGroup']  = 'ItemAttributes,Offers,Images';
 
    // sort $param by asc.
    ksort($params);
 
    return $params;
}
 
// 関連サーチ
function aks_make_similarity_query($asin)
{
    $params = aks_make_query_prototype();
 
    $params['Operation']      = 'SimilarityLookup';
    $params['ItemId']         = $asin;
    $params['Sort']           = 'salesrank';
 
    $params['ResponseGroup']  = 'ItemAttributes,Offers,Images';
 
    // sort $param by asc.
    ksort($params);
 
    return $params;
}
 
// カテゴリーサーチ
function aks_make_node_query($node, $product_type)
{
    $params = aks_make_query_prototype();
 
    $params['Operation']      = 'ItemSearch';
    $params['Sort']           = 'salesrank';
    $params['SearchIndex']    = $product_type;
 
    $params['BrowseNode']       = $node;
 
    $params['ResponseGroup']  = 'ItemAttributes,Offers,Images';
 
    // sort $param by asc.
    ksort($params);
 
    return $params;
}
 
// amazon にクエリを送ってレスポンスを得る
function aks_send_query($params)
{
    $base_param = 'AWSAccessKeyId='.ACCESS_KEY_ID;
 
    // create canonical string.
    $canonical_string = $base_param;
    foreach ($params as $k => $v) {
        $canonical_string .= '&'.urlencode_RFC3986($k).'='.urlencode_RFC3986($v);
    }
 
    // create signature strings.( HMAC-SHA256 & BASE64 )
    $parsed_url = parse_url(ACCESS_URL);
    $string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$canonical_string}";
 
    $signature = base64_encode(hash_hmac('sha256', $string_to_sign, SECRET_ACCESS_KEY, true) );
 
    // create URL strings.
    $url = ACCESS_URL.'?'.$canonical_string.'&Signature='.urlencode_RFC3986($signature);
     
    // request to amazon !!
    $response = file_get_contents($url);
    if($response==false){
        echo "request failed.";
    }
     
    return $response;
}
 
// レスポンスをパースして simplexml に変換
function aks_get_parsed_xml( $response )
{
    // response to strings.
    $parsed_xml = null;
    if(isset($response)){
        $parsed_xml = simplexml_load_string($response);
    }
    return $parsed_xml;
}
 
// simplexml を html に整形して表示
function aks_print_items( $response, $parsed_xml, $max_item_num=5 )
{
    $result_str = '';
    // print out of response.
    if( $response &&
        isset($parsed_xml) &&
        !$parsed_xml->faultstring &&
        !$parsed_xml->Items->Request->Errors  ){
 
        $itemcnt = 0;
 
        // print("All Result Count:".$total_results."  | Pages :".$total_pages );
 
        $result_str .= "<table>";
        foreach($parsed_xml->Items->Item as $current){
            if( $itemcnt >= $max_item_num ){
                break;
            }
            $itemcnt += 1;
 
            $nerr=0;
 
            $result_str .= "<tr><td><font size='-1'>";
 
            // 画像が無い場合の例外処理をしなきゃね。
            $result_str .= '<a href="'.$current->DetailPageURL.'"><img src="'.$current->SmallImage->URL.'" border=0></a><br >';
            $result_str .= '<a href="'.$current->DetailPageURL.'">'.$current->ItemAttributes->Title.'</a><br />';
            $result_str .= $current->ItemAttributes->Manufacturer.'<br />';
 
            if(isset($current->Offers) && isset($current->Offers->Offer)){
                $result_str .= $current->Offers->Offer->OfferListing->Price->FormattedPrice.'<br />';
            } else {
                $result_str .=$current->ItemAttributes->ListPrice->FormattedPrice.'<br />';
            }
            if(isset($current->CustomerReviews->TotalReviews) && $current->CustomerReviews->TotalReviews>0){
                $result_str .= 'Rate:<a href="'.$current->ItemLinks->ItemLink[2]->URL.'">';
                $result_str .= $current->CustomerReviews->AverageRating.'('. $current->CustomerReviews->TotalReviews .')'.'<br />';
                $result_str .= '</a><hr />';
            }
 
            $result_str .= "</td></tr>";
        }
        $result_str .= "</table>";
    }
    return $result_str;
}
 
//-------------------------------------------------------------------
// Main routine.
//-------------------------------------------------------------------
?>
<h2>ASIN search (ItemLookup)</h2>
<?php
$params = aks_make_asin_query("4756136494");
$response = aks_send_query($params);
$parsed_xml = aks_get_parsed_xml( $response );
echo aks_print_items( $response, $parsed_xml );
?>
<h2>Keyword search</h2>
<?php
$params = aks_make_keyword_query("c++", "Books");
$response = aks_send_query($params);
$parsed_xml = aks_get_parsed_xml( $response );
echo aks_print_items( $response, $parsed_xml );
?>
<h2>Similarity search</h2>
<?php
$params = aks_make_similarity_query("4756136494");
$response = aks_send_query($params);
$parsed_xml = aks_get_parsed_xml( $response );
echo aks_print_items( $response, $parsed_xml );
?>
<h2>Browse node search</h2>
<?php
$params = aks_make_node_query("466300","Books");
$response = aks_send_query($params);
$parsed_xml = aks_get_parsed_xml( $response );
echo aks_print_items( $response, $parsed_xml );
?>