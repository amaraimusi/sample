<?php

//★※脚注　検索条件データのプロパティ
//　個別で設定する必要のあるプロパティ
//		field	フィールド
//		wamei	フィールド
//		kind	種類（text	int	float	double	long	decimal	comb	radio	chk	chk_bool	date	time	datetime)
//		cnd_ope	検索方法(0:完全一致	1:部分一致	2:前方部分一致	3:後方部分一致	4:以上	5:以下	6:超える	7:未満	8:範囲)
//		value		入力フォームの値
//		value2	入力フォーム２の値
//		visible 検索演算子コンボの表示・非表示
//		txtFormType	テキストボックスタイプ（email	url	search	tel	number	date	datetime	datetime-local	month	week	time	range	color）
//		selectData	選択データ（コンボボックス、ラジオボタンで使用）
//　
// 入力チェック系(省略可能。省略した場合、kindの値ごとに異なるデフォルト値が自動設定される。）
//		size 						入力文字数。
//		primaryKey			主キー。デフォルトではfalse
//		req							必須入力。デフォルトではfalse
//		ic							入力チェック対象である場合、true
//		maxvalue				数値入力系の場合の最大値
//		minvalue				数値入力系の場合の最小
//
// 内部で利用するプロパティ
//		cnd_opeCmbHtml　検索方法コンボボックスＨＴＭＬ（処理内部で利用するため空白でよい）
//		inpForm　入力フォームＨＴＭＬ（処理内部で利用するため空白でよい）

//★検索項目の種類
//text			文字列検索
//int				数値系
//float
//double
//long
//decimal
//comb			コンボボックス
//radio			ラジオボタン
//chk				チェックボックス
//bool			チェックボックス
//date			日付系
//time
//datetime
require_once dirname(__FILE__) .'/../combbox_html_creater.php';
require_once dirname(__FILE__) .'/../combbox_html_creater.php';
require_once dirname(__FILE__) .'/../radio_html_creater.php';
require_once dirname(__FILE__) .'/../i_entity_info.php';
require_once dirname(__FILE__) .'/../mysql_const.php';
require_once dirname(__FILE__) .'/../input_check_ex2.php';


require_once 'i_kj_sub.php';
require_once 'kj_sub_text.php';
require_once 'kj_sub_int.php';
require_once 'kj_sub_float.php';
require_once 'kj_sub_double.php';
require_once 'kj_sub_long.php';
require_once 'kj_sub_decimal.php';
require_once 'kj_sub_comb.php';
require_once 'kj_sub_radio.php';
require_once 'kj_sub_chk.php';
require_once 'kj_sub_bool.php';
require_once 'kj_sub_date.php';
require_once 'kj_sub_time.php';
require_once 'kj_sub_datetime.php';

require_once 'kj_ic_entity_info.php';





class KensakuJoken{
	
	var $m_cbHtmlCrt;//コンボボックスＨＴＭＬ生成
	var $m_radioHtmlCrt;//ラジオボタンＨＴＭＬ生成
	var $m_subs;//サブクラスリスト
	var $m_icData;//入力チェックデータ
	
	function __construct() {
		$m_cbHtmlCrt=new CombboxHtmlCreater();
	}
	
	/**
	 * サブクラスリストを取得する。
	 * @return サブクラスリスト
	 */
	public function getSubs(){
		if($m_subs==null){
			$subs['text']=new KjSubText();
			$subs['int']=new KjSubInt();
			$subs['float']=new KjSubFloat();
			$subs['double']=new KjSubDouble();
			$subs['long']=new KjSubLong();
			$subs['decimal']=new KjSubDecimal();
			$subs['comb']=new KjSubComb();
			$subs['radio']=new KjSubRadio();
			$subs['chk']=new KjSubChk();
			$subs['bool']=new KjSubBool();
			$subs['date']=new KjSubDate();
			$subs['time']=new KjSubTime();
			$subs['datetime']=new KjSubDatetime();
			
			$this->m_subs=$subs;
		}
		
		return $this->m_subs;
	}
	
