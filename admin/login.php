<?php include '../classes/Adminlogin.php';
$al = new Adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   /*checks username and password are entered or not*/
	$username = $_POST['username'];
	$password =($_POST['password']);
//checks admin login username and password 
	$loginchk = $al->adminlogin($username,$password);
}
//import bootstrap styling 
?>
<html>
<head>
 
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
 
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <link rel="stylesheet" href="css/">
 <link rel="stylesheet" href="assets/css/login_style.css">
</head>
 
<body style="background:url(../images/7.jpg)">
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- Login form creation starts-->
  <section class="container-fluid">
    <!-- row and justify-content-center class is used to place the form in center -->
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-4">
        <form class="form-container " action="login.php" method="post">
        <?php
           if (isset($loginchk)) {
            echo $loginchk;
        }?>
        <div class="form-group">
          <h4 class="text-center font-weight-bold">Admin Login </h4>
          <label for="InputEmail1">Username</label>
           <input type="text" name="username" class="form-control" id="InputEmail1" aria-describeby="emailHelp" placeholder="Enter Username..." required>
        </div>
        <div class="form-group">
          <label for="InputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Enter Password..." required>
        </div>
        <button type="submit" name="submit" class="glow" style="margin-left:15%;">Sign in</button>
        
        </form>
      </section>
    </section>
  </section>
<!-- Login form creation ends -->
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>