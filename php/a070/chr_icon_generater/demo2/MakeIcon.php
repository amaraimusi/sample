<?php

/**
 * アイコン生成クラス
 * @author kenji uehara
 * @license MIT
 * @since 2021-1-9
 *
 */
class MakeIcon{
    
    /**
     * アイコンを作成する
     * @param [] $param
     */
    public function make($param){
        debug('xxx');//■■■□□□■■■□□□)
        
        $img_w = $param['img_w'];
        $img_h = $param['img_h'];
        $font_size = $param['font_size']; // 文字列のサイズ
        $angle = 0; // 文字列の角度
        
        $back_color = $param['back_color'];
        $text_color = $param['text_color'];

        $img =$this->imagecreatetruecolor($img_w, $img_h);

        $rgb = $this->colorcodeToRGB($back_color);
        $back_color2 = $this->imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // 背景色（RGB値）
        
        $rgb = colorcodeToRGB($text_color);
        $text_color2 = $this->imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // テキストの色（RGB値）
        
        imagefill ($img ,0 , 0 ,  $back_color2 ); // 背景色で塗りつぶす
        
        $img_fp = "icon.png"; // 合成結果画像ファイルパス
        
        // 	// ルートパスを取得する
        // 	$root = $_SERVER['DOCUMENT_ROOT'];
        // 	$root_last_str =  mb_substr($root, -1);
        // 	if($root_last_str == '/' || $root_last_str == '\\'){
        // 		$root = mb_substr($root,0,mb_strlen($root)-1);
        // 	}
        
        $fontfile = "ipaexm.ttf"; // 文字列フォントの指定
        
        // Windows環境用の文字列フォント設定
        if(PHP_OS == 'WINNT' ){
            $fontfile = "C:\Windows\Fonts\meiryo.ttc";
        }
        
        // テキストを重ねる
        $this->textOverlay($img, $img_w, $img_h, $font_size, $angle, $fontfile, $icon_text, $text_color2 );
        
//         // 数値テキストを重ねる
//         $num_text = $index;
//         $num_text_size = 26;
//         numTextOverlay($img, $img_w, $img_h, $num_text_size, $angle, $fontfile, $num_text, $text_color2);
        
        imagepng($img, $img_fp); // png形式で画像を出力
        
        
//         $icon_text = $_POST['icon_text'];
//         $back_color= $_POST['back_color'];
//         $text_color = $_POST['text_color'];
        
//         $fps = [];
//         for($i=1;$i<13;$i++){
//             $fps[] = makeIcon($icon_text, $i, $back_color, $text_color);
//         }
        
//         $t = time();
//         foreach($fps as $fp){
//             echo "<div style='display:inline-block;padding:5px;'><img src='{$fp}?t={$t}' style='width:32px;height:32px;' /> </div>";
//         }

        return $param;
        
    }
    
    
    // ■■■□□□■■■□□□あとで削除
    function makeIcon2($icon_text, $index, $back_color, $text_color){
        $img_w = 120;
        $img_h = 120;
        $font_size = 34; // 文字列のサイズ
        $angle = 0; // 文字列の角度
        
        
        $img = imagecreatetruecolor($img_w, $img_h);
        
        
        
        $rgb = colorcodeToRGB($back_color);
        $back_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // 背景色（RGB値）
        
        $rgb = colorcodeToRGB($text_color);
        $text_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // テキストの色（RGB値）
        
        imagefill ($img ,0 , 0 ,  $back_color2 ); // 背景色で塗りつぶす
        
        $img_fp = "icon{$index}.png"; // 合成結果画像ファイルパス
        
        // 	// ルートパスを取得する
        // 	$root = $_SERVER['DOCUMENT_ROOT'];
        // 	$root_last_str =  mb_substr($root, -1);
        // 	if($root_last_str == '/' || $root_last_str == '\\'){
        // 		$root = mb_substr($root,0,mb_strlen($root)-1);
        // 	}
            
        $fontfile = "ipaexm.ttf"; // 文字列フォントの指定
        
        // Windows環境用の文字列フォント設定
        if(PHP_OS == 'WINNT' ){
            $fontfile = "C:\Windows\Fonts\meiryo.ttc";
        }
        
        // テキストを重ねる
        textOverlay($img, $img_w, $img_h, $font_size, $angle, $fontfile, $icon_text, $text_color2 );
        
        // 数値テキストを重ねる
        $num_text = $index;
        $num_text_size = 26;
        numTextOverlay($img, $img_w, $img_h, $num_text_size, $angle, $fontfile, $num_text, $text_color2);
        
        imagepng($img, $img_fp); // png形式で画像を出力
        
        return $img_fp;
    }
    
    /**
     * カラーコードからRGB値に変換
     * @param string $color_code カラーコード (例:##da4f42)
     * @return number[] RGB値
     */
    function colorcodeToRGB($color_code){
        
        $color_code = preg_replace("/#/", "", $color_code);
        
        $res=[];
        $res[] = hexdec(substr($color_code, 0, 2)); // R
        $res[] = hexdec(substr($color_code, 2, 2)); // G
        $res[] = hexdec(substr($color_code, 4, 2)); // B
        
        return $res;
    }
    
    
    
    // テキスト重ね表示
    function textOverlay($img, $img_w, $img_h, $font_size, $angle, $fontfile, $text, $color ){
        $info = imagettfbbox ( $font_size, $angle, $fontfile, $text );
        $text_w = abs($info[0] - $info[2]);
        $text_h = abs($info[1] - $info[5]);
        $x = ($img_w - $text_w) * 0.5 - $info[0];
        $y = ($img_h - $text_h) * 0.6  - $info[5] + $info[1];
        
        // 	$cnt = mb_strlen ($text);
        // 	$b_cnt = mb_strwidth($text);
        // 	$text_w = $b_cnt * $font_size / 2;
        // 	$a_w = 6 * $cnt; // 調整値
        
        // 	$text_h = $font_size;
        // 	$a_h = 6;
        
        // 	$x = ($img_w - $text_w) * 0.5 - $a_w;
        // 	$y = ($img_h - $text_h) * 0.6 + $font_size + $a_h;
        
        imagettftext($img, $font_size, $angle, $x, $y, $color, $fontfile, $text); // 文字列を画像に重ねて合成
    }
    
    // 数値テキスト重ね表示
    function numTextOverlay($img, $img_w, $img_h, $font_size, $angle, $fontfile, $text, $color ){
        $info = imagettfbbox ( $font_size, $angle, $fontfile, $text );
        $text_w = abs($info[0] - $info[2]);
        $text_h = abs($info[1] - $info[5]);
        $x = ($img_w - $text_w) * 0.5 - $info[0];
        $y = ($img_h - $text_h) * 0.2  - $info[5] + $info[1];
        
        // 	$cnt = mb_strlen ($text);
        // 	$b_cnt = mb_strwidth($text);
        // 	$text_w = $b_cnt * $font_size / 2;
        // 	$a_w = 6 * $cnt; // 調整値
        
        // 	$text_h = $font_size;
        // 	$a_h = 0;
        
        // 	$x = ($img_w - $text_w) * 0.5 - $a_w;
        // 	$y = ($img_h - $text_h) * 0.2 + $font_size + $a_h;
        
        imagettftext($img, $font_size, $angle, $x, $y, $color, $fontfile, $text); // 文字列を画像に重ねて合成
    }
    
}