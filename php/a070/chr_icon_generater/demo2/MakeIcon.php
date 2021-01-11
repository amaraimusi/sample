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

        // ■■■□□□■■■□□□
//         $corp_text = $param['corp_text']; // 法人名
//         $group_text = $param['group_text']; // グループ名
        
//         $back_color = $param['back_color'];
//         $text_color = $param['text_color'];
//        $font_size = $param['font_size']; // 文字列のサイズ
        
        $img_w = $param['img_w'];
        $img_h = $param['img_h'];
        $angle = 0; // 文字列の角度
        $img_fp = "icon.png"; // 合成結果画像ファイルパス
        
        $corp_text = $param['corp_text']; // 法人名;
        $corp_backcolor = $param['corp_backcolor']; // 法人名・背景色;
        $corp_fontcolor = $param['corp_fontcolor']; // 法人名・文字色;
        $corp_fontsize = $param['corp_fontsize']; // 法人名・文字サイズ;
        
        $group_text = $param['group_text']; // グループ名;
        $group_backcolor = $param['group_backcolor']; // グループ名・背景色;
        $group_fontcolor = $param['group_fontcolor']; // グループ名・文字色;
        $group_fontsize = $param['group_fontsize']; // 法人名・文字サイズ;

        $rect1_w = $param['rect1_w']; // グループ名矩形・横幅;
        $rect1_h = $param['rect1_h']; // グループ名矩形・縦幅;
        $rect1_w_rate = $param['rect1_w_rate']; // グループ名矩形・横幅率;
        $rect1_h_rate = $param['rect1_h_rate']; // グループ名矩形・縦幅率;
        $rect1_top_rate = $param['rect1_top_rate']; // グループ名矩形・上位置率;
        $rect1_x1 = $param['rect1_x1']; // グループ名矩形・左上X;
        $rect1_y1 = $param['rect1_y1']; // グループ名矩形・左上Y;
        $rect1_x2 = $param['rect1_x2']; // グループ名矩形・右下X;
        $rect1_y2 = $param['rect1_y2']; // グループ名矩形・右下Y;
        
        $ellipse1_top_rate = $param['ellipse1_top_rate']; // 法人名楕円・縦位置率;
        $ellipse1_w_rate = $param['ellipse1_w_rate']; // 法人名楕円・横幅率;
        $ellipse1_h_rate = $param['ellipse1_h_rate']; // 法人名楕円・縦幅率;
        $ellipse1_w = $param['ellipse1_w']; // 法人名楕円・横幅;
        $ellipse1_h = $param['ellipse1_h']; // 法人名楕円・縦幅;
        $ellipse1_cx = $param['ellipse1_cx']; // 法人名楕円・中心位置X;
        $ellipse1_cy = $param['ellipse1_cy']; // 法人名楕円・中心位置Y;


        $img = imagecreatetruecolor($img_w, $img_h); // 矩形を作成
        imagecolortransparent($img, imagecolorallocate($img, 0, 0, 0)); // 背景を透明にする
        
        // 色コードをInt型に変換する
        $corp_backcolor_i = $this->colorcodeToInt($img, $corp_backcolor);
        $corp_fontcolor_i = $this->colorcodeToInt($img, $corp_fontcolor);
        $group_backcolor_i = $this->colorcodeToInt($img, $group_backcolor);
        $group_fontcolor_i = $this->colorcodeToInt($img, $group_fontcolor);
        
//         //■■■□□□■■■□□□
//         $back_color_i = $this->colorcodeToInt($img, $back_color); // Int型背景色を作成
        
//         // 四角形を描画
//         imagerectangle ( $img, 5, 5, 50, 50, $back_color_i );
        //imagefill ($img ,0 , 0 , $back_color_i ); // 背景色で塗りつぶす
        
        // グループ名矩形の塗りつぶし描画
        imagefilledrectangle($img, $rect1_x1, $rect1_y1, $rect1_x2, $rect1_y2, $group_backcolor_i);
        
        //法人名楕円の描画
        imagefilledellipse($img, $ellipse1_cx, $ellipse1_cy, $ellipse1_w, $ellipse1_h, $corp_backcolor_i );
        
        //■■■□□□■■■□□□
        //ImageFilledRectangle($img, 20,20, 60,60, $black);

