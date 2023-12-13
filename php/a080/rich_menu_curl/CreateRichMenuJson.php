<?php 


class CreateRichMenuJson{
	
	
	public function createRichMenuJson($richMenus, $richMenuAreas){
		
		
		$areas = [];
		foreach($richMenuAreas as $rmEnt){
			
			$area = [
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
}