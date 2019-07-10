<?php

require_once 'common.php';
require_once 'copy_ex.php';
/**
 * アップロード関連メソッドを提供
 * @author user01
 *2011/11/2	新規作成
 *2011/11/28 isImgFileCheck追加
 *2011/11/29 moveTmpToAnyを追加
 *2011/11/30 isFileCheckを追加
 *2012/01/18 isFileCheckの仕様変更。日本語ファイルのバグを修正。
 */
class UploadFileOperator{
	
	///エラーメッセージ【一般向け】
	var $m_err;
	
	///詳細エラーメッセージ【開発用】
	var $m_errDetail;
	
	
	
	
	//詳細エラー。要素は「$_FILES[$key]['error']」の返値で、値は詳細エラーメッセージ
	var $m_detailErrList;
	
	function __construct(){
		
		$list['1']="アップロードされたファイルは、php.ini の upload_max_filesize ディレクティブの値を超えています。";
		$list['2']="アップロードされたファイルは、HTML フォームで指定された MAX_FILE_SIZE を超えています。";
		$list['3']="アップロードされたファイルは一部のみしかアップロードされていません。";
		$list['4']="ファイルはアップロードされませんでした。";
		$list['6']="テンポラリフォルダがありません。PHP 4.3.10 と PHP 5.0.3 で導入されました。";
		$list['7']="ディスクへの書き込みに失敗しました。PHP 5.1.0 で導入されました。";
		$list['8']="PHP の拡張モジュールがファイルのアップロードを中止しました。 どの拡張モジュールがファイルアップロードを中止させたのかを突き止めることはできません。 ";
		$this->m_detailErrList=&$list;
	}
	
	
	/**
	 * 画像アップロードファイルの適正チェック。ファイル入力配列型。一括チェック。
	 * @param  $key　name属性
	 * @param  $jName	ファイル入力の日本語名称
	 * @param  $req		必須入力ちぇくを行う場合はTrue
	 */
	function isImgFileCheckForMult($key,$jName=null,$req=false){
		
		$errs=array();
		$errDs=array();
		$cnt=count($_FILES[$key]['name']);
		for ($i=0;$i<$cnt;$i++){
			if($this->isImgFileCheckForMultIndex($key, $i,$jName,$req)==false){
				$errs[]=$this->m_err;
				$errDs[]=$this->m_errDetail;
			}
		}
		
		$rtn=true;
		if (count($errs)>0){
			$this->m_err=join("<br>\n",$errs);
			$rtn=false;
		}
		if (count($errDs)>0){
			$this->m_errDetail=join("<br>\n",$errDs);
			$rtn=false;
		}
		
		return $rtn;
	}

	/**
	 * 画像アップロードファイルの適正チェック。ファイル入力配列型。Index指定
	 * 	エラーメッセージはメンバ$m_errにセット。開発用の詳細エラーは$m_errDetailにセット
	 * @param  $key　キー（エレメントのname属性)
	 * @param  $index 配列のINDEX
	 * @param  $req	   必須入力である場合はTrueをセット
	 * @return boolean true:正常　false:エラー
	 */
	function isImgFileCheckForMultIndex($key,$index,$jName=null,$req=false){
		
		$this->m_err=null;
		$this->m_errDetail=null;
		
		
		$fn=$_FILES[$key]['name'][$index];

		//▼nullチェック。
		if($fn==null){
			if($req==true){
		
				$this->m_err="{$jName}ファイル入力は必須入力です。【{$no}番目】";
				return false;
			}else{
		
				return true;
			}
		}
		
		//▼共通エラー情報を作成
		$no=$index+1;
		$strErrInfo="【{$jName}→{$no}番目：ファイル名：{$fn}】";
		
		//▼Shift-Jisにエンコードする。
		$fn=mb_convert_encoding($fn, 'sjis', 'utf-8,sjis,euc_jp,jis');
		
		//▼アップロードに成功したかチェック
		$errDetailNo=$_FILES[$key]['error'][$index];
		if($errDetailNo!=0){
			$this->m_errDetail=$this->m_detailErrList[$errDetailNo]."<br />\n".$strErrInfo;
		}
	
		//▼ファイルの拡張子が画像関連（jpg,jpeg,png,gif)であるかチェック
		
		if($this->isExt($fn,'jpg,jpeg,png,gif')==false){
			$this->m_err="画像関連の拡張子（jpg,jpeg,png,gif)であるファイルを指定してください。{$strErrInfo}";
			return false;
		}
		
		
		//▼受信したファイルが画像関係であるかチェック
		if(strPos($_FILES[$key]['type'][$index],'image/') == true){
			$this->m_err="画像ファイルではありません。{$strErrInfo}";
			return false;
		}
		
		
		//▼ファイルサイズが０サイズでないかチェック
		if($_FILES[$key]['size'][$index] == 0){
			$this->m_err="アップロードに失敗しました。ファイルサイズ0、もしくは大きすぎる、存在しないことが考えられます。{$strErrInfo}";
			return false;
		}
		
		
		if($errDetailNo!=0){
			$this->m_err="アップロードに失敗しました。{$strErrInfo}";
			return false;
		}
		
		
		return true;
	}
	