	/**
	 * 検索条件ＨＴＭＬを作成する。
	 * @param $data	検索条件データ（※　上部にある脚注参照）
	 * @return 検索条件ＨＴＭＬ
	 */
	function createHtml(&$data){
		
		//サブクラスリストを取得。
		$subs=$this->getSubs();
		

		
		//データ件数分、以下の処理を繰り返す。
		foreach($data as $i=>&$ent){
			
			$kind=$ent['kind'];//型を取得する。
			$sub=$subs[$kind];

			//型、フィールドから検索方法コンボボックスＨＴＭＬを作成する。
			$cmbHtml=$sub->createCndOpeCmbHtml($ent);
			
			//データに検索コンボボックスＨＴＭＬをセット
			$ent['cnd_opeCmbHtml']=$cmbHtml;
			
			//入力制限数を取得。
			$ent['maxlength']=$this->getDefIcVal('size',$sub,$ent);

			//入力フォームＨＴＭＬを作成する。
			$inpForm=$sub->createInpHtml($ent);
			
			
			//データに入力フォームＨＴＭＬをセット
			$ent['inpForm']=$inpForm;
			
			

		
		}
		
		//データをテーブル化する。
		$html=$this->createTableHtml($data);
		
		
		return $html;
			
	}
	
	/**
	 * 入力チェック
	 * @param  $kjData　検索条件データ
	 * @return エラーがない場合、null。エラーがある場合、エラーHTMLコード。
	 */
	public function inputCheck(&$kjData){
		
		//検索条件データなどから、入力チェック用エンティティインフォクラスを作成する。
		$ei=$this->createEntityInfo($kjData);
		
		//入力チェック用のデータを作成する。
		$icEnt=$this->createIcEntity($kjData);

		//入力チェッククラスを生成。
		$ice=InputCheckEx2::getInstance();
		$err=$ice->checkEntity($icEnt,$ei);
		
		//相関入力チェック
		$corrErr=$this->corrInpChk($kjData);
		$err.=$corrErr;
		
		return $err;

	}
	
	/**
	 * 相関入力チェック
	 * @param  $kjData	検索条件情報
	 * @return エラーがある場合、エラーメッセージ
	 */
	private function corrInpChk($kjData){
		//サブクラスリストを取得する。
		$subs=$this->getSubs();
		
		$errMsg=null;
		
		//検索条件データの件数文、以下の処理を繰り返す。
		foreach($kjData as $i=>$ent){
			
			//kindを取得
			$kind=$ent['kind'];
			
			//サブクラスを取得
			$sub=&$subs[$kind];
			
			//相関チェックを行う。
			$msg=$sub->corrInpChk($ent);
			
			//エラーがあれば、エラーメッセージに追加。
			if($msg!=null){
				$errMsg.=$msg.'<br>';
			}
			
		}
		return $errMsg;
	}
	

	/**
	 * 検索条件SQL文を生成する。
	 * @param  $kjData 検索条件データ
	 * @return 検索条件SQL文
	 */
	public function createJokenSql($kjData){
		
		//サブクラスリストを取得する。
		$subs=$this->getSubs();
		
		//検索条件データの件数文、以下の処理を繰り返す。
		$firstLoopFlg=1;
		foreach($kjData as $i=>$ent){
			if($ent['value']!=null){
				//kindを取得
				$kind=$ent['kind'];
				
				//サブクラスを取得
				$sub=&$subs[$kind];
				
				//条件SQL文を生成する。
				$sql=$sub->createJokenSql($ent);
				
				//初回ループでなければ、「AND」を条件SQLを付加する。
				if($firstLoopFlg==2){
					$sql='AND '.$sql;
				}else{
					$firstLoopFlg=2;
				}
				
				//SQL文をちょっと装飾する。
				$sql=" {$sql}\n";
				
				//全体条件SQLに条件SQLを連結する。
				$allSql.=$sql;
				
				$sql='';//クリア
			}
		}
		
		//全体条件SQLに条件SQLを返す。
		return $allSql;
	}
	
