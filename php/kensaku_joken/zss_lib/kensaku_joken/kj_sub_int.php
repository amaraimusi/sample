<?php
require_once 'i_kj_sub.php';
require_once 'kj_util.php';
require_once dirname(__FILE__) .'/../common.php';


/**
 * 検索条件・整数系項目
 * ★履歴
 * 2013/7/27	新規作成
 * @author Kenji Uehara
 *
 */
class KjSubInt implements IKjSub{
	
		/**
		 * 検索条件演算子コンボボックスのＨＴＭＬを作成。
		 * @see kensaku_joken/IKjSub#createCndOpeCmbHtml($ent)
		 */
	  public function createCndOpeCmbHtml($ent){

					//数値系の検索条件演算コンボボックスのＨＴＭＬを作成。
					$util=KjUtil::getInstance();
					$html=$util->createCndOpeCmbHtmlNum($ent);
					
					return $html;
	  }
    

		/**
		 * 入力フォームＨＴＭＬを作成
		 * @param $ent	検索条件エンティティ
		 * @return 入力フォームＨＴＭＬ
		 */
		public function createInpHtml($ent){
			
			//数値系の入力フォームＨＴＭＬを作成
			$util=KjUtil::getInstance();
			$html=$util->createInpHtmlNum($ent);
			
			return $html;
		
		}
		
		 /**
     * デフォルト入力チェックデータを取得
     * @return デフォルト入力チェックデータ
     */
    public function getDefInpData(){
    	$data['ic']=true;					//入力チェック対象項目であればtrueをセット
    	$data['size']=INT_LEN;					//入力文字数
    	$data['primaryKey']=false;//主キー
    	$data['req']=false;				//必須入力
    	$data['maxvalue']=INT_MAX;			//数値入力系の場合の最大値
    	$data['minvalue']=INT_MIN;			//数値入力系の場合の最小
    	
    	return $data;
    }
    
    /**
     * 検索条件SQL文を生成する。
     * @param $kjEnt　検索条件エンティティ
     * @return 検索条件SQL文
     */
    public function createJokenSql($kjEnt){

			//検索条件SQL文を生成する。数値系用。
    	$util=KjUtil::getInstance();
			$sql=$util->createJokenSqlForNum(&$kjEnt);
			
			return $sql;
    }
    
    /**
     * 相関入力チェック
     * @param $kjEnt	　検索条件エンティティ
     * @return 相関入力チェックエラーメッセージ
     */
    public function corrInpChk($kjEnt){
    	
    	//相関入力チェック。数値系用
    	$util=KjUtil::getInstance();
    	$err=$util->corrInpChkForNum($kjEnt);
    	
    	return $err;

    }
    
    
}