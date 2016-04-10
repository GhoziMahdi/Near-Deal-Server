<?php
require_once('db.php');

$imei = !empty($_REQUEST['imei'])?$_REQUEST['imei']:'';
$gcm_id = !empty($_REQUEST['gcm_id'])?$_REQUEST['gcm_id']:'';


if(!empty($imei) && !empty($gcm_id)) {
    $db->where('imei', $imei);
    $device = $db->getOne('device');

    if(empty($device)) {
        $data = array('imei'=>$imei, 'gcm_id'=>$gcm_id);
        $db->insert('device', $data);
    }
    else {
        $data = array('gcm_id'=> $gcm_id);
        $db->where('imei', $imei);
        $db->update('device', $data);
    }

    echo json_encode(array('success'=>true));
}
else {
    echo json_encode(array('success'=>false));
}
