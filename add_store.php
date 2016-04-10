<?php
require_once('db.php');
require_once('gcm.php');

$name = !empty($_REQUEST['name'])?$_REQUEST['name']:'';
$discount = !empty($_REQUEST['discount'])?$_REQUEST['discount']:0;
$lat = !empty($_REQUEST['lat'])?$_REQUEST['lat']:0;
$lng = !empty($_REQUEST['lng'])?$_REQUEST['lng']:0;
$open_hour= !empty($_REQUEST['open_hour'])?$_REQUEST['open_hour']:'';
$telp = !empty($_REQUEST['telp'])?$_REQUEST['telp']:'';
$promotion_end = !empty($_REQUEST['promotion_end'])?$_REQUEST['promotion_end']:'';
$description = !empty($_REQUEST['description'])?$_REQUEST['description']:'';
$address = !empty($_REQUEST['address'])?$_REQUEST['address']:'';


$data = array(
    'name' => $name,
    'discount' => $discount,
    'lat' => $lat,
    'lng' => $lng,
    'open_hour' => $open_hour,
    'telp' => $telp,
    'promotion_end' => $promotion_end,
    'description' => $description,
    'address' => $address,
);

$id = $db->insert('store', $data);

if($id) {
    $devices = $db->get('device');
    $gcm_ids = array();

    foreach($devices as $device) {
        $gcm_ids[] = $device['gcm_id'];
    }

    $push = array(
        'id' => intval($id),
        'name' => $name,
        'discount' => intval($discount)
    );

    $gcm = new GCM();
    $result = $gcm->send_notifications($gcm_ids, $push);

    echo json_encode(array('success' => true, 'gcm_result' => $result));
}
else {
    echo json_encode(array('success' => false));
}
