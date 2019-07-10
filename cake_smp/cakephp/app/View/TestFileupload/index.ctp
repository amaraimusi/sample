<h1>Cakephpでのファイルアップロード</h1>


<?php echo $this->Form->create('Neko', array('type'=>'file', 'enctype' => 'multipart/form-data'));?>

<?php  echo $this->Form->input('smp_img', array('label' => false, 'type' => 'file', 'multiple'));?>

<?php echo $this->Form->submit('UPLOAD');?>

<?php echo $this->Form->end()  ?>


<div>
<img src="<?php echo $img_fn?>" />
</div>