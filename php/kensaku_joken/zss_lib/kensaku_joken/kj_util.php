<?php


/**
 * 検索条件関連の汎用クラス。
 * 
 * ★履歴
 * 2013/7/26	新規作成
 * @author Kenji Uehara
 *
 */
class KjUtil{
	
	var $m_cbHtmlCrt;//コンボボックスＨＴＭＬ生成
	
	var $m_kjIcMap;//変換マップ。検索条件データ→入力チェックデータ変換
	
	/**
	 * 当クラスのインスタンスを返す。<br>
	 * 不完全なシングルトンパターンを適用。（インスタンスは一回のリクエスト中でしか保持されない。）<br>
	 * @return KjUtil2
	 */
	public static function getInstance(){
		
		
		if(!$_REQUEST['KjUtil']){
			$obj=new KjUtil();
			$_REQUEST['KjUtil']=&$obj;
		}else{
			$obj=&$_REQUEST['KjUtil'];
		}
		
		return $obj;

	}
	
	/**
	 * 検索条件演算子コンボボックスＨＴＭＬを作成する。
	 * @param $cmbData　　検索条件演算子コンボボックスのデータ
	 * @param $ent　　		検索条件エンティティ
	 * @param $option　　	オプション（エレメントの属性）
	 * @return 検索条件演算子コンボボックスＨＴＭＬ
	 */
	public function createCmbHtml($cmbData,$ent,$option=''){
		if($cmbData==null){return null;}
	
		//各種検索条件のプロパティを取得
		$field=$ent['field'];
		$cnd_ope=$ent['cnd_ope'];
		
		$m_cbHtmlCrt= $this->getCombboxHtmlCreater();//コンボボックスＨＴＭＬ生成オブジェクト

		//▽コンボボックスＨＴＭＬを生成。
		$cnt=count($cmbData);//選択項目数。
		$id="kj_cmb_cnd_ope_{$field}";//コンボボックスのＩＤ属性名
		$html=$m_cbHtmlCrt->createHtml2($id,$cnd_ope,$cmbData,$option);//コンボボックスＨＴＭＬを生成
		
		
		return $html;
	}
	
	//コンボボックスＨＴＭＬ生成オブジェクトを取得
	private function getCombboxHtmlCreater(){
			if($m_cbHtmlCrt==null){
				$m_cbHtmlCrt=new CombboxHtmlCreater();
				
			}
			return $m_cbHtmlCrt;
	}
	
		/**
		 * 検索条件演算子コンボボックスのＨＴＭＬを作成。数値系の検索項目用。
		 * @see kensaku_joken/IKjSub#createCndOpeCmbHtml($ent)
		 */
	  public function createCndOpeCmbHtmlNum($ent){

					$data[0]['value']=0;
					$data[0]['text']='完全一致';
					$data[1]['value']=1;
					$data[1]['text']='以上';
					$data[2]['value']=2;
					$data[2]['text']='以下';
					$data[3]['value']=3;
					$data[3]['text']='範囲';
					
					//JSイベントをエレメント属性に追加。
					$field=$ent['field'];
					$option="onchange=\"jkCmbChgCndOpeNum('{$field}')\"";//ＪＳのイベントコード。
					
					//表示・非表示関連のＣＳＳをエレメント属性に追加。
	  			$visible=$ent['visible'];
					if($visible==true){
						$css=" style='display:inline'";
					}else{
						$css=" style='display:none'";
					}
					$option.=$css;
					
					//検索条件演算コンボボックスのＨＴＭＬを作成。
					$html=$this->createCmbHtml($data,$ent,$option);
					
					return $html;
	  }
	  
	/**
		 * 入力フォームＨＴＭＬを作成。数値系用。
		 * @param $ent	検索条件エンティティ
		 * @return 入力フォームＨＴＭＬ
		 */
		public function createInpHtmlNum($ent){
			//▽各種パラメータを取得
			$field=$ent['field'];
			$text_type=$ent['txtFormType'];
			$value=$ent['value'];
			$value2=$ent['value2'];
			$id="kj_{$field}";
			$id2="kj_{$field}_2";
			$id_a2="kj_{$field}_a2";
			
			//入力フォーム2（範囲入力用）の表示・非表示
			$cnd_ope=$ent['cnd_ope'];
			if($cnd_ope==3){
				$con_ope_display='inline';
			}else{
				$con_ope_display='none';
			}
			
			//入力制限属性コードを生成する。
			$maxlength=$this->createMaxlength($ent['maxlength']);
			
			//HTMLを組み立て
			$html="<input type='{$text_type}' id='{$id}' name='{$id}' value='{$value}' {$maxlength} />".
				"<span id='{$id_a2}' style='display:{$con_ope_display}'> ～ <input type='{$text_type}' id='{$id2}' name='{$id2}' value='{$value2}' {$maxlength} /></span>\n";

			return $html;
		
		}
	
