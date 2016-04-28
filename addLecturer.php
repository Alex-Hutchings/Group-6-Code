<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(isset($_POST['LID'])){
$lid = $_POST['LID'];
}

if(isset($_POST['name'])){
$name = $_POST['name'];
}
if(isset($_POST['lname'])){
$lname = $_POST['lname'];
}
if(isset($_POST['email'])){
$email = $_POST['email'];
}
if(isset($_POST['office'])){
$office = $_POST['office'];
}
if(isset($_POST['mod'])){
$mod = $_POST['mod'];
}
if(isset($_POST['title'])){
$title = $_POST['title'];
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

$sql = "INSERT INTO USER(USER_ID, USER_Type, Pass, Email, Forename, Surname) Values ('".$lid."','lec','".mt_rand(10000000, 99999999)."','".$email."','".$name."','".$lname."');";
if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} 
// sql command to update a record
$sql = "INSERT INTO LECTURER (Lecturer_ID, Lecturer_NAME, Office) VALUES ('".$lid."','".$name."','".$office."')";
if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} 

$sql = "INSERT INTO LECTURERS_IN_MODULE(Lecturer_ID, Module_ID, Module_TITLE) Values ('".$lid."','".$mod."','".$title."');";
if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
header("location:lecturerMenu.html");
} else {
echo "Error updating record: " . $db->error;
} 



$db->close();
?>

</body>
</html>