<html>
<body>

<?php

session_start();
include_once("config.php");

require_once __DIR__ . '/vendor/autoload.php';

//session
$module = $_SESSION['moduleID']."/";
$uploader = $_SESSION["username"];

//testing values. Delete when needed.
$module = "CM1000"."/";
$uploader = 1445555;

if(isset($_POST["pdf"])){
$file = $_POST["pdf"];
}else{
	$file = "png.png"; // Test value.

if(isset($_POST['title'])){
$title = $_POST['title'];
}else{
	$title = "Title"; // Test value. 
}

if(isset($_POST['type'])){
$type = $_POST['type'];
}else{
	$type = 'oth'; // Test value.
}


if ($type == 'pdf') {
	$mime = 'application/pdf';
}

if ($type == 'oth' &&(mime_content_type($file) == 'application/zip' || mime_content_type($file) == 'image/jpg'|| mime_content_type($file) == 'image/png') ) {
 	$mime = mime_content_type($file);
 } else{
	//display error "wrong filetype"
 }
	


if(isset($_POST['access'])){
$accessdate = $_POST['access'];
}else{
	$accessdate = date("Y/m/d");
}

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
}

/**
 * Upload a file to google cloud storage
 */
$storage = new Google_Service_Storage($client);
$file_name = $module.$title;
$obj = new Google_Service_Storage_StorageObject();
$postbody = array('name' => $file_name, 'data' => file_get_contents($file), 'uploadType' => 'media', 'predefinedAcl' => 'publicRead', 'mimeType' => $mime);
$storage->objects->insert("intellekt_file_storage",$obj, $postbody);




//database
if( $db === FALSE ){
header( "Location: error.html" ); die();
}

$update = null;

if ($db->connect_error) {
die("Connection failed: " . $db->connect_error); }

if(isset($_SESSION['id'])){
$update = $_SESSION['id'];
}

$link = "https://storage.googleapis.com/intellekt_file_storage/'".$module.$title."'";

// sql command to update a record

$sql = "INSERT INTO MATERIAL (Material_ID, User_ID, Module_ID, Material_TITLE, File, Upload_DATE, Access_DATE, Material_TYPE) VALUES (".$uploader."','".$module."','".$title."','".$link."','".date("Y/m/d")."','".$accessdate."', '"$type"')";


if ($db->query($sql) === TRUE) {
$message = "Record added successfully"; echo $message;
} else {
echo "Error updating record: " . $db->error;
} $db->close();
*/
?>

</body>
</html>