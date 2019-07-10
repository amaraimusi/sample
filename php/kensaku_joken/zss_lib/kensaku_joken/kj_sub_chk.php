<?php
require_once 'i_kj_sub.php';
require_once 'kj_util.php';
require_once dirname(__FILE__) .'/../common.php';


/**
 * 検索条件・chk
 * ★履歴
 * 2013/7/28	新規作成
 * @author Kenji Uehara
 *
 */
class KjSubChk implements IKjSub{
	
		/**
		 * 検索条件演算子コンボボックスのＨＴＭＬを作成。
		 * @see kensaku_joken/IKjSub#createCndOpeCmbHtml($ent)
		 */
	  public function createCndOpeCmbHtml($ent){
	  			$data[0]['value']=0;
					$data[0]['text']='完全一致';

			
					//検索条件演算コンボボックスのＨＴＭＬを作成。
					$util=KjUtil::getInstance();
					$html=$util->createCmbHtml($data,$ent);
					
					return $html;
	  }
    

		/**
		 * 入力フォームＨＴＭＬを作成
		 * @param $ent	検索条件エンティティ
		 * @return 入力フォームＨＴＭＬ
		 */
		public function createInpHtml($ent){
			
			//▽各種パラメータを取得
			$field=$ent['field'];
			$value=$ent['value'];
			if($value==null | $value==0 | $value==false){
				$checked='';
			}else{
				$checked='checked';
			}
			
			$id="kj_{$field}";//IDを作成
			
			$html="<input type='checkbox' name='{$id}' value='1' {$checked}>";
			
			return $html;
		
		}
		
		 /**
     * デフォルト入力チェックデータを取得
     * @return デフォルト入力チェックデータ
     */
    public function getDefInpData(){

    	$data['ic']=false;				//入力チェック対象項目であればtrueをセット
    	$data['size']=1;					//入力文字数
    	$data['primaryKey']=false;//主キー
    	$data['req']=false;				//必須入力
    	$data['maxvalue']=0;			//数値入力系の場合の最大値
    	$data['minvalue']=0;			//数値入力系の場合の最小
    	
    	return $data;
    }
    
    /**
     * 検索条件SQL文を生成する。
     * @param $kjEnt　検索条件エンティティ
     * @return 検索条件SQL文
     */
    public function createJokenSql($kjEnt){
    	$field=$kjEnt['field'];			//フィールドを取得
    	$v=$kjEnt['value'];					//値を取得
    	
    	//値がnullやfalseなら0をセット
    	if($v==null || $v==false){
    		$v=0;
    	}else{
    		$v=1;
    	}
    	
    	//条件SQLの作成。
			$sql="{$field} = {$v}";
			
			return $sql;
    }
    
    /**
     * 相関入力チェック
     * @param $kjEnt	　検索条件エンティティ
     * @return 相関入力チェックエラーメッセージ
     */
    public function corrInpChk($kjEnt){
    	//何もせず
    
    }
}