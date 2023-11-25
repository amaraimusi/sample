<?php 

/**
 * リッチメニューテンプレートのエリアテンプレートデータに関するクラス
 * @note svgデータを含むエリアテンプレートデータのデータを作成する。
 *
 */
class AreaTp{
	
	/**
	 * svgデータを含むエリアテンプレートデータのデータを作成する。
	 * @param array $params
	 */
	public function createData($params = []){
		
		if(empty($params['size_w'])) $params['size_w'] = 2500 * 0.1; // エリア全体の横幅
		if(empty($params['size_h'])) $params['size_h'] = 1686 * 0.1; // エリア全体の縦幅
		if(empty($params['fill_color'])) $params['fill_color'] = 'lightgray'; // SVG図形の背景色 設定例→#ff0000
		if(empty($params['stroke_color'])) $params['stroke_color'] = '#788187'; // SVG図形の線色 設定例→#ffff00
		if(empty($params['fill_opacity'])) $params['fill_opacity'] = 0.5; // SVG図形の透明度 0～1の範囲で指定する
		
		if(empty($params['font_size'])) $params['font_size'] = 24;
		if(empty($params['font_color'])) $params['font_color'] = '#408055';

		$areaTps = $this->getBaseData(); // エリアテンプレートデータの基本データを取得する
		
		$areaTps = $this->makeSvgs($areaTps, $params); // 基本データからSVGを作成する

		return $areaTps;
		
	}
	
	
	/**
	 * 基本データからSVGデータを作成する
	 * @param [] $areaTps エリアテンプレートデータ【基本データ】
	 * @param [] $params
	 * @return [] $areaTps svgをセット後のエリアテンプレートデータ
	 */
	public function makeSvgs($areaTps, &$params){
		
		foreach($areaTps as &$atEnt){
			$atEnt['svg'] = $this->makeSvgText($atEnt, $params); // SVGテキストを作成する
		}
		unset($atEnt);
		
		return $areaTps;
	}
	
	
	/**
	 * SVGテキストを作成する
	 * @param [] $atEnt
	 * @param [] $params
	 */
	public function makeSvgText(&$atEnt, &$params){
		
		$size_w = $params['size_w'];
		$size_h = $params['size_h'];
		$areas = $atEnt['areas'];
		
		$rects = [];
		foreach($areas as $key => $area){
			$width = $size_w * $area['bounds_width_ratio'];
			$height = $size_h * $area['bounds_height_ratio'];
			$x = $size_w * $area['bounds_x_ratio'];
			$y = $size_h * $area['bounds_y_ratio'];
			$fill_color = $params['fill_color']; // SVG図形の背景色
			$stroke_color = $params['stroke_color']; // SVG図形の線色 
			$fill_opacity = $params['fill_opacity']; // SVG図形の透明度(0～1）
			
			$font_size = $params['font_size'];
			$font_color = $params['font_color'];
			$text_x = $x + ($width / 2) - ($font_size / 2);
			$text_y = $y + ($height / 2) ;
			
			// 影テキスト用
			$text_x2 = $text_x + 1;
			$text_y2 = $text_y + 1;
			
			$rects[] = "
				<rect fill='{$fill_color}' fill-opacity='{$fill_opacity}' stroke='{$stroke_color}' width='{$width}' height='{$height}' x='{$x}' y='{$y}'/>
				<text x='{$text_x2}' y='{$text_y2}' fill='#ffffff' font-size='{$font_size}'>{$key}</text>
				<text x='{$text_x}' y='{$text_y}' fill='{$font_color}' font-size='{$font_size}'>{$key}</text>
			";
		}
		
		$rect_str = implode('', $rects);
		
		$svg_text = "
			<svg baseProfile='full' height='{$size_h}' width='{$size_w}' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
			  {$rect_str}
			</svg>
		";
			  
			  return $svg_text;
	}
	
	
	/**
	 * エリアテンプレートデータの基本データを取得する
	 * @return number[][][]
	 */
	public function getBaseData(){
		
		$areaTps = [
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 1, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1/3, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 0.5, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 1/3,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'C' => [
										'bounds_x_ratio' => 2/3,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'D' => [
										'bounds_x_ratio' => 0, 
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'E' => [
										'bounds_x_ratio' => 1/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'F' => [
										'bounds_x_ratio' => 2/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1/2, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 1/2, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 1/2,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1/2,
								],
								'C' => [
										'bounds_x_ratio' => 0,
										'bounds_y_ratio' => 1/2,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1/2,
								],
								'D' => [
										'bounds_x_ratio' => 1/2,
										'bounds_y_ratio' => 1/2,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1/2,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1/2, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 2/2, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 1/2,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1/2,
								],
								'C' => [
										'bounds_x_ratio' => 1/2,
										'bounds_y_ratio' => 1/2,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1/2,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1/3, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 0.5, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 1/3,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 2/3,
										'bounds_height_ratio' => 0.5,
								],
								'C' => [
										'bounds_x_ratio' => 0,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'D' => [
										'bounds_x_ratio' => 1/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'E' => [
										'bounds_x_ratio' => 2/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 3/3, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 0.5, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 0,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'C' => [
										'bounds_x_ratio' => 1/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
								'D' => [
										'bounds_x_ratio' => 2/3,
										'bounds_y_ratio' => 0.5,
										'bounds_width_ratio' => 1/3,
										'bounds_height_ratio' => 0.5,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 2/2,
										'bounds_height_ratio' => 1/2,
								],
								'B' => [
										'bounds_x_ratio' => 0,
										'bounds_y_ratio' => 1/2,
										'bounds_width_ratio' => 1,
										'bounds_height_ratio' => 1/2,
								],
						],
						
				],
				[
						'svg' => '',
						'areas' => [
								'A' => [
										'bounds_x_ratio' => 0, // エリアテンプレート矩形上での相対位置X: エリア全体横幅の比率でセットする
										'bounds_y_ratio' => 0, // エリアテンプレート矩形上での相対位置Y: エリア全体縦幅の縦幅の比率でセットする
										'bounds_width_ratio' => 1/2, // エリアテンプレート矩形上での横幅: エリア全体横幅のの比率でセットする
										'bounds_height_ratio' => 1, // エリアテンプレート矩形上での縦幅: エリア全体縦幅の比率でセットする
								],
								'B' => [
										'bounds_x_ratio' => 1/2,
										'bounds_y_ratio' => 0,
										'bounds_width_ratio' => 1/2,
										'bounds_height_ratio' => 1,
								],
						],
						
				],
		];

		return $areaTps;
	}
	
	
}