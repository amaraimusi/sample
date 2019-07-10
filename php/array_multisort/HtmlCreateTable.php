<?php

/**
 *
 * データからテーブルHTMLを作成する。
 * ★履歴
 * 2013/8/14	新規作成
 * 2014/4/15	ファイル名をハンガリ記法からキャメル記法に変更
 * 2014/10/14	createHtml3のバグを修正
 *
 * @author kenji uehara
 *
 */
class HtmlCreateTable{

	/**
	 * テーブルHTMLを作成
	 * @param $data		データ（二次元配列）
	 * @param $fields	フィールド（配列）
	 * @param $option	属性パラメータ文字列
	 * @return テーブルHTML
	 */
	function createHtml1($data,$fields,$option=''){


		$html="<table {$option}>\n<thead><tr>";

		//フィールド部分を作成
		foreach((array)$fields as $i => $field){
			$html.="<th>{$field}</th>";
		}
		$html.="</tr></thead>\n";

		$html.="<tbody>\n";

		//データ部分を作成
		foreach((array)$data as $i => $ent){
			$trd='';
			foreach($ent as $i => $val){
				$trd.="<td>{$val}</td>";
			}
			$html.="<tr>{$trd}</tr>\n";
		}

		$html.="<tbody>\n</table>";

		return $html;
	}

	/**
	 * テーブルHTMLを作成する。
	 * エンティティのキーがフィールド名となる。
	 * @param $data		データ
	 * @param $option	属性パラメータ文字列
	 * @return テーブルHTML
	 */
	function createHtml_entKey($data,$option=''){

		//nullチェック
		if(data==null){return null;}

		//▽フィールド配列を取得
		$ent=$data[0];
		foreach($ent as $key =>$v){
			//フィールド配列へフィールドを追加
			$fields[]=$key;
		}

		//テーブル生成メソッドを呼び出し。
		$html=$this->createHtml1($data,$fields,$option);

		return $html;
	}

	/**
	 * テーブルHTMLを作成する。
	 * 1行目がフィールド名となる。
	 * @param $data		データ
	 * @param $option	属性パラメータ文字列
	 * @return テーブルHTML
	 */
	function createHtml3($data,$option=''){

		//nullチェック
		if(empty($data)){
			return null;
		}


		//フィールド配列を取得
		$fields=$data[0];

		//データ部分の切り出し
		foreach($data as $i=>&$ent){
			if($i!=0){
				$data2[]=$ent;
			}
		}
		unset($ent);

		//テーブル生成メソッドを呼び出し。
		$html=$this->createHtml1($data2,$fields,$option);

		return $html;
	}
}
?>