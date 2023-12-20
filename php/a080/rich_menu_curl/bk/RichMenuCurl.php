<?php 

namespace App\Services\RichMenu;


/**
 * LINE リッチメニュープラットフォームにCURLコマンドでリッチメニューを配信設定する。
 *
 */
class RichMenuCurl{
	

	/**
 	 * LINE リッチメニュープラットフォームにCURLコマンドでリッチメニューを配信設定する。
	 */
	public function curlTemplateToLine($access_token, $rich_menu_json){
		
		// LINE APIのURL
		$url = 'https://api.line.me/v2/bot/richmenu';

		// リクエストヘッダー
		$headers = [
				"Authorization: Bearer {$access_token}",
				'Content-Type: application/json',
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $rich_menu_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch); // リクエストの実行

		// エラーチェック
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
	
		// cURLセッションの終了
		curl_close($ch);
		
		$res = json_decode($result,true);//JSONデコード
		$err = '';
		$richMenuId = '';
		if($res===null){
			$err = "エラー：LINEプラットフォームへリッチメニューをリンク付けられませんでした。（配信設定失敗）\n" . $res;
		}else{
			$richMenuId = $res['richMenuId'];
		}

		return [
			'err' => $err,
			'richMenuId' => $richMenuId,
		];

	}
	
	
	/**
	 * LINEリッチメニューの画像をLINEに送信する
	 *
	 * @param array $param
	 */
	public function curlImgToLine($params){
		$access_token = $params['access_token'];
		$line_rich_menu_id = $params['line_rich_menu_id'];
		$img_path = $params['img_path'];
		
		// ファイルの拡張子を取得し、拡張子を小文字に変換
		$ext = pathinfo($img_path, PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		
		// MIMEタイプの確認（サポートされている形式のみ）
		if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
			echo "Unsupported file format";
			return;
		}
		
		// 正しいMIMEタイプを設定
		$mime = ($ext == "png") ? "image/png" : "image/jpeg";
		
		// LINE APIのエンドポイント
		$url = "https://api-data.line.me/v2/bot/richmenu/{$line_rich_menu_id}/content";
		
		// ヘッダー
		$headers = [
				"Authorization: Bearer {$access_token}",
				"Content-Type: {$mime}"
				];
		
		// cURLセッションの初期化
		$ch = curl_init($url);
		
		// ファイルの内容を読み込む
		$data = file_get_contents($img_path);
		if ($data === false) {
			echo "Failed to read file";
			return;
		}
		
		// オプションの設定
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// リクエストの実行
		$response = curl_exec($ch);
		
		// エラーチェック
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		
		// cURLセッションの終了
		curl_close($ch);
		
		return $response;
		
	}
	
	
	/**
	 * LINEリッチメニューをデフォルトに設定するようLINEに送信する（リッチメニューを適用）
	 *
	 * @param array $param
	 */
	public function curlDefaultToLine($params){
		
		$access_token = $params['access_token'];
		$line_rich_menu_id = $params['line_rich_menu_id'];

		
		// LINE APIのエンドポイント
		$url = "https://api.line.me/v2/bot/user/all/richmenu/{$line_rich_menu_id}";
		
		// ヘッダー
		$headers = [
				"Authorization: Bearer {$access_token}"
		];
		
		// cURLセッションの初期化
		$ch = curl_init($url);
		
		// オプションの設定
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		// リクエストの実行
		$response = curl_exec($ch);
		
		// エラーチェック
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		
		// cURLセッションの終了
		curl_close($ch);
		
		// レスポンスの表示
		return $response;
		
	}
	
