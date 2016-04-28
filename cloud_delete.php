<html>
<body>
<?php

/**
 * Group 6
 * 2016 Intelekt.
 * Used Google libabries are licensed under the Apache License, Version 2.0
 * and are Copyright 2016 Google Inc.
 */
 
/** 
 * Required libraries/files on server:
 * 		- google/appengine-php-sdk v-1.9,
 * 		- google/apiclient v-2.0.0@RC
 *		- .json file containing authentication key
 *
 * Prefered installation tools:
 *      - Composer
 */

/**
 * The "cloud_delete" implements the file upload functionality:
 * 		- Deletes the file from Google Cloud Storage(GCS) bucket
 * 		- Deletes a link of the bucket from the database
 * 
 * Issues to be resolved in the future:
 *		- Authenticate the application on schools server to test it
 *		there
 *	
 * Future extentions:
 *      - Improve the consistency of the code
 *		- Function that removes records from the database if the
 *		 file is deleted from the GCS console
 */

session_start();

include_once("config.php");
require_once __DIR__.'/vendor/autoload.php';

$id = $_SESSION['moduleID'];
$back = "modulesLecturer.php?id=".$id;

$module = $id."/";
$uploader = $_SESSION["username"];

$error = False;

if(isset($_POST['del'])){
	$title = $_POST['del'];
}else{
	echo "Error: File title not retrieved.<br>";
	$error = True;
}

if($error == False){

	/**
	 * Connect to Google Cloud Storage API
	 */
	$client = new Google_Client();
	$client->setApplicationName("Intellekt");
	$client->setAccessType("offline");

	// Authenticates with the key inside .json file
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
	$storage->objects->delete("intellekt_file_storage", $file_name);
	
	/**
	 * Update the database
	 */
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

	/**
	 * Link of the file to be removed
	 */
	$link = "https://storage.googleapis.com/intellekt_file_storage/".$module.$title;
	$sql = "DELETE FROM MATERIAL WHERE File = '".$link."'";

	if ($db->query($sql) === TRUE) {
		echo "File deleted successfully!<br>";
		echo"<a href='".$back."'>Back to module</a> ";
	}else{
		echo "Error while deleting a record: " . $db->error;
		echo"<a href='".$back."'>Back to module</a> ";
	} 
$db->close();

}else{
	echo"<a href='".$back."'>Back to module</a> ";
}

?>
</body>
</html>

