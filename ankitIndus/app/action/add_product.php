<?php
require_once '../init.php';


if (isset($_POST)) {
	$product_name = $_POST['product_name'];
	$product_code = "P" . time();
	$brand = $_POST['brand'];
	$p_catagory = $_POST['p_catagory'];
	// find catagory name 
	$p_catagory_name = $obj->find('catagory', 'id', $p_catagory);
	$p_catagory_name = $p_catagory_name->name;

	$product_gst = $_POST['product_gst'];
	$hnscode = $_POST['hnscode'];
	$alert_quantity = $_POST['alert_quantity'];
	$quantity = $_POST['quantity'];
	$user_id = $_SESSION['user_id'];
	$discount = $_POST['discount'];
	$selling_price = $_POST['selling_price'];


	if (
		isset($product_name, $brand, $p_catagory, $product_gst, $hnscode, $alert_quantity, $quantity, $discount, $selling_price) &&
		$product_name !== '' &&
		$brand !== '' &&
		$p_catagory !== '' &&
		$product_gst !== '' &&
		$hnscode !== '' &&
		is_numeric($alert_quantity) &&
		is_numeric($quantity) &&
		is_numeric($discount) &&
		is_numeric($selling_price)
	) {
		// Check that numeric fields are >= 0
		if ($alert_quantity >= 0 && $quantity >= 0 && $selling_price >= 0) {
			// Prepare insert query
			$query = [
				'product_name'     => $product_name,
				'product_id'       => $product_code,
				'brand_name'       => $brand,
				'catagory_id'      => $p_catagory,
				'catagory_name'    => $p_catagory_name,
				'product_gst'      => $product_gst,
				'hnscode'          => $hnscode,
				'alert_quanttity'  => $alert_quantity,
				'quantity'         => $quantity,
				'added_by'         => $user_id,
				'discount'         => $discount,
				'sell_price'       => $selling_price,
			];

			$res = $obj->create('products', $query);
			echo $res ? "yes" : "Failed to add product";
		} else {
			echo "Quantity, alert quantity, and selling price must be greater than or equal to 0.";
		}
	} else {
		echo "Please fill out all required fields correctly.";
	}
}
