
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
Session::checkLogin();

include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Formate.php');

?>



<?php


class Adminlogin
{
	
private $db;
private $fm;

	public function __construct()
	{
		
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function adminlogin($adminUser,$adminPassword){

$adminUser = $this->fm->validation($adminUser);
$adminPassword = $this->fm->validation($adminPassword);
//used to escape all special characters for use in an SQL query. 
//It is used before inserting a string in a database, as it removes any special characters that may interfere with 
//the query operations
$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
$adminPassword = mysqli_real_escape_string($this->db->link, $adminPassword);

if (empty($adminUser) ||empty($adminPassword) ) {
	
	$loginmsg = "Username or Password must not be empty !";
	return $loginmsg;
		} else{


			$query = "SELECT * FROM admintbl WHERE adminUser = 'admin'
			AND adminPassword = 'admin001'";

			$result = $this->db->select($query);

			if ($result != false) {
				$value = $result->fetch_assoc();

				Session::set("adminlogin",true);
				Session::set("adminId",$value['adminId']);
				Session::set("adminUser",$value['adminUser']);
				Session::set("adminName",$value['adminName']);

				header("Location:dashboard.php");
			} else{
				$loginmsg = "Username or Password not match !";
				return $loginmsg;
			}


		}

	}
}


?>