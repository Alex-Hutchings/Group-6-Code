<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include_once("config.php");
if(isset($_POST['sid'])){
$sid = $_POST['sid'];
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

if(isset($_POST['cid'])){
$cid = $_POST['cid'];
}

$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
$sql = 'UPDATE STUDENT SET Student_ID="'.$sid.'", Student_NAME= "'.$name.'", Address= "'.$address.'", Study_YEAR= "'.$year.'", Course_ID= "'.$cid.'" WHERE Student_ID='. $update ;


if ($db->query($sql) === TRUE) {
$message = "Record updated successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
?>
</body>
</html>