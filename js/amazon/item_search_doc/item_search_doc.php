<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>ItemSearch ｜ リクエストとレスポンスについて</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>

		</script>
		
		<style type="text/css">

			.tbl2 td div{
				width:588px;
				word-wrap:break-word;
				overflow: auto; 
				white-space: nowrap; 
				
			}
			
		</style>
		
	</head>
	<body>
		<div id="page1">
		<div id="header">ItemSearch ｜ リクエストとレスポンスについて</div>
		<div id="content" >
		
			
			<div class="sec1">
			
				<a href="https://images-na.ssl-images-amazon.com/images/G/09/associates/paapi/dg/index.html">ドキュメントItemSearch</a>
				<br/><hr/>
				
				<h3>基本的なリクエストパラメータ</h3>
				<table border="1">
							
				
					<thead><tr></tr><th>パラメータ種別</th><th>例</th><th>Parameter</th><th>値	</th><th>説明</th></tr></thead>
					<tbody>
					
						<tr>	<td>必須パラメータ</td>	<td>AWSECommerceService</td>	<td>Service</td>	<td>AWSECommerceService</td>	<td>Product Advertising API のサービスを指定します。</td>	</tr>
						<tr>	<td>必須パラメータ</td>	<td>＊＊＊＊</td>	<td>AWSAccessKeyId</td>	<td>AWS アクセスキー ID</td>	<td>Amazon の Web サイトでアクセスキーIDを割り当てるには、http://aws.amazon.com?をご覧ください。 Product Advertising API 4.0の全てのリクエストは、アクセスキーIDか登録IDのいずれか一方だけを含んでいる必要があります。</td>	</tr>
						<tr>	<td>必須パラメータ</td>	<td></td>	<td>SubscriptionId</td>	<td>Amazonによって割り当てられた登録ID</td>	<td>Product Advertising API 4.0の全てのリクエストは、アクセスキーIDか登録IDのいずれか一方だけを含んでいる必要があります。バージョン2005-10-05以降、Product Advertising API は登録IDの配布を停止しました。すでに登録IDを持っている場合には、引き続き使用できます。</td>	</tr>
						<tr>	<td>必須パラメータ</td>	<td>ItemLookup</td>	<td>Operation</td>	<td>実行するオペレーション。例えば、?ItemLookup</td>	<td>Product Advertising API のいずれかのオペレーションタイプです。</td>	</tr>
						<tr>	<td>一般的なオプションパラメータ</td>	<td>amaraimusi-22</td>	<td>AssociateTag</td>	<td>Amazonによって割り当てられたアソシエイトID</td>	<td>AssociateTagを使用すると、Product Advertising API から返される商品のURLに、ご自身のアソシエイトWeb サイトから送客されたことを示すタグを付けることができます。商品の販売に対する紹介料を受け取るには、AssociateTag の値を?CartCreate?リクエストに指定する必要があります。必ず正しい値を指定してください。誤った値を指定してもエラーは生成されません。</td>	</tr>
						<tr>	<td>一般的なオプションパラメータ</td>	<td></td>	<td>MerchantId</td>	<td>Amazon によってマーチャントに割り当てられた英数字の文字列。</td>	<td>MerchantIdには3つの設定があります。All (全てのマーチャントがレスポンスに含まれます)、単一のマーチャントを指定する英数字のID、 "FeaturedBuyBoxMerchant" (商品の詳細ページで "ショッピングカートに入れる" ボタンのあるボックスに表示される、"Buy Box Winner" と呼ばれるマーチャントを返します)のいずれかです。 "Buy Box Winner" は、"ショッピングカートに入れる" ボタンのある商品の出品に関連付けられているマーチャントです。"ショッピングカートに入れる" ボタンは、商品の詳細ページにあるボタンで、ショッピングカートに商品を追加できるようにします。MerchantIdのデフォルト値は "Amazon" です。</td>	</tr>
						<tr>	<td>一般的なオプションパラメータ</td>	<td>ItemAttributes,Offers,Images</td>	<td>ResponseGroup</td>	<td>各種の値</td>	<td>返されるデータのサブセットを指定します。APIリファレンスガイドは、各オペレーションで使用できるレスポンスグループを指定します。</td>	</tr>
						<tr>	<td>一般的なオプションパラメータ</td>	<td>40087</td>	<td>Version</td>	<td>各種の値</td>	<td>Product Advertising API 4.0 WSDLのバージョンです。デフォルトは2005-10-05です。最新バージョンなど、別のバージョンを使用する場合は、リクエスト内で指定する必要があります。</td>	</tr>
						<tr>	<td>XSLパラメータ</td>	<td></td>	<td>Style</td>	<td>"XML" (デフォルト)またはXSLスタイルシートのURL</td>	<td>Styleパラメータは、RESTリクエストにのみ適用されます。Styleパラメータは、Product Advertising API で返されるデータの形式の制御に使用します。このパラメータに "XML" を設定すると、純粋なXMLレスポンスが生成されます。このパラメータにXSLスタイルシートのURLを指定すると、XMLレスポンスを指定した形式に変換されます。</td>	</tr>
						<tr>	<td>XSLパラメータ</td>	<td></td>	<td>ContentType</td>	<td>"text/xml" (デフォルト)または "text/html"</td>	<td>ContentTypeパラメータは、RESTリクエストでのみ有効です。リクエストで設定したContentTypeが、Product Advertising API が返すレスポンスのHTTPヘッダのコンテンツタイプとして返されます。通常、ContentTypeが変更されるのは、Style?パラメータが指定されているXSLTスタイルシートとともに使われる場合に限られます。スタイルシートを使用して Product Advertising API のレスポンスをHTMLに変換する場合は、このパラメータに text/html を設定します。</td>	</tr>
						<tr>	<td>XMLエンコードされたパラメータ</td>	<td></td>	<td>XMLEscaping</td>	<td>"Single" (デフォルト) または "Double"</td>	<td>XMLEscapingは、レスポンスをシングルパスとダブルパスのどちらでXMLエンコードするかを指定します。デフォルトでは,?XMLEscapingは "Single" で、Product Advertising API のレスポンスは XML 内で1回だけエンコードされます。例えば、レスポンスデータにアンパサンド文字 (&) が含まれている場合、その文字は通常のXMLエンコード (&) で返されます。もし?XMLEscapingが "Double" の場合、同じアンパサンド文字が2回 XML エンコードされます（&amp;）。このXMLEscapingの値 "Double" は、XML 要素内のテキストをデコードしない、PHP などのクライアントで便利です。</td>	</tr>
						<tr>	<td>デバッグパラメータ</td>	<td></td>	<td>Validate</td>	<td>"False" (デフォルト) または "True"</td>	<td>Validate?パラメータは、Product Advertising API に対し、リクエストを実際に実行せずにテストすることを指示します。リクエストにValidate?を指定する場合、値は必ず "True" にしてください。リクエストが有効な場合、レスポンス内の IsValid 要素の値は True になっています。 リクエストが無効な場合、レスポンスに、1)値がFalseになっているIsValid要素と、2)リクエストを実際に実行したときに返されるエラーが含まれます。注意: リクエストは実際には実行されないため、リクエストのエラーの一部だけが返されることがあります。これは、一部のエラー (例えば、no_exact_matches=リクエストに該当する結果がありません) はリクエストの実行中にしか生成されないためです。</td>	</tr>
											
					</tbody>
				</table>
				<a href="https://images-na.ssl-images-amazon.com/images/G/09/associates/paapi/dg/index.html">共通のリクエストパラメータ</a>
				
				<br/><hr/>
				<h3>ＩｔｅｍＳｅａｒｃｈの主なリクエスト</h3>
				<table border="1">
					<thead><tr><th>プロパティ</th><th>例</th><th>有効なサーチインデックス</th><th>説明</th></tr></thead>
					<tbody>
						<tr><td>BrowseNode</td><td>466284</td><td>All、Blended を除く全て</td><td>
							ブラウズノードは、商品カタログを識別する正の整数です。<br />
							例えば、文学・評論は 466284、医学・薬学は 492166、社会・政治は 571584、ノンフィクションは 492152、
							科学・テクノロジーは 466290 となります。<br />
							タイプ: 文字列,
							デフォルト: なし,
							有効な値: 正の整数
						</td></tr>

						<tr><td>Keywords</td><td>夏目漱石</td><td>全て</td><td>
							商品に関連する単語または語句。<br />
							これらの単語や語句は、商品に関するさまざまなフィールド
							（商品のタイトル、著者、アーティスト、商品説明、メーカー名など）で使用できます。<br />
							たとえば、サーチインデックスが "MusicTracks" の場合、Keywordsパラメータを使用して曲のタイトルを検索できます。<br />
							語句を入力する場合、スペースを %20 に URL エンコードしてください。<br />
							タイプ: 文字列,デフォルト: なし
						</td></tr>
						
						<tr><td>MaximumPrice</td><td>3241</td><td>All、Blended を除く全て</td><td>
							商品の最高価格をレスポンスに指定します。<br />
							価格は、最低通貨単位（ペニーなど）を基準としています。<br />
							例えば、US サイトの場合、3241 は 32.41 ドルを表します。JP サイトの場合、3241 は 3241 円を表します。<br />
							タイプ: 文字列,デフォルト: なし,有効な値: 正の整数
						</td></tr>
						
						<tr><td>MerchantId</td><td>All</td><td>All、Blended を除く全て</td><td>
							商品を出品しているマーチャントを指定します。
							MerchantIdは Amazon がマーチャントに割り当てた半角英数字の ID です。<br />
							出品者 ID ではなく必ずマーチャント ID を使用してください。<br />
							出品者 ID はサポートされていません。デフォルト値は "Amazon" です。<br />
							リクエストで結果が何も返されない場合は、値を "All" に設定してみてください。<br />
							タイプ: 文字列,デフォルト: Amazon<br />
							有効な値:マーチャントの有効なマーチャント ID<br />
							　All-- Amazon とほかの全てのマーチャント<br />
							　Featured-- "Add to Cart (ショッピングカートに入れる)" をクリックしたときに表示されるマーチャント（USサイトのみ）<br />
						</td></tr>
						
						<tr><td>MinimumPrice</td><td>3241</td><td>All、Blended を除く全て</td><td>
							商品の最低価格をレスポンスに指定します。<br />
							価格は、最低通貨単位（ペニーなど）を基準としています。<br />
							例えば、US サイトの場合、3241 は 32.41 ドルを表します。JP サイトの場合、3241 は 3241 円を表します。<br />
							タイプ: 文字列,デフォルト: なし,有効な値: 正の整数
						</td></tr>
						
						<tr><td>Title</td><td>Ｃ＋＋</td><td>All、Blended を除く全て</td><td>
							商品に関連したタイトル。<br />
							タイトルの全部または一部を入力できます。<br />
							Title検索は、Keyword検索のうちの1つです。<br />
							もしTitle検索によって十分な結果が得られない場合は、Keywords 検索をお試しください。<br />
							タイプ: 文字列,デフォルト: なし
						</td></tr>
						
					</tbody>
				</table>
				※他にも多数の検索項目がある。<a href="https://images-na.ssl-images-amazon.com/images/G/09/associates/paapi/dg/index.html">参照</a>
				
				
				
				
				<br/><hr />
				<h3>主なレスポンス</h3>
				<table border="1" >
					<thead><tr><th>プロパティ</th><th width="400">例</th><th>説明</th></tr></thead>
					<tbody>
						<tr>	<td>ASIN</td>	<td>4873115655</td>	<td>Amazon Standard Identification Number の略。Amazon によって割り当てられた、商品を一意に識別する半角英数字の文字列です。</td>	</tr>
						<tr>	<td>DetailPageURL</td>	<td>http://www.amazon.co.jp/<br />
							%E3%83%AA%E3%83%BC%E3%83%80%E3%83%96%E3%83%AB%E3%82%B3%E3%83%BC%E3%83%89-<br />
							%E2%80%95%E3%82%88%E3%82%8A%E8%89%AF%E3%81%84%E3%82%B3%E3%83%BC%E3%83%89<br />
							%E3%82%92%E6%9B%B8%E3%81%8F%E3%81%9F%E3%82%81%E3%81%AE%E3%82%B7%E3%83%B3<br />
							%E3%83%97%E3%83%AB%E3%81%A7%E5%AE%9F%E8%B7%B5%E7%9A%84%E3%81%AA%E3%83%86<br />
							%E3%82%AF%E3%83%8B%E3%83%83%E3%82%AF-Theory-practice-Boswell/<br />
							dp/4873115655%3FSubscriptionId%3DAKIAJ2EO6YDAN5HRF4RQ%26tag%3Damaraimusi-22<br />
							%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3D4873115655</td>	<td>商品の Web サイトのURL。商品のタイトル、在庫状況、類似品、機能、アクセサリ、商品の説明、商品のカスタマーレビュー、商品に関するニュース記事へのリンク、関連するリストマニアのリスト、"So You’d Like To...." リスト、"Browse For Photo" リストが指定されます。</td>	</tr>
						<tr>	<td>Item</td>	<td>子要素のプロパティが多数。</td>	<td>ASIN、DetailPageURL、ItemAttributes を含む、商品情報のコンテナ。</td>	</tr>
						<tr>	<td>ItemAttributes</td>	<td>子要素のプロパティが多数。</td>	<td>Manufacturer、ProductGroup、Title を含む、商品についての情報のコンテナ。</td>	</tr>
						<tr>	<td>Manufacturer</td>	<td>翔泳社</td>	<td>商品のメーカー。</td>	</tr>
						<tr>	<td>ProductGroup</td>	<td>Book</td>	<td>商品カテゴリ。サーチインデックスに類似しています。</td>	</tr>
						<tr>	<td>Title</td>	<td>Cの絵本―C言語が好きになる9つの扉</td>	<td>商品のタイトル。</td>	</tr>
						<tr>	<td>TotalPages</td>	<td>82</td>	<td>レスポンスのページの合計数。各ページには10個の商品が表示されます。</td>	</tr>
						<tr>	<td>TotalResults</td>	<td>812</td>	<td>商品の総数。</td>	</tr>
					
					</tbody>
				</table>
				
				<hr />
				<h3>レスポンス一覧</h3>
				<table border="1" class="tbl2">
					<thead><th>プロパティ</th><th>例</th></thead>
					<tbody>
					
						<tr>	<td><div>?xml version="1.0" ?</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>ItemSearchResponse xmlns="http://webservices.amazon.com/AWSECommerceService/2011-08-01"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　OperationRequest</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　RequestId</div></td>	<td><div>7dc137e7-fb45-474b-b7ca-672302d0395f</div></td>	</tr>
						<tr>	<td><div>　　Arguments</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Service" Value="AWSECommerceService"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Keywords" Value="c++"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="SignatureMethod" Value="HmacSHA256"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Timestamp" Value="2013-08-27T01:45:33Z"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Operation" Value="ItemSearch"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="AssociateTag" Value="amaraimusi-22"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Version" Value="2009-10-01"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Sort" Value="salesrank"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="SearchIndex" Value="Books"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="SignatureVersion" Value="2"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="Signature" Value="p8HnwuQaOt1ZgkYHraAJx0EjHxZn28jYEgWsBcaQwg4="</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="AWSAccessKeyId" Value="AKIAJ2EO6YDAN5HRF4RQ"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Argument Name="ResponseGroup" Value="ItemAttributes,Offers,Images"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　RequestProcessingTime</div></td>	<td><div>0.138099</div></td>	</tr>
						<tr>	<td><div>　Items</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　Request</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　IsValid</div></td>	<td><div>TRUE</div></td>	</tr>
						<tr>	<td><div>　　　ItemSearchRequest</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Keywords</div></td>	<td><div>c++</div></td>	</tr>
						<tr>	<td><div>　　　　ResponseGroup</div></td>	<td><div>ItemAttributes</div></td>	</tr>
						<tr>	<td><div>　　　　ResponseGroup</div></td>	<td><div>Offers</div></td>	</tr>
						<tr>	<td><div>　　　　ResponseGroup</div></td>	<td><div>Images</div></td>	</tr>
						<tr>	<td><div>　　　　SearchIndex</div></td>	<td><div>Books</div></td>	</tr>
						<tr>	<td><div>　　　　Sort</div></td>	<td><div>salesrank</div></td>	</tr>
						<tr>	<td><div>　TotalResults</div></td>	<td><div>812</div></td>	</tr>
						<tr>	<td><div>　TotalPages</div></td>	<td><div>82</div></td>	</tr>
						<tr>	<td><div>　MoreSearchResultsUrl</div></td>	<td><div>http://www.amazon.co.jp/gp/redirect.html?camp=2025&amp;creative=5143&amp;location=http%3A%2F%2Fwww.amazon.co.jp%2Fgp%2Fsearch%3Fkeywords%3Dc%252B%252B%26url%3Dsearch-alias%253Dbooks-single-index&amp;linkCode=xm2&amp;tag=amaraimusi-22&amp;SubscriptionId=AKIAJ2EO6YDAN5HRF4RQ</div></td>	</tr>
						<tr>	<td><div>　Item</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　ASIN</div></td>	<td><div>4873115655</div></td>	</tr>
						<tr>	<td><div>　　DetailPageURL</div></td>	<td><div>http://www.amazon.co.jp/%E3%83%AA%E3%83%BC%E3%83%80%E3%83%96%E3%83%AB%E3%82%B3%E3%83%BC%E3%83%89-%E2%80%95%E3%82%88%E3%82%8A%E8%89%AF%E3%81%84%E3%82%B3%E3%83%BC%E3%83%89%E3%82%92%E6%9B%B8%E3%81%8F%E3%81%9F%E3%82%81%E3%81%AE%E3%82%B7%E3%83%B3%E3%83%97%E3%83%AB%E3%81%A7%E5%AE%9F%E8%B7%B5%E7%9A%84%E3%81%AA%E3%83%86%E3%82%AF%E3%83%8B%E3%83%83%E3%82%AF-Theory-practice-Boswell/dp/4873115655%3FSubscriptionId%3DAKIAJ2EO6YDAN5HRF4RQ%26tag%3Damaraimusi-22%26linkCode%3Dxm2%26camp%3D2025%26creative%3D165953%26creativeASIN%3D4873115655</div></td>	</tr>
						<tr>	<td><div>　　ItemLinks</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　ItemLink</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Description</div></td>	<td><div>Add To Wishlist</div></td>	</tr>
						<tr>	<td><div>　　　URL</div></td>	<td><div>http://www.amazon.co.jp/gp/registry/wishlist/add-item.html%3Fasin.0%3D4873115655%26SubscriptionId%3DAKIAJ2EO6YDAN5HRF4RQ%26tag%3Damaraimusi-22%26linkCode%3Dxm2%26camp%3D2025%26creative%3D5143%26creativeASIN%3D4873115655</div></td>	</tr>
						<tr>	<td><div>　　　ItemLink</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Description</div></td>	<td><div>Tell A Friend</div></td>	</tr>
						<tr>	<td><div>　　　　URL</div></td>	<td><div>http://www.amazon.co.jp/gp/pdp/taf/4873115655%3FSubscriptionId%3DAKIAJ2EO6YDAN5HRF4RQ%26tag%3Damaraimusi-22%26linkCode%3Dxm2%26camp%3D2025%26creative%3D5143%26creativeASIN%3D4873115655</div></td>	</tr>
						<tr>	<td><div>　　　SmallImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL75_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　Height Units="pixels"</div></td>	<td><div>75</div></td>	</tr>
						<tr>	<td><div>　　　　Width Units="pixels"</div></td>	<td><div>53</div></td>	</tr>
						<tr>	<td><div>　　　MediumImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL160_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　Height Units="pixels"</div></td>	<td><div>160</div></td>	</tr>
						<tr>	<td><div>　　　　Width Units="pixels"</div></td>	<td><div>113</div></td>	</tr>
						<tr>	<td><div>　　LargeImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L.jpg</div></td>	</tr>
						<tr>	<td><div>　　　Height Units="pixels"</div></td>	<td><div>500</div></td>	</tr>
						<tr>	<td><div>　　　Width Units="pixels"</div></td>	<td><div>354</div></td>	</tr>
						<tr>	<td><div>　　ImageSets</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　ImageSet Category="primary"</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　SwatchImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL30_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>30</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>21</div></td>	</tr>
						<tr>	<td><div>　　　　SmallImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL75_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>75</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>53</div></td>	</tr>
						<tr>	<td><div>　　　　ThumbnailImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL75_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>75</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>53</div></td>	</tr>
						<tr>	<td><div>　　　　TinyImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL110_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>110</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>78</div></td>	</tr>
						<tr>	<td><div>　　　　MediumImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L._SL160_.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>160</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>113</div></td>	</tr>
						<tr>	<td><div>　　　　LargeImage</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　URL</div></td>	<td><div>http://ecx.images-amazon.com/images/I/51MgH8Jmr3L.jpg</div></td>	</tr>
						<tr>	<td><div>　　　　　Height Units="pixels"</div></td>	<td><div>500</div></td>	</tr>
						<tr>	<td><div>　　　　　Width Units="pixels"</div></td>	<td><div>354</div></td>	</tr>
						<tr>	<td><div>　　ItemAttributes</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　Author</div></td>	<td><div>Dustin Boswell</div></td>	</tr>
						<tr>	<td><div>　　　Author</div></td>	<td><div>Trevor Foucher</div></td>	</tr>
						<tr>	<td><div>　　　Binding</div></td>	<td><div>単行本（ソフトカバー）</div></td>	</tr>
						<tr>	<td><div>　　　Creator Role="解説"</div></td>	<td><div>須藤 功平</div></td>	</tr>
						<tr>	<td><div>　　　Creator Role="翻訳"</div></td>	<td><div>角 征典</div></td>	</tr>
						<tr>	<td><div>　　　EAN</div></td>	<td><div>9784873115658</div></td>	</tr>
						<tr>	<td><div>　　　EANList</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　EANListElement</div></td>	<td><div>9784873115658</div></td>	</tr>
						<tr>	<td><div>　　　IsAdultProduct</div></td>	<td><div>0</div></td>	</tr>
						<tr>	<td><div>　　　ISBN</div></td>	<td><div>4873115655</div></td>	</tr>
						<tr>	<td><div>　　　Label</div></td>	<td><div>オライリージャパン</div></td>	</tr>
						<tr>	<td><div>　　　Languages</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Language</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　Name</div></td>	<td><div>日本語</div></td>	</tr>
						<tr>	<td><div>　　　Type</div></td>	<td><div>Published</div></td>	</tr>
						<tr>	<td><div>　　　ListPrice</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Amount</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　　CurrencyCode</div></td>	<td><div>JPY</div></td>	</tr>
						<tr>	<td><div>　　　　FormattedPrice</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　Manufacturer</div></td>	<td><div>オライリージャパン</div></td>	</tr>
						<tr>	<td><div>　　　NumberOfPages</div></td>	<td><div>260</div></td>	</tr>
						<tr>	<td><div>　　　PackageDimensions</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Height Units="hundredths-inches"</div></td>	<td><div>63</div></td>	</tr>
						<tr>	<td><div>　　　　Length Units="hundredths-inches"</div></td>	<td><div>827</div></td>	</tr>
						<tr>	<td><div>　　　　Weight Units="hundredths-pounds"</div></td>	<td><div>79</div></td>	</tr>
						<tr>	<td><div>　　　　Width Units="hundredths-inches"</div></td>	<td><div>591</div></td>	</tr>
						<tr>	<td><div>　　　ProductGroup</div></td>	<td><div>Book</div></td>	</tr>
						<tr>	<td><div>　　　ProductTypeName</div></td>	<td><div>ABIS_BOOK</div></td>	</tr>
						<tr>	<td><div>　　　PublicationDate</div></td>	<td><div>41083</div></td>	</tr>
						<tr>	<td><div>　　　Publisher</div></td>	<td><div>オライリージャパン</div></td>	</tr>
						<tr>	<td><div>　　　Studio</div></td>	<td><div>オライリージャパン</div></td>	</tr>
						<tr>	<td><div>　　　Title</div></td>	<td><div>リーダブルコード ―より良いコードを書くためのシンプルで実践的なテクニック (Theory in practice)</div></td>	</tr>
						<tr>	<td><div>　　OfferSummary</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　LowestNewPrice</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Amount</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　　CurrencyCode</div></td>	<td><div>JPY</div></td>	</tr>
						<tr>	<td><div>　　　　FormattedPrice</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　LowestUsedPrice</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　Amount</div></td>	<td><div>2250</div></td>	</tr>
						<tr>	<td><div>　　　　CurrencyCode</div></td>	<td><div>JPY</div></td>	</tr>
						<tr>	<td><div>　　　　FormattedPrice</div></td>	<td><div>2250</div></td>	</tr>
						<tr>	<td><div>　　　TotalNew</div></td>	<td><div>1</div></td>	</tr>
						<tr>	<td><div>　　　TotalUsed</div></td>	<td><div>11</div></td>	</tr>
						<tr>	<td><div>　　　TotalCollectible</div></td>	<td><div>0</div></td>	</tr>
						<tr>	<td><div>　　　TotalRefurbished</div></td>	<td><div>0</div></td>	</tr>
						<tr>	<td><div>　　Offers</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　TotalOffers</div></td>	<td><div>1</div></td>	</tr>
						<tr>	<td><div>　　　TotalOfferPages</div></td>	<td><div>1</div></td>	</tr>
						<tr>	<td><div>　　　MoreOffersUrl</div></td>	<td><div>http://www.amazon.co.jp/gp/offer-listing/4873115655%3FSubscriptionId%3DAKIAJ2EO6YDAN5HRF4RQ%26tag%3Damaraimusi-22%26linkCode%3Dxm2%26camp%3D2025%26creative%3D5143%26creativeASIN%3D4873115655</div></td>	</tr>
						<tr>	<td><div>　　　Offer</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　OfferAttributes</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　Condition</div></td>	<td><div>New</div></td>	</tr>
						<tr>	<td><div>　　　　OfferListing</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　OfferListingId</div></td>	<td><div>vtpRt4ITPfsAuQ8WJ8fR2wGJuNe8eR53d%2B%2Bok%2Bef7QOIbDYnqV0yU4%2BrOD6GQsrz30VxKc1OcrIqoi26UbMnFZgeUPwSt17e%2FmHUGuYLEl8%3D</div></td>	</tr>
						<tr>	<td><div>　　　　　Price</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　　Amount</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　　　　CurrencyCode</div></td>	<td><div>JPY</div></td>	</tr>
						<tr>	<td><div>　　　　　　FormattedPrice</div></td>	<td><div>2520</div></td>	</tr>
						<tr>	<td><div>　　　　　Availability</div></td>	<td><div>在庫あり。</div></td>	</tr>
						<tr>	<td><div>　　　　　AvailabilityAttributes</div></td>	<td><div></div></td>	</tr>
						<tr>	<td><div>　　　　　　AvailabilityType</div></td>	<td><div>now</div></td>	</tr>
						<tr>	<td><div>　　　　　　MinimumHours</div></td>	<td><div>0</div></td>	</tr>
						<tr>	<td><div>　　　　　　MaximumHours</div></td>	<td><div>0</div></td>	</tr>
						<tr>	<td><div>　　　　　IsEligibleForSuperSaverShipping</div></td>	<td><div>1</div></td>	</tr>

					</tbody>
				</table>
				
				
				
				
				<br/><hr/>
				<h3>各言語ごとの母体URL（エンドポイント）</h3>
				<table border="1">
					<thead><tr><th>国名</th><th>国コード</th><th>通貨コード</th><th>母体URL</th></tr></thead>
					<tbody>
					
						<tr><td>アメリカ</td><td>US</td><td>USD</td>
						<td>
							http://ecs.amazonaws.com/onca/xml<br />
							https://aws.amazonaws.com/onca/xml
						</td></tr>
					
						<tr><td>カナダ</td><td>CA</td><td>CAD</td>
						<td>
							http://ecs.amazonaws.ca/onca/xml<br />
							https://aws.amazonaws.ca/onca/xml
						</td></tr>
					
						<tr><td>ドイツ</td><td>DE</td><td>EUR</td>
						<td>
							http://ecs.amazonaws.de/onca/xml<br />
							https://aws.amazonaws.de/onca/xml
						</td></tr>
					
						<tr><td>フランス</td><td>FR</td><td>EUR</td>
						<td>
							http://ecs.amazonaws.fr/onca/xml<br />
							https://aws.amazonaws.fr/onca/xml
						</td></tr>
					
						<tr><td>日本</td><td>JP</td><td>JPY</td>
						<td>
							http://ecs.amazonaws.jp/onca/xml<br />
							https://aws.amazonaws.jp/onca/xml
						</td></tr>
					
						<tr><td>イギリス</td><td>UK</td><td>GBP</td>
						<td>
							http://ecs.amazonaws.co.uk/onca/xml<br />
							https://aws.amazonaws.co.uk/onca/xml
						</td></tr>

						
					</tbody>
				</table>
				<div style="font-size:0.8em">※備考：母体URLの上段URLは通常URL。下段URLはセキュリティ強化版</div>
				<div style="padding-top:5px">参考</div>
				<div style="padding-left:1em">
					<a href="https://images-na.ssl-images-amazon.com/images/G/09/associates/paapi/dg/index.html" >国ごとのエンドポイント</a>
					：URLへアクセス後、カテゴリ移動。「ようこそ » プログラミングガイド » リクエスト » REST リクエストの構造」
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			</div><!-- sec1 -->
			
			
			
			
		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2013/08/26</div>
		</div><!-- page1 -->
	</body>
</html>