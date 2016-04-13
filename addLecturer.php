<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
//Checks to see if the post array has the following variables in them and if they do,
//assigns them to an instance variable for use on the form
if(isset($_POST['LID'])){
$lid = $_POST['LID'];
}

if(isset($_POST['name'])){
$name = $_POST['name'];
}

if(isset($_POST['office'])){
$office = $_POST['office'];
}
//Establishes connection to the database
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
$sql = "INSERT INTO LECTURER (Lecturer_ID, Lecturer_NAME, Office) VALUES ('".$lid."','".$name."','".$office."')";

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
