<?php 
session_start(); 
if(isset($_SESSION["username"])){
header('location:module.php');}
 ?>
<?php
$user = 'x';
$pass = 'x';
include_once("config.php");
if( $db === FALSE ){
 header( "Location: error.html" ); //redirects to an error page in case of an error.
 die();
}


else{
$username = (isset($_POST["username"]) ? $_POST["username"] : null);
$password= (isset($_POST["password"]) ? $_POST["password"] : null);


$command = 'SELECT * FROM USER WHERE User_ID ="'.$username.'"';
$result = mysqli_query($db, $command);
    while($row1 = mysqli_fetch_assoc($result)) {
$user = $row1['User_ID'];
$pass = $row1['Pass'];
$type = $row1['User_Type'];
// $_SESSION["lecturer"] = $type;
 }

// $command = 'SELECT Pass FROM USER WHERE Pass ="'.$password.'"';
// $result = mysqli_query($db, $command);
//     while($row1 = mysqli_fetch_assoc($result)) {
//     $pass = $row1['Pass'];
//  }
if($user == $username && $pass == $password && $type == 'stu'){
$_SESSION["lecturer"] = false;
$_SESSION["username"] = $username;
header('location:module.php');
}
if($user == $username && $pass == $password && $type == 'lec'){
$_SESSION["lecturer"] = true;
$_SESSION["username"] = $username;
header('location:module.php');
}
else{
if(null != $username){
echo "<script> alert('Wrong username or password')</script>";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="icon.ico"/>
    <title>Welcome To Intellekt</title>

    <!-- Bootstrap -->
    <link href='masterStyle.css' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' media='screen' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js'></script>
  </head>



  <body style="background:#eee;">
    <div class="container">
    		<br/>
        <br/>
  		<div class="row">
  			<div class="col-md-4"></div>
  			<div class="col-md-4">
  				<div class="panel panel-default">
  					<div class="panel-body">
    						<div class="page-header">
                <center><img id="logo" src="logo.png" width="275" alt="logo"/></center>
						</div>

						 <form class="form-signin" style="font-family: verdana" method="POST" action="">
  							<div class="form-group">
    								<label for="enterusername">Username</label>
    								<div class="input-group">
  									<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
  									<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" autofocus required>
								</div>
  							</div>
  							<div class="form-group">
    								<label for="exampleInputPassword1">Password</label>
    								<div class="input-group">
  									<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
  									<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
								</div>
  							</div>
  							<hr/>
  							<center><button type="submit" value='Submit' name='submit' class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Log in</button></center>

  							<br/>
						</form>

  					</div>
				</div>
  			</div>
		</div>
    </div>




</div>
<br/>
<a href = 'adminLogin.php'><p style="text-align: right;">login as admin</p></a>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
