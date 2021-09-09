<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

?>

<?php

class Product{
	
private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function productInsert($data,$file){

$productName = $this->fm->validation($data['productName']);
$catId = $this->fm->validation($data['catId']);
$brandId = $this->fm->validation($data['brandId']);
$body = $this->fm->validation($data['body']);
$price = $this->fm->validation($data['price']);
$type = $this->fm->validation($data['type']);
$name = $this->fm->validation($data['name']);
$contact = $this->fm->validation($data['contact']);
$location = $this->fm->validation($data['location']);
//used to escape all special characters for use in an SQL query. 
//It is used before inserting a string in a database, as it removes any special characters that may interfere with the query operations
$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
$body        = mysqli_real_escape_string($this->db->link, $data['body']);
$price       = mysqli_real_escape_string($this->db->link, $data['price']);
$type        = mysqli_real_escape_string($this->db->link, $data['type']);
$name        = mysqli_real_escape_string($this->db->link, $data['name']);
$contact     = mysqli_real_escape_string($this->db->link, $data['contact']);
$location    = mysqli_real_escape_string($this->db->link, $data['location']);



    $permited  = array('jpg', 'jpeg', 'png', 'gif','jfif','jpeg');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];
	// explode() function breaks a string into an array
    $div = explode('.', $file_name);
	//converts string to lowercase
    $file_ext = strtolower(end($div));
	//used to return a part of a string
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == ""|| $name == "" || $contact == ""|| $location == "" ) {
	
	$msg = "<span class='error'>Fields must not be empty !</span>";
	return $msg;
}elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
		//implode() function accept its parameters in either order
     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";


}else{

	 move_uploaded_file($file_temp, $uploaded_image);
	 $query = "INSERT INTO producttbl(productName,catId,brandId,body,price,image,type,name,contact,location) VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type','$name','$contact','$location') ";

	 $inserted_row = $this->db->insert($query);
			if ($inserted_row) {
				$msg = "<span class='success'>Product inserted Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product Not inserted.</span>";
				return $msg;
		}
		}

		}

public function getAllProduct(){

$query = "SELECT p.*,c.catName,b.brandName
FROM producttbl as p,categorytbl as c, brandtbl as b
WHERE p.catId = c.catId AND p.brandId = b.brandId
ORDER BY p.productId DESC";

$result = $this->db->select($query);
	return $result;
}

public function getProById($id){

	$query = "SELECT * FROM producttbl WHERE productId = '$id'";
	$result = $this->db->select($query);
	return $result;

}

public function productUpdate($data,$file,$id){

$productName = $this->fm->validation($data['productName']);
$catId = $this->fm->validation($data['catId']);
$brandId = $this->fm->validation($data['brandId']);
$body = $this->fm->validation($data['body']);
$price = $this->fm->validation($data['price']);
$type = $this->fm->validation($data['type']);
$name = $this->fm->validation($data['name']);
$contact = $this->fm->validation($data['contact']);
$location = $this->fm->validation($data['location']);

$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
$catId       = mysqli_real_escape_string($this->db->link, $data['catId']);
$brandId     = mysqli_real_escape_string($this->db->link, $data['brandId']);
$body        = mysqli_real_escape_string($this->db->link, $data['body']);
$price       = mysqli_real_escape_string($this->db->link, $data['price']);
$type        = mysqli_real_escape_string($this->db->link, $data['type']);
$name        = mysqli_real_escape_string($this->db->link, $data['name']);
$contact     = mysqli_real_escape_string($this->db->link, $data['contact']);
$location    = mysqli_real_escape_string($this->db->link, $data['location']);


    $permited  = array('jpg', 'jpeg', 'png', 'gif','jfif','jpeg');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" ||$type == ""|| $name == "" || $contact == ""|| $location == "") {
	
	$msg = "<span class='error'>Fields must not be empty !</span>";
	return $msg;


}else{
if (!empty($file_name)) {
	



if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";


}else{

	 move_uploaded_file($file_temp, $uploaded_image);


	 $query = "UPDATE producttbl 
	 SET
	 productName = '$productName',
	 catId       = '$catId',
	 brandId     = '$brandId',
	 body        = '$body',
	 price       = '$price',
	 image       = '$uploaded_image',
	 type        = '$type',
	 name		 ='$name',
	 contact	 ='$contact',
	 location	 ='$location',
	 WHERE productId = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>Product Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product Not Updated.</span>";
				return $msg;
		}
		}
}else{

	 $query = "UPDATE producttbl 
	 SET
	 productName = '$productName',
	 catId       = '$catId',
	 brandId     = '$brandId',
	 body        = '$body',
	 price       = '$price',
	 type        = '$type',
	 name		 ='$name',
	 contact	 ='$contact',
	 location	 ='$location',
	 WHERE productId = '$id'";

	 $updatedted_row = $this->db->update($query);
			if ($updatedted_row) {
				$msg = "<span class='success'>Product Updated Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Product Not Updated.</span>";
				return $msg;
		}
}

}
}

