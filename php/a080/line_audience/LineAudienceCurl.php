<?php 

namespace App\Services\Audience;


/**
 * LINE リッチメニュープラットフォームにCURLコマンドでリッチメニューを配信設定する。
 *
 */
class LineAudienceCurl{
	
	
	public function getAudienceList($access_token){

		$errs = [];
		
		// エンドポイントURL
		$url = 'https://api.line.me/v2/bot/audienceGroup/list';
		
		// cURLセッションを初期化
		$ch = curl_init($url);
		
		// HTTPヘッダを設定
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer ' . $access_token,
		));
		
		// 返り値を文字列として受け取るよう設定
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// GETリクエストを実行
		$response = curl_exec($ch);
		
		// cURLセッションを閉じる
		curl_close($ch);
		
		
		$res = json_decode($response,true);//JSONデコード

		if($res===null){
			$errs[] = "オーディエンス一覧の取得に失敗しました。" . $res;
		}
	
		return [
				'errs' => $errs,
				'list' => $res,
		];
	}
	
	
	public function getAudienceReg($params){
		
		
		$accessToken = 'lPdXJ1j4doZCNpA8gecTEldh9R+mq3XboSroYwUTwiU0cwQRoqEHG8DF8QXLlM9xVekwxxRMhckI2Aim+nqF3SOaKvZMrtipijoqzvjjocigrg7oPCwCmUZXpXSXpXvi2GqIlV5QBSagUHTzrmKLSAdB04t89/1O/w1cDnyilFU='; // ここにLINE APIのアクセストークンを設定
		
		$url = 'https://api.line.me/v2/bot/audienceGroup/click';
		
		$headers = [
				'Authorization: Bearer ' . $accessToken,
				'Content-Type: application/json',
		];
		
		$data = [
				'description' => 'kitune',
				//'clickUrl' => 'https://amaraimusi.sakura.ne.jp/',
				// 'requestId' はオプショナルです。必要に応じて設定してください。
				'requestId' => '478435281'
		];
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		echo $response;
		
		
// 		$url = 'https://api.line.me/v2/bot/audienceGroup/upload';
		
// 		$headers = [
// 				'Authorization: Bearer ' . $accessToken,
// 				'Content-Type: application/json',
// 		];
		
// 		$data = [
// 				'description' => 'kitune',
// 				'isIfaAudience' => false,
// 				'audiences' => [
// 						[
// 								'id' => null, // requestIdがないのでnullを設定
// 								'type' => 'CLICK',
// 								'clickUrl' => 'https://amaraimusi.sakura.ne.jp/',
// 						],
// 				],
// 		];
		
// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
// 		$response = curl_exec($ch);
// 		curl_close($ch);
		
// 		dump($response);//■■■□□□■■■□□□)
		
// 		$access_token = $params['access_token']; //
// 		$description = $params['description']; // オーディエンス名
// 		$request_id = $params['request_id']; // ブロードキャストメッセージとナローキャストメッセージのリクエストID
// 		$click_url = $params['click_url']; // ユーザーがクリックしたURL
// 		$audiences = $params['audiences']; // ユーザーIDまたはIFAの配列
		
	
// 		$url = 'https://api.line.me/v2/bot/audienceGroup/upload';
		
// 		$headers = [
// 				'Authorization: Bearer ' . $access_token,
// 				'Content-Type: application/json',
// 		];
		
// 		$data = [
// 				'description' => 'kitune',
// 				'isIfaAudience' => false,
// 				'audiences' => [
// 						[
// 								'id' => null, // requestIdがないのでnullを設定
// 								'type' => 'CLICK',
// 								'clickUrl' => $click_url,
// 						],
// 				],
// 		];
		
// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
// 		$response = curl_exec($ch);
		
// 		$res = json_decode($response,true);//JSONデコード
// 		dump($res);//■■■□□□■■■□□□)
		
// 		if($res===null){
// 			$errs[] = "オーディエンス一覧の取得に失敗しました。" . $res;
// 		}
		
// 		return [
// 				'errs' => $errs,
// 				'list' => $res,
// 		];
	}
	
	
	
	public function naroMsg(){
		$accessToken = 'YOUR_ACCESS_TOKEN'; // LINEボットのチャネルアクセストークンを設定
		$accessToken = 'lPdXJ1j4doZCNpA8gecTEldh9R+mq3XboSroYwUTwiU0cwQRoqEHG8DF8QXLlM9xVekwxxRMhckI2Aim+nqF3SOaKvZMrtipijoqzvjjocigrg7oPCwCmUZXpXSXpXvi2GqIlV5QBSagUHTzrmKLSAdB04t89/1O/w1cDnyilFU='; // ここにLINE APIのアクセストークンを設定
		
		
		$url = 'https://api.line.me/v2/bot/message/narrowcast';
		
		$headers = [
				'Authorization: Bearer ' . $accessToken,
				'Content-Type: application/json',
		];
		
		$data = [
				'messages' => [
						[
								'type' => 'text',
								'text' => 'Hello, this is a narrowcast message!' // 送信するメッセージ
						]
				],
				'filter' => [
						'demographic' => [
								'appVersion' => '>= 8.0.0',
								'language' => 'ja'
						]
				],
				// 追加で他のオプションを指定する場合はここに記述
		];
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		echo $response;
		
// 		$url = 'https://api.line.me/v2/bot/message/narrowcast';
		
// 		$headers = [
// 				'Authorization: Bearer ' . $accessToken,
// 				'Content-Type: application/json',
// 		];
		
// 		$data = [
// 				'messages' => [
// 						[
// 								'type' => 'text',
// 								'text' => 'Hello, this is a narrowcast message!' // 送信するメッセージ
// 						]
// 				],
// 				'recipient' => [
// 						// ターゲットユーザーの条件を設定
// 						'demographic' => [
// 								'type' => 'operator',
// 								'and' => [
// 										[
// 												'type' => 'language',
// 												'value' => 'ja' // 言語が日本語のユーザーをターゲット
// 										],
// 										[
// 												'type' => 'appVersion',
// 												'op' => '>=',
// 												'value' => '8.0.0' // アプリバージョンが8.0.0以上のユーザーをターゲット
// 										]
// 								]
// 						]
// 				]
// 		];
		
// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
// 		$response = curl_exec($ch);
// 		curl_close($ch);
		
// 		echo $response;
	}
	
	
