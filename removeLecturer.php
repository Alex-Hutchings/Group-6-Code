<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include_once("config.php");
$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
$id = $_GET['id'];
$sql = "DELETE FROM USER WHERE User_ID = $id" ;


if ($db->query($sql) === TRUE) {
$message = "Record deleted successfully"; echo $message;
header("location:lecturerMenu.html");
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>
