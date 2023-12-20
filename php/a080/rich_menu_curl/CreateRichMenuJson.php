<?php 


class CreateRichMenuJson{
	
	
	public function createRichMenuJson($richMenus, $richMenuAreas){
		dump($richMenuAreas);//■■■□□□■■■□□□)
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
		
		dump($data);//■■■□□□■■■□□□)
		
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

