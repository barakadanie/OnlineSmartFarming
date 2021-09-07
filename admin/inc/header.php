<?php
include '../lib/Session.php';
Session::checkSession();
include '../lib/Database.php';
include '../helpers/Format.php';
spl_autoload_register(function($class)
{
include_once "classes/".$class.".php";
});
?>
<?php  
$db = new Database();
$fm = new Format();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            //compresses the sidebar menu to expanding when munu headers are clicked
            setupLeftMenu();
            //sets the height of the side menu bar
		    setSidebarHeight();
        });
    </script>
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/logo1.png" alt="Logo" />
				</div>
            <!-- tob header styling -->
			<div class="floatleft middle" style="width: 80%;">
				<h1><marquee behavior="1" direction="right">Online Smart Farm dashboard</marquee></h1>
				<p>Online Smart Farm url:<a href="../" target="_blank" style="color:aqua;text-decoration: underline;"><i>www.onlinesmartfarming.org</i></a></p>
			</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
<?php
//logs out f the admin panel and opens the log in page
if (isset($_GET['action']) && $_GET['action'] == "logout") 
{
   //closses the admin homepage and opens the login page
   Session::destroy();
}
?>
<div class="floatleft marginleft10">
     <ul class="inline-ul floatleft">
         <!-- fetches the admin name stored in the admin table and appends it to the text hello -->
         <li>Hello <?php echo Session::get('adminName'); ?></li>
             <li><a href="?action=logout">Logout</a></li>
    </ul>
</div>
</div>
    <div class="clear">
        </div>
     </div>
</div>
    <div class="clear"></div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="dashboard.php"><span>Dashboard</span></a> </li>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
                <li class="ic-grid-tables"><a href="message.php"><span>Message
                    <?php
                    //query all messages from the contact table from the database and display the in the tables 
                        $query = "select * from contacttbl where status='0' order by id desc";
                        $msg = $db->select($query);

                        if ($msg) 
                        {
                            //adds a message number notificatin i.e messages(1)
                            $count = mysqli_num_rows($msg);
                            echo "(".$count.")";
                        }   
                        else
                        {
                            //when no message is available within the database
                            echo "(0)";
                        }
                    ?></span></a></li>
                <!-- opens the main site(user interraction site) -->
                <li class="ic-charts"><a href="../" target="_blank"><span>Visit Website</span></a></li>
            </ul>
        </div>
    <div class="clear">
</div>
    