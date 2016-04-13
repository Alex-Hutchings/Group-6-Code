<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
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
//checks to see if the username has been set
//if username is set then the user variable is set to the be posted username variable from the login form
if(isset($_POST['username']))
{	$user = $_POST['username']; //sets the user variable to be the value stored in the post array

	if($user == $_POST['username'])
	{
		$_SESSION['username'] = $user;
	//prints out the entire navigation bar.
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
//establishes the connection to the database
$DBserver = "csmysql.cs.cf.ac.uk"; //mysql server
$DBuser = "group6.2015"; //mysql username
$DBpass = "bhF54FWzyq"; //mysql password
$DBdatabase = "group6_2015"; //mysql database name
	$db = mysqli_connect($DBserver,$DBuser,$DBpass,$DBdatabase);
if( $db === FALSE ){
header( "Location: error.html" ); //redirects to an error page in case of an error.
die();
}
//query retrieves the module id from student takes module where the student id is the same as the value stored for username in the post array.
//this checks if a student takes a certain module, and only retrieves the modules that the student is enrolled on.
$query = 'SELECT Module_ID FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_POST["username"].'"';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($row1 = mysqli_fetch_assoc($result)){
$moduleID = $row1['Module_ID'];
$moduleTitle = $row1['Module_TITLE'];

echo"<div class='row'>
<form action='module-1.php' method='POST'>

<div class='container'>
    <div class='well modules-buttons'>
        <input hidden type='text' id='username' name='username' value= ".$_SESSION['username']."><a href='module-1.html?moduleID=".$row1['Module_ID']."'><button class='btn-lg'>".$row1['Module_ID'], $row1['ModuleTitle']."</button></a><br>
        <input hidden type='text' id='moduleID' name='moduleID' value= ".$moduleID.">
</form>
    </div>
</div>
</div>";
}
//$_SESSION['moduleID'] = $moduleID;
	}
}
//checks to see if the username is not set then redirects users to the login page
if(!isset($_POST['username']))
{
	echo "<p>no user found.</p>";
	header('location:adminMenu.html');
	}
?>
</body>
</div>
</html>
