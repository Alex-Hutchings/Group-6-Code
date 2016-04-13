<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
//this file is used to delete a student from the database. This may be used if a student wishes to drop out of university
//change degree programme or has breached some regulation that requires expulsion.
//establishes a connection to the database
$server = "csmysql.cs.cf.ac.uk"; //server variable
$user = "group6.2015";  //username needed to access the database site
$password = "bhF54FWzyq"; //password needed to grant access to the database
$database = "group6_2015"; //the database itself 
$db = mysqli_connect($server,$user,$password,$database); //puts all the above variables together to use as a connection
if( $db === FALSE ){
header( "Location: error.html" ); die();
}
$update = null;
//if an ID for the session is set then update is set to be the value in the session array.
if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
//sets a id variable to the ID posted from the admin form.
//uses that ID to delete the student from the database if they match with the student id in the database
$id = $_GET['id'];
$sql = "DELETE FROM STUDENT WHERE Student_ID = $id" ;

//successful or unsuccessful database query message
if ($db->query($sql) === TRUE) {
$message = "Record updated successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>