	/**
	 * 入力チェック用のエンティティを作成する。
	 * @param  検索条件データ
	 * @return 入力チェック用エンティティ
	 */
	private function createIcEntity(&$kjData){
		foreach($kjData as $i=>&$ent){
			
			$field=$ent['field'];//フィールドを取得
			
			//キー名を作成
			$key="kj_{$field}";
			$key2="kj_{$field}_2";
			
			//値を取得
			$v=$ent['value'];
			$v2=$ent['value2'];
			
			//入力チェックデータにセット
			$icEnt[$key]=$v;
			$icEnt[$key2]=$v2;
			
		}
		unset($ent);
		
		return $icEnt;
	}
	
	/**
	 * リクエストから値を取得し、引数の検索条件データにセットする。
	 * @param $kjData	検索条件データ
	 * @return 
	 */
	public function getRequest(&$kjData){
		//検索条件データの件数分、処理を繰り返す。
		foreach($kjData as $i => &$ent){
			//フィールドを取得する。
			$field=$ent['field'];
			
			//フィールドからキーを２つ作成。
			$key="kj_{$field}";
			$key2="kj_{$field}_2";
			
			//リクエストから値を取得。
			$v=$_POST[$key];
			$v2=$_POST[$key2];

			
			//トリミング
			$v=trim($v);
			$v2=trim($v2);
			
			//値をサニタイズする。
			$v=htmlspecialchars($v);//サニタイズ。HTML用の記号を無効化にする。
			$v2=htmlspecialchars($v2);
			$v=stripslashes($v);//サニタイズ￥解除。特定の記号から\マークを削除する。
			$v2=stripslashes($v2);
			
			//検索条件データに値をセット
			$ent['value']=$v;
			$ent['value2']=$v2;
			
			//条件演算子コンボボックスの値を取得し、検索条件データにセット
			$cnd_ope_key="kj_cmb_cnd_ope_{$field}";//キーを作成
			$cnd_ope=$_POST[$cnd_ope_key];//値を取得
			$cnd_ope=htmlspecialchars($cnd_ope);//サニタイズ。HTML用の記号を無効化にする。
			$cnd_ope=stripslashes($cnd_ope);//サニタイズ￥解除。特定の記号から\マークを削除する。
			$ent['cnd_ope']=$cnd_ope;//検索条件データにセット
			
		}
		unset($ent);
		
		return $kjData;
	}
	
			
			
	/**
	 * ◇検索条件データなどから、入力チェック用エンティティインフォクラスを生成する。
	 * @param  $kjData	検索条件データ。
	 * @return 入力チェックデータ
	 */
	private function createEntityInfo(&$kjData){
		//▽型変換マップを生成する。
		$typeMap=$this->createKjToIcMap();
		
		//▽サブクラスリストを生成する。
		$subs=$this->getSubs();
		
		//▽検索条件データなどから入力チェックデータを作成。
		foreach($kjData as $i=>&$ent){
			
			$field=$ent['field'];//フィールド取得
			
			//左側テキストボックスのeiデータを作成
			$name="kj_{$field}";//キー名を作成
			$jname=$ent['wamei'];//和名を作成
			$icData[$name]=$this->createEiEntity($name,$jname,$subs,$typeMap,$ent);
			
			//右側テキストボックスのeiデータを作成
			$name2="kj_{$field}_2";//キー名を作成
			$jname2=$ent['wamei'].'【右側】';//和名を作成
			$icData[$name2]=$this->createEiEntity($name2,$jname2,$subs,$typeMap,$ent);
			
		}
		unset($ent);
		
		$ei=new KjIcEntityInfo();
		$ei->setEntityInfo($icData);
		
		return $ei;
	}
	

