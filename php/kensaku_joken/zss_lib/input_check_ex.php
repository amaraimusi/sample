<?php
require_once 'input_check.php';
require_once 'i_entity_info.php';
require_once 'common.php';
/**
 * 拡張入力チェック
 * @author uehara
 * @date 2010/10/26
 * 2012/1/13	エラーフィールドリストメンバを追加
 * 2013/8/6		datetime関連の入力チェック
 * 2013/8/12		範囲チェックのバグを修正
 */
class InputCheckEx{
	///入力チェッククラス
	var $ic;
	
	///チェック対象文字を修正したときの文字
	var $m_newVal;
	
	///エラーメッセージ
	var $errMsg;
	
	///エラーメッセージリスト
	var $m_errMsgList;
	
	///値を修正したエンティティ
	var $m_newEnt;
	
	///エラーフィールド名リスト
	var $m_errFieldList;
	
	/**
	 *コンストラクタ。
	 *入力チェックの生成
	 */
	function __construct(){
		$this->ic=new InputCheck();
	}
	
	/**
	 * エンティティの入力チェックを行う。
	 * @param  $ent	エンティティ
	 * @param IEntityInfo $entityObj		エンティティ情報オブジェクト
	 * @return 入力エラーがない場合、TRUEを返す。
	 * ※結果はメンバにセットされる。
	 */
	public function checkEntity(&$ent,IEntityInfo &$entityObj){
		
		$this->m_newEnt=$ent;
		
		//▼エンティディ詳細情報を取得する。
		$entInfo=$entityObj->getEntityInfo();
	
		$flgA=true;
		
		//▼エンティティのすべてのフィールド分、入力チェックを行う。
		foreach ((array)$entInfo as $key => $rec){
			
			
			
			//▼入力チェック対象となっているデータのみ入力チェック。
			if($rec['ic']){
				if($this->check($ent[$key], $rec['size'], $rec['type'], $rec['jname'],$rec['req'], null,$rec['inptype'],$rec['def'],$rec['minvalue'],$rec['maxvalue'])==false){
					//入力チェックエラーがある場合。
					$em=$this->errMsg;		//エラーメッセージを取得する。

					//▼入力タイプがselect,radio,checkboxの場合、デフォルト値を修正後エンティティにセット
					$this->m_newEnt[$key]=$this->getSyusei($ent[$key],$rec['inptype'],$rec['def']);
			
					
					$flgA=null;//
				}else{
					//入力チェックでエラーがなかった場合
				}
				
			}
			if($em!=null){
				$errMsgs[$key]=$em;//エラーメッセージを追加します。入力エラーがないときはnullが張ります。
				$errFieldList[]=$key;//エラーフィールドリストをセット
			}
			$em=null;
		}
		$this->m_errMsgList=$errMsgs;
		$this->m_errFieldList=$errFieldList;

		return $flgA;
	}
	
