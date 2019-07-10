<?php
require_once 'common.php';

/**
 * MYSQL用データベースアクセスオブジェクト<br>
 * @author uehara<br>
 * 2010/10/22	新規作成<br>
 * 2012/1/24	リニューアル<br>
 * 2012/6/09	正式版のDAOとする<br>
 * 2012/6/09	db_config.phpを削除
 */
class DaoForMySql{
	
	
	///登録結果情報。	regDataOverおよびregDataDelInsを実行した場合の登録方法結果（insert or update)が格納される。
	var $m_regResultInfo;
	
	
	
	/**
	 * 当クラスのインスタンスを返す。<br>
	 * 不完全なシングルトンパターンを適用。（インスタンスは一回のリクエスト中でしか保持されない。）<br>
	 * @return DaoForMySql2
	 */
	public static function getInstance(){
		
		
		if(!$_REQUEST['DaoForMysql']){
			$obj=new DaoForMySql();
			$_REQUEST['DaoForMySql']=&$obj;
		}else{
			$obj=&$_REQUEST['DaoForMySql'];
		}
		
		return $obj;

	}
	
	/**
	 * ダミーDBコネクションを取得します。
	 * */
	function getConnectionForDummy(){
		$config['db_type']='mysql';
		$config['db_host']='localhost';
		$config['db_name']='dummy';
		$config['db_user']='root';
		$config['db_pass']='neko';
		return getConnection($config);
	}
	
	/**
	 * MySQLへ接続し、コネクションを返します。ついでにPOIデータベースを選択します。<br>
	 * 文字コードの設定、UTF８で固定します。<br>
	 * @return resource
	 */
	protected function getConnection($config){
	
		$cn=mysql_connect($config['db_host'],$config['db_user'],$config['db_pass']);
		if (!($cn)) {
			echo "DBコネクション取得に失敗";
			die;
		}
		mysql_set_charset( "UTF8", $cn );//文字コードを設定
		if (!(mysql_select_db($config['db_name'],$cn))) {
			echo "DBコネクション取得：文字コード設定に失敗";die;
		
		}
		return $cn;
	}
	
	
	/**
	 * SQLを実行してデータを取得する。
	 * @param  $sql　SQL文
	 * @param  $prm_conn　DBコネクション。省略可能
	 * @param  $sanitaizeRelease サニタイズ解除をする場合はtrue; デフォルトでTRUE
	 */
	function &getData(&$sql,$prm_conn=null,$sanitaizeRelease=true){
		
		
		$cn=$this->open($prm_conn);//引数コネクションがnullの場合はコネクションを新規作成。
		$rs=mysql_query($sql,$cn);	//実行する。
		
		
		if($rs===false){
			//▼実行エラーがあった場合の処理。検索結果が０件の場合も実行されるので注意。
			echo('SQLの実行エラーです。  '
				.'Error No:      '.mysql_errno($cn).'<br>  '
				.'Error Mesage:  '.mysql_error($cn).'<br>  '
				.'Error SQL:     '.$sql);
		}else{
			
			//▼実行結果からデータを取得する。
			$i=0;
			while($row=mysql_fetch_assoc($rs)){
				foreach ($row as $key => $val){
					$data[$i][$key]=$val;
				}
				$i++;
			}
			
			
		}
		
		$this->close($prm_conn, $cn);//引数コネクションがnullである場合はコネクションを閉じる。
		
		//▼サニタイジングされた文字を元に戻す。
		if($sanitaizeRelease==true){
			$data=&$this->sanitaizeAfterReadingDb($data);
		}
		
		return $data;
	}
	
	
	/**
	 * コネクションを取得する。
	 * 引数のコネクションがnullでない場合は、このコネクションを利用し、
	 * nullである場合は、新たにコネクションを生成する。
	 * @param unknown_type $prm_conn
	 * @return unknown
	 */
	private  function open(&$prm_conn){
		if ($prm_conn){
			$cn=$prm_conn;
		}else{
			$cn=$this->getDaoConnection();
			
			
		}
		return $cn;
	}
	
