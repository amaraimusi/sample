<?php
/**
 * ２点の座標（緯度経度）から距離を算出する。
 * @author uehara
 * @date 2010/10/22
 */
class CalcDist{
	
	/**
	 * 緯度経度から2点間の距離を求める
	 * $mode はTrueの場合世界測地系、falseならに本則地形
	 * @param  $lat1　始点の緯度
	 * @param  $lon1　始点の経度
	 * @param  $lat2　終点の緯度
	 * @param  $lon2　終点の経度
	 * @param  $mode　Trueの場合世界測地系、falseならに日本則地形
	 * @return 距離（ｍ）
	 */
	function distance( $lat1, $lon1, $lat2, $lon2, $mode=true ) {
		// 緯度経度をラジアンに変換
		$radLat1 = $lat1 * M_PI / 180.0; // 緯度１
		$radLon1 = $lon1 * M_PI / 180.0; // 経度１
		$radLat2 = $lat2 * M_PI / 180.0; // 緯度２
		$radLon2 = $lon2 * M_PI / 180.0; // 経度２
		
		// 平均緯度
		$radLatAve = ($radLat1 + $radLat2) / 2.0;
		
		// 緯度差
		$radLatDiff = $radLat1 - $radLat2;
		
		// 経度差算
		$radLonDiff = $radLon1 - $radLon2;
		
		$sinLat = sin($radLatAve);
		
		if( $mode) {
		// $mode引数がtrueなら世界測地系で計算（デフォルト）
		$temp = 1.0 - 0.00669438 * ($sinLat*$sinLat);
		$meridianRad = 6335439.0 / sqrt($temp*$temp*$temp); // 子午線曲率半径
		$dvrad = 6378137.0 / sqrt($temp); // 卯酉線曲率半径
		} else {
		// $mode引数がfalseなら日本測地系で計算
		$temp = 1.0 - 0.00667478 * ($sinLat*$sinLat);
		$meridianRad = 6334834.0 / sqrt($temp*$temp*$temp); // 子午線曲率半径
		$dvrad = 6377397.155 / sqrt($temp); // 卯酉線曲率半径
		}
		
		$t1 = $meridianRad * $radLatDiff;
		$t2 = $dvrad * Cos($radLatAve) * $radLonDiff;
		$dist = sqrt(($t1*$t1) + ($t2*$t2));
		
		return $dist;
	}
}