<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>データからINSERTとUPDATEのSQL文を生成する | ワクガンス</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="/note_prg/css/bootstrap.min.css" rel="stylesheet">
	<link href="/note_prg/css/highlight/default.css" rel="stylesheet">
	<link href="/note_prg/css/common2.css" rel="stylesheet">

	<script src="/note_prg/js/jquery3.js"></script>	<!-- jquery-3.3.1.min.js -->
	<script src="/note_prg/js/bootstrap.min.js"></script>
	<script src="/note_prg/js/highlight.pack.js"></script>

	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<div id="header" ><h1>データからINSERTとUPDATEのSQL文を生成する | ワクガンス</h1></div>
<div class="container">


<h2>Demo</h2>
<pre><code>
	/**
	 * データからINSERTとUPDATEのSQL文を生成する
	 * @param string $tbl_name テーブル名
	 * @param array $data エンティティ配列型のデータ
	 * @return array|string[][]
	 */
	private function createInsertAndUpdate($tbl_name, $data){
		if(empty($data)) return array();
		
		// 列名群文字列を組み立て
		$ent0 = current($data);
		$keys = array_keys($ent0);
		$clms_str = implode(',', $keys); // 列名群文字列
		
		$inserts = array(); // INSERT SQLリスト
		$updates = array(); // UPDATE SQLリスト
		foreach($data as &amp;$ent){
			
			
			// IDが空ならINSERT文を組み立て
			if(empty($ent['id'])){
				$inserts[] = $this-&gt;makeInsertSql($tbl_name, $ent); // INSERT文を作成する
			}
			
			// IDが存在すればUPDATE文を組み立て
			else{
				$updates[] = $this-&gt;makeUpdateSql($tbl_name, $ent); // UPDATE文を作成する
			}
		}
		unset($ent);
		
		$res = [
				'inserts' =&gt; $inserts,
				'updates' =&gt; $updates,
		];
		return $res;
	}
	
	
	/**
	 * INSERT文を作成する
	 * @param string $tbl_name テーブル名
	 * @param array $ent 登録データのエンティティ
	 * @return string INSERT文
	 */
	private function makeInsertSql($tbl_name, &amp;$ent){
		
		$clms_str = '';
		$vals_str = '';
		foreach($ent as $field =&gt; $value){
			if($value === null) continue;
			$clms_str .= $field . ',';
			$vals_str .= "'{$value}',";
		}
		
		// 末尾の一文字であるコンマを削る
		$clms_str = mb_substr($clms_str,0,mb_strlen($clms_str)-1);
		$vals_str = mb_substr($vals_str,0,mb_strlen($vals_str)-1);
		
		$insert_sql = "INSERT INTO {$tbl_name} ({$clms_str}) VALUES ({$vals_str});";
		return $insert_sql;
	}
	
	
	/**
	 * UPDATE文を作成する
	 * @param string $tbl_name テーブル名
	 * @param array $ent 登録データのエンティティ
	 * @return string UPDATE文
	 */
	private function makeUpdateSql($tbl_name, &amp;$ent){
		if(empty($ent['id'])) throw new Exception('makeUpdateSql: idが空です。');
		
		$vals_str = '';
		foreach($ent as $field =&gt; $value){
			if($value === null) continue;
			$vals_str .= "{$field}='{$value}',";
		}
			
		$vals_str = mb_substr($vals_str,0,mb_strlen($vals_str)-1);// 末尾の一文字であるコンマを削る
		
		$update_sql = "UPDATE {$tbl_name} SET {$vals_str} WHERE id={$ent['id']}";
		
		return $update_sql;
	}
</code></pre>