	/**
	 * 検索条件SQL文を生成する。数値系用。
	 * @param  $kjEnt	検索条件エンティティ
	 * @return 検索条件SQL文
	 */
	public function createJokenSqlForNum(&$kjEnt){
		  $field=$kjEnt['field'];			//フィールドを取得
    	$cnd_ope=$kjEnt['cnd_ope'];	//条件演算子番号を取得
    	$v=$kjEnt['value'];					//値を取得
    	$v2=$kjEnt['value2'];					//値2を取得

					
    	//条件SQLの作成。条件演算子番号による処理分岐。
    	switch($cnd_ope){
    		case 0;//完全一致
    			$sql="{$field} = {$v}";
    			break;
    		case 1;//以上
					$sql="{$field} <= {$v}";
    			break;
    		case 2;//以下
					$sql="{$field} >= {$v}";
    			break;
    		case 3;//範囲
					$sql="{$field} >= {$v} AND {$field} <= {$v2}";
    			break;
    	}
    	
    	return $sql;
	}
		
	/**
	 * 検索条件SQL文を生成する。日付系用。
	 * @param  $kjEnt	検索条件エンティティ
	 * @return 検索条件SQL文
	 */
	public function createJokenSqlForDate(&$kjEnt){
		  $field=$kjEnt['field'];			//フィールドを取得
    	$cnd_ope=$kjEnt['cnd_ope'];	//条件演算子番号を取得
    	$v=$kjEnt['value'];					//値を取得
    	$v2=$kjEnt['value2'];					//値2を取得

					
    	//条件SQLの作成。条件演算子番号による処理分岐。
    	switch($cnd_ope){
    		case 0;//完全一致
    			$sql="{$field} = '{$v}'";
    			break;
    		case 1;//以上
					$sql="{$field} <= '{$v}'";
    			break;
    		case 2;//以下
					$sql="{$field} >= '{$v}'";
    			break;
    		case 3;//範囲
					$sql="{$field} >= '{$v}' AND {$field} <= '{$v2}'";
    			break;
    	}
    	
    	return $sql;
	}

	/**
	 * maxlength属性コードを生成する。
	 * @param  $v	入力制限数
	 * @return maxlength属性コード
	 */
	public function createMaxlength($v){
			//▽入力制限を属性を生成する。
			$maxlength=$v;
			if($maxlength!=null){
				$maxlength="maxlength='{$maxlength}'";
			}else{
				$maxlength='';
			}
			
			return $maxlength;
			
	}
	
	/**
	 * 相関入力チェック。数値系用
	 * @param  $kjEnt	検索条件エンティティ
	 * @return エラーメッセージ
	 */
	public function corrInpChkForNum(&$kjEnt){
		  $cnd_ope=$kjEnt['cnd_ope'];	//条件演算子番号を取得
    	$v=$kjEnt['value'];					//値を取得
    	$v2=$kjEnt['value2'];				//値2を取得
    	$wamei=$kjEnt['wamei'];			//和名を取得
    	
    	//値１、値２の両方がnull及び空文字ならエラーなし。
    	if(($v===null || $v==='') && ($v2===null || $v2==='')){
    		return null;
    	}
    	
    	
    	
    	//条件演算子番号が「範囲」である場合、相関入力チェックを行う。
    	if($cnd_ope==3){
    		//値１および、値２のいずれかがnullまたは空文字である場合、エラー。
    		if($v===null || $v==='' || $v2===null || $v2===''){
    			$err="{$wamei}の範囲が正しく入力されていません。";
    		}else{
    			//値1が値2より大きい場合、エラー
    			if($v > $v2){
    				$err="{$wamei}の範囲入力が正しくありません。左側の入力は右側より、小さい値を設定してください。";
    			}
    		}

    	}
    	
    	return $err;
	}
	
	
	
	/**
	 * 相関入力チェック。日付系用
	 * @param  $kjEnt	検索条件エンティティ
	 * @param  $dtmName	「時刻」、「日付」、「日時」のいずれかを指定する。（エラーメッセージで表示する）
	 * @return エラーメッセージ
	 */
	public function corrInpChkForDTm(&$kjEnt,$dtmName){
		  $cnd_ope=$kjEnt['cnd_ope'];	//条件演算子番号を取得
    	$v=$kjEnt['value'];					//値を取得
    	$v2=$kjEnt['value2'];				//値2を取得
    	$wamei=$kjEnt['wamei'];			//和名を取得
    	
    	
    	//条件演算子番号が「範囲」である場合、相関入力チェックを行う。
    	if($cnd_ope==3){
    		
    	  //値１、値２の両方がnull及び空文字ならエラーなし。
    		if(($v===null || $v==='') && ($v2===null || $v2==='')){
	    		return;
	    	}
    		//値１および、値２のいずれかがnullまたは空文字である場合、エラー。
    		if($v===null || $v==='' || $v2===null || $v2===''){
    			$err="{$wamei}の範囲が正しく入力されていません。";
    		}else{
    			//値1が値2より大きい場合、エラー
    			if($v > $v2){
    				$err="{$wamei}の範囲入力が正しくありません。左側の{$dtmName}は右側より、以前の{$dtmName}を設定してください。";
    			}
    		}

    	}
    	
    	return $err;
	}
	
	/**
	 * 空文字「''」または、null以外であるか調べる。
	 * @param $v	入力チェック値
	 * @return 空文字「''」または、null以外であればtrue;
	 */
	private function isEmptyOrNull($v){
		if($v===null || $v===''){
			return false;
		}else{
			return true;
		}
	}
	
}

?>