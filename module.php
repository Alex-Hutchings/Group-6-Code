<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

    <title>Modules</title>

    <!--  -->

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
    </script>
<?php
if(isset($_POST['username']))
{
	
	$user = $_POST['username'];

	if($user == $_POST['username'])
	{
		$_SESSION['username'] = $user;
        echo "
            <div class='container-fluid'>
        <nav class='navbar navbar-default'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <img src='logo.png'>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>

              <div class='nav navbar-nav navbar-right'>
                <span class='glyphicon glyphicon-user'></span>
                <span>Username: </span>
                <span>".$_SESSION['username']."</span>
                <a href='logout.php'><button class='btn-md'>Log out</button>
              </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>";

$DBserver = "csmysql.cs.cf.ac.uk"; //mysql server
$DBuser = "group6.2015"; //mysql username
$DBpass = "bhF54FWzyq"; //mysql password
$DBdatabase = "group6_2015"; //mysql database name
	$db = mysqli_connect($DBserver,$DBuser,$DBpass,$DBdatabase);
if( $db === FALSE ){
header( "Location: error.html" ); //redirects to an error page in case of an error.
die();
}

function setModule($Mod){
$query = 'SELECT * FROM MODULE WHERE Module_ID="'.$Mod.'"';
$result = mysqli_query($db, $query);
while ($row = mysqli_fetch_assoc($result)){
	$moduleID = $row['Module_ID'];
	$moduleTitle = $row['Module_TITLE'];
	$moduleDesc = $row['Module_DESCRIPTION'];
	$moduleYear = $row['Module_YEAR'];

	}
}
$query = 'SELECT Module_ID FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_POST["username"].'"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($row1 = mysqli_fetch_assoc($result)){
$moduleID = $row1['Module_ID'];

echo"<div class='row'>
<form action='module-1.php' method='POST'>

<div class='container'>
    <div class='well modules-buttons'>
        <input hidden type='text' id='username' name='username' value= ".$_SESSION['username']."><a href='module-1.html?moduleID=".$row1['Module_ID']."'><button class='btn-lg'>".$row1['Module_ID']."</button></a><br>
        <input hidden type='text' id='moduleID' name='moduleID' value= ".$moduleID.">
</form>
    </div>
</div>
</div>";
}
//$_SESSION['moduleID'] = $moduleID;
	}
}
else{
	//$user = $_SESSION['username'];
	echo "<p>no user found.</p>";
	header('location:login-2.php');
	}
?>
</body>
</div>
</html>
