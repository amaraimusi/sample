<?php
require_once 'i_kj_sub.php';
require_once 'kj_util.php';
require_once dirname(__FILE__) .'/../common.php';

/**
 * 検索条件・テキスト系項目
 * ★履歴
 * 2013/7/27	新規作成
 * @author Kenji Uehara
 *
 */
class KjSubText implements IKjSub{
	
		/**
		 * 検索条件演算子コンボボックスのＨＴＭＬを作成。
		 * @see kensaku_joken/IKjSub#createCndOpeCmbHtml($ent)
		 */
	  public function createCndOpeCmbHtml($ent){
	  			$data[0]['value']=0;
					$data[0]['text']='完全一致';
					$data[1]['value']=1;;
					$data[1]['text']='部分一致';
					$data[2]['value']=2;;
					$data[2]['text']='前方部分一致';
					$data[3]['value']=3;;
					$data[3]['text']='後方部分一致';
			
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
			$text_type=$ent['txtFormType'];
			$value=$ent['value'];
			$id="kj_{$field}";
			
			//▽入力制限属性を作成する。
			$util=KjUtil::getInstance();
			$maxlength=$util->createMaxlength($ent['maxlength']);
			
			
			//HTMLを組み立て
			$html="<input type='{$text_type}' id='{$id}' name='{$id}' value='{$value}' {$maxlength} />\n";

			return $html;
		
		}
		
		 /**
     * デフォルト入力チェックデータを取得
     * @return デフォルト入力チェックデータ
     */
    public function getDefInpData(){

    	$data['ic']=true;				//入力チェック対象項目であればtrueをセット
    	$data['size']=255;					//入力文字数
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
     * ※重複対策を避けるため、SQLインジェクション対策はしていない。
     */
    public function createJokenSql($kjEnt){
    	
    	
    	$field=$kjEnt['field'];			//フィールドを取得
    	$cnd_ope=$kjEnt['cnd_ope'];	//条件演算子番号を取得
    	$v=$kjEnt['value'];					//値を取得

    	//条件SQLの作成。条件演算子番号による処理分岐。
    	switch($cnd_ope){
    		case 0;//完全一致
    			$sql="{$field} = '{$v}'";
    			break;
    		case 1;//部分一致
					$sql="{$field} like '%{$v}%'";
    			break;
    		case 2;//前方部分一致
					$sql="{$field} like '{$v}%'";
    			break;
    		case 3;//後方部分一致
					$sql="{$field} like '%{$v}'";
    			break;
    	}
    	
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