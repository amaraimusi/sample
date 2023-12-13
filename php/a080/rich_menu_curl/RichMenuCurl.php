<?php 


class RichMenuCurl{
	
	
	/**
	 * LINEリッチメニューのテンプレートをLINEに送信し、LINEリッチメニューIDを取得する
	 * 
	 * @param array $param
	 */
	public function curlTemplateToLine($param = []){
		
		$access_token = $param['access_token'];

		// LINE APIのURL
		$url = 'https://api.line.me/v2/bot/richmenu';

		// リクエストヘッダー
		$headers = [
				"Authorization: Bearer {$access_token}",
				'Content-Type: application/json',
		];
		
		// 送信するデータ
		$data = json_encode([
						"size" => [
										"width" => 2500,
										"height" => 843
								],
						"selected" => false,
								"name" => "Animal Rich",
								"chatBarText" => "Tap to open",
								"areas" => [
												[
																"bounds" => [
																				"x" => 0,
																		"y" => 0,
																		"width" => 1250,
																		"height" => 843
																],
												"action" => [
																"type" => "uri",
														"label" => "my_home",
														"uri" => "https://amaraimusi.sakura.ne.jp/"
												]
								],
												[
																"bounds" => [
																				"x" => 1250,
																				"y" => 0,
																				"width" => 1250,
																				"height" => 843
																		],
																"action" => [
																				"type" => "uri",
																				"label" => "Jisin",
																				"uri" => "https://www.jma.go.jp/bosai/map.html#5/32.12/137.856/&contents=hypo"
																		]
																]
												]
										]);
						
		// cURLセッションの初期化
		$ch = curl_init($url);

		// オプションの設定
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
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

		// レスポンスの表示
		$res=json_decode($response,true);//JSON文字を配列に戻す
		$richMenuId = $res['richMenuId'];
		
		return $richMenuId;
		
		
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
	
	
}