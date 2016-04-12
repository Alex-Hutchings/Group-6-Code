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

$command = "SELECT * FROM LECTURER";
$result = mysqli_query($db, $command);

echo "<table style='font-family:Helvetica;'>";
 echo "<tr style= 'border:1px solid black'>";
 echo "<th style = 'border: 1px solid black' >Delete</th>";
 echo "<th style = 'border: 1px solid black' >Lecturer_ID</th>";
 echo "<th style = 'border: 1px solid black' >Lecturer_NAME</th>";
 echo "<th style = 'border: 1px solid black' >Office</th>";
 echo "</tr>";
 while($row = mysqli_fetch_assoc($result)) {
 $id = $row['Lecturer_ID']."'";
 $loc = '"#_"';
 // outputs the mysql database table with an elete button infront of each row
 echo "<tr style= 'border:1px solid black'>";
 echo "<td style = 'border: 1px solid black' ><a href='removeLecturer.php?id=".$id."><button>Delete</
button></a></td>";
 echo "<td style = 'border: 1px solid black' >".$row['Lecturer_ID'] . "</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Lecturer_NAME']."</td>";
 echo "<td style = 'border: 1px solid black'>".$row['Office'] . "</td>";
 echo "</tr>";
 }
 echo "</table>";
?>
</body>
</html>