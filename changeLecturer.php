<?php session_start() ?>
<?php
include_once("config.php");
$result = mysqli_query($db, $command); 
while($row = mysqli_fetch_assoc($result)) {
$LID = $row['Lecturer_ID'];
$name = $row['Lecturer_NAME']; 
$office = $row['Office']; 
$_SESSION['id'] = $row['Lecturer_ID'];
}
$result = mysqli_query($db, $command); 
?>
<div style="margin:1%; padding:1%; background-color:white;" >
<form method='post' name='adder' method="post" onSubmit='return validateForm()' action="lecturerPageSubmit.php" >
Lecturer ID:<input type='text' name='lid' id= 'lid' value="<?php echo htmlspecialchars($LID); ?>" onFocus="help('Enter the lecturer's ID here.')"
onBlur="help('')" />
Lecturer Name:<input type='text' name='name' id='name' value="<?php echo htmlspecialchars($name); ?>" onFocus="help('Enter the lecturer's name here.')" onBlur="help('')" /> 
Lecturer's office:<input type='text' name='office' id = 'office' value="<?php echo htmlspecialchars($office); ?>" onFocus="help('Enter the lecturer's office here.')" onBlur="help('')" />
<br/><br/>
<input type='submit' name='Update' value='Update' />
</form>
<div id="help"></div>
</div>