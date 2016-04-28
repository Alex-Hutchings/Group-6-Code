<html>
<body>

<?php

/**
 * Group 6
 * 2016 Intelekt.
 *
 */

/**
 * The "cloud_upload" implements the file upload functionality:
 * 		-Adds the file to Google Cloud Storage(GCS) bucket
 * 		-Inserts a link to the bucket into the database
 * 
 * Issues to be resolved in the future:
 *		-Authenticate the application on schools server
 *	
 * Future extentions:
 *      -Improve the consistency of the code
 * 		-Change the implementation to update the existing file with the same name
 *  	-Improved error checking
 */


session_start();

include_once("config.php");
require_once __DIR__ . '/vendor/autoload.php';

$module = $_SESSION['moduleID'];
$uploader = $_SESSION["username"];

$id = $module;
$back = "modulesLecturer.php?id=".$id;

$module = $module."/";
$error = FALSE;

if(isset($_POST['upload'])){
	$file = $_POST['upload'];
}else{
	echo "Error: Empty request. File not set.<br>";
	$error = True;
}

if(isset($_POST['title'])){
	$title = $_POST['title'];
}else{
	echo "Error: Title not valid or not set.<br>";
	$error = True;
}

if(isset($_POST['type'])){
	$type = $_POST['type'];
}else{
	echo "Error: File type not set<br>";
	$error = True;
}

if ($type == 'pdf') {
	$mime = 'application/pdf';
}

if ($type == 'oth') {
	$mime = mime_content_type($file);
}

if(isset($_POST['access'])){
	$accessdate = $_POST['access'];
}else{
	echo "Error with date settings.<br>";
	$error = True;
}

if( $accessdate == "" ){
	$accessdate = date("Y-m-d");
}

/**
 * If all the information from the form is retrieved, proceed to file storage
 */
if($error == False){

	// Database set up
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
	 * The public link of the new material
	 */
	$link = "https://storage.googleapis.com/intellekt_file_storage/".$module.$title;

	$query = 'SELECT * FROM MATERIAL WHERE File = "'.$link.'"';
	$result = mysqli_query($db, $query);
	if( mysqli_num_rows($result) > 0){
	    echo "File with the same title already exists!";
	    }else{

	        /**
			* Connect to Google Cloud Storage API
			*/
			$client = new Google_Client();
			$client->setApplicationName("Intellekt");
			$client->setAccessType("offline");
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
			$postbody = array('name' => $file_name, 'data' => file_get_contents(__DIR__ .'/'.$file), 'uploadType' => 'media', 'predefinedAcl' => 'publicRead', 'mimeType' => $mime);
			$storage->objects->insert("intellekt_file_storage",$obj, $postbody);

			/**
			* Upload a link and other information to the database
			*/
	        $sql = "INSERT INTO MATERIAL (User_ID, Module_ID, Material_TITLE, File, Upload_DATE, Access_DATE, Material_TYPE) VALUES ('".$uploader."', '".$id."', '".$title."' , '".$link."', '".date("Y-m-d")."', '".$accessdate."','".$type."')";
	        if ($db->query($sql) === TRUE) {
				echo "File uploaded successfully!<br>";
				echo"<a href='".$back."'>Back to module</a> ";
			}else{
				echo "Error while inserting a record: " . $db->error;
			} 
			$db->close();
	    }
}
else{
	echo"<a href='".$back."'>Back to module</a> ";
}

?>
</body>
</html>
