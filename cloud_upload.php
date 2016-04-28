<html>
<body>

<?php

session_start();

include_once("config.php");

require_once __DIR__ . '/vendor/autoload.php';

$module = $_SESSION['moduleID'];
$uploader = $_SESSION["username"];

//header('Location: modulesLecturer.php?id='.$module);

$id = $module;
$back = "modulesLecturer.php?id=".$id;
$module = $module."/";
$error = FALSE;

if(isset($_POST['upload'])){
	$file = $_POST['upload'];
}else{
	echo "Error: Empty request. File not set.";
	$error = True;
}


if(isset($_POST['title'])){
	$title = $_POST['title'];
}else{
	echo "Error: Title not valid or not set.";
	$error = True;
}


if(isset($_POST['type'])){
	$type = $_POST['type'];
}else{
	echo "Error: File type not set";
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
	echo "Error with date settings.";
	$error = True;
}


if( $accessdate == "" ){
	$accessdate = date("Y-m-d");
}


if($error == False){

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
			//database
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
	echo "Error";
}

?>
</body>
</html>
