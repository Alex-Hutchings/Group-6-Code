<!DOCTYPE html>
<?php
session_start();
include_once("config.php");
$comment = $_POST['comment'];
$id = $_SESSION['moduleID'];
// echo $comment;

$sql = "INSERT INTO MATERIAL_COMMENTS(User_ID, Module_ID, Material_ID, Comment) 
	VALUES ('".$_SESSION['username']."','".$_SESSION['moduleID']."','".$_SESSION['materialID']."','".$comment. "')";


	if ($db->query($sql) === TRUE) {
	$message = "Record added successfully"; echo $message;
	} else {
	echo "Error updating record: " . $db->error;
	} $db->close();
	header("location:module-1.php?id=".$_SESSION["moduleID"]);

?>

