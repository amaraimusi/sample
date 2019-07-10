<?php
/**
 * 文字列を暗号化する。
 * 暗号化した文字列を複合することも可能
 *
 * @author k-uehara
 *
 */
class AngoYagi{

	/**
	 * 暗号化
	 * 暗号に変換
	 * @param  $str	文字列
	 * @param  $kagi	鍵
	 * @return string	暗号文字列
	 */
	public function ango($str,$kagi){

		$td  = mcrypt_module_open('des', '', 'ecb', '');
		$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
		$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
			exit('error.');
		}
		$xxx = base64_encode(mcrypt_generic($td, $str));
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $xxx;
	}

	/**
	 * 複合化
	 * 暗号文字列を復元する。
	 * @param  $str 暗号文字列
	 * @param  $kagi　鍵
	 * @return string　文字列
	 */
	public function hukugo($str,$kagi){


		$td  = mcrypt_module_open('des', '', 'ecb', '');
		$kagi = substr($kagi, 0, mcrypt_enc_get_key_size($td));
		$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		if (mcrypt_generic_init($td, $kagi, $iv) < 0) {
			exit('error.');
		}
		$xxx = mdecrypt_generic($td, base64_decode($str));
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $xxx;
	}
}