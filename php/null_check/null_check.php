<?php




	$wameis=array(
			'""',
			'null',
			'0',
			'0.0',
			'false',
	       "'0'",
			'array()',
			'未宣言'
	);

	$xs;
	$tests=array(
		"",
		null,
		0,
		0.0,
	    false,
	    "0",
		array(),
		@$xxx
	);




	$rets=null;

	//empty
	foreach($tests as $i=> $v){
		$rets[$i]['empty']=empty($v);

	}




	//iset
	foreach($tests as $i=> $v){
		$rets[$i]['isset']=isset($v);


	}


	//is_null
	foreach($tests as $i=> $v){

		$rets[$i]['is_null']=is_null($v);

	}


	//==""
	foreach($tests as $i=> $v){
		if($v==""){
			$rets[$i]['e_dd']=1;
		}else{
			$rets[$i]['e_dd']=0;
		}
	}

	//==null
	foreach($tests as $i=> $v){
		if($v==null){
			$rets[$i]['e_null']=1;
		}else{
			$rets[$i]['e_null']=0;
		}
	}

	//==false
	foreach($tests as $i=> $v){
		if($v==false){
			$rets[$i]['e_false']=1;
		}else{
			$rets[$i]['e_false']=0;
		}
	}

	//==0
	foreach($tests as $i=> $v){
		if($v==0){
			$rets[$i]['e_zero']=1;
		}else{
			$rets[$i]['e_zero']=0;
		}
	}


	////////////// ===
	//===""
	foreach($tests as $i=> $v){
		if($v===""){
			$rets[$i]['ee_dd']=1;
		}else{
			$rets[$i]['ee_dd']=0;
		}
	}

	//===null
	foreach($tests as $i=> $v){
		if($v===null){
			$rets[$i]['ee_null']=1;
		}else{
			$rets[$i]['ee_null']=0;
		}
	}

	//===false
	foreach($tests as $i=> $v){
		if($v===false){
			$rets[$i]['ee_false']=1;
		}else{
			$rets[$i]['ee_false']=0;
		}
	}

	//===0
	foreach($tests as $i=> $v){
		if($v===0){
			$rets[$i]['ee_zero']=1;
		}else{
			$rets[$i]['ee_zero']=0;
		}
	}
	
	// empty0
	foreach($tests as $i=> $v){
	    if(_empty0($v)){
	        $rets[$i]['_empty0']=1;
	    }else{
	        $rets[$i]['_empty0']=0;
	    }
	}
	
	
	
	
	/**
	 * 0以外の空判定
	 * 
	 * @note
	 * いくつかの空値のうち、0と'0'は空と判定しない。
	 * 
	 * @param $value
	 * @return int 判定結果 0:空でない , 1:空である
	 */
	function _empty0($value){
	    if(empty($value) && $value!==0 && $value!=='0'){
	        return 1;
	    }
	    return 0;
	}



?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="google" content="notranslate" />
		<title>空判定について</title>
		<link rel="stylesheet" type="text/css" href="common1.css"  />
		<script>



		</script>

		<style type="text/css">

		</style>

	</head>
	<body>
		<div id="page1">
		<h1 id="header">空判定について</h1>
		<div id="content" >

			<div class="sec1">

				<table border="1">
					<thead><tr>
						<th>空値の種類</th><th>empty</th><th>isset</th><th>is_null</th>
						<th>== ""</th><th>== null</th><th>== false</th><th>== 0</th>
						<th>=== ""</th><th>=== null</th><th>=== false</th><th>=== 0</th>
						<th>empty0【※1】</th>
						</tr></thead>
					<tbody>
						<?php
							foreach($wameis as  $i=>$wamei){
								$ent=$rets[$i];
								echo '<tr>';
								echo "<td>{$wamei}</td>";
								foreach($ent as $v){
									if($v==1){
										echo "<td style='color:#16458e'>1</td>";

									}else{
										echo "<td style='color:#ef6756'>0</td>";
									}

								}

								echo "</tr>\n";
							}
						?>
					</tbody>
				</table>
				※未宣言の変数はemptyとisset以外だと警告が表示される。
			</div><!-- sec1 -->


		<h2>※1 empty0</h2>
		<pre><code>
    	/**
    	 * 0以外の空判定
    	 * 
    	 * @note
    	 * いくつかの空値のうち、0と'0'は空と判定しない。
    	 * 
    	 * @param $value
    	 * @return int 判定結果 0:空でない , 1:空である
    	 */
    	function _empty0($value){
    	    if(empty($value) &amp;&amp; $value!==0 &amp;&amp; $value!=='0'){
    	        return 1;
    	    }
    	    return 0;
    	}
		</code></pre>
		



		</div><!-- content -->
		<div id="footer">(C) kenji uehara 2014/05/06</div>
		</div><!-- page1 -->
	</body>
</html>