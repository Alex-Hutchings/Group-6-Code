<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

    <title>Module Feedback</title>

    <!--  -->

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
</script>
<!--creates the navbar and its relevant links -->
        <div class='container-fluid'>
        <nav class='navbar navbar-default'>
      	<div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <img src='logo.png'>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav intelekt-nav-left'>
                <li><a href='module.php'><img src='ModulesIcon.png' width='50%'></a></li>
            </ul>
              <div class='nav navbar-nav navbar-right'>
                <span class='glyphicon glyphicon-user'></span>
                <span>Username: </span>
                <span><?php echo $_SESSION['username']; ?></span>
                <a href='logout.php'><button>Log out</button></a>
              </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
<?php
include_once("config.php");
date_default_timezone_set('UTC');
$time = date('Y');
$moduleID = $_SESSION['moduleID'];

if(isset($_POST['question1'])){
$question1 = $_POST['question1'];
}

if(isset($_POST['question2'])){
$question2 = $_POST['question2'];
}

if(isset($_POST['question3'])){
$question3 = $_POST['question3'];
}

if(isset($_POST['question4'])){
$question4 = $_POST['question4'];
}

if(isset($_POST['question5'])){
$question5 = $_POST['question5'];
}

$additionalComments = $_POST['additionalComments'];

if($question1 !=null && $question2 !=null && $question3 !=null && $question4 !=null && $question5 !=null){
	echo "Thank you for your feedback.";}

	// sql command to update a record ModuleID
	$sql = "INSERT INTO MODULE_FEEDBACK(Module_ID, Q1, Q2, Q3, Q4, Q5, Additional_COMMENTS, Module_Year) 
	VALUES ('".$moduleID."', '".$question1."','".$question2."','".$question3."','".$question4."','".$question5."', '".$additionalComments."','".$time. "')";


	if ($db->query($sql) === TRUE) {
	$message = "Record added successfully"; echo $message;
	} else {
	echo "Error updating record: " . $db->error;
	} $db->close();
?>

