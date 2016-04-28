<?php session_start() ?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="icon.ico"/>
    <title>Admin Page</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link href="masterStyle.css" rel="stylesheet">
</head>
<body style="background:#eee;">
    <div class="container">
    	<br/>
        <br/>
  		<div class="row">
  			<div class="col-md-3"></div>
  			<div class="col-md-6">
  				<div class="panel panel-default">
    				<div class="page-header">
                		<center><img id="logo" src="logo.png" width="275" alt="logo"/></center>
					</div>
					<div class="panel-body">
<?php
$server = "csmysql.cs.cf.ac.uk";
$user = "group6.2015"; $password = "bhF54FWzyq"; $database = "group6_2015";
if(isset($_GET['id'])){
$ID = intval($_GET['id']);
$command = "SELECT * FROM STUDENT WHERE Student_ID = $ID";
}

$db = mysqli_connect($server,$user,$password,$database); 
if( $db === FALSE ){
header( "Location: error.html" ); die();
}
$result = mysqli_query($db, $command); 
while($row = mysqli_fetch_assoc($result)) {


$SID = $row['Student_ID'];

$name = $row['Student_NAME']; 
$address = $row['Address']; 
$year = $row['Study_YEAR'];
$CID = $row['Course_ID'];
$_SESSION['id'] = $row['Student_ID'];
}
//$command1 = "INSERT INTO Shop VALUES ($name,$image,$description,$price)";
$result = mysqli_query($db, $command); //$result1 = mysqli_query($db, $command1);
/*if(isset($_POST['name'])&& isset($_POST['image']) && isset($_POST['description']) && isset($_POST['price']) ){
$sql = "INSERT INTO Shop (name, image, description, price) VALUES ('".$name."','".$image."','". $description."','".$price."')";
echo "<table style='boder:1px solid black'>"; if ($db->query($sql) === TRUE) {
echo "New record created successfully"; }
else {
echo "Error: " . $sql . "<br>" . $db->error;
} ;

}*/?>
<div style="margin:1%; padding:1%;">
				<div id="help"></div>
				</div>
						<form class="form-horizontal" role="form" method='post' name='adder' method="post" onSubmit='return validateForm()' action="studentPageSubmit.php">
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="sid">Student ID: </label>
						    <div class="col-sm-10">
						      <?php echo htmlspecialchars($SID); ?>
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="name">Student Name: </label>
						    <div class="col-sm-10"> 
						      <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="<?php echo htmlspecialchars($name); ?>" onFocus="help('Enter the student's name here.')" onBlur="help('')">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="address">Address: </label>
						    <div class="col-sm-10"> 
						      <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" value="<?php echo htmlspecialchars($address); ?>" onFocus="help('Enter the student's address here.')" onBlur="help('')" >
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="year">Year: </label>
						    <div class="col-sm-10"> 
						      <input type="text" name="year" id="year" class="form-control" placeholder="Enter year" value="<?php echo htmlspecialchars($year); ?>" >
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="cid">Course ID: </label>

						    <div class="col-sm-10"> 
						      <?php echo htmlspecialchars($CID); ?>
						    </div>
						  </div>
						  <div class="form-group"> 
						    <div class="col-sm-offset-5 col-sm-10">
						      <button type="submit" name='Update' value='Update' class="btn btn-default">Update</button>
						    </div>
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <center><a href="studentMenu.html">Back</a><br><br>
        <a href="lecturerMenu.html">Switch to lecturer details</a><br><br><br><br>
        <a href="logout.php" style="color:black;"><button class="btn btn-md">Log out</button></a><center>
      </div>
    </div>
    </div>
	<br/>
</body>
</html>