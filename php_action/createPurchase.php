<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if( $_POST ) {	
	$purchase_date = $_POST["date"];
	$pclient_name = $_POST["name"];
	$pclient_contact = $_POST["contact"];
	$product_id = $_POST["product_id"];
	$pproduct_name =  $_POST["product_name"];
	$psub_total = $_POST["subTotal"];
	$pvat = $_POST["vat"];
	$pdiscount = $_POST["discounted"];
	$ptotal_amount = $_POST["total"];
	$ppaid = $_POST["paid"];
	$pdue = $_POST["due"];
	$ppayment_type = $_POST["paymentType"];
	$pnumberOfItems = $_POST["numberOfItems"];

	if ($due < 1) {
		$payment_status = "completed";
		$due = 0;
	} else{
		$payment_status = "partial";
	}

	$sql = "INSERT INTO purchases (
	 purchase_date,
	 client_name,
	 client_contact,
	 product_id,
	 product_name,
	 noOfProducts,
	 sub_total,
	 vat,
	 discount,
	 total_amount, 
	 paid, 
	 due, 
	 payment_type, 
	 payment_status)
	 VALUES (
	 '$purchase_date', 
	 '$pclient_name', 
	 '$pclient_contact', 
	 '$product_id', 
	 '$pproduct_name',
	 '$pnumberOfItems', 
	 '$psub_total', 
	 '$pvat', 
	 '$pdiscount', 
	 '$ptotal_amount', 
	 '$ppaid', 
	 '$pdue', 
	 '$ppayment_type',
	 '$ppayment_status')";

	if($connect->query($sql) === TRUE) {

                      $update = "UPDATE product SET quantity += '$numberOfItems' where product_id = '$product_id'";
                      $connect->query($update);

	header('location: http://localhost/inventory/purchaseManageOrders.php');	

	} else {
	 	echo "Failed!";
	}
	  
}