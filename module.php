<!DOCTYPE html>
<html lang="en">
<?php session_start();
include_once("config.php"); //calls the config file which connects to the database
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

    <title>Modules</title>

    <!--  -->

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
    </script>
<?php
//checks to see if the username has been set
//if username is set then the user variable is set to the be posted username variable from the login form
if(isset($_SESSION['username']))
{   $user = $_SESSION['username']; //sets the user variable to be the value stored in the post array
    // if($user == $_POST['username'])
    // {
    //     $_SESSION['username'] = $user;
    //prints out the entire navigation bar.
        echo "
            <div class='container-fluid'>
        <nav class='navbar navbar-default'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <img src='logo.png'>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
              <ul class='nav navbar-nav intelekt-nav-left'>
                <li><a href='module.php'><img src='ModulesIcon.png' width='50%'></a></li>
                </ul>
              <div class='nav navbar-nav navbar-right'>
                <span class='glyphicon glyphicon-user'></span>
                <span>Username: </span>
                <span>".$_SESSION['username']."</span>
                <a href='logout.php'><button class='btn-md'>Log out</button>
              </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>";

$update = null;
//query retrieves the module id from student takes module where the student id is the same as the value stored for username in the post array.
//this checks if a student takes a certain module, and only retrieves the modules that the student is enrolled on.

if($_SESSION['lecturer'] == true) {
    $query = 'SELECT * FROM LECTURERS_IN_MODULE WHERE Lecturer_ID="'.$_SESSION['username'].'"';
    $page = 'modulesLecturer.php';
}else{
    $query = 'SELECT * FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_SESSION["username"].'"';
    $page = 'module-1.php';
}

$result = mysqli_query($db, $query) or die(mysqli_error($db));
while ($row1 = mysqli_fetch_assoc($result)){
$id = $row1['Module_ID'];
$moduleTitle = $row1['Module_TITLE'];
echo"<div class='row'>
<div class='container'>
    <div class='well modules-buttons'>
        <input hidden type='text' id='username' name='username' value= ".$_SESSION['username']."><a href='".$page."?id=".$row1['Module_ID']."'><button class='btn-lg'>".$row1['Module_ID'],": ", $moduleTitle."</button></a><br>
        <input hidden type='text' id='moduleID' name='moduleID' value= ".$id.">
    </div>
</div>
</div>";
}//Sends hidden data to the next form so that the module ID can be collected and used as the page contents
}

?>
</body>
</div>
</html>