<!DOCTYPE html>
<?php
session_start();
include_once("config.php");
$comment = "test comment";

//$comment = $_POST['comment'];
$sql = "INSERT INTO MATERIAL_COMMENTS(Comment_ID, User_ID, Module_ID, Material_ID, Comment) 
	VALUES ('".$moduleID."', '".$_SESSION['username']."','".$_SESSION['moduleID']."','".$_SESSION['materialID']."','".$Comment. "')";


	if ($db->query($sql) === TRUE) {
	$message = "Record added successfully"; echo $message;
	} else {
	echo "Error updating record: " . $db->error;
	} $db->close();
// header("location:module-1.php");

?>