	/**
	 * コネクションと閉じる。ただし引数のコネクションがnullではない場合は閉じない。
	 * @param unknown_type $prm_conn
	 * @param unknown_type $cn
	 */
	private function close(&$prm_conn,&$cn){
		if(!$prm_conn){
			mysql_close($cn);
		}
	}
	
	
	/**
	 * DB取得直後データにかけるサニタイジング。XSS対策および、SQLインジェクションによる無駄な「\」はずし。<br>
	 * 文字列データだけがサニタイズ対象<br>
	 * @param $treeData ツリー構造配列。値でも可
	 */
	public function &sanitaizeAfterReadingDb(&$treeData){
		if (is_array($treeData)){
			foreach ($treeData as $i => &$val){
				$treeData[$i]=$this->sanitaizeAfterReadingDb($val);
			}
		}else{
			if(gettype($treeData)=='string'){
				
				$treeData=htmlspecialchars($treeData);//XSS用サニタイズ。HTML用の記号を無効化にする。
				$treeData=stripslashes($treeData);//SQLインジェクションサニタイズで付加された￥を解除。特定の記号から\マークを削除する。
						
			}
		}
		
		return $treeData;
	}
	
	
	
	/**
	 * DB登録直前データにかけるサニタイジング。SQLインジェクション対策を行う。<br>
	 * 文字列データだけがサニタイズ対象<br>
	 * ※DBコネクションを開いている状態で実施する必要がある。<br>
	 * @param $treeData ツリー構造配列。値でも可
	 */
	public function &sanitaizeBeforeRegDb(&$treeData){
		if (is_array($treeData)){
			foreach ($treeData as $i => &$val){
				$treeData[$i]=$this->sanitaizeBeforeRegDb($val);
			}
		}else{
			//XSSサニタイジング
			if(gettype($treeData)=='string'){
				
				$treeData=mysql_real_escape_string($treeData);//SQLインジェクション対策
				
			}
		}
		
		return $treeData;
	}
	
	
	
	
	
	
	
	
	
	
	//---------------- 登録系 -----------------------------------
	


	
	/**
	 * データをDBに登録する。削除後、追加登録
	 * @param  $tableName		テーブル名
	 * @param  $data				登録するデータ
	 * @param  $prm_conn		DB接続コネクション（省略可）
	 * @param  $primaryKey	主キー連結文字列。複数存在する場合はコンマで区切る。（省略可）
	 * @param  $tblLockFlg true:テーブルロック（省略可）
	 * @param  $notFieldDelFlg true:テーブルに存在しないデータをフィールドから自動削除（省略可）
	 * @param  $sanitaizeFlg		true:サニタイズする。（省略可）
	 * @return true:成功　、　false:失敗
	 */
	public function regDataDelIns($tableName,&$data,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		
		if($tableName==null){
			echo 'テーブル名がnullです。:updateData<br>';
			return null;
		}
		
		$rtn=true;
		if(!$data){return $rtn;}
		
		//DB接続
		$cn=$this->open($prm_conn);

		//▼サニタイズ
		if($sanitaizeFlg==true){
			$data=&$this->sanitaizeBeforeRegDb($data);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		
		//▼テーブルに存在しないフィールドをデータから削除
		if($notFieldDelFlg==true){
			$data=&$this->fillingDbField($data, $tableName,$cn);
		}
		
		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}

		//▼削除する
		$rtn=$this->deleteData($tableName, $data,$cn,$primaryKey,false,false);
		
		//▼追加する
		if($rtn==true){
			$rtn=$this->insertData($tableName, $data,$cn,false,false,false);
		}
		
		
		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return $rtn;

		
	}
	
		/**
	 * エンティティをDBに登録する。削除後、追加登録
	 * @param  $tableName		テーブル名
	 * @param  $ent					登録するエンティティ
	 * @param  $prm_conn		DB接続コネクション（省略可）
	 * @param  $primaryKey	主キー連結文字列。複数存在する場合はコンマで区切る。（省略可）
	 * @param  $tblLockFlg true:テーブルロック（省略可）
	 * @param  $notFieldDelFlg true:テーブルに存在しないデータをフィールドから自動削除（省略可）
	 * @param  $sanitaizeFlg		true:サニタイズする。（省略可）
	 * @return true:成功　、　false:失敗
	 */
	public function regEntDelIns($tableName,&$ent,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		$data[0]=$ent;
		
		$this->regDataOver($tableName,$data,$prm_conn,$primaryKey,$tblLockFlg,$notFieldDelFlg,$sanitaizeFlg);
		
	}
		
		
	
	
	
