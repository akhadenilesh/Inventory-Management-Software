<?php
require_once '../init.php';

if (isset($_POST)) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$gstno = $_POST['gstno'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$gst_type = $_POST['gst_type'];
	$email = $_POST['email'];
	$update_at =  date('Y-m-d');

	$query = array(
		'name' => $name,
		'gstno' => $gstno,
		'address' => $address,
		'con_num' => $contact,
		'email' => $email,
		'gst_type' => $gst_type,
		'update_at' => $update_at,
	);

	$res = $obj->update('member', 'id', $id, $query);
	if ($res) {
		echo "Member update successfull";
	} else {
		echo "Failed to update member";
	}
}
