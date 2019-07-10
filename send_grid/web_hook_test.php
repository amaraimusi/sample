<?php
require_once 'ADebug.php';



//echo 'いろはにほへとちりぬるをわかよたれそつねならむ';
$data = file_get_contents("php://input");
a_debug($data);
// $events = json_decode($data, true);

// foreach ($events as $event) {
//   // Here, you now have each event and can process them how you like
//   //process_event($event);
//   a_debug($event);
// }