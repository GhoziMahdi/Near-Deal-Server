<?php
require_once('db.php');

$lat = !empty($_REQUEST['lat'])?$_REQUEST['lat']:0;
$lng = !empty($_REQUEST['lng'])?$_REQUEST['lng']:0;

$sql = "SELECT id,name, lat, lng, address,discount,( 6371 * acos( cos( radians({$lat}) ) * cos( radians(lat)  ) ". 
    "* cos( radians( lng ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin(radians(lat)) ) ) AS distance ". 
    " FROM store ".
    " HAVING distance <= ? ".
    " ORDER BY distance ";

$stores = $db->rawQuery ($sql, Array(10));

echo json_encode(array('stores' => $stores));