	/**
	 * 画像アップロードファイルの適正チェック。
	 * 	エラーメッセージはメンバ$m_errにセット。開発用の詳細エラーは$m_errDetailにセット
	 * @param  $key　キー（エレメントのname属性)
	 * @param  $req	   必須入力である場合はTrueをセット
	 * @return boolean true:正常　false:エラー
	 */
	function isImgFileCheck($key,$jName=null,$req=false){
		
		$this->m_err=null;
		$this->m_errDetail=null;
		
		
		$fn=$_FILES[$key]['name'];

		//▼nullチェック。
		if($fn==null){
			if($req==true){
		
				$this->m_err="{$jName}ファイル入力は必須入力です。";
				return false;
			}else{
		
				return true;
			}
		}
		
		//▼共通エラー情報を作成
	
		$strErrInfo="【{$jName}ファイル入力：ファイル名：{$fn}】";
		
		//▼Shift-Jisにエンコードする。
		$fn=mb_convert_encoding($fn, 'sjis', 'utf-8,sjis,euc_jp,jis');
		
		//▼アップロードに成功したかチェック
		$errDetailNo=$_FILES[$key]['error'];
		if($errDetailNo!=0){
			$this->m_errDetail=$this->m_detailErrList[$errDetailNo]."<br />\n".$strErrInfo;
		}
	
		//▼ファイルの拡張子が画像関連（jpg,jpeg,png,gif,bmp)であるかチェック
		
		if($this->isExt($fn,'jpg,jpeg,png,gif,bmp')==false){
			$this->m_err="画像関連の拡張子（jpg,jpeg,png,gif)であるファイルを指定してください。{$strErrInfo}";
			return false;
		}
		
		
		//▼受信したファイルが画像関係であるかチェック
		if(strPos($_FILES[$key]['type'],'image/') == true){
			$this->m_err="画像ファイルではありません。{$strErrInfo}";
			return false;
		}
		
		
		//▼ファイルサイズが０サイズでないかチェック
		if($_FILES[$key]['size'] == 0){
			$this->m_err="アップロードに失敗しました。ファイルサイズ0、もしくは大きすぎる、存在しないことが考えられます。{$strErrInfo}";
			return false;
		}
		
		
		if($errDetailNo!=0){
			$this->m_err="アップロードに失敗しました。{$strErrInfo}";
			return false;
		}
		
		
		return true;
	}
	
	

