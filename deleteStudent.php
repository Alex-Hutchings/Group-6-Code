<?php session_start() ?>
<!DOCTYPE html>
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
<body>
	<body style="background:#eee;">
    <div class="container">
    	<br/>
        <br/>
  		<div class="row">
  			<div class="col-lg-2"></div>
  			<div class="col-lg-8">
  				<div class="panel panel-default">
    				<div class="page-header">
                		<center><img id="logo" src="logo.png" width="275" alt="logo"/></center>
					</div>
					<div class="panel-body">
<?php
$DBserver = "csmysql.cs.cf.ac.uk"; //mysql server
$DBuser = "group6.2015"; //mysql username
$DBpass = "bhF54FWzyq"; //mysql password
$DBdatabase = "group6_2015"; //mysql database name
$db = mysqli_connect($DBserver,$DBuser,$DBpass,$DBdatabase);
if( $db === FALSE ){
 header( "Location: error.html" ); //redirects to an error page in case of an error.
 die();
}

$command = "SELECT * FROM STUDENT";
$result = mysqli_query($db, $command);

echo "<table style='font-family:Helvetica;'>";
 echo "<tr style= 'border:1px solid black'>";
 echo "<th style = 'border: 1px solid black' >Delete</th>";
 echo "<th style = 'border: 1px solid black' >Student_ID</th>";
 echo "<th style = 'border: 1px solid black' >Student_NAME</th>";
 echo "<th style = 'border: 1px solid black' >Address</th>";
 echo "<th style = 'border: 1px solid black' >Study_Year</th>";
 echo "<th style = 'border: 1px solid black' >Course_ID</th>";
 echo "</tr>";
 while($row = mysqli_fetch_assoc($result)) {
 $id = $row['Student_ID']."'";
 $loc = '"#_"';
 // outputs the mysql database table with an elete button infront of each row
 echo "<tr style= 'border:1px solid black'>";
 echo "<td style = 'border: 1px solid black' ><a href='removeStudent.php?id=".$id."><button>Delete</
button></a></td>";
 echo "<td style = 'border: 1px solid black' >".$row['Student_ID'] . "</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Student_NAME']."</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Address'] . "</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Study_YEAR'] . "</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Course_ID']."</td>";
 echo "</tr>";
 }
 echo "</table>";
?>
</div>
				</div>
  			</div>
		</div>
		<div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <center><a href="studentMenu.html">Back</a><br><br>
        <a href="lecturerMenu.html">Switch to lecturer details</a>
        <br><br><br><br>
        <a href="logout.php" style="color:black;"><button class="btn btn-md">Log out</button></a><center>
      </div>
    </div>
    </div>
	<br/>
</body>
</html>