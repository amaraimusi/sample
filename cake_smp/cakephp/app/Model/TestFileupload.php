<?php
App::uses('Model', 'Model');
class TestFileupload extends Model {

	var $name='TestFileupload';
	public $useTable = false;//テーブルを使わない

	//バリデーション
	public $validate = array(
	   'smp_img'=>array(
	      'exten' => array(
	         //拡張子の指定
	         'rule' => array('extension',array('jpg','jpeg','png')),
	         'message' => 'jpg,jpeg,png以外のファイルはアップロードできません',
	         'allowEmpty' => true,
	      ),
	      'img_size' => array(
	         //画像サイズの制限
	         'rule' => array('fileSize', '<=', '1000000'),
	         'message' => '画像サイズは1MBまでです',
	      )
	   ),
	);








}