//         $rgb = $this->colorcodeToRGB($back_color);
//         //$back_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // 背景色（RGB値）
        
//         $rgb = $this->colorcodeToRGB($text_color);
//         $text_color2 = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // テキストの色（RGB値）
        
        
        
        //imagefill ($img ,0 , 0 ,  $back_color2 ); // 背景色で塗りつぶす
        
        
        $fontfile = "GenShinGothic-Bold.ttf"; // 文字列フォントの指定
        
        // Windows環境用の文字列フォント設定
        if(PHP_OS == 'WINNT' ){
            $fontfile = "C:\Windows\Fonts\meiryo.ttc";
        }
        
         // グループ名テキストを描画する
        $this->textOverlay($img, $img_w, $img_h, $group_fontsize, $angle, $fontfile, $group_text, $group_fontcolor_i, $rect1_h, $rect1_y1 );
        
         // 法人名テキストを描画する
        $ellipse1_y1 = $ellipse1_cy - ($ellipse1_h / 2);
        $this->textOverlay($img, $img_w, $img_h, $corp_fontsize, $angle, $fontfile, $corp_text, $corp_fontcolor_i, $ellipse1_h, $ellipse1_y1);
        
//         // 数値テキストを重ねる
//         $num_text = $index;
//         $num_text_size = 26;
//         numTextOverlay($img, $img_w, $img_h, $num_text_size, $angle, $fontfile, $num_text, $text_color2);
        
        imagepng($img, $img_fp); // png形式で画像を出力
        
        
//         $group_text = $_POST['icon_text'];
//         $back_color= $_POST['back_color'];
//         $text_color = $_POST['text_color'];
        
//         $fps = [];
//         for($i=1;$i<13;$i++){
//             $fps[] = makeIcon($group_text, $i, $back_color, $text_color);
//         }
        
//         $t = time();
//         foreach($fps as $fp){
//             echo "<div style='display:inline-block;padding:5px;'><img src='{$fp}?t={$t}' style='width:32px;height:32px;' /> </div>";
//         }
        $param['img_fp'] = $img_fp;

        return $param;
        
    }
    
    
    
    /**
     * カラーコードからint値に変換
     * @param string $color_code カラーコード (例:##da4f42)
     * @return int カラーint値
     */
    private function colorcodeToInt(&$img, $color_code){
        $rgb = $this->colorcodeToRGB($color_code); // カラーコードからRGB値に変換
        $color_int = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]); // テキストの色（RGB値）
        return $color_int;
    }
    
    /**
     * カラーコードからRGB値に変換
     * @param string $color_code カラーコード (例:##da4f42)
     * @return number[] RGB値
     */
    private function colorcodeToRGB($color_code){
        
        $color_code = preg_replace("/#/", "", $color_code);
        
        $res=[];
        $res[] = hexdec(substr($color_code, 0, 2)); // R
        $res[] = hexdec(substr($color_code, 2, 2)); // G
        $res[] = hexdec(substr($color_code, 4, 2)); // B
        
        return $res;
    }
    
    // テキスト重ね表示
    private function textOverlay($img, $img_w, $img_h, $font_size, $angle, $fontfile, $text, $color, $parent_h, $parent_y ){
        
        $info = imagettfbbox ( $font_size, $angle, $fontfile, $text );
        $text_w = abs($info[0] - $info[2]);
        $text_h = abs($info[1] - $info[5]);
        $x = ($img_w - $text_w) * 0.5 - $info[0];
        
        $padding_y = ($parent_h - $text_h) * 0.4;
        $y = $padding_y + $parent_y + $text_h;
 
        
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