<h1>パンくずリストのサンプル</h1>

<hr>
  <?php
  	//パンくずリスト
    $this->Html->addCrumb("ホーム", "/main");
    $this->Html->addCrumb("猫", "/neko");
    $this->Html->addCrumb("サンプルパンくず");
    echo $this->Html->getCrumbs(" > ");
   ?>