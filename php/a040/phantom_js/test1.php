<?php 
require_once 'vendor/autoload.php';
use JonnyW\PhantomJs\Client;

$client = Client::getInstance();
//$client->getEngine()->setPath('absolute_path/bin/phantomjs.exe');
$client->getEngine()->setPath('vendor\bin\phantomjs.exe');

$request  = $client->getMessageFactory()->createRequest();
$response = $client->getMessageFactory()->createResponse();
$request->setTimeout(60 * 1000); // extend timeout to 1 minute (60000 ms)
$request->setMethod('GET');
$url = "https://www.airbnb.jp/s/homes?adults=0&children=0&infants=0&toddlers=0&query=%E4%BB%8A%E5%B8%B0%E4%BB%81%E6%9D%91&place_id=ChIJ5_T88nP45DQR609M5CqBS9Q&refinement_paths%5B%5D=%2Fhomes&allow_override%5B%5D=&s_tag=LJBefm-j";
//$url = "https://www.airbnb.jp/s/homes";

$request->setUrl($url);
//$request->setUrl('https://pg.kdtk.net/sample/phamtomjs_test.html');
//$request->setUrl('http://amaraimusi.sakura.ne.jp/');

$client->send($request, $response);

// echo $response->getContent();
// echo '<br>';
echo $client->getLog();
echo "request url: " . $request->getUrl() . "<br>";
echo "response: " . $response->getStatus() . "<br>";
if($response->getStatus() === 200) {
	echo "content: \n";
	echo $response->getContent();
}

echo 'TEST';