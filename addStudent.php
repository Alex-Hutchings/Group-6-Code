<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
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

$server = "csmysql.cs.cf.ac.uk";
$user = "group6.2015"; 
$password = "bhF54FWzyq"; 
$database = "group6_2015";
$db = mysqli_connect($server,$user,$password,$database); 
if( $db === FALSE ){
header( "Location: error.html" ); die();
}
$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
$sql = "INSERT INTO STUDENT (Student_ID, Student_NAME, Address, Study_YEAR, Course_ID) VALUES ('".$sid."','".$name."','".$address."','".$year."','".$cid."')";


if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>