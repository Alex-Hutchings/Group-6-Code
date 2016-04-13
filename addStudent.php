<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
//Checks the post array for the following variables. If they have been set then 
//they are assigned to instance variables, for use on this form.
if(isset($_POST['SID'])){
$sid = $_POST['SID'];
}

if(isset($_POST['name'])){
$name = $_POST['name'];
}

if(isset($_POST['address'])){
$address = $_POST['address'];
}

if(isset($_POST['year'])){
$year = $_POST['year'];
}

if(isset($_POST['CID'])){
$cid = $_POST['CID'];
}
//establishes connection to the database
$server = "csmysql.cs.cf.ac.uk";
$user = "group6.2015"; 
$password = "bhF54FWzyq"; 
$database = "group6_2015";
$db = mysqli_connect($server,$user,$password,$database); 
if( $db === FALSE ){
header( "Location: error.html" ); die();
}
$update = null;
//if there was a problem with the connection to the database an error is displayed telling the user
if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
$sql = "INSERT INTO STUDENT (Student_ID, Student_NAME, Address, Study_YEAR, Course_ID) VALUES ('".$sid."','".$name."','".$address."','".$year."','".$cid."')";

//Section that checks whether the query was completed successfully, if it was then a message is displayed saying so,
//if it was unsuccessful then it displays that message
if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>
