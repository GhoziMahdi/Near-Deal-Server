<?php
require_once('db.php');

$id = !empty($_REQUEST['id'])?$_REQUEST['id']:0;

$db->where("id", $id);
$store = $db->getOne("store");

echo json_encode(array('store'=>$store));
