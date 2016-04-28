<!DOCTYPE html>
<?php
/*
 * Group 6
 * 2016 Intelekt. 

 * The "FAQ add" implements the addition of the frequently asked questions functioanlity:
 *    -add a question
 *    -add an answer
 * 
 * Issues to be resolved in the future:
 *    -Change the position of the container
 *
 * Future extentions:
 *    -Add an edit feature for the FAQs
 *    -Delete FAQ feature
 */
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