	/**
	 * eiエンティティを生成
	 * @param  $name		キー名
	 * @param  $jname		和名
	 * @param  $subs		サブクラスリスト
	 * @param  $typeMap	型変換マップ
	 * @param  $ent			検索条件エンティティ
	 * @return eiエンティティ
	 */
	private function createEiEntity($name,$jname,&$subs,&$typeMap,&$ent){
			$eiEnt['name']=$name;
			$eiEnt['jname']=$jname;
			$eiEnt['type']=$typeMap[$ent['kind']];
			
			//▽サブクラスを取得する。
			$kind=$ent['kind'];
			
			$sub=$subs[$kind];
			
			//▽入力チェックデータにkindごとのデフォルト値を設定。（検索条件データの値がnullの場合）
			$eiEnt['size']=$this->getDefIcVal('size',$sub,$ent);
			$eiEnt['def']=$this->getDefIcVal('def',$sub,$ent);
			$eiEnt['primaryKey']=$this->getDefIcVal('primaryKey',$sub,$ent);
			$eiEnt['req']=$this->getDefIcVal('req',$sub,$ent);
			$eiEnt['ic']=$this->getDefIcVal('ic',$sub,$ent);
			$eiEnt['maxvalue']=$this->getDefIcVal('maxvalue',$sub,$ent);
			$eiEnt['minvalue']=$this->getDefIcVal('minvalue',$sub,$ent);
			
			return $eiEnt;
	}
	
	/**
	 * デフォルト入力チェック値を取得。
	 * @param  $kind　種類キー
	 * @param  $sub	　サブクラス
	 * @param  $ent		検索条件エンティティ
	 * @return デフォルト入力チェック値
	 */
	private function getDefIcVal($kind,IKjSub &$sub,&$ent){

		$defData=$sub->getDefInpData();
		if($ent[$kind]==null){
			$v=$defData[$kind];
		}else{
			$v=$ent[$kind];
		}
		return $v;
	}
	
	/**
	 * 検索条件データから入力チェック用データを変換作成する。
	 * @param  $kjData	検索条件データ
	 * @return 入力チェック用データ。
	 */
	private function createKjToIcMap(){
		
		//型変換マップの生成。
		$map['text']='string';
		$map['int']='int';
		$map['float']='double';
		$map['double']='double';
		$map['long']='int';
		$map['decimal']='double';
		$map['comb']='int';
		$map['radio']='int';
		$map['chk']='int';
		$map['bool']='int';
		$map['date']='date';
		$map['time']='time';
		$map['datetime']='datetime';
		
		return $map;
		
	}


	/**
	 * データをテーブルHTML化する。
	 * @param $data	検索条件データ
	 * @return テーブルＨＴＭＬ
	 */
	private function createTableHtml($data){
		
		$html="<table class='kj_tbl' ><thead>\n";
		
		foreach($data as $i=>&$ent){
			$html.="<tr>\n";
			
			//和名を組み込む
			$wamei=$ent['wamei'];
			$html.="<td >{$wamei}</td>\n";
			
			//検索方法コンボボックスを組み込む
			$cnd_opeCmbHtml=$ent['cnd_opeCmbHtml'];
			$html.="<td >\n";
			$html.=$cnd_opeCmbHtml;
			$html.="</td>\n";
			
			//入力フォームを組み込む
			$inpHtml=$ent['inpForm'];
			$html.="<td >\n";
			$html.=$inpHtml;
			$html.="</td>\n";
			
			$html.="<tr>\n";
		}
		
		$html.="</table>\n";
		
		return $html;
	}

	/**
	 * 入力フォームＨＴＭＬを作成する。
	 * @param $field	フィールドＩＤ
	 * @param $kind		型
	 * @param $inpFormType	入力フォームタイプ
	 * @param $txtFormType	テキストボックスタイプ
	 * @return 入力フォームＨＴＭＬ
	 */
	function createInpHtml($ent){

		$kind=$ent['kind'];
		
		$html='';
		switch ($kind) {
	    case "text":
	        $html=$this->createInpHtmlText($ent);
	        break;
	    case "int":
	        $html=$this->createInpHtmlNum($ent);

	        break;
	    case "float":
	        $html=$this->createInpHtmlNum($ent);
	        break;
	    case "double":
	        $html=$this->createInpHtmlNum($ent);
	        break;
	    case "long":
	        $html=$this->createInpHtmlNum($ent);
	        break;
	    case "decimal":
	        $html=$this->createInpHtmlNum($ent);
	        break;
	    case "comb":
	        $html=$this->createInpHtmlComb($ent);
	        break;
	    case "radio":
	    		$html=$this->createInpHtmlRadio($ent);
	        break;
	    case "chk":
	    		$html=$this->createInpHtmlChk($ent);
	        break;
	    case "bool":
	    		$html=$this->createInpHtmlBool($ent);
	        break;
	    case "date":
	        $html=$this->createInpHtmlDate($ent);
	        break;
	    case "time":
	        $html=$this->createInpHtmlTime($ent);
	        break;
	    case "datetime":
	        $html=$this->createInpHtmlDatatime($ent);
	        break;
	
			}
		return $html;
		
	}

