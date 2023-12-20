<?php 

require_once 'CreateRichMenuJson.php';

$obj = new CreateRichMenuJson();
$richMenu = getSampleRichMenu();
$areas = getSampleAreas1();


$json = $obj->createRichMenuJson($richMenu, $areas);

dump($json);
function dump($var){
	echo "<pre><code>";
	var_dump($var);
	echo "</code></pre>";
}






// 【見本JSON】
// '{
//     "size": {
//         "width": 2500,
//         "height": 1686
//     },
//     "selected": false,
//     "name": "デフォルトのリッチメニューのテスト",
//     "chatBarText": "Tap to open",
//     "areas": [
//         {
//             "bounds": {
//                 "x": 0,
//                 "y": 0,
//                 "width": 1666,
//                 "height": 1686
//             },
//             "action": {
//                 "type": "uri",
//                 "label": "タップ領域A",
//                 "uri": "https://developers.line.biz/ja/news/"
//             }
//         },
//         {
//             "bounds": {
//                 "x": 1667,
//                 "y": 0,
//                 "width": 834,
//                 "height": 843
//             },
//             "action": {
//                 "type": "uri",
//                 "label": "タップ領域B",
//                 "uri": "https://lineapiusecase.com/ja/top.html"
//             }
//         },
//         {
//             "bounds": {
//                 "x": 1667,
//                 "y": 844,
//                 "width": 834,
//                 "height": 843
//             },
//             "action": {
//                 "type": "uri",
//                 "label": "タップ領域C",
//                 "uri": "https://techblog.lycorp.co.jp/ja/"
//             }
//         }
//     ]
// }'

function getSampleRichMenu(){
	return   array (
			'id' => 'RM3',
			'name' => 'Sample Rich Menuブタ3',
			'rich_menu_category_id' => '3',
			'segment' => 'アウトドア 旅行 スポーツ',
			'rich_menu_img' => '20231218135912_5dc7c5462d6710d285.png',
			'chat_bar_text' => 'ブタのメニューバーTEST',
			'area_template_type' => 1,
			'size_w' => 2500,
			'size_h' => 843,
			'default_selected' => false,
	);
}

function getSampleAreas1(){
	
	$areas = array (
			'a' =>
			array (
					'id' => 'cf14f581ec3a479d8b0c7815c6',
					'rich_menu_id' => 'RM3',
					'area_code' => 'a',
					'bounds_x' => 0,
					'bounds_y' => 0,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => 'message',
					'action_label' => 'TEST1',
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => "メッセージ1\nTEST",
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'b' =>
			array (
					'id' => 'cad5752aa73542efbe96f22492',
					'rich_menu_id' => 'RM3',
					'area_code' => 'b',
					'bounds_x' => 833.3333333333333,
					'bounds_y' => 0,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => 'postback',
					'action_label' => 'ポストバックB',
					'action_data' => '?abc=123',
					'action_display_text' => 'トークテキスト',
					'action_input_option' => '入力オプションB',
					'action_fill_in_text' => 'ねこ',
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'c' =>
			array (
					'id' => '4957d0c6a3744224936e9b84f1',
					'rich_menu_id' => 'RM3',
					'area_code' => 'c',
					'bounds_x' => 1666.6666666666665,
					'bounds_y' => 0,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'd' =>
			array (
					'id' => 'e92601c195d945fd82b3b73968',
					'rich_menu_id' => 'RM3',
					'area_code' => 'd',
					'bounds_x' => 0,
					'bounds_y' => 421.5,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'e' =>
			array (
					'id' => 'd4056f546d5f4c618af8384408',
					'rich_menu_id' => 'RM3',
					'area_code' => 'e',
					'bounds_x' => 833.3333333333333,
					'bounds_y' => 421.5,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'f' =>
			array (
					'id' => '1817feacc6b047d5b4f26cd6b6',
					'rich_menu_id' => 'RM3',
					'area_code' => 'f',
					'bounds_x' => 1666.6666666666665,
					'bounds_y' => 421.5,
					'bounds_width' => 833.3333333333333,
					'bounds_height' => 421.5,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 0,
			),
			'g' =>
			array (
					'id' => '30f99ab3fb2a4d44beaa121a11',
					'rich_menu_id' => 'RM3',
					'area_code' => 'g',
					'bounds_x' => 0,
					'bounds_y' => 0,
					'bounds_width' => 0,
					'bounds_height' => 0,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 1,
			),
			'h' =>
			array (
					'id' => 'c1e8c3ffc7e84cb1b8707f5868',
					'rich_menu_id' => 'RM3',
					'area_code' => 'h',
					'bounds_x' => 0,
					'bounds_y' => 0,
					'bounds_width' => 0,
					'bounds_height' => 0,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 1,
			),
			'i' =>
			array (
					'id' => 'b2af565d97bc4018834b9ed0a8',
					'rich_menu_id' => 'RM3',
					'area_code' => 'i',
					'bounds_x' => 0,
					'bounds_y' => 0,
					'bounds_width' => 0,
					'bounds_height' => 0,
					'action_type' => null,
					'action_label' => null,
					'action_data' => null,
					'action_display_text' => null,
					'action_input_option' => null,
					'action_fill_in_text' => null,
					'action_text' => null,
					'action_uri' => null,
					'action_mode' => null,
					'action_dtp_initial' => null,
					'action_dtp_max' => null,
					'action_dtp_min' => null,
					'rich_menu_alias_id' => null,
					'delete_flg' => 1,
			),
	);
	
	return $areas;
}