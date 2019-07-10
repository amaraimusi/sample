<?php

/**
 * 小分けZIP
 * 
 * @version 1.0.0
 * @date 2017-10-10
 *
 */
class ZipSubdiv{
	
	/**
	 * 圧縮イテレータ
	 * 
	 */
	public function iteratorCmpr($dataset){
		
		$param = $dataset['param'];


		$zip_no = $param['zip_no']; // ZIP番号
		
		// 一連の処理で当メソッドを最初に呼び出したとき
		if($zip_no == 1){
			$param = $this->preparePaths($param); // パス関連のセパレータまわりを整える
		}
		
		$root = $_SERVER['DOCUMENT_ROOT']; 	// ルートパス
		$sub_root = $param['subroot']; 		// サブルート
		$size_limit = $param['size_limit']; // 容量制限
		
		
		$fileData = $dataset['fileData']; // ファイルデータ
		$remain_count = $this->countRemain($fileData);// 残数を数える
		
		$cmpr_count = 0; // 当回の圧縮ファイル数
		$size_stack = 0; // 容量スタック
		$first_loop = 1; // 初回ループフラグ:  0:2回目以降ループ  , 1:初回ループ
		$complete_flg = 1; // 完了フラグ:    0:途中 , 1:完了
		
		// ZIPファイルパスを作成する
		$zip_fp = $this->makeZipFp($root,$param);

		$zip = new ZipArchive();

		// ZIPファイルをオープン
		$res = $zip->open($zip_fp, ZipArchive::CREATE);
		
		if($res == false){
			//★★★保留
			var_dump('ZIPファイルをオープンに失敗');//■■■□□□■■■□□□■■■□□□
		}
		
		foreach($fileData as &$fEnt){
			
			if(!empty($fEnt['settled'])){
				continue;
			}
			
			
			$pfn = $fEnt['fp']; // ファイル名（小パス付）
			
			// ファイルパスを組み立てる
			$fp = $root . $sub_root . $fEnt['fp'];
			$fp = mb_convert_encoding($fp, 'sjis', 'utf-8'); // 日本語ファイル名に対応


			// ファイルパスが存在しない場合
			if(!is_file($fp)){
				$fEnt['err'] = 'ファイルなし';
				$fEnt['settled'] = 1;
				$cmpr_count++;
				continue;
			}
			
			// ファイル容量を取得する
			$file_size = filesize($fp);
			$fEnt['file_size'] = $file_size;
			
			// ２回目以降のループである場合（初回ループフラグがOFF)
			if(empty($first_loop)){
				
				// 「ファイル容量＋サイズスタック」が容量制限より大きい場合、完了フラグをOFFにして中断する。
				if($file_size + $size_stack > $size_limit){
					
					$complete_flg = 0; // 完了フラグをOFFにする
					break;
				}
			}
			$first_loop = 0;
			
			$size_stack += $file_size; // サイズスタックにファイルサイズを加算する
			
			// ファイル名（小パス付）からディレクトリパス（小パス部分）を取得する
			$pi = pathinfo($pfn);
			$dn = $pi['dirname'];

			// ディレクトリパスが空でない場合、ZIPにパスを追加
			if(!empty($dn)){
				$zip->addEmptyDir($dn);
			}
			
			// ZIPへ追加	
			$zip->addFile($fp,$pfn);
			$fEnt['settled'] = 1; // 済みフラグをONにする
			$cmpr_count++; // 圧縮ファイル数のインプリメント
			
			
		}
		unset($fEnt);
		
		$zip->close();// 圧縮開始
		
		
		$param['remain_count'] = $remain_count;
		$param['cmpr_count'] = $cmpr_count;
		
		// 現在進捗の算出
		$param['prog_value'] = $this->calcProgress($param);

		
		$zip_no++;
		$param['zip_no'] = $zip_no;
		$param['complete_flg'] = $complete_flg;
		$dataset['fileData'] = $fileData;
		$dataset['param'] = $param;
		 
		
		return $dataset;
	}
	
	
	
	
	/**
	 * 現在進捗の算出
	 * @param array $param
	 * @return 現在進捗
	 */
	private function calcProgress(&$param){
		
		$prog_value = $param['prog_value'];
		$prog_max = $param['prog_max'];
		$remain_count = $param['remain_count'];
		$cmpr_count = $param['cmpr_count'];
		
		// 残進捗＝最大進捗-現在進捗
		$prog_remain = $prog_max - $prog_value;
		
		// 当回進捗値＝（当回の圧縮ファイル数/残ファイル数）×残進捗
		$this_prog = ($cmpr_count / $remain_count) * $prog_remain;
		
		// 現在進捗＋＝当回進捗値
		$prog_value += $this_prog;
		
		return $prog_value;
	}
	
	
	