	/**
	 * 入力チェックを行う。OKであればtrueを返し、エラーであればfalseを返す。
	 * エラーメッセージや修正値はメンバにセットされる。
	 * @param  $val　チェック対象文字列
	 * @param  $limitLen	制限文字数
	 * @param  $type	入力チェックの種類。現在はint,double,string,dateに対応。
	 * @param  $jname　項目の日本語名称
	 * @param  $req		必須入力フラグ。必須入力にする場合はtrue。省略可能。
	 * @param  $errMsg	任意のエラーメッセージにする。省略時には規定エラーメッセージを返す。
	 * @param  $inptype 入力ボックスタイプ。省略時はtextになる。text,radio,select,checkbox,hiddenのいずれかを指定。
	 * @param  $def 	初期値。select,radio,checkbox系の場合、エラーだった場合この値をセット
	 * @return string OKであればtrue,エラーであればfalse
	 */
	private function check($val ,$limitLen,$type,$jname,$req=false,$prm_errMsg=null,$inptype='text',$def=null,$minvalue=null,$maxvalue=null){
		
		$ic=&$this->ic;
		
		$flg=true;
		switch($type){
			case 'int';
				//▼整数チェック
				if($ic->isIntEx($val, $limitLen, $req)==false){
					if(!$prm_errMsg){
						$errMsg=sprintf("%sは%s文字以内の整数で入力してください。",$jname,$limitLen);
						$flg=false;
					}
				}else{			
					//▼範囲値チェック
					if($ic->is_range($val, $minvalue, $maxvalue)==false){
						$errMsg=sprintf("%sは%sから%sまでの範囲内で数値を入力してください。",$jname, $minvalue, $maxvalue);
						$flg=false;
					}
					
				}
				
	
				break;
			case 'string';
				//▼文字列チェック
		
				if($ic->isTextEx1($val, $limitLen, $req)==false){
				
					if(!$prm_errMsg){
						if($req){
							$errMsg=sprintf("%sを%s文字以内で入力してください。【必須入力】",$jname,$limitLen);
							
						}else{
							$errMsg=sprintf("%sは%s文字以内で入力してください。",$jname,$limitLen);
						}
						$flg=false;
					}
				}
				break;
			case 'double';
				//▼数値チェック
				if($ic->isNumEx($val, $limitLen, $req)==false){
					if(!$prm_errMsg){
						$errMsg=sprintf("%sは%s文字以内の数値で入力してください。",$jname,$limitLen);
						$flg=false;
					}
				}else{			
					//▼範囲値チェック
					if($ic->is_range($val, $minvalue, $maxvalue)==false){
						$errMsg=sprintf("%sは%sから%sまでの範囲内で数値を入力してください。",$jname, $minvalue, $maxvalue);
						$flg=false;
					}
					
				}
				break;
			case 'date';
				//▼日付チェック 。時刻までの表記はエラー
		        if($ic->isDateEx($val, $limitLen, $req)==false){
		        	if(!$prm_errMsg){
		        		$errMsg=sprintf("%sは「yyyy/mm/dd」形式の存在する日付を入力してください。【半角で入力】",$jname);
						$flg=false;
		        	}

		        }
				break;
			case 'time';
				//▼時刻チェック 。
		        if($ic->isTimeEx($val, $limitLen, $req)==false){
		        	if(!$prm_errMsg){
		        		$errMsg=sprintf("%sは「h:i:s」形式の時刻を入力してください。【半角で入力】",$jname);
								$flg=false;
		        	}

		        }
				break;
			case 'datetime';
				//▼日時チェック 。
		        if($ic->isDatetimeEx($val,$req)==false){
		        	if(!$prm_errMsg){
		        		$errMsg=sprintf("%sは「y/m/d h:i:s」形式の日時を入力してください。【半角で入力】",$jname);
								$flg=false;
		        	}

		        }
				break;
				
			default;
				echo 'InputCheckExにて致命的エラー $type='.$type;
		}
		
		
		//▼入力エラーがあった場合の処理。
		if ($flg==false){
			if(!$prm_errMsg){
				//特定の入力タイプである場合、エラメッセージを変更します。
				$errMsg=$this->inputboxEachErrMsg($errMsg,$inptype,$jname);
			}else{
				//引数でエラーメッセージが指定されている場合は、これをエラーメッセージとします。
				$errMsg=$prm_errMsg;
			}
			
			
			//特定の入力タイプである場合、初期値をメンバの修正値にセットする。
			$this->setDefalut($inptype,$def);
		}
		//メンバへエラーメッセージをセット
		$this->errMsg=$errMsg;
		
		return $flg;

	}
	
	
	/**
	 * 入力タイプがselect,radio,checkboxの場合、それぞれ専用のエラーメッセージを作成する。
	 * @param  $inptype　入力タイプ
	 * @param  $jname	デフォルト文字
	 * @return string
	 */
	private function inputboxEachErrMsg($errMsg,$inptype,$jname){
		switch ($inptype){
			case 'select';
				$errMsg=sprintf("%sは想定外の値でしたのでデフォルトを選択しました。確認のためもう一度選択しなおしてください。",$jname);
				break;
			case 'checkbox';
				$errMsg=sprintf("%sのチェックボックスは想定外の値でしたのでデフォルトを設定しました。確認のためもう一度設定しなおしてください。",$jname);
				break;
			case 'radio';
				$errMsg=sprintf("%sのラジオボタンは未選択でしたのでデフォルトを選択しました。確認のためもう一度選択しなおしてください。",$jname);
				break;
			
		}
		return $errMsg;
	}
	

	/**
	 * 入力タイプがselect,radio,checkboxの場合、デフォルト値をメンバの修正値にセットする。
	 * @param  $inptype　入力タイプ
	 * @param  $def		デフォルト文字
	 */
	private function setDefalut($inptype,$def){
		if('select' == $inptype || 'checkbox' == $inptype || 'radio' == $inptype ){
			$this->m_newVal=$def;
		}
	}
	
	/**
	 * 入力タイプがselect,radio,checkboxの場合、デフォルト値をメンバの修正値にセットする。
	 * @param  $val　値
	 * @param  $inptype 入力タイプ
	 * @param  $def	デフォルト文字
	 * @return 修正値
	 */
	private function getSyusei($val,$inptype,$def){
		if('select' == $inptype || 'checkbox' == $inptype || 'radio' == $inptype ){
			$rtn=$def;
		}else{
			$rtn=$val;
		}
		return $rtn;
	}
	
}