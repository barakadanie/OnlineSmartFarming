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
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/back.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <style>
      /* insert a background image behind the login interface */
      body{
         background-image: url(img/home.jpg);
      }
      /* styles up the login inter to the centre of the paage*/
      .inputs
      {
         padding-top: 90px;
         margin-left: 600px;
         width: 560px;
         height: 100px;

      }
      .me
      {
         padding-top: 10px;
         margin-left:-55%;
         align-items: center;
      }
        </style>
   <body class="bg-dark" background=src="/..img/27315.jpg" >
      <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="inputs">
      <div class="me">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form action="login.php" method="post" style ="background-image: url('/img/27315.jpg');">
                          <?php
                           if (isset($loginchk)) {
                              echo $loginchk;
                           }?>
                        <div class="form-group">
                          
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                     
					</form>
					</div>
            </div>
            </div>
         </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>