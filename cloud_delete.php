<html>
<body>

<?php
session_start();
include_once("config.php");
require_once __DIR__.'/vendor/autoload.php';

//session
$id = $_SESSION['moduleID'];
$back = "modulesLecturer.php?id=".$id;
$module = $id."/";
$uploader = $_SESSION["username"];
$title = $_POST["del"];
/**
 * Connect to Google Cloud Storage API
 */
$client = new Google_Client();
$client->setApplicationName("Intellekt");
$client->setAccessType("offline");

// $stored_access_token - your cached oauth access token 
$client->setAuthConfig('Intellekt-12aebbba5d44.json');
$client->addScope(Google_Service_Storage::DEVSTORAGE_FULL_CONTROL);

if($client->isAccessTokenExpired()){
	$client->setAuthConfig('Intellekt-12aebbba5d44.json');
	// Cache the access token however you choose, getting the access token with $client->getAccessToken()
}

/**
 * Upload a file to google cloud storage
 */
$storage = new Google_Service_Storage($client);
$file_name = $module.$title;
$storage->objects->delete("intellekt_file_storage", $file_name);

//database
if( $db === FALSE ){
	header( "Location: error.html" ); die();
}
$update = null;

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error); 
}

if(isset($_SESSION['id'])){
	$update = $_SESSION['id'];
}
// sql command to update a record

$link = "https://storage.googleapis.com/intellekt_file_storage/".$module.$title;
$sql = "DELETE FROM MATERIAL WHERE File = '".$link."'" ;

if ($db->query($sql) === TRUE) {
	echo "File deleted successfully!<br>";
	echo"<a href='".$back."'>Back to module</a> ";
}else{
	echo "Error while deleting a record: " . $db->error;
} 
$db->close();
?>
</body>
</html>

