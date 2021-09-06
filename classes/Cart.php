<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

?>


<?php

class Cart{
	
private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}
public function addToCart($quantity, $id){
	$quantity = $this->fm->validation($quantity);
	//used to escape all special characters for use in an SQL query. 
	//It is used before inserting a string in a database, as it removes any special characters that may interfere with 
	//the query operations
    $quantity = mysqli_real_escape_string($this->db->link, $quantity);
    $productId = mysqli_real_escape_string($this->db->link, $id);

    $sId  = session_id();

    $squery = "SELECT * FROM producttbl WHERE productId = '$productId'";
    $result = $this->db->select($squery)->fetch_assoc();

    $productName = $result['productName'];
    $price = $result['price'];
    $image = $result['image'];


    $chquery = "SELECT * FROM carttbl WHERE productId = '$productId' AND sId='$sId'";
    $getPro = $this->db->select($chquery);
    if ($getPro) {
    	$msg = "Product already added!";
    	return $msg;
    }else{



    $query = "INSERT INTO carttbl (sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image') ";
			$inserted_row = $this->db->insert($query);
			if ($inserted_row) {
				header("Location:cart.php");
			} else{
				header("Location:404.php");
			}
		}
}

public function getCartProduct(){

	$sId  = session_id();
	$query = "SELECT * FROM carttbl WHERE sId = '$sId'";
	$result = $this->db->select($query);
	return $result;
	

}

	public function updateCartQuantity($cartId,$quantity){

		$cartId = mysqli_real_escape_string($this->db->link, $cartId);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);

	$query = "UPDATE carttbl

	SET
	quantity = '$quantity' 
	WHERE cartId = '$cartId'";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		header("Location:cart.php");
	} else{
			$msg = "<span class='error'>Quantity Not Updated !</span>";
				return $msg;
	}
	}


	public function delProductByCart($delId){

	$delId = mysqli_real_escape_string($this->db->link, $delId);
	$query = "DELETE FROM carttbl WHERE cartId = '$delId'";
	$deldata = $this->db->delete($query);
	if ($deldata) {
		echo "<script>window.location = 'cart.php';</script>";
	}else{
$msg = "<span class='error'>Product Not Deleted !</span>";
				return $msg;

	}
	}

	public function checkCartTable(){
	$sId  = session_id();
	$query = "SELECT * FROM carttbl WHERE sId = '$sId'";
		$result = $this->db->select($query);
		return $result;
	}

	public function delCustomerCart(){
		$sId  = session_id();
		$query = "DELETE FROM carttbl WHERE sId = '$sId'";
		$this->db->delete($query);
	}

	public function orderProduct($cmrId){
		$sId  = session_id();
	    $query = "SELECT * FROM carttbl WHERE sId = '$sId'";
		$getPro = $this->db->select($query);
		if ($getPro) {
			while ($result = $getPro->fetch_assoc()) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];

				$query = "INSERT INTO ordertbl(cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image') ";
			$inserted_row = $this->db->insert($query);
			}
		}
	}
	public function payableAmount($cmrId){
	$query = "SELECT price FROM ordertbl WHERE cmrId = '$cmrId' AND date = now()";
	$result = $this->db->select($query);
	return $result;
	}

	public function getOrderedProduct($cmrId){
    $query = "SELECT * FROM ordertbl WHERE cmrId = '$cmrId' ORDER BY date DESC";
	$result = $this->db->select($query);
	return $result;

	}
	public function checkOrder($cmrId){
	    $query = "SELECT * FROM ordertbl WHERE cmrId = '$cmrId'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getAllOrderProduct(){
		$query = "SELECT * FROM ordertbl ORDER BY date DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function productShifted($id){
		$id = mysqli_real_escape_string($this->db->link, $id);

	$query = "UPDATE ordertbl
	SET status ='1'
	WHERE id = '$id' ";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		$msg = "<span class='success'>Updated Successfully.</span>";
				return $msg;
	} else{
			$msg = "<span class='error'>Not Updated !</span>";
				return $msg;
	}

	}

	public function delProductShifted($id){
		$id = mysqli_real_escape_string($this->db->link, $id);

		$query = "DELETE FROM ordertbl WHERE id = '$id' ";
	    $deldata = $this->db->delete($query);
	    if ($deldata) {
		$msg = "<span class='success'>Data Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Data Not Deleted !</span>";
				return $msg;

	}
	}

	public function productShiftConfirm($id){
	$id = mysqli_real_escape_string($this->db->link, $id);

	$query = "UPDATE ordertbl
	SET status ='2'
	WHERE id = '$id' ";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		$msg = "<span class='success'>Updated Successfully.</span>";
				return $msg;
	} else{
			$msg = "<span class='error'>Not Updated !</span>";
				return $msg;
	}
	}
}

?>