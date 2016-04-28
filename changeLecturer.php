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
$command = "SELECT * FROM LECTURER WHERE Lecturer_ID = $ID";
}

$db = mysqli_connect($server,$user,$password,$database); 
if( $db === FALSE ){
header( "Location: error.html" ); die();
}
$result = mysqli_query($db, $command); 
while($row = mysqli_fetch_assoc($result)) {

$LID = $row['Lecturer_ID'];
$name = $row['Lecturer_NAME']; 
$office = $row['Office']; 
$_SESSION['id'] = $row['Lecturer_ID'];
}

$result = mysqli_query($db, $command); 
?>
<div style="margin:1%; padding:1%;" >
	<div id="help"></div>
							<form class="form-horizontal" role="form"  id="adder" method='post' name='adder' method="post" onSubmit='return validateForm()' action="lecturerPageSubmit.php"  >
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="lid">Lecturer ID: </label>
						    <div class="col-sm-10">
						      <?php echo htmlspecialchars($LID); ?>
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="name">Lecturer Name: </label>
						    <div class="col-sm-10"> 
						      <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="<?php echo htmlspecialchars($name); ?>" onFocus="help('Enter the lecturer's name here.')" onBlur="help('')" >
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="office">Lecturer Office: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="office" id="office" class="form-control" placeholder="Enter office" value="<?php echo htmlspecialchars($office); ?>" onFocus="help('Enter the lecturer's office here.')" onBlur="help('')" >
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
		</div>
		<div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <center><a href="lecturerMenu.html">Back</a><br><br>
        <a href="studentMenu.html">Switch to student details</a><br><br><br><br>
        <a href="logout.php" style="color:black;"><button class="btn btn-md">Log out</button></a><center>
      </div>
    </div>
    </div>
	<br/>
</body>
</html>