public function delProById($id){
$query = "SELECT * FROM producttbl WHERE productId = '$id'";
$getData = $this->db->select($query);
if ($getData) {
	//function fetches a result row as an associative array(an array with strings as an index)
while ($delImg = $getData->fetch_assoc()) {
$dellink = $delImg['image'];
//used to delete a file
unlink($dellink);

}

}

$delquery = "DELETE FROM producttbl where productId = '$id'";
$deldata = $this->db->delete($delquery);
	if ($deldata) {
		$msg = "<span class='success'>Product Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Product Not Deleted !</span>";
				return $msg;

	}

}

public function getFeaturedProduct(){

	$query = "SELECT * FROM producttbl WHERE type = '0' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}

public function getNewProduct(){
   $query = "SELECT * FROM producttbl ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;

}

public function getSingleProduct($id){

	$query = "SELECT p.*,c.catName,b.brandName
FROM producttbl as p,categorytbl as c, brandtbl as b
WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";
	$result = $this->db->select($query);
	return $result;
}


public function latestFromSpices(){
	$query = "SELECT * FROM producttbl WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromVegetables(){
	$query = "SELECT * FROM producttbl WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromFruits(){
	$query = "SELECT * FROM producttbl WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
	$result = $this->db->select($query);
	return $result;
}
public function latestFromCerials(){
	$query = "SELECT * FROM producttbl WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
	$result = $this->db->select($query);
	return $result;
}

public function productByCat($id){
$catId       = mysqli_real_escape_string($this->db->link,$id);
$query       = "SELECT * FROM producttbl WHERE catId = '$catId'";
$result      = $this->db->select($query);
return $result;	
}

public function insertCompareData($cmprid,$cmrId){
	$cmrId     = mysqli_real_escape_string($this->db->link,$cmrId);
	$productId = mysqli_real_escape_string($this->db->link,$cmprid);

	$cquery = "SELECT * FROM comparetbl WHERE cmrId = '$cmrId' AND productId = '$productId'";
	$check = $this->db->select($cquery);
	if ($check) {
		$msg = "<span class='error'>Already Added !</span>";
				return $msg;
	}
	$query = "SELECT * FROM producttbl WHERE productId = '$productId'";
	$result = $this->db->select($query)->fetch_assoc();
	if ($result) {
		$productId = $result['productId'];
		$productName = $result['productName'];
		$price = $result['price'];
		$image = $result['image'];
		$name=$result['name'];
		$contact=$result['contact'];
		$location=$result['location'];

		$query = "INSERT INTO comparetbl(cmrId,productId,productName,price,image)VALUES
			('$cmrId','$productId','$productName','$price','$image','$name','$contact','$location')";
			$inserted_row = $this->db->insert($query);

			if ($inserted_row) {
				
	$msg = "<span class='success'>Added ! Check Compare Page</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Not Added !</span>";
				return $msg;

	}
	}
}

public function getCompareData($cmrId){
	$query = "SELECT * FROM comparetbl WHERE cmrId = '$cmrId' ORDER BY id desc";
	$result = $this->db->select($query);
	return $result;
}

public function delCompareData($cmrId){
	$query = "DELETE FROM comparetbl WHERE cmrId = '$cmrId'";
	$deldata = $this->db->delete($query);
}

public function saveWishListData($id,$cmrId){


	$cquery = "SELECT * FROM wishlisttbl WHERE cmrId = '$cmrId' AND productId = '$id'";
	$check = $this->db->select($cquery);
	if ($check) {
		$msg = "<span class='error'>Already Added !</span>";
				return $msg;
	}
	$pquery = "SELECT * FROM producttbl WHERE productId = '$id'";
		$result = $this->db->select($pquery)->fetch_assoc();
		if ($result) {
				$productId = $result['productId'];
				$productName = $result['productName'];
				$price = $result['price'];
				$image = $result['image'];
				$name	=$result['name'];
				$contact=$result['contact'];
				$location=$result['location'];

				$query = "INSERT INTO wishlisttbl(cmrId,productId,productName,price,image,name,contact,location) VALUES('$cmrId','$productId','$productName','$price','$image','$name','$contact','$location') ";
			$inserted_row = $this->db->insert($query);

	if ($inserted_row) {
				
	$msg = "<span class='success'>Added ! Check wishlist Page</span>";
		return $msg;
	}else{
   $msg = "<span class='error'>Not Added !</span>";
		return $msg;
	}
 }
}

public function checkWlistData($cmrId){
	$query = "SELECT * FROM wishlisttbl WHERE cmrId = '$cmrId' ORDER BY id desc";
	$result = $this->db->select($query);
	return $result;	
}

public function delWlistData($cmrId, $productId){
	$query = "DELETE FROM wishlisttbl WHERE cmrId = '$cmrId' AND productId = '$productId'";
	$delete = $this->db->delete($query);
}


public function getTopbrandFruits(){

	$query = "SELECT * FROM producttbl WHERE brandId = '5' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
public function getTopbrandVegetables(){

	$query = "SELECT * FROM producttbl WHERE brandId = '2' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}

public function getTopbrandCerials(){

	$query = "SELECT * FROM producttbl WHERE brandId = '3' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}

public function getTopbrandSpices(){

	$query = "SELECT * FROM producttbl WHERE brandId = '4' ORDER BY productId DESC LIMIT 4";
	$result = $this->db->select($query);
	return $result;
}
}

?>