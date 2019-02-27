<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();
$customerID = $_SESSION['customerSession'];
if($reg_user->is_logged_in()=="")
{
 $reg_user->redirect('index.php');
}


if(isset($_POST['submit']))
{

 $cpass = trim($_POST['cpass']);
 $npass = trim($_POST['npass']);
 $cpass = md5($cpass);
 $stmt = $reg_user->runQuery("SELECT * FROM customer WHERE customerID=:cid");
 $stmt->execute(array(":cid"=>$customerID));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($row['customerPass'] != $cpass)
 {
  $msg = "
        <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry !</strong>  You Entered Wrong password , Please Try again
     </div>
     ";
 }
 else
 {
  	$npass = md5($npass);
  	$stmt = $reg_user->runQuery("UPDATE customer SET customerPass = :npass WHERE customerID=:cid");
 $stmt->execute(array(":npass"=>$npass,":cid"=>$customerID));
   $msg = "
     <div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Success!</strong>  Your Password is Changed Successfully.
                   
       </div>
     ";
  }
  
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>The World Bank</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/button_style.css">
</head>
<body>
	<div class="container" id="wrapper">
		<div id="white"></div>
		<header>
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
					<a href="index.php"><img  id="logo" src="images/logo.png" alt="The World Bank Logo" class="img-responsive img-rounded"></a>
				</div>
			<!--<div class="col-sm-9 col-md-9 col-lg-9">
					<h1 style="float: right;color: lightblue">World Bank</h1>
				</div>-->
			</div>
		</header>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<nav class="navbar navbar-default">
					<div class="navbar-header hidden-sm hidden-md hidden-lg">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#my_navbar">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.html"></a><img id="logo" class="img-responsive img-rounded" src="images/logo.png" alt="The World Bank Logo">
					</div>
					<div class="collapse navbar-collapse" id="my_navbar" style="height: 0px">
						<ul class="nav navbar-nav" id="main_nav">
							<li><a href="customer.php" role="button">My Account</a></li>
							<li><a href="ministat.php" role="button">Mini Statement</a></li>
							<li><a href="moneytransfer.php" role="button">Money Transfer</a></li>
							<li><a href="loan.php" role="button">Loan</a></li>
							<li><a href="customize.php" role="button">Customize</a></li>
							<li><a href="logout.php" role="button">Logout</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
 		<div class="features_area row">	
			<div class="row_register">
				<?php if(isset($msg)) echo $msg;  ?>
				<h1><center>Change Password</center></h1>
				<form  name = "myForm" class="register_form" action="" method="post">
				<table> 
					<tr>
						<td><label><b>Current Password</b></label>
						</td><td>:-</td>
						<td><input class="register" type="text" placeholder="Enter Your Name Here" name="cpass" required> <br><br></td>
					</tr>
			
                    
					<tr> 
						<td><label><b>New Password</b></label></td>
						<td>:-</td>
						<td><input class="register" type="password" placeholder="Enter new password" name="npass" required></center><br><br></td>
					</tr>
    			   </table>
    			   <div class="button_register">
    			   		<button class="button1" id="register_button1" type="submit" name="submit"  ><span>Submit</span></button>
      					<button class="button1" id="register_button2" type="reset"><span>Reset</span></button>     
					</div>
				</form> 
			</div>	 
		</div>
			 

	</div>
	<script type="text/javascript" src=""></script>
</body>
</html>                                                       