// 	/**
//  	 * LINE リッチメニュープラットフォームにCURLコマンドでリッチメニューを配信設定する。
// 	 *
// 	 * @param array $param
// 	 * @return []
// 	 * - richMenuId リッチメニューID
// 	 *  - errs エラーメッセージ配列 :成功時はerrsのメッセージは空。
// 	 */
// 	public function curlTemplateToLine($access_token, $rich_menu_json){
		
// 		$errs = [];
		
// 		// LINE APIのURL
// 		$url = 'https://api.line.me/v2/bot/richmenu';

// 		// リクエストヘッダー
// 		$headers = [
// 				"Authorization: Bearer {$access_token}",
// 				'Content-Type: application/json',
// 		];

// 		$ch = curl_init($url);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $rich_menu_json);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 		$result = curl_exec($ch); // リクエストの実行

		
// 		// エラーチェック
// 		if (curl_errno($ch)) {
// 			$errs[] = 'LINEプラットフォームへのリッチメニュー登録に失敗しました。' . curl_error($ch);
// 		}
	
// 		// cURLセッションの終了
// 		curl_close($ch);

// 		$res = json_decode($result,true);//JSONデコード
		
// 		$richMenuId = '';
// 		if($res===null){
// 			$errs[] = "LINEプラットフォームへのリッチメニュー登録に失敗しました。" . $res;
// 		}else{
// 			$richMenuId = $res['richMenuId'];
// 		}
		
// 		return [
// 				'errs' => $errs,
// 				'richMenuId' => $richMenuId,
// 		];
		
// 	}
	
	
// 	/**
// 	 * LINEリッチメニューの画像をLINEに送信する。
// 	 *
// 	 * @param array $param
// 	 * @return []
// 	 *  - errs エラーメッセージ配列 :成功時はerrsのメッセージは空。
// 	 */
// 	public function curlImgToLine($params){
		
// 		$errs = [];
		
// 		$access_token = $params['access_token'];
// 		$line_rich_menu_id = $params['line_rich_menu_id'];
// 		$img_path = $params['img_path'];
		
// 		// ファイルの拡張子を取得し、拡張子を小文字に変換
// 		$ext = pathinfo($img_path, PATHINFO_EXTENSION);
// 		$ext = strtolower($ext);
		
