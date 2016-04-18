<!DOCTYPE html>
<?php session_start();

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
    header("location:module-1.php?id=".$_SESSION["moduleID"]);
?>