	/**
	 * データをDBに上書き登録する。更新または追加を行う。
	 * @param  $tableName		テーブル名
	 * @param  $data					登録するデータ
	 * @param  $prm_conn		DB接続コネクション（省略可）
	 * @param  $primaryKey	主キー連結文字列。複数存在する場合はコンマで区切る。（省略可）
	 * @param  $tblLockFlg true:テーブルロック（省略可）
	 * @param  $notFieldDelFlg true:テーブルに存在しないデータをフィールドから自動削除（省略可）
	 * @param  $sanitaizeFlg		true:サニタイズする。（省略可）
	 * @return true:成功　、　false:失敗
	 */
	public function regDataOver($tableName,&$data,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		
		if($tableName==null){
			echo 'テーブル名がnullです。:updateData<br>';
			return null;
		}
		
		$rtn=true;
		if(!$data){return $rtn;}
		
		//DB接続
		$cn=$this->open($prm_conn);

		//▼サニタイズ
		if($sanitaizeFlg==true){
			$data=&$this->sanitaizeBeforeRegDb($data);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		
		//▼テーブルに存在しないフィールドをデータから削除
		if($notFieldDelFlg==true){
			$data=&$this->fillingDbField($data, $tableName,$cn);
		}
		
		//▼追加と更新に振り分ける。
		$dataSet=&$this->furiwake($tableName, $data,$cn,$primaryKey);
		$insertData=$dataSet['insert'];
		$updateData=$dataSet['update'];
		
		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}
		
		//▼追加データをINSERT
		$this->insertData($tableName, $insertData,$cn,false,false,false);
		
		//▼更新データをUPDATE
		$this->updateData($tableName, $updateData,$cn,$primaryKey,false,false,false);

		

		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return $rtn;
	}
	
	

	/**
	 * データを更新用と追加用に振り分ける。
	 * 	ついでに登録結果情報もメンバにセットされる。
	 * @param  $tableName		テーブル名
	 * @param  $data				振り分け対象データ
	 * @param  $cn					DBコネクション
	 * @param  $primaryKey								主キー連結文字列
	 * @return データセット update=>更新用データ insert=>追加用データ
	 */
	private function &furiwake($tableName,&$data,$cn,$primaryKey){
		
		//▼主キー連結文字列を主キーリストに変換
		$pKeys=explode(',', $primaryKey);

		
		//▼追加処理エンティティと更新処理エンティティに振り分け。
		foreach ((array)$data as $i => $ent){
			
			//▽エンティティがテーブルに存在する場合、更新データにエンティティを追加
			if($this->checkPreData($tableName, $ent,$pKeys,$cn)){
				$updateData[]=$ent;
				$rsts[]='update';//登録結果情報に更新をセット
			
			//▽エンティティがテーブルに存在しない場合、追加データにエンティティを追加
			}else{
				$insertData[]=$ent;
				$rsts[]='insert';//登録結果情報に追加をセット
			}
			
		}
		
		$dataSet['insert']=&$insertData;
		$dataSet['update']=&$updateData;
		
		//▼登録結果情報をメンバにセット
		$this->m_regResultInfo=$rsts;

		return $dataSet;
		
	}
	

	/**
	 * 引数で指定したエンティティがDBに存在するかチェックする。
	 * @param  $tableName 	テーブル名
	 * @param  $ent					エンティティ
	 * @param  $pKeys				主キーリスト
	 * @param  $cn					DBコネクション
	 * @return boolean			true:DBにエンティティのデータが存在する。　false:存在しない
	 */
	function checkPreData($tableName, $ent,$pKeys,$cn){
		
		
		//検索配列を取得
		foreach ($pKeys as &$key){ 
			if (is_numeric($val)){//数値の場合、カンマでくくらず
				$whs[$key]="{$key} = {$ent[$key]}";
			}else{
				$whs[$key]="{$key} = '{$ent[$key]}'";
				
			}
			
		}
		$joinWhs=join(' AND ',$whs);//キー配列を「AND」で連結
		$sql="SELECT * FROM {$tableName} WHERE {$joinWhs}";//SQLを作成

		
		$data=$this->getData($sql,$cn);//SQLを実行。
		
	
		//▼実行してデータが存在すればTrueを返す。
		$flg=false;
		if($data){
			$flg=true;
		}
		
		return $flg;
		
	}

	

