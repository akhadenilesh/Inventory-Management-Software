<?php
require_once '../init.php';
if (isset($_POST['customer_name']) && isset($_POST['orderdate'])) {
	
	$invoice_number = "S" . time();
	$customer_id = $_POST['customer_name'];
	$find_customer_name = $obj->find('member', 'id', $customer_id);
	$customer_name = $find_customer_name->name;
	$orderdate = $obj->convertDateMysql($_POST['orderdate']);
	$po_no = $_POST['po-no']; //new
	$po_date = $obj->convertDateMysql($_POST['po-date']); //new
	$challan_no = $_POST['challan-no']; //new
	$challan_date = $obj->convertDateMysql($_POST['challan-date']); //new

	// now get the array value 
	$total_quantity = $_POST['total_quantity'];
	$orderQuantity = $_POST['orderQuantity'];
	$price = $_POST['price']; //before discount
	$totalPrice = $_POST['totalPrice']; //after discount
	$pro_name = $_POST['pro_name'];
	$pid = $_POST['pid'];
	$gstPrice = $_POST['gstPrice']; //new
	$gst = $_POST['gst']; //new
	$hnscode = $_POST['hnscode']; //new
	$subtotal = $_POST['subtotal'];
	$gsttotal = $_POST['totalgst']; //new
	$billamount = $_POST['billamount']; //new
	$payMethode = $_POST['payMethode'];
	$discount =$_POST['discount'];



	echo $result = $obj->storeCustomerOrderInvoice($invoice_number, $customer_id, $orderdate, $customer_name, $po_no, $po_date, $challan_no, $challan_date, $total_quantity, $orderQuantity, $price, $totalPrice, $pro_name, $pid, $gstPrice, $gst, $hnscode, $subtotal, $gsttotal, $billamount, $payMethode,$discount);
}
