<!DOCTYPE html>
<?php
//This script adds an FAQ to the system from the lecturer page
//Only lecturers are able to do this
//The question and answer are posted from the modulesLecturer.php page and submitted into the database
session_start();
include_once("config.php");
$question = $_POST['question'];
$answer =$_POST['answer'];
$FAQid = mt_rand(10000000, 99999999);

$sql = "INSERT INTO FAQ(FAQ_ID, Module_ID, Question, Answer) 
	VALUES ('".$FAQid."','".$_SESSION['moduleID']."','".$question."','".$answer. "')";


	if ($db->query($sql) === TRUE) {
	$message = "Record added successfully"; echo $message;
	} else {
	echo "Error updating record: " . $db->error;
	} $db->close();
	header("location:modulesLecturer.php?id=".$_SESSION['moduleID']);

?>