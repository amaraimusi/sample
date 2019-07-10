<?php
/**
 * 検索条件サブクラスのインターフェース
 * ★履歴
 * 2013/7/26	新規作成
 * @author Kenji Uehara
 *
 */
interface IKjSub
{
	
		/**
		 * 検索条件演算子コンボボックスのHTMLを生成する。
		 * @param  $ent	検索条件エンティティ
		 * @return 検索条件演算子コンボボックスのHTML
		 */
    public function createCndOpeCmbHtml($ent);
    
    /**
     * 検索条件の入力フォームHTMLを生成する。
     * @param $ent	検索条件エンティティ
     * @return 検索条件の入力フォームHTML
     */
    public function createInpHtml($ent);
    
    /**
     * デフォルト入力チェックデータを取得
     * @return デフォルト入力チェックデータ
     */
    public function getDefInpData();
    
    /**
     * 検索条件SQL文を生成する。
     * @param $kjEnt　検索条件エンティティ
     * @return 検索条件SQL文
     */
    public function createJokenSql($kjEnt);
    
    /**
     * 相関入力チェック
     * @param $kjEnt	　検索条件エンティティ
     * @return 相関入力チェックエラーメッセージ
     */
    public function corrInpChk($kjEnt);
    
}