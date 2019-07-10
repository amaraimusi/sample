<h1>CakeMailのテスト</h1>
<br>


メールを送信せずに送信内容だけとりたかったが上手く行かず。<br>
やはり一度メール送信しないと送信内容はとれないのだろうか？<br>
<br><br>
テスト中のソースコード。
<pre>
    	App::uses('CakeEmail', 'Network/Email');

     	$email = new CakeEmail();
     	$email->from(array('xx_test_xx@example.com' => 'My Site'));
     	$email->to('you_test@example.com');
     	$email->subject('hello world! subject');
     	$email->message('hello world!');


     	$msg=$email->message();

     	Debugger::dump('$msg');//■■■□□□■■■□□□■■■□□□
     	Debugger::dump($msg);//■■■□□□■■■□□□■■■□□□
     	Debugger::dump('$email');//■■■□□□■■■□□□■■■□□□
     	Debugger::dump($email);//■■■□□□■■■□□□■■■□□□
</pre>



