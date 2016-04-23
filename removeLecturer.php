<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
//establishing connection to the database
include_once("menu.php");
$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){ //if an id exists in the session array then the update variable is set to that value in the array.
$update = $_SESSION['id'];
}
// sql command to update a record
//deletes the required id field from the table lecturer where there is a match between the ID and the lecturer ID in the database
$id = $_GET['id'];
$sql = "DELETE FROM LECTURER WHERE Lecturer_ID = $id" ;

//if the sql query is successful then a message is displayed
//if the sql is unsuccessful then a message is displayed
if ($db->query($sql) === TRUE) {
$message = "Record deleted successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>