	/**
	 * 日時入力テキストボックスＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return 日時入力テキストボックスＨＴＭＬ
	 */
	private function createInpHtmlDatetime($ent){
		$html=$this->createInpHtmlNum($ent);
		return $html;
	}
	/**
	 * 時間入力テキストボックスＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return 時間入力テキストボックスＨＴＭＬ
	 */
	private function createInpHtmlTime($ent){
		$html=$this->createInpHtmlNum($ent);
		return $html;
	}
	/**
	 * 日付入力テキストボックスＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return 日付入力テキストボックスＨＴＭＬ
	 */
	private function createInpHtmlDate($ent){
		$html=$this->createInpHtmlNum($ent);
		return $html;
	}
	

	/**
	 * bool用（チェックボックス）ＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return チェックボックスＨＴＭＬ
	 */
	private function createInpHtmlBool($ent){
		$html=$this->createInpHtmlChk($ent);
		return $html;
	}
	
	/**
	 * チェックボックスＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return チェックボックスＨＴＭＬ
	 */
	private function createInpHtmlChk($ent){
		
		//▽各種パラメータを取得
		$field=$ent['field'];
		$def_val=$ent['defVal'];
		if($def_val==null | $def_val==0 | $def_val==false){
			$checked='';
		}else{
			$checked='checked';
		}
		
		$html="<input type='checkbox' name='{$field}' value='1' {$$checked}>";
		
		
		return $html;

	}
	
	
	/**
	 * オプションボタンＨＴＭＬを生成する。
	 * @param  $ent	検索条件エンティティ
	 * @return オプションボタンＨＴＭＬ
	 */
	private function createInpHtmlRadio($ent){
		
		//▽各種パラメータを取得
		$field=$ent['field'];
		$def_val=$ent['defVal'];
		
		$selectData=$ent['selectData'];//コンボボックスデータを作成
		
		//コンボボックスＨＴＭＬ生成オブジェクトを取得
		if($m_radioHtmlCrt==null){
			$m_radioHtmlCrt=new RadioHtmlCreater();
		}
		
		//コンボボックスＨＴＭＬを作成する
		$html=$m_radioHtmlCrt->createHtml2($field,$defVal,$selectData);
		
	
		
		return $html;


		
	}
	
	/**
	 * コンボボックスＨＴＭＬを生成する。
	 * @param unknown_type $ent
	 * @return string
	 */
	private function createInpHtmlComb($ent){
		//▽各種パラメータを取得
		$field=$ent['field'];
		$def_val=$ent['defVal'];
		
		$selectData=$ent['selectData'];//コンボボックスデータを作成
		
		//コンボボックスＨＴＭＬ生成オブジェクトを取得
		if($m_cbHtmlCrt==null){
			$m_cbHtmlCrt=new CombboxHtmlCreater();
		}
		
		//コンボボックスＨＴＭＬを作成する
		$html=$m_cbHtmlCrt->createHtml2($field,$defVal,$selectData);
		
		return $html;


		
	}
	/**
	 * 数値入力用のテキストボックスＨＴＭＬを作成
	 * @param $ent
	 * @return unknown_type
	 */
	private function createInpHtmlNum($ent){
		//▽各種パラメータを取得
		$inpCnt=4;
		$field=$ent['field'];
		$text_type=$ent['txtFormType'];
		$def_val=$ent['defVal'];
		$cnd_ope=$ent['cnd_ope'];
		
		
		//▽入力フォーム表示フラグ配列の設定
		for($i=0;$i<$inpCnt;$i++){
			$showFlgs[$i]=false;
		}
		$showFlgs[$cnd_ope]=true;
		
		//完全一致、以上、以下,範囲のテキストボックスHTMLを作成　。
		$inp_kanzen=$this->createTextBoxHtmlUnit($field,0,$showFlgs[0],$text_type,$def_val);
		$inp_ijo=$this->createTextBoxHtmlUnit($field,1,$showFlgs[1],$text_type,$def_val);
		$inp_ika=$this->createTextBoxHtmlUnit($field,2,$showFlgs[2],$text_type,$def_val);
		$inp_rng=$this->createTextBoxHtmlRng($field,3,$showFlgs[3],$text_type,$def_val);
		
		$html=$inp_kanzen."\n".$inp_ijo."\n".$inp_ika."\n".$inp_rng."\n";
		
		return $html;

		
	}
	
