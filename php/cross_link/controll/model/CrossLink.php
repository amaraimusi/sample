<?php
require_once 'zss_lib/DaoForSqlite.php';
require_once 'zss_lib/common.php';

class CrossLink{

	public function saveEntity($ent){

		$dao=new DaoForSqlite();
		if(empty($ent['id'])){
			$sql="SELECT MAX(id) AS max_id FROM cross_links";

			$data=$dao->find($sql);

			if(empty($data)){
				$ent['id']=0;
			}else{
				$maxId=$data[0]['max_id'];
				$maxId++;
				$ent['id']=$maxId;
			}


		}


		$sql="INSERT INTO cross_links (id, title,url,note,omomi) VALUES ".
			"({$ent['id']}, '{$ent['title']}','{$ent['url']}','{$ent['note']}',{$ent['omomi']});";

		$dao->exec($sql);

	}


	public function getList(){
		$dao=new DaoForSqlite();

		$sql="SELECT * FROM cross_links";

		$data=$dao->find($sql);
		return $data;
	}

	public function del($id){
		$dao=new DaoForSqlite();

		$sql="DELETE  FROM cross_links WHERE id={$id}";

		$r=$dao->exec($sql);

		return $r;

	}
}
?>