	/**
	 * DBからエンティティの主キーに紐づくレコードを削除
	 * @param  $tableName		テーブル名
	 * @param  $data				データ
	 * @param  $prm_conn		DBコネクション
	 * @param  $primaryKey	主キー。複数の主キーが存在する場合はコンマで連結。（省略可）
	 * @param  $tblLockFlg	true:テーブルにロックをかける。 false:かけない。
	 * @param  $sanitaizeFlg		true:サニタイズをかける。　false:かけない。　デフォルトfalse
	 * @return boolean true:削除成功	false:削除失敗
	 */
	public function deleteData($tableName,&$data,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$sanitaizeFlg=true){
		
		if($tableName==null){
			echo 'テーブル名がnullです。<br>';
			return null;
		}
		
		$rtn=true;
		if(!$data){return $rtn;}
		
		//DB接続
		$cn=$this->open($prm_conn);

		//▼サニタイズ
		if($sanitaizeFlg==true){
			$data=&$this->sanitaizeBeforeRegDb($data);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		

		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}

		
		//▼データ件数文のエンティティを削除する。
		foreach ($data as &$ent){
			//★削除処理
			$rtn2=$this->delete($tableName, $ent,$cn,$primaryKey,false,false);
			if($rtn2===false){
				$rtn=false;
			}
		}
		
		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return $rtn;
	}	
	
	/**
	 * DBからエンティティの主キーに紐づくレコードを削除
	 * @param  $tableName		テーブル名
	 * @param  $ent					エンティティ
	 * @param  $prm_conn		DBコネクション
	 * @param  $primaryKey	主キー。複数の主キーが存在する場合はコンマで連結。（省略可）
	 * @param  $tblLockFlg	true:テーブルにロックをかける。 false:かけない。
	 * @param  $sanitaizeFlg		true:サニタイズをかける。　false:かけない。　デフォルトfalse
	 * @return boolean true:削除成功	false:削除失敗
	 */
	public function delete($tableName,&$ent,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$sanitaizeFlg=false){
		
		if($tableName==null){
			echo 'テーブル名がnullです。<br>';
			return null;
		}
		
		$rtn=true;
		if(!$ent){return $rtn;}
		
		//DB接続
		$cn=$this->open($prm_conn);

		//▼サニタイズ
		if($sanitaizeFlg==true){
			$ent=&$this->sanitaizeBeforeRegDb($ent);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		
		//▼主キー連結文字列から主キーリストを作成する。
		$pKeys=&$this->convertPrimaryKeys($primaryKey);
	

		//▼主キーリストの件数分、以下の処理を繰り返し、検索条件リストを作成する。
		foreach ($pKeys as $key){

			//▽WHERE部分を組立、検索条件リストにセット
			$whs[$key]="{$key} = '{$ent[$key]}'";
			
		}
			
		//▼削除SQLを組み立てる
		$wh=join(' AND ',$whs);
		$sql='DELETE FROM '.$tableName.' WHERE '.$wh.';';

		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}

		//★削除処理実行
		$rs=mysql_query($sql,$cn);
		
		if($rs===false){
			echo("DBエラー：DELETE失敗：<br>失敗SQL:<br>{$sql}");
			$rtn=false;
		}
		
		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return $rtn;
	}	

	

	
	
	
	
	//-------------------------- 追加系　----------------------------------------------------
	
	/**
	 * エンティティをDBに追加(INSERT)する。
	 * 空値や''はnull値として更新される。
	 * @param  $tableName　テーブル名
	 * @param  $ent					エンティティ
	 * @param  $prm_conn　	DBコネクション　省略可能
	 * @param  $tblLockFlg テーブルロックをする場合はTrue。省略時はロックする。
	 * @param 	$notFieldDelFlg	True：テーブルに存在しないフィールドをデータから削除。省略時はFalse
	 * @param  $sanitaizeFlg		True:サニタイズ実施。省略時はtrue;
	 * @return 成功した場合、trueを返し、失敗した場合,falseを返す。
	 */
	public function insertEntity($tableName,&$ent,$prm_conn=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		$data[0]=&$ent;
		$this->insertData($tableName, $ent,$daoEx,$prm_conn,$primaryKey);
	}
	