	/**
	 * ZIPファイルパスを作成する
	 * @param string $root ルートパス
	 * @param array $param
	 * @return ZIPファイルパス
	 */
	private function makeZipFp($root,&$param){
		
		// ZIPファイルパスのファイル名部分を組み立てる
		$zip_fp = $param['zip_tmp_fn'] . $param['zip_no'] . '.zip';
		
		// ZIPサブルートが空でなければ、ディレクトリパスを付加する
		if(!empty($param['zip_subroot'])){
			$zip_fp = $root . $param['zip_subroot'] . $zip_fp;
		}
		
		return $zip_fp;
	}
	
	
	
	
	
	
	
	/**
	 * 残数を数える
	 * @param array $fileData ファイルデータ
	 * @return 残数
	 */
	private function countRemain(&$fileData){
		
		$remain_count = 0; // 残数
		
		// 済みフラグがOFFのデータを数える
		foreach($fileData as &$ent){
			if(empty($ent['settled'])){
				$remain_count ++;
			}
		}
		unset($ent);
		
		return $remain_count;
	}
	
	
	
	
	
	

	
	/**
	 * パス関連のセパレータまわりを整える
	 * @param array $param パラメータ
	 * @return パラメータ
	 */
	private function preparePaths($param){
		
		$param['subroot'] = $this->preparePathForSubroot($param['subroot']);
		$param['zip_subroot'] = $this->preparePathForSubroot($param['zip_subroot']);
	
		$param['zip_tmp_fn'] = $this->preparePathForFn($param['zip_tmp_fn']);

		
		return $param;
		
	}
	
	/**
	 * サブルート系のパスを整える
	 * @param string $path サブルート系のパス
	 * @return サブルート系のパス
	 */
	private function preparePathForSubroot($path){
		
		// パスのセパレータをシステム基準のセパレータに変換する（DIRECTORY_SEPARATORに変換）
		$path = $this->_convSeparator($path);
		
		// パスの先頭にセパレータがあれば除去する
		$path = $this->_headSeparator($path,0);
		
		// パスの末尾にセパレータがなければ付加する
		$path = $this->_endSeparator($path,1);
		
		return $path;
	}
	
	/**
	 * ファイル名系のパスを整える
	 * @param string $path ファイル名系のパス
	 * @return ファイル名系のパス
	 */
	private function preparePathForFn($path){
		
		// パスのセパレータをシステム基準のセパレータに変換する（DIRECTORY_SEPARATORに変換）
		$path = $this->_convSeparator($path);
		
		// パスの先頭にセパレータがあれば除去する
		$path = $this->_headSeparator($path,0);
		
		return $path;
	}
	
	
	
	/**
	 * パスのセパレータをシステム基準のセパレータに変換する（DIRECTORY_SEPARATORに変換）
	 * @param string $fp
	 * @return mixed
	 */
	private function _convSeparator($fp){
		
		if(strpos($fp,"/")!==false){
			$fp =  str_replace("/", DIRECTORY_SEPARATOR, $fp);
		}
		
		if(strpos($fp,"\\")!==false){
			$fp =  str_replace("/", DIRECTORY_SEPARATOR, $fp);
		}
		
		return $fp;
	}
	
	
	
	
	/**
	 * パスの先頭にセパレータを付加あるいは削除を行う
	 * @param string $path パス
	 * @param int $flg 0:削除  , 1:付加
	 * @param string $sep セパレータ（省略時は基準セパレータ）
	 * @return パス
	 */
	private function _headSeparator($path,$flg,$sep = DIRECTORY_SEPARATOR){
		if(empty($path)){
			return $path;
		}
		
		$s1 = mb_substr($path,0 ,1);
		if(empty($flg)){
			if($s1 == $sep){
				$path = mb_substr($path,1);
			}
		}else{
			if($s1 != $sep){
				$path = $sep . $path;
			}
		}
		
		return $path;
	}
	
	
	
	
	/**
	 * パスの末尾にセパレータを付加あるいは削除を行う
	 * @param string $path パス
	 * @param int $flg 0:削除  , 1:付加
	 * @param string $sep セパレータ（省略時は基準セパレータ）
	 * @return パス
	 */
	private function _endSeparator($path,$flg,$sep = DIRECTORY_SEPARATOR){
		if(empty($path)){
			return $path;
		}
		
		$s1 = mb_substr($path, -1);
		if(empty($flg)){
			if($s1 == $sep){
				$path = mb_substr($path,0,mb_strlen($path)-1);// 末尾の一文字を削る
			}
		}else{
			if($s1 != $sep){
				$path .= $sep;
			}
		}
		
		return $path;
		
	}
	
	
	
}