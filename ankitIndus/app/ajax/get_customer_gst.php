<?php
require_once '../init.php';

if (isset($_POST['customer_id'])) {
    $id = $_POST['customer_id'];
    $customer = $obj->find('member', 'id', $id);
    $gst_type = $customer->gst_type ?? '';
    echo $gst_type;
}
