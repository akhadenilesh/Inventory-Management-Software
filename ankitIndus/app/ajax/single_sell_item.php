<?php
require_once '../init.php';

if (isset($_POST['getSellSingleInfo'])) {
	$id = $_POST['id'];
	$custid = $_POST['custid'];

	// Get latest invoice for this customer
	$sql = "SELECT * FROM invoice WHERE customer_id = ? ORDER BY last_update DESC LIMIT 1";
	$invoc = $obj->fetchOne($sql, [$custid]);

	$latestInvoiceNumber = $invoc['invoice_number'] ?? null;

	// Get product info
	$res = $obj->find('products', 'id', $id);

	if ($latestInvoiceNumber) {
		// Check invoice_details for price
		$checkSql = "SELECT price FROM invoice_details WHERE invoice_no = ? AND pid = ?";
		$invoiceDetail = $obj->fetchOne($checkSql, [$latestInvoiceNumber, $id]);

		$res->oldPrice = $invoiceDetail->price ?? 0;
	} else {
		$res->oldPrice = 0;
	}

	echo json_encode($res);
}
