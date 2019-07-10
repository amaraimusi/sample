<?php

/**
 * ディレクトリ内のファイルをまとめて削除する。
 * @author k-uehara
 *
 */
class DirClear{
	/**
	 * ディレクトリ内のファイルをまとめて削除する。
	 * @param  $dir_name ファイル削除対象のディレクト名
	 * @return
	 */
	function clear($dir_name){
		//フォルダ内のファイルを列挙
		$files = scandir($dir_name);
		$files = array_filter($files, function ($file) {
			return !in_array($file, array('.', '..'));
		});

			foreach($files as $fn){
				$ffn=$dir_name.'/'.$fn;
				try {
					unlink($ffn);//削除
				} catch (Exception $e) {
					throw e;
				}
			}

			return true;
	}

}