	/**
	 * LINEプラットフォームに登録されているリッチメニュー一覧の情報を取得する
	 *
	 * @param array $param
	 */
	public function curlListFromLine($params){
		
		$access_token = $params['access_token'];
		
		// 初期化
		$curl = curl_init();
		
		// cURLオプションの設定
		curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/richmenu/list");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				"Authorization: Bearer {$access_token}"
		));
		
		// HTTPリクエストの実行
		$response = curl_exec($curl);
		
		// エラーチェック
		if(curl_errno($curl)){
			echo 'Curl error: ' . curl_error($curl);
		}
		
		// cURLセッションの終了
		curl_close($curl);

		$res = json_decode($response, true);

		return $res;
		
	}
	
	
	/**
	 * LINEリッチメニューを削除するようLINEに送信する（リッチメニューIDを指定して削除）
	 *
	 * @param array $param
	 */
	public function curlDeleteToLine($params){
		
		$access_token = $params['access_token'];
		$line_rich_menu_id = $params['line_rich_menu_id'];
		
		// cURLセッションを初期化
		$curl = curl_init();
		
		// cURLオプションの設定
		curl_setopt($curl, CURLOPT_URL, "https://api.line.me/v2/bot/richmenu/{$line_rich_menu_id}");
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				"Authorization: Bearer {$access_token}"
		));
		
		// HTTPリクエストを実行
		$response = curl_exec($curl);
		
		// エラーチェック
		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl);
		}
		
		// cURLセッションを閉じる
		curl_close($curl);
		
		$res = json_decode($response, true);
		
		return $res;
		
		
	}
	
	
	public function createRichMenuJson($richMenus, $richMenuAreas){

		foreach($richMenuAreas as $rmaEnt){
			
			if(!empty($rmaEnt['delete_flg'])) continue;
			if(empty($rmaEnt['action_type'])) continue;
			
			$bounds_x = round($rmaEnt['bounds_x']);
			$bounds_y = round($rmaEnt['bounds_y']);
			$bounds_width = round($rmaEnt['bounds_width']);
			$bounds_height = round($rmaEnt['bounds_height']);
			
			$action = $this->getActionData($rmaEnt); // アクションオブジェクトを作成
			
			$area = [
					"bounds" => [
							"x" => $bounds_x,
							"y" => $bounds_y,
							"width" => $bounds_width,
							"height" => $bounds_height
					],
					"action" => $action,
			];
			
			$areas[] = $area;
			
		}
		
		$selected = false;
		if($richMenus['default_selected']) $selected = true;
		
		
		$data =[
				"size" => [
						"width" => $richMenus['size_w'],
						"height" => $richMenus['size_h']
				],
				"selected" => $selected,
				"name" => $richMenus['name'],
				"chatBarText" => $richMenus['chat_bar_text'],
				"areas" =>$areas,
		];
		
		$json = json_encode($data, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
		return $json;
		
	}
	
	/**
	 * ; アクションオブジェクトを作成
	 * @param {} $rmaEnt エリアエンティティ
	 */
	public function getActionData($rmaEnt){
		
		$action_type = $rmaEnt['action_type'];
		
		$action = [
				'type'=> $action_type,
				'label'=> $rmaEnt['action_label'],
		];
		
		switch ($action_type){
			case "postback":
				$action['data'] = $rmaEnt['action_data']; // 汎用データ
				$action['displayText'] = $rmaEnt['action_display_text']; // ユーザーのトークテキスト
				$action['inputOption'] = $rmaEnt['action_input_option']; // 入力オプション
				$action['fillInText'] = $rmaEnt['action_fill_in_text']; // キーボード初期表示テキスト
				break;
				
			case "message":
				$action['text'] = $rmaEnt['action_text']; // アクション実行送信テキスト
				break;
				
			case "uri":
				$action['uri'] = $rmaEnt['action_uri']; // アクションURL
				break;
				
			case "datetimepicker":
				$action['data'] = $rmaEnt['action_data']; // 汎用データ
				$action['mode'] = $rmaEnt['action_mode']; // アクションモード
				$action['initial'] = $rmaEnt['action_dtp_initial'];
				$action['max'] = $rmaEnt['action_dtp_max'];
				$action['min'] = $rmaEnt['action_dtp_min'];
				break;
				
				
			case "camera":
				
				break;
				
			case "cameraRoll":
				
				break;
				
			case "location":
				
				break;
				
			case "richmenuswitch":
				$action['data'] = $rmaEnt['action_data']; // 汎用データ
				$action['richMenuAliasId'] = $rmaEnt['rich_menu_alias_id']; // 切替先のリッチメニューエイリアスID
				
				break;
			default;
		}
		
		return $action;
		
	}
	
	
}