// 		// MIMEタイプの確認（サポートされている形式のみ）
// 		if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
// 			echo "Unsupported file format";
// 			return;
// 		}
		
// 		// 正しいMIMEタイプを設定
// 		$mime = ($ext == "png") ? "image/png" : "image/jpeg";
		
// 		// LINE APIのエンドポイント
// 		$url = "https://api-data.line.me/v2/bot/richmenu/{$line_rich_menu_id}/content";
		
// 		// ヘッダー
// 		$headers = [
// 				"Authorization: Bearer {$access_token}",
// 				"Content-Type: {$mime}"
// 				];
		
// 		// cURLセッションの初期化
// 		$ch = curl_init($url);
		
// 		// ファイルの内容を読み込む
// 		$data = file_get_contents($img_path);
// 		if ($data === false) {
// 			$errs[] = "LINEへの画像送信に失敗しました。画像読込に失敗しました。";
// 			return ['errs' => $errs];
// 		}
		
// 		// オプションの設定
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 		curl_setopt($ch, CURLOPT_POST, true);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
// 		// リクエストの実行
// 		$response = curl_exec($ch);
		
// 		// エラーチェック
// 		if (curl_errno($ch)) {
// 			$errs[] = "LINEへの画像送信に失敗しました。" .  curl_error($ch);
// 		}
		
// 		// cURLセッションの終了
// 		curl_close($ch);
		
		
// 		$res = json_decode($response,true);//JSONデコード
// 		$errs = array_merge($errs, $res);
		
// 		return ['errs' => $errs];
		
// 	}
	
	
// // 	/**■■■□□□■■■□□□
// // 	 * LINEリッチメニューをデフォルトに設定するようLINEに送信する（リッチメニューを適用）
// // 	 *
// // 	 * @param array $param
// // 	 * @return []
// // 	 *  - errs エラーメッセージ配列 :成功時はerrsのメッセージは空。
// // 	 */
// // 	public function curlDefaultToLine($params){
		
// // 		$errs = [];
// // 		$access_token = $params['access_token'];
// // 		$line_rich_menu_id = $params['line_rich_menu_id'];

		
// // 		// LINE APIのエンドポイント
// // 		$url = "https://api.line.me/v2/bot/user/all/richmenu/{$line_rich_menu_id}";
		
// // 		// ヘッダー
// // 		$headers = [
// // 				"Authorization: Bearer {$access_token}"
// // 		];
		
// // 		// cURLセッションの初期化
// // 		$ch = curl_init($url);
		
// // 		// オプションの設定
// // 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// // 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// // 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
// // 		// リクエストの実行
// // 		$response = curl_exec($ch);
		
// // 		// エラーチェック
// // 		if (curl_errno($ch)) {
// // 			$errs[] = "LINEプラットフォームへのデフォルト設定が失敗しました。" . curl_error($ch);
// // 		}
		
// // 		// cURLセッションの終了
// // 		curl_close($ch);
		
// // 		$res = json_decode($response, true);//JSONデコード
		
// // 		$errs = array_merge($errs, $res);
		
// // 		// レスポンスの表示
// // 		return ['errs' => $errs];
		
// // 	}
	
// // 	/**■■■□□□■■■□□□
// // 	 * LINEプラットフォームに登録されているリッチメニュー一覧の情報を取得する
// // 	 *
// // 	 * @param array $param
// // 	 */
// // 	public function curlListFromLine($params){
		
// // 		$access_token = $params['access_token'];
		
// // 		// 初期化
// // 		$curl = curl_init();
		
// // 		// cURLオプションの設定
// // 		curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/richmenu/list");
// // 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// // 		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
// // 				"Authorization: Bearer {$access_token}"
// // 		));
		
// // 		// HTTPリクエストの実行
// // 		$response = curl_exec($curl);
		
// // 		// エラーチェック
// // 		if(curl_errno($curl)){
// // 			echo 'Curl error: ' . curl_error($curl);
// // 		}
		
// // 		// cURLセッションの終了
// // 		curl_close($curl);

// // 		$res = json_decode($response, true);

// // 		return $res;
		
// // 	}
	
	
// 	/**
// 	 * LINEリッチメニューを削除するようLINEに送信する（リッチメニューIDを指定して削除）
// 	 *
// 	 * @param array $param
// 	 */
// 	public function curlDeleteToLine($params){
		
// 		$errs = [];
// 		$access_token = $params['access_token'];
// 		$line_rich_menu_id = $params['line_rich_menu_id'];
		
