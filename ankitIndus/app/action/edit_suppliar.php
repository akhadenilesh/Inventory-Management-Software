<?php 
	require_once '../init.php';
	
	if (isset($_POST)) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$sup_gstno = $_POST['sup_gstno'];
		$sup_gst_type = $_POST['sup_gst_type'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$update_at =  date('Y-m-d');

			$query = array(
				'name' => $name,
				'sup_gstno' => $sup_gstno,
				'sup_gst_type' => $sup_gst_type,
				'address' => $address,
				'con_num' => $contact,
				'email' => $email,
				'update_at' => $update_at,
			);

			$res = $obj->update('suppliar' ,'id',$id, $query);
			if ($res) {
				echo "Member update successfull";
			}else{
				echo "Failed to update member";
			}
		
	}
 ?>