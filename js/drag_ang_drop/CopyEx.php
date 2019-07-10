<?php
/**
 * 拡張ファイルコピー。
 * 日本語ファイル名のファイルコピーとディレクトリ作成コピーができる。
 *
 * ディレクトリ存在チェックメソッドを備える。
 * ディレクトリ内のファイルをすべて削除するメソッドを備える。
 *
 * ★履歴
 * 2010/10/22	新規作成
 * 2015/8/6		リニューアル
 * 2015/8/10	dirClearメソッドを追加
 *
 * @author uehara
 */
class CopyEx{


	/**
	 * 拡張コピー　存在しないディテクトリも自動生成
	 * 日本語ファイルに対応
	 * @param コピー元ファイル名 $sourceFn
	 * @param コピー先ファイル名 $copyFn
	 */
	function copy($sourceFn,$copyFn){

		//フルファイル名からパスを取得する。
		$di=dirname($copyFn);

		//コピー先ファイル名とコピー元ファイル名が同名であれば、Nullを返して処理を終了
		if($sourceFn==$copyFn){
			return null;
		}

		//ディレクトリが存在するかチェック。
		if ($this->is_dir_ex($di)){

			//存在するならそのままコピー処理
			$sourceFn=mb_convert_encoding($sourceFn,'SJIS','UTF-8');
			$copyFn=mb_convert_encoding($copyFn,'SJIS','UTF-8');
			copy($sourceFn,$copyFn);
		}else{

			//存在しない場合。
			//パスを各ディレクトリに分解し、ディレクトリ配列をして取得する。
			$ary=explode('/', $di);
			//ディレクトリ配列の件数分以下の処理を繰り返す。
			$iniFlg=true;
			foreach ($ary as $key => $val){

				//作成したディレクトリが存在しない場合、ディレクトリを作成
				if ($iniFlg==true){
					$iniFlg=false;
					$dd=$val;
				}else{
					$dd.='/'.$val;
				}

				if (!($this->is_dir_ex($dd))){
					mkdir($dd);//ディレクトリを作成
				}

			}

			$sourceFn=mb_convert_encoding($sourceFn,'SJIS','UTF-8');
			$copyFn=mb_convert_encoding($copyFn,'SJIS','UTF-8');
			copy($sourceFn,$copyFn);//ファイルをコピーする。

		}
	}


	/**
	 * 日本語ディレクトリの存在チェック
	 * @param  $dn	ディレクトリ名
	 * @return boolean	true:存在	false:未存在
	 */
	function is_dir_ex($dn){
		$dn=mb_convert_encoding($dn,'SJIS','UTF-8');
		if (is_dir($dn)){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * ディレクトリ内のファイルをまとめて削除する。
	 * @param  $dir_name ファイル削除対象のディレクト名
	 * @return
	 */
	function dirClear($dir_name){
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