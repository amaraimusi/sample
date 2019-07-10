<?php


require_once dirname(__FILE__) .'/../i_entity_info.php';
/**
 * 検索条件・入力チェック用エンティティ情報
 *★履歴<br>
 *2013/8/01	新規作成<br>
 */
class KjIcEntityInfo implements IEntityInfo{
	
	///エンティティInfoデータの構造情報
	var $m_eiData;
	
	///ファイル名入力フィールド系の構造情報
	var $m_fiData;
	
	public static function getInstance(){
		
		
		if(!$_REQUEST['KjIcEntityInfo']){
			$obj=new KjIcEntityInfo();
			$_REQUEST['KjIcEntityInfo']=&$obj;
		}else{
			$obj=&$_REQUEST['KjIcEntityInfo'];
		}
		
		return $obj;

	}
	/**
	 * コンストラクタ。
	 * エンティティの詳細情報を定義
	 */
	public function KjIcEntityInfo() {
		//▼エンティティデータ
		$ei['Id'] = array(name=> 'Id' ,type=> 'int' ,jname=> 'Id' , htmlName=>'Id' , size=> 0 , def=> null , primaryKey=> TRUE , req=> TRUE ,ic=> FALSE ,maxvalue=> 30000 ,minvalue=> 0 ,disabled=>null ,money=>null);
		$ei['HisFigName'] = array(name=> 'HisFigName' ,type=> 'string' ,jname=> '名称' , htmlName=>'HisFigName' , size=> 32 , def=> null , primaryKey=> FALSE , req=> TRUE ,ic=> TRUE ,maxvalue=> 0 ,minvalue=> 0 ,disabled=>null ,money=>null);
		$ei['Country'] = array(name=> 'Country' ,type=> 'string' ,jname=> '国' , htmlName=>'Country' , size=> 16 , def=> null , primaryKey=> FALSE , req=> TRUE ,ic=> TRUE ,maxvalue=> 0 ,minvalue=> 0 ,disabled=>null ,money=>null);
		$ei['ActivityYear'] = array(name=> 'ActivityYear' ,type=> 'int' ,jname=> '活躍年' , htmlName=>'ActivityYear' , size=> 4 , def=> 1500 , primaryKey=> FALSE , req=> FALSE ,ic=> TRUE ,maxvalue=> 9999 ,minvalue=> -30000 ,disabled=>null ,money=>null);
		$ei['BirthYear'] = array(name=> 'BirthYear' ,type=> 'int' ,jname=> '生年' , htmlName=>'BirthYear' , size=> 4 , def=> 1500 , primaryKey=> FALSE , req=> FALSE ,ic=> TRUE ,maxvalue=> 9999 ,minvalue=> -30000 ,disabled=>null ,money=>null);
		$ei['DeathYear'] = array(name=> 'DeathYear' ,type=> 'int' ,jname=> '没年' , htmlName=>'DeathYear' , size=> 4 , def=> 1500 , primaryKey=> FALSE , req=> FALSE ,ic=> TRUE ,maxvalue=> 9999 ,minvalue=> -30000 ,disabled=>null ,money=>null);
		$ei['Note'] = array(name=> 'Note' ,type=> 'string' ,jname=> '列伝' , htmlName=>'Note' , size=> 1024 , def=> null , primaryKey=> FALSE , req=> FALSE ,ic=> TRUE ,maxvalue=> 0 ,minvalue=> 0 ,disabled=>null ,money=>null);
		//$ei['ImgFileName'] = array(name=> 'ImgFileName' ,type=> 'string' ,jname=> '画像ファイル名' , htmlName=>'ImgFileName' , size=> 64 , def=> 0 , primaryKey=> FALSE , req=> FALSE ,ic=> TRUE ,maxvalue=> 0 ,minvalue=> 0 ,disabled=>null ,money=>null);
		$ei['Man'] = array(name=> 'Man' ,type=> 'int' ,jname=> '性別' , htmlName=>'Man' , size=> 1 , def=> 0 , primaryKey=> FALSE , req=> TRUE ,ic=> TRUE ,maxvalue=> 9 ,minvalue=> 0 ,disabled=>null ,money=>null);
		$ei['UpdateDate'] = array(name=> 'UpdateDate' ,type=> 'int' ,jname=> '更新日' , htmlName=>'UpdateDate' , size=> 0 , def=> 0 , primaryKey=> FALSE , req=> TRUE ,ic=> FALSE ,maxvalue=> 0 ,minvalue=> 0 ,disabled=>null ,money=>null);
				
		$this->m_eiData=$ei;
		
//		//▼添付ファイル情報
//		$fiData['ImgFileName']=array(name => 'ImgFileName' ,  jname=>'アップロード画像ファイル名', req => null , ic => true);	
//	
//		$this->m_fiData=$fiData;
		
		
	}
	

	
		/**
	 * エンティティ情報を取得する。
	 */
	public function getEntityInfo(){
		return $this->m_eiData;
	}
	
	
	/**
	 * エンティティ情報をセットする。
	 * @param  $eiData　エンティティ情報
	 */
	public function setEntityInfo(&$eiData){
		$this->m_eiData=&$eiData;
	}
	
	/**
	 * デフォルトエンティティを取得する。
	 * @return Ambigous <string, number, NULL>
	 */
	public function getDefalutEnt(){
		foreach ($this->m_eiData as $key => $rec){
			
			$ent[$key]=$rec['def'];

		}

		
		return $ent;
	}
	
	
}