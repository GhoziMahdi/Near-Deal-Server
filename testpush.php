<?php
require_once('gcm.php');

$gcm = new GCM();

$result = $gcm->send_notification('dXx8G-umkLo:APA91bGFO2jLd_OpakMOSaTzB8sf1lgJtjfXgH1gGDllWRYm-gRUTb7jZLEC4ZM2yr-A4TO0-r8lxUHyc--C5694QlJXadFS_5Hg1PW9k7HK38wWtHyokeJ4NGalHa3inkak1ADgs4iw', array('name' => 'test'));
var_dump($result);
