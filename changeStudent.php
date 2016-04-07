<?php session_start() ?>
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

if($row['Student_ID'] == 1444444){
	echo 'yes';
}
else{
	echo 'no the student id is'.$row['Student_ID'];
}
$SID = $row['Student_ID'];
echo '<h1> id: '.$SID.'</h1>';
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
<div style="margin:1%; padding:1%; background-color:white;" >
<form method='post' name='adder' method="post" onSubmit='return validateForm()' action="studentPageSubmit.php" >
Student ID:<input type='text' name='sid' id= 'sid' value="<?php echo htmlspecialchars($SID); ?>" onFocus="help('Enter the student's ID here.')"
onBlur="help('')" />
Student Name:<input type='text' name='name' id='name' value="<?php echo htmlspecialchars($name); ?>" onFocus="help('Enter the student's name here.')" onBlur="help('')" /> 
Student's address:<input type='text' name='address' id = 'address' value="<?php echo htmlspecialchars($address); ?>" onFocus="help('Enter the student's address here.')" onBlur="help('')" />
Year:<input type='text' name='year' id = 'year' value="<?php echo htmlspecialchars($year); ?>" />
Course ID:<input type='text' name='cid' id = 'cid' value="<?php echo htmlspecialchars($CID); ?>" onFocus="help('Enter the ID of the course the student is in here.')" onBlur="help('')" /> <br/><br/>
<input type='submit' name='Update' value='Update' />
</form>
<div id="help"></div>
</div>