	/**
	 * データ（エンティティの配列）をDBに追加(INSERT)する。
	 * 空値や''はnull値として更新される。
	 * @param  $tableName　テーブル名
	 * @param  $data				データ（エンティティの配列）
	 * @param  $prm_conn　	DBコネクション　省略可能
	 * @param  $tblLockFlg テーブルロックをする場合はTrue。省略時はロックする。
	 * @param 	$notFieldDelFlg	True：テーブルに存在しないフィールドをデータから削除。省略時はFalse
	 * @param  $sanitaizeFlg		True:サニタイズ実施。省略時はtrue;
	 * @return 成功した場合、trueを返し、失敗した場合,falseを返す。
	 */
	public function insertData($tableName,&$data,$prm_conn=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		
		if($tableName==null){
			echo 'テーブル名がnullです。:updateData<br>';
			return null;
		}
		
		if(!$data){return true;}
		
		
		//▼サニタイズ
		if($sanitaizeFlg==true){
			$data=&$this->sanitaizeBeforeRegDb($data);
		}
		
		//エンティティの値を登録用に変換する
		$data=$this->convertForRegValueForData($data);

		
		//▼テーブルに存在しないフィールドをデータから削除
		if($notFieldDelFlg==true){
			$data=$this->fillingDbField($data, $tableName,$cn);
		}
		
		//DB接続
		$cn=$this->open($prm_conn);
		

		
			//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
		
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}
		
		
		// ▼▼▼SQLを作成する。
		// INSERT INTO table (a,b,c) VALUES (1,2,3),(4,5,6)
		
		//▼SQLのフィールド部分を作成
		$ent=$data[0];
		foreach ($ent as $key => $val){ 
			$feilds[$key]=$key;
		}
		$strFeilds=join(',',$feilds);
		
		//▼SQLのVALUES部分を作成
		foreach ($data as $i => $ent){
			
			//▽SQLのVALUESの一部分を作成
			$values[$i]='('.join(',',$ent).')';

		}
		$strValues=join(',',$values);
		
