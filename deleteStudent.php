<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include_once("config.php");

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
</body>
</html>