	/**
	 * テキスト入力用のテキストボックスＨＴＭＬを作成
	 * @param $ent	検索条件円ｔｈ地非
	 * @return テキストボックスＨＴＭＬ
	 */
	private function createInpHtmlText($ent){
		//▽各種パラメータを取得
		$inpCnt=4;
		$field=$ent['field'];
		$text_type=$ent['txtFormType'];
		$def_val=$ent['defVal'];
		$cnd_ope=$ent['cnd_ope'];
		
		//▽入力フォーム表示フラグ配列の設定
		for($i=0;$i<$inpCnt;$i++){
			$showFlgs[$i]=false;
		}
		$showFlgs[$cnd_ope]=true;
		
		//▽以下のテキストボックスを作成
		//	完全一致		テキストボックス1
		//	部分一致		テキストボックス1
		//	前方部分一致		テキストボックス1
		//	後方部分一致		テキストボックス1
		$h1=$this->createTextBoxHtmlUnit($field,0,$showFlgs[0],$text_type,$def_val);
		$h2=$this->createTextBoxHtmlUnit($field,1,$showFlgs[1],$text_type,$def_val);
		$h3=$this->createTextBoxHtmlUnit($field,2,$showFlgs[2],$text_type,$def_val);
		$h4=$this->createTextBoxHtmlUnit($field,3,$showFlgs[3],$text_type,$def_val);
		
		$html=$h1."\n".$h2."\n".$h3."\n".$h4."\n";

		return $html;

		
	}
	
