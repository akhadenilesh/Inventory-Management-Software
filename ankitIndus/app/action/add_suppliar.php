<?php 
	require_once '../init.php';

	if (isset($_POST)) {
		$sup_name = $_POST['sup_name'];
		$sup_gstno = $_POST['sup_gstno'];
		$sup_contact = $_POST['sup_contact'];
		$sup_email = $_POST['sup_email'];
		$sup_gst_type = $_POST['sup_gst_type'];
		$sup_reg_date = $obj->convertDateMysql($_POST['sup_reg_date']);
		$supaddress = $_POST['supaddress'];
	    $suppliar_id = "S".time();
	    $user = $_SESSION['user_id'];

		if (!empty($sup_name)) {
			$query = array(
				'suppliar_id' => $suppliar_id,
				'name' => $sup_name,
				'sup_gstno' => $sup_gstno,
				'address' => $supaddress,
				'con_num' => $sup_contact,
				'email' => $sup_email,
				'sup_gst_type' => $sup_gst_type,
				'reg_date' => $sup_reg_date,
				'update_by' => $user
			);

			$res = $obj->create('suppliar' , $query);
			
			if ($res) {
				echo "yes";
			}else{
				echo "Failed to add member. please try again";
			}
		}else{
			echo "Name field required";
		}
	}

	
 ?> 