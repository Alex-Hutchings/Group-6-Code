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
if(isset($_POST['lname'])){
$lname = $_POST['lname'];
}
if(isset($_POST['email'])){
$email = $_POST['email'];
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

include_once("config.php");
$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }
if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}
// sql command to update a record
$sql = "INSERT INTO USER(USER_ID, USER_Type, Pass, Email, Forename, Surname) Values ('".$sid."','stu','".mt_rand(10000000, 99999999)."','".$email."','".$name."','".$lname."');";
if (mysqli_query($db, $sql) === TRUE) {
$message = "Record added successfully"; echo $message;

} else {
echo "Error updating record: " . $db->error;
}

$sql = "INSERT INTO STUDENT (Student_ID, Student_NAME, Address, Study_YEAR, Course_ID) VALUES ('".$sid."','".$name."','".$address."','".$year."','".$cid."');";
if (mysqli_query($db, $sql) === TRUE) {
$message = "Record added successfully"; echo $message;

} else {
echo "Error updating record: " . $db->error;
} 

$sqli = "SELECT Module_ID, Module_TITLE FROM MODULES_IN_COURSE WHERE Course_ID = ".intval($cid)."";

$result = mysqli_query($db, $sqli);
while ($row = mysqli_fetch_assoc($result)){
	$moduleID = $row['Module_ID'];
	$module = $row['Module_TITLE'];
	$query = "INSERT INTO STUDENT_TAKES_MODULE (Student_ID, Module_ID, Module_TITLE) VALUES ('".$sid."','".$moduleID."','".$module."');";
	if ($db->query($query) === TRUE) {
		$message = "Record added successfully"; echo $message;
		header("location:studentMenu.html");
	} else {
	echo "Error updating record: " . $db->error;
	}
}
	
$db->close();
?>
</body>
</html>