	/**
	 * 単体系のテキストボックスのＨＴＭＬを生成する。
	 * @param $field	フィールド名
	 * @param $index	インデックス
	 * @param $showFlg	表示フラグ
	 * @param $text_type	type名(text,numberなど）
	 * @param $def_val	デフォルト値
	 * @return テキストボックスＨＴＭＬ
	 */
	private function createTextBoxHtmlUnit($field,$index,$showFlg,$text_type,$def_val){
		
		if($showFlg==true){
			$display='block';
		}else{
			$display='none';
		}
		$html="<div id='jk_{$field}_a{$index}' cnd_ope='display:{$display}' >".
			"<input type='{$text_type}' id='jk_{$field}_{$index}' name='jk_{$field}_{$index}' value='{$def_val}' /></div>";
		return $html;
	}
	
/**
	 * 範囲系のテキストボックスのＨＴＭＬを生成する。
	 * @param $field	フィールド名
	 * @param $index	インデックス
	 * @param $showFlg	表示フラグ
	 * @param $text_type	type名(text,numberなど）
	 * @param $def_val	デフォルト値
	 * @return テキストボックスＨＴＭＬ
	 */
	private function createTextBoxHtmlRng($field,$index,$showFlg,$text_type,$def_val){
		
		if($showFlg==true){
			$display='block';
		}else{
			$display='none';
		}
		$html="<div id='jk_{$field}_a{$index}' cnd_ope='display:{$display}' >".
			"<input type='{$text_type}' id='jk_{$field}_{$index}_0' name='jk_{$field}_{$index}_0' value='{$def_val}' />　～　".
			"<input type='{$text_type}' id='jk_{$field}_{$index}_1' name='jk_{$field}_{$index}_1' value='{$def_val}' /></div>";
		return $html;
	}
			
	
//	/**
//	 * コンボボックスＨＴＭＬを作成する。
//	 * @param  $field　フィールド名
//	 * @param  $kind　	型
//	 * @param  $cnd_ope　	デフォルト検索方法値
//	 * @return コンボボックスＨＴＭＬ
//	 */
//	private function createCmbHtml(){
//		$subs[]
//		//$field,$kind,$cnd_ope
////		switch ($kind) {
////    case "text":
////        $data=$this->createCmbHtmlText();
////        break;
////    case "int":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "float":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "double":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "long":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "decimal":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "comb":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "radio":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "chk":
////        $data=$this->createCmbHtmlNum();
////        break;
////    case "bool":
////        $data=$this->createCmbHtmlBoolean();
////        break;
////    case "date":
////        $data=$this->createCmbHtmlDate();
////        break;
////    case "time":
////        $data=$this->createCmbHtmlDate();
////        break;
////    case "datetime":
////        $data=$this->createCmbHtmlDate();
////        break;
////
////		}
////		
////		if($data!=null){
////			if($m_cbHtmlCrt==null){
////				$m_cbHtmlCrt=new CombboxHtmlCreater();
////			}
////			$cnt=count($data);
////			$option="onchange=\"jkChgCmb('{$field}',$cnt)\"";
////			$id="kj_cnd_ope_cmb_{$field}";
////			$html=$m_cbHtmlCrt->createHtml2($id,$cnd_ope,$data,$option);
////		}
////		
////		return $html;
//	}
//	
	
	
	/**
	 * 数値系のコンボボックスデータを作成する。
	 * @return 数値系コンボボックスデータ
	 */
	private function createCmbHtmlNum(){

//		$data[0]['value']=KjCst::STL_KANZEN;;
//		$data[0]['text']='完全一致';
//		$data[1]['value']=KjCst::STL_IJO;;
//		$data[1]['text']='以上';
//		$data[2]['value']=KjCst::STL_IKA;;
//		$data[2]['text']='以下';
//		$data[3]['value']=KjCst::STL_RNG;;
//		$data[3]['text']='範囲';
		
		$data[0]['value']=0;
		$data[0]['text']='完全一致';
		$data[1]['value']=1;
		$data[1]['text']='以上';
		$data[2]['value']=2;
		$data[2]['text']='以下';
		$data[3]['value']=3;
		$data[3]['text']='範囲';

		return $data;
	}
	
	/**
	 * テキスト系のコンボボックスデータを作成する。
	 * @return テキスト系コンボボックスデータ
	 */
	private function createCmbHtmlText(){

		$data[0]['value']=KjCst::STL_KANZEN;;
		$data[0]['text']='完全一致';
		$data[1]['value']=KjCst::STL_BUBUN;;
		$data[1]['text']='部分一致';
		$data[2]['value']=KjCst::STL_ZEN;;
		$data[2]['text']='前方部分一致';
		$data[3]['value']=KjCst::STL_KOU;;
		$data[3]['text']='後方部分一致';

		return $data;
	}
	
	/**
	 * フラグ系のコンボボックスデータを作成する。
	 * @return フラグ系コンボボックスデータ
	 */
	private function createCmbHtmlBoolean(){

		$data[0]['value']=KjCst::STL_KANZEN;;
		$data[0]['text']='完全一致';
		
		return $data;
	}

	/**
	 * 日付系のコンボボックスデータを作成する。
	 * @return 日付系コンボボックスデータ
	 */
	private function createCmbHtmlDate(){

		$data[0]['value']=KjCst::STL_KANZEN;;
		$data[0]['text']='完全一致';
		$data[1]['value']=KjCst::STL_IJO;;
		$data[1]['text']='以上';
		$data[2]['value']=KjCst::STL_IKA;;
		$data[2]['text']='以下';
		$data[3]['value']=KjCst::STL_RNG;;
		$data[3]['text']='範囲';
		
		return $data;
	}
}
?>