<p>出力</p>
<?php 
$data = [
		['id'=>2, 'tanuki_name'=>'アオダヌキ','tanuki_date'=>'2019-4-8','kemono_id'=>100],
		['id'=>null, 'tanuki_name'=>'赤ダヌキ','tanuki_date'=>'2019-4-9','kemono_id'=>101],
		['id'=>3, 'tanuki_name'=>'黒ダヌキ','tanuki_date'=>'2019-4-10','kemono_id'=>102],
		['id'=>null, 'tanuki_name'=>'ビッグダヌキ','tanuki_date'=>'','kemono_id'=>103],
		['id'=>null, 'tanuki_name'=>'緑のタヌキ','tanuki_date'=>null,'kemono_id'=>0],
		['id'=>4, 'tanuki_name'=>'ニホンタヌキ','tanuki_date'=>null,'kemono_id'=>null],
];

$res = createInsertAndUpdate('tanukis', $data);
echo '<pre class="console">';
var_dump($res);
echo '</pre>';

	/**
	 * データからINSERTとUPDATEのSQL文を生成する
	 * @param string $tbl_name テーブル名
	 * @param array $data エンティティ配列型のデータ
	 * @return array|string[][]
	 */
	function createInsertAndUpdate($tbl_name, $data){
		if(empty($data)) return array();
		
		// 列名群文字列を組み立て
		$ent0 = current($data);
		$keys = array_keys($ent0);
		$clms_str = implode(',', $keys); // 列名群文字列
		
		$inserts = array(); // INSERT SQLリスト
		$updates = array(); // UPDATE SQLリスト
		foreach($data as &$ent){
			
			
			// IDが空ならINSERT文を組み立て
			if(empty($ent['id'])){
				$inserts[] = makeInsertSql($tbl_name, $ent); // INSERT文を作成する
			}
			
			// IDが存在すればUPDATE文を組み立て
			else{
				$updates[] = makeUpdateSql($tbl_name, $ent); // UPDATE文を作成する
			}
		}
		unset($ent);
		
		$res = [
				'inserts' => $inserts,
				'updates' => $updates,
		];
		return $res;
	}
	
	
	/**
	 * INSERT文を作成する
	 * @param string $tbl_name テーブル名
	 * @param array $ent 登録データのエンティティ
	 * @return string INSERT文
	 */
	function makeInsertSql($tbl_name, &$ent){
		
		$clms_str = '';
		$vals_str = '';
		foreach($ent as $field => $value){
			if($value === null) continue;
			$clms_str .= $field . ',';
			$vals_str .= "'{$value}',";
		}
		
		// 末尾の一文字であるコンマを削る
		$clms_str = mb_substr($clms_str,0,mb_strlen($clms_str)-1);
		$vals_str = mb_substr($vals_str,0,mb_strlen($vals_str)-1);
		
		$insert_sql = "INSERT INTO {$tbl_name} ({$clms_str}) VALUES ({$vals_str});";
		return $insert_sql;
	}
	
	
	/**
	 * UPDATE文を作成する
	 * @param string $tbl_name テーブル名
	 * @param array $ent 登録データのエンティティ
	 * @return string UPDATE文
	 */
	function makeUpdateSql($tbl_name, &$ent){
		if(empty($ent['id'])) throw new Exception('makeUpdateSql: idが空です。');
		
		$vals_str = '';
		foreach($ent as $field => $value){
			if($value === null) continue;
			$vals_str .= "{$field}='{$value}',";
		}
			
		$vals_str = mb_substr($vals_str,0,mb_strlen($vals_str)-1);// 末尾の一文字であるコンマを削る
		
		$update_sql = "UPDATE {$tbl_name} SET {$vals_str} WHERE id={$ent['id']}";
		
		return $update_sql;
	}
?>


<div class="yohaku"></div>
<ol class="breadcrumb">
	<li><a href="/">ホーム</a></li>
	<li><a href="/sample">サンプルソースコード</a></li>
	<li><a href="/sample/php">PHP ｜ サンプル</a></li>
	<li>データからINSERTとUPDATEのSQL文を生成する</li>
</ol>
</div><!-- content -->
<div id="footer">(C) kenji uehara 2019-4-8</div>
</body>
</html>