		//▼SQLを組み立てる
		$sql="INSERT INTO {$tableName}({$strFeilds}) VALUES {$strValues}";
	


		
		//★SQL実行（INSERT)
		$rs=mysql_query($sql,$cn);	//実行する。
		if($rs===false){
			echo("DBエラー：INSERT失敗：<br>失敗SQL:<br>{$sql}");
			$this->unlock_($cn);
			return false;
		}

		
		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);
		
		return true;
	}
	
	
	
	
	
	
	
	

	
	
	/**
	 * データをDBに更新する。
	 * @param  $tableName		テーブル名
	 * @param  $data				更新するデータ
	 * @param  $prm_conn		DB接続コネクション（省略可）
	 * @param  $primaryKey	主キー連結文字列。複数存在する場合はコンマで区切る。（省略可）
	 * @param  $tblLockFlg true:テーブルロック（省略可）
	 * @param  $notFieldDelFlg true:テーブルに存在しないデータをフィールドから自動削除（省略可）
	 * @param  $sanitaizeFlg		true:サニタイズする。（省略可）
	 * @return true:成功　、　false:失敗
	 */
	public function updateData($tableName,&$data,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		
		if($tableName==null){
			echo 'テーブル名がnullです。:updateData<br>';
			return null;
		}
		
		$rtn=true;
		if(!$data){return $rtn;}
		
		//DB接続
		$cn=$this->open($prm_conn);

		//▼サニタイズ
		if($sanitaizeFlg==true){
			$data=&$this->sanitaizeBeforeRegDb($data);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		
		//▼テーブルに存在しないフィールドをデータから削除
		if($notFieldDelFlg==true){
			$data=&$this->fillingDbField($data, $tableName,$cn);
		}
		
		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}

		
		//▼更新処理
		foreach ($data as $key => &$ent){
			$rtn=$this->updateEntity($tableName,$ent,$cn,$primaryKey,false,false,false);
			
			if($rtn==false){return false;}
		}
		
		//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return $rtn;

		
	}
	
	/**
	 * フィールド情報から主キーを取得する。（複数の主キーが存在する場合はコンマで連結）
	 * @param unknown_type $fieldInfo
	 * @return string
	 */
	private function getPrimaryKey(&$fieldInfo){
		foreach ($fieldInfo as $i => &$fInfo){
			if($fInfo['Key']=='PRI'){
				$keys[]=$fInfo['Field'];
			}
		}
		$sKeys=join(',',$keys);
		return $sKeys;
	}
	
	
	/**
	 * エンティティをDBに更新する。
	 * @param  $tableName		テーブル名
	 * @param  $ent					更新するデータ
	 * @param  $prm_conn		DB接続コネクション（省略可）
	 * @param  $primaryKey	主キー。複数存在する場合はコンマで区切る。（省略可）
	 * @param  $tblLockFlg true:テーブルロック（省略可）
	 * @param  $notFieldDelFlg true:テーブルに存在しないデータをフィールドから自動削除（省略可）
	 * @param  $sanitaizeFlg		true:サニタイズする。（省略可）
	 * @return true:成功　、　false:失敗
	 */
	public function updateEntity($tableName,&$ent,$prm_conn=null,$primaryKey=null,$tblLockFlg=true,$notFieldDelFlg=false,$sanitaizeFlg=true){
		if($tableName==null){
			echo 'テーブル名がnullです。:updateData<br>';
			return false;
		}
		
		$rtn=true;
		if(!$ent){return $rtn;}
		
		$cn=$this->open($prm_conn);//引数のDB接続がnullならDBに接続
		

		//▼テーブルに存在しないフィールドをデータから削除
		if($notFieldDelFlg==true){
			$ent=&$this->fillingEntField($ent, $tableName,$cn);
		}
		
		//▼サニタイズ
		if($sanitaizeFlg==true){
			$ent=&$this->sanitaizeBeforeRegDb($ent);
		}
		
		//▼主キー連結文字列がnullならDBから取得
		if($primaryKey==null){
			$fieldInfo=$this->getFieldInfo($tableName,$cn);//フィールド情報取得
			$primaryKey=$this->getPrimaryKey($fieldInfo);//フィールド情報から主キー連結文字列を取得
		}
		
		//▼値を登録用に変換する。
		$ent=&$this->convertForRegValue($ent);
		


		
		//▼▼▼エンティティからSQL文を作成
		
		//主キー連結文字列から主キーリストに変換
		$primaryKeys=&$this->convertPrimaryKeys($primaryKey);

		//▼SQLのSET部分の作成　
		foreach ($ent as $key => $val){

			
			//主キー以外であるなら以下の処理を行う。
			if(array_key_exists ($key,$primaryKeys)==false){
				$ent2[$key]=$key.' =  '.$val;
			}
		}

		//▼主キーからWHERE部分をを作成
		foreach ($primaryKeys as $key => $val){ 
			$pks2[$val]=$val. ' = ' .$ent[$val]; 
		}

		$wh=join(' AND ',$pks2);
	
		
		$part1=join(' , ',$ent2);
		$sql="UPDATE ".$tableName." SET ".$part1." WHERE ".$wh.";";
		
		//▼テーブルをロックします。
		if($tblLockFlg==true){
			$sql="LOCK TABLES {$tableName} WRITE;";
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo "テーブルロックに失敗しました。：テーブル名＝{$tableName}";
			}
		}

		//▼SQLを実行する。
		$rs=mysql_query($sql,$cn);	//実行する。
		
			//▼テーブルロックを解除
		if($tblLockFlg==true){
			$this->unlock_($cn);
		}
		
		if($rs===false){
			echo("DBエラー：UPDATE失敗：<br>失敗SQL:<br>{$sql}");
			$this->unlock_($cn);
			return false;
		}
		
		$this->close($prm_conn, $cn);//引数のDB接続がnullならDB接続を閉じる。
		
		return true;
	}
	
	
	//主キー連結文字列から主キーリストに変換
	private function convertPrimaryKeys($primaryKey){
		$ary=explode(',', $primaryKey);
		foreach ($ary as $key){
			$keys[$key]=$key;
		}
		
		return $keys;
	}
		

	/**
	 * エンティティの値を登録用に変換する。【data用】
	 * @param  $ent			変換対象エンティティ
	 * @return string
	 */
	private function &convertForRegValueForData(&$data){
	
		foreach ($data as $i => &$ent){
			foreach ($ent as $key => $val){
	
				
				if($val===null || $val===''){//null値である場合、nullを設定。 0と''はnullとして扱われず
					$ent[$key]='null';
				}else{
					if(is_string($val)){
						$ent[$key]="'".$val."'";
					}
				}
	
				
			}
			unset($ent);
			
		}
		return $data;
	}
	/**
	 * エンティティの値を登録用に変換する。
	 * @param  $ent			変換対象エンティティ
	 * @return string
	 */
	private function &convertForRegValue(&$ent){
	

		foreach ($ent as $key => $val){

			
			if($val===null || $val===''){//null値である場合、nullを設定。 0と''はnullとして扱われず
				$ent[$key]='null';
			}else{
				if(is_string($val)){
					$ent[$key]="'".$val."'";
				}
			}

			
		}
		return $ent;
	}
	
	

	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//------------------------ サポート用 ------------------------------------------
	
	
	/**
	 * テーブル名からフィールド情報を取得する。
	 * @param  $tblName		テーブル名
	 * @param  $cn				DBコネクション
	 * @return エンティティ情報<br>
	 * ●エンティティ情報の詳細<br>
	 *  エンティティ→	Field			Type		Null	Key	Default	Extra   <br>
   *	例1→						UserId		int(11)	NO		PRI	 	 							<br>
	 *  例2→						CardId		int(5)	NO		PRI	 	 							<br>
   *  例3→						Cnt				int(5)	YES	 	 										<br>
	 */
	public function getFieldInfo($tblName,$cn){
		
		//▼DBよりテーブル情報を取得する。
		$sql="SHOW COLUMNS FROM {$tblName};";
		$data=$this->getData($sql,$cn);
		if($data===false){
			echo("DBエラー：テーブル情報取得に失敗：テーブル名＝{$tblName}");
		}
		
		return $data;
	}
	
	/**
	 * DBに存在するフィールドのみを抽出。<br>
	 * このメソッドはgetDataメソッドを実行した後に実行すること。<br>
	 * @param  $ent　DBに存在するフィールドのみ抽出する。
	 */
	public function fillingDbField($data,$tblName,$cn){
		
		if($data==null){return null;}
		
		//▼フィールド情報を取得する。
		$fields=$this->getFieldInfo($tblName,$cn);
		

		
		//▼許可キーリスト
		$ent=$data[0];
		foreach ($ent as $key => $val){
			foreach ($fields as &$fInfo){
				if ($key==$fInfo['Field']){
					$permitKeys[]=$key;
					break;
				}
			}
		}
		
		//▼DBに存在するフィールドのみを抽出。
		foreach ($data as $ent){
			foreach ($permitKeys as $permitKey){
				$ent2[$permitKey]=$ent[$permitKey];
			}
			$data2[]=$ent2;
			unset ($ent2);
		}

		
		return $data2;
	}
	

	/**
	 * DBに存在するフィールドのみを抽出。<br>
	 * @param  $ent　				抽出対象エンティティ
	 * @param  $tblName			テーブル名
	 * @param  $cn					DBコネクション
	 * @param  $fieldInfo		フィールド情報（省略可）
	 * @return 抽出後エンティティ
	 */
	public function fillingEntField($ent,$tblName,$cn,$fieldInfo=null){
		
		if($ent==null){return null;}
		
		//▼フィールド情報を取得する。
		if($fieldInfo==null){
			$fieldInfo=$this->getFieldInfo($tblName,$cn);
		}
		

		//▼許可キーリスト
		foreach ($ent as $key => $val){
			foreach ($fieldInfo as &$fInfo){
				if ($key==$fInfo['Field']){
					$permitKeys[]=$key;//許可キーをセット
					break;
				}
			}
		}
		
		//▼DBに存在するフィールドのみを抽出。
		foreach ($permitKeys as $permitKey){
			$ent2[$permitKey]=$ent[$permitKey];
		}
		$ent=$ent2;

		return $ent;
	}

	
	/**
	 * テーブルロック解除
	 * @return boolean trueはロック解除成功
	 */
	public function unlock_($cn){
			$sql='UNLOCK TABLES;';
			$rs=mysql_query($sql,$cn);
			if($rs===false){
				echo("DBエラー：ロック解除失敗");
				return false;
			}
			return true;
	}
	
	
	/**
	 * IDを自動生成する。数値タイプのIDにのみ対応<br>
	 * @param  $tblName	　テーブル名
	 * @param  $field			IDフィールド名
	 * @param  $cn				DBコネクション
	 * @return 自動生成されたID
	 */
	public function createAutoId($tblName,$field,$cn){
		$sql="SELECT MAX({$field}) AS Id FROM {$tblName};";
		$data=$this->getData($sql,$cn);
		$id=$data[0]['Id'];
		$id+=1;

		return $id;
	}
}
?>