<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
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
$id = $_GET['id'];
$sql = "DELETE FROM LECTURER WHERE Lecturer_ID = $id" ;


if ($db->query($sql) === TRUE) {
$message = "Record deleted successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>
