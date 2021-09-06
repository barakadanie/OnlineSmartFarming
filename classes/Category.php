<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

?>

<?php

class Category
{
	
private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
//used to escape all special characters for use in an SQL query. 
//It is used before inserting a string in a database, as it removes any special characters that may interfere with 
//the query operations
        $catName = mysqli_real_escape_string($this->db->link, $catName);


if (empty($catName) ) {
	
	$msg = "<span class='error'>Category field must not be empty !</span>";
	return $msg;
		} else{
			$query = "INSERT INTO categorytbl(catName) VALUES('$catName') ";
			$catinsert = $this->db->insert($query);
			if ($catinsert) {
				$msg = "<span class='success'>Category inserted Successfully.</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Category Not inserted.</span>";
				return $msg;
			}

		}
	}
public function getAllCat(){

	$query = "SELECT * FROM categorytbl ORDER BY catId DESC";
	$result = $this->db->select($query);
	return $result;

}

public function getCatById($id){
$query = "SELECT * FROM categorytbl WHERE catId = '$id'";
	$result = $this->db->select($query);
	return $result;

}

public function catUpdate($catName,$id){

	$catName = $this->fm->validation($catName);
//used to escape all special characters for use in an SQL query. 
//It is used before inserting a string in a database, as it removes any special characters that may interfere with 
//the query operations
    $catName = mysqli_real_escape_string($this->db->link, $catName);
    $id = mysqli_real_escape_string($this->db->link, $id);


if (empty($catName) ) {
	
	$msg = "<span class='error'>Category field must not be empty !</span>";
	return $msg;
} else{

	$query = "UPDATE categorytbl

	SET
	catName = '$catName' 
	WHERE catId = '$id'";

	$updated_row = $this->db->update($query);
	if ($updated_row) {
		$msg = "<span class='success'>Category Updated Successfully.</span>";
				return $msg;
	} else{
			$msg = "<span class='error'>Category Not Updated !</span>";
				return $msg;
	}
}

}
public function delcatById($id){

	$query = "DELETE FROM categorytbl WHERE catId = '$id'";
	$deldata = $this->db->delete($query);
	if ($deldata) {
		$msg = "<span class='success'>Category Deleted Successfully.</span>";
				return $msg;
	}else{
$msg = "<span class='error'>Category Not Deleted !</span>";
				return $msg;

	}
}

}

?>