<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
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
 echo "<th style = 'border: 1px solid black' >Edit</th>";
 echo "<th style = 'border: 1px solid black' >Student_ID</th>";
 echo "<th style = 'border: 1px solid black' >Student_NAME</th>";
 echo "<th style = 'border: 1px solid black' >Address</th>";
 echo "<th style = 'border: 1px solid black' >Study_Year</th>";
 echo "<th style = 'border: 1px solid black' >Course_ID</th>";
 echo "</tr>";
 while($row = mysqli_fetch_assoc($result)) {
 $id = $row['Student_ID']."'";
 $loc = '"#_"';
 // outputs the mysql database table with an edit button infront of each row
 echo "<tr style= 'border:1px solid black'>";
 echo "<td style = 'border: 1px solid black' ><a href='changeStudent.php?id=".$id."><button>Edit</
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
</body>
</html>