// 		// cURLセッションを初期化
// 		$curl = curl_init();
		
// 		// cURLオプションの設定
// 		curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/richmenu/{$line_rich_menu_id}");
// 		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
// 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
// 				"Authorization: Bearer {$access_token}"
// 		));
		
// 		// HTTPリクエストを実行
// 		$response = curl_exec($curl);
		
// 		// エラーチェック
// 		if (curl_errno($curl)) {
// 			$errs[] = "LINEプラットフォームからリッチメニューの削除に失敗しました。". curl_error($curl);
// 		}
		
// 		// cURLセッションを閉じる
// 		curl_close($curl);
		
// 		$res = json_decode($response, true);
		
// 		$errs = array_merge($errs, $res);
		
// 		return ['errs' => $errs];
		
		
// 	}
	
	
// 	public function createAudienceJson($richMenus, $richMenuAreas){

// 		foreach($richMenuAreas as $rmaEnt){
			
// 			if(!empty($rmaEnt['delete_flg'])) continue;
// 			if(empty($rmaEnt['action_type'])) continue;
			
// 			$bounds_x = round($rmaEnt['bounds_x']);
// 			$bounds_y = round($rmaEnt['bounds_y']);
// 			$bounds_width = round($rmaEnt['bounds_width']);
// 			$bounds_height = round($rmaEnt['bounds_height']);
			
// 			$action = $this->getActionData($rmaEnt); // アクションオブジェクトを作成
			
// 			$area = [
// 					"bounds" => [
// 							"x" => $bounds_x,
// 							"y" => $bounds_y,
// 							"width" => $bounds_width,
// 							"height" => $bounds_height
// 					],
// 					"action" => $action,
// 			];
			
// 			$areas[] = $area;
			
// 		}
		
// 		$selected = false;
// 		if($richMenus['default_selected']) $selected = true;
		
		
// 		$data =[
// 				"size" => [
// 						"width" => $richMenus['size_w'],
// 						"height" => $richMenus['size_h']
// 				],
// 				"selected" => $selected,
// 				"name" => $richMenus['name'],
// 				"chatBarText" => $richMenus['chat_bar_text'],
// 				"areas" =>$areas,
// 		];
		
// 		$json = json_encode($data, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
// 		return $json;
		
// 	}
	
// 	/**
// 	 * ; アクションオブジェクトを作成
// 	 * @param {} $rmaEnt エリアエンティティ
// 	 */
// 	public function getActionData($rmaEnt){
		
// 		$action_type = $rmaEnt['action_type'];
		
// 		$action = [
// 				'type'=> $action_type,
// 				'label'=> $rmaEnt['action_label'],
// 		];
		
// 		switch ($action_type){
// 			case "postback":
// 				$action['data'] = $rmaEnt['action_data']; // 汎用データ
// 				$action['displayText'] = $rmaEnt['action_display_text']; // ユーザーのトークテキスト
// 				$action['inputOption'] = $rmaEnt['action_input_option']; // 入力オプション
// 				$action['fillInText'] = $rmaEnt['action_fill_in_text']; // キーボード初期表示テキスト
// 				break;
				
// 			case "message":
// 				$action['text'] = $rmaEnt['action_text']; // アクション実行送信テキスト
// 				break;
				
// 			case "uri":
// 				$action['uri'] = $rmaEnt['action_uri']; // アクションURL
// 				break;
				
// 			case "datetimepicker":
// 				$action['data'] = $rmaEnt['action_data']; // 汎用データ
// 				$action['mode'] = $rmaEnt['action_mode']; // アクションモード
// 				$action['initial'] = $rmaEnt['action_dtp_initial'];
// 				$action['max'] = $rmaEnt['action_dtp_max'];
// 				$action['min'] = $rmaEnt['action_dtp_min'];
// 				break;
				
				
// 			case "camera":
				
// 				break;
				
// 			case "cameraRoll":
				
// 				break;
				
// 			case "location":
				
// 				break;
				
// 			case "richmenuswitch":
// 				$action['data'] = $rmaEnt['action_data']; // 汎用データ
// 				$action['richMenuAliasId'] = $rmaEnt['rich_menu_alias_id']; // 切替先のリッチメニューエイリアスID
				
// 				break;
// 			default;
// 		}
		
// 		return $action;
		
// 	}
	
	
}