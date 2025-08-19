<?php 
	require_once '../init.php';

	if (isset($_POST)) {
		$name = $_POST['name'];
		$gstno = $_POST['gstno'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$gst_type = $_POST['gst_type'];
		$reg_date = $obj->convertDateMysql($_POST['reg_date']);
	    $get_m_name = "C".time();

		if (!empty($name)) {
			$query = array(
				'member_id' => $get_m_name,
				'name' => $name,
				'gstno' => $gstno,
				'address' => $address,
				'con_num' => $contact,
				'email' => $email,
				'gst_type' => $gst_type,
				'reg_date' => $reg_date,
				'update_by' => 1
			);

			$res = $obj->create('member' , $query);
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