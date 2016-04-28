<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php


if(isset($_POST['name'])){
$name = $_POST['name'];
}

if(isset($_POST['address'])){
$address = $_POST['address'];
}

if(isset($_POST['year'])){
$year = $_POST['year'];
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
$sql = 'UPDATE STUDENT SET Student_NAME= "'.$name.'", Address= "'.$address.'", Study_YEAR= "'.$year.'" WHERE Student_ID='. $update ;


if ($db->query($sql) === TRUE) {
$message = "Record updated successfully"; echo $message;
header("location:studentMenu.html");
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>