	/**
	 * アップロードファイルの適正チェック。（一般ファイル用。mineのチェックは行わず）
	 * 	エラーメッセージはメンバ$m_errにセット。開発用の詳細エラーは$m_errDetailにセット
	 * @param  $extJoinStr	許可拡張子連結文字列。「*」を指定すると拡張子チェックは行わない
	 * @param  $key　キー（エレメントのname属性)
	 * @param  $req	   必須入力である場合はTrueをセット
	 * @return boolean true:正常　false:エラー
	 */
	function isFileCheck($extJoinStr,$key,$jName=null,$req=false){
		
		$this->m_err=null;
		$this->m_errDetail=null;
		
		
		$fn=$_FILES[$key]['name'];

		//▼nullチェック。
		if($fn==null){
			if($req==true){
		
				$this->m_err="{$jName}ファイル入力は必須入力です。";
				return false;
			}else{
		
				return true;
			}
		}
		
		//▼共通エラー情報を作成
	
		$strErrInfo="【{$jName}→{$fn}】";
		
		//▼Shift-Jisにエンコードする。
		$fn=mb_convert_encoding($fn, 'sjis', 'utf-8,sjis,euc_jp,jis');
		
		//▼アップロードに成功したかチェック
		$errDetailNo=$_FILES[$key]['error'];
		if($errDetailNo!=0){
			$this->m_errDetail=$this->m_detailErrList[$errDetailNo]."<br />\n".$strErrInfo;
		}
	
		//▼チェックする拡張子が「*」以外なら拡張子チェックを行う。
		if($extJoinStr!='*'){
			
			//▽ファイルの拡張子をチェック
			if($this->isExt($fn,$extJoinStr)==false){
				$this->m_err="画像関連の拡張子（{$extJoinStr})であるファイルを指定してください。{$strErrInfo}";
				return false;
			}
		}
		
		
//		//▼受信したファイルが画像関係であるかチェック
//		if(strPos($_FILES[$key]['type'],'image/') == true){
//			$this->m_err="画像ファイルではありません。{$strErrInfo}";
//			return false;
//		}
		
		
		//▼ファイルサイズが０サイズでないかチェック
		if($_FILES[$key]['size'] == 0){
			$this->m_err="アップロードに失敗しました。ファイルサイズ0、もしくは大きすぎる、存在しないことが考えられます。{$strErrInfo}";
			return false;
		}
		
		
		if($errDetailNo!=0){
			$this->m_err="アップロードに失敗しました。{$strErrInfo}";
			return false;
		}
		
		
		return true;
	}
	
	
	//▼ファイルの拡張子をチェック
	private function isExt($fn,$ext){
		
		$exts=explode(',', $ext);
		
		//ファイルから拡張子を取得する。
		$info=pathinfo($fn);
		$ext1=$info['extension'];
		
		foreach ($exts as &$ext2){
			//小文字、大文字無関係に比較
			if(strcasecmp($ext1,$ext2)==0){
				return true;
			}
		}
		
		return false;
		
	}
	
	

	/**
	 * アップロードした一時ファイルを指定ファイル名の位置に移動
	 * 配列型
	 * @param  $key　ファイルエレメントのname属性
	 * @param  $index	配列要素
	 * @param  $fn		移動先のファイル名
	 * @return 成功すればTRUEを返す。
	 */	
	public function moveTmpToAnyMult($key,$index,$fn){
		$tmpFn=$_FILES[$key]['tmp_name'][$index];
	
		if($tmpFn!=null){
	
			$rtn=move_uploaded_file($tmpFn,$fn);
	
		}
		
		return $rtn;
	}

	/**
	 * アップロードした一時ファイルを指定ファイル名の位置に移動
	 * 
	 * @param  $key　ファイルエレメントのname属性
	 * @param  $index	配列要素
	 * @param  $fn		移動先のファイル名
	 * @param		$strTypeOfFile　ファイルの文字コード（Windowsはsjis,レンタルサーバーはutf8が多い）
	 * @return 成功すればTRUEを返す。
	 */	
	public function moveTmpToAny($key,$fn,$strTypeOfFile='sjis'){
		$tmpFn=$_FILES[$key]['tmp_name'];
	
		if($tmpFn!=null){
	
			if($strTypeOfFile=='sjis'){
				try {
					$cpe=new CopyEx();
					$cpe->copy_($tmpFn,$fn);
					$rtn=true;
				} catch (Exception $e) {
					$rtn=false;
				}
				
			}else{
				$rtn=move_uploaded_file($tmpFn,$fn);
			}

			
			
	
		}
		
		return $rtn;
	}


}


?>