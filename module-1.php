<?php session_start();
/*
 * Group 6
 * 2016 Intelekt.
 *
 */

/**
 * The "module-1 form" implements the module specific page for students:
 *    -View module specific material on the page
 *    -Access material 
 *    -Access modular specific buttons - Question forums and module summary page
 *    - Access module feedback
 *    -View deadlines, FAQ and lecturers on the module
 * Future extentions:
 *    -Improve the layout of the page
 *    -Add more functionality e.g. dynamic deadline material that constantly updates
 *    -Add ability for display lecturers to display every lecture enrolled on that module
 *    -Add timetabled slots for each module activity . ie. lectures, labs and tutorials
 */
include_once("config.php");
include_once("menu.php");
if($_SESSION['lecturer'] == true) {
    $query = 'SELECT * FROM LECTURERS_IN_MODULE WHERE Lecturer_ID="'.$_SESSION['username'].'"';
    include_once("lectMenu.php");
}else{
    $query = 'SELECT * FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_SESSION["username"].'"';
    include_once("menu.php");
}
if(!isset($_SESSION['username'])){
  header("location:login.php");
}
if(isset($moduleID)){
  $query = "SELECT * FROM MODULE WHERE Module_ID = '".$_GET['id']."'";
  $checkModuleID = mysqli_query($db, $query);

if(mysqli_num_rows($checkModuleID) > 0){
  $moduleID = $_GET['id'];
}
else{
  header('location: error.html');
}
}
else{
  $_SESSION['moduleID'] = $moduleID;
}
$_SESSION['moduleID'] = $moduleID;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".FAQpanelhead").click(function(){
            $(".FAQpanelbody").toggle();
           $(this).toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
        });
    });

    $(document).ready(function(){
        $(".Deadlinepanelhead").click(function(){
            $(".Deadlinepanelbody").toggle();
            $(this).toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
        });
    });

    $(document).ready(function(){
        $(".LecturerPanelhead").click(function(){
            $(".Lecturerpanelbody").toggle();
            $(this).toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
        });
    });
    </script>

    <title>Module</title>

    <link rel="stylesheet" href="style.css">
    <link href="masterStyle.css" rel="stylesheet">
        <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body>
<?php

?>
    <div class="row">

        <div class="col-md-7">
            <div class="well">
                <h3><?php echo $_SESSION['moduleID'] ?></h3>
                <h4>Module Title</h4>
                <?php
                
                    
                    $query = 'SELECT * FROM MODULE WHERE Module_ID="'.$_SESSION['moduleID'].'"';
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)){
                      $moduleTitle = $row['Module_TITLE'];
                      $moduleDesc = $row['Module_DESCRIPTION'];
                echo"
                <p>".$moduleTitle."</p>
                <br>";
                echo"<h4> Module Description</h4>";
                echo "<p>".$moduleDesc."</p>";
              }
              echo"<h4>Lecture Material</h4>";
              $query = 'SELECT * FROM MATERIAL WHERE Module_ID = "'.$_SESSION['moduleID'].'" AND Material_TYPE = "pdf"';
                    $result = mysqli_query($db, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE'];
                      $materialLink = $row['File'];
                      $access = $row['Access_DATE'];
                      $Material_ID = $row['Material_ID'];     
                      echo"
                    <div class='modules-lect-button'>
                     <a href='material.php?matID=".$Material_ID."'>".$i.". ".$materialTitle."</a>
                    </div>";
                    $i++;
                    if($access > date("Y-m-d")){
                      echo "Set to be accessible from " . $access;
                    }
              }
              ?>

                <h4>Other Material</h4>
                <?php 
                $query = 'SELECT * FROM MATERIAL WHERE Module_ID = "'.$_SESSION['moduleID'].'" AND Material_TYPE = "oth"';
                    $result = mysqli_query($db, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE'];
                      $materialLink = $row['File'];
                      $access = $row['Access_DATE'];
                      $Material_ID = $row['Material_ID'];      
                      echo"
                    <div class='modules-lect-button'>
                    <a href='material.php?matID=".$Material_ID."'>".$i.". ".$materialTitle."</a>
                    </div>";
                    $i++;
                    if($access > date("Y-m-d")){
                      echo "Set to be accessible from " . $access;
                    }
              }?>

                <h4>Module Feedback</h4>
                <a href="moduleFeedbackForm.php"><button class="btn-md">Module Feedback</button></a>
                   <input hidden type='text' id='moduleID' name='moduleID' value= <?php $moduleID ?>>
            </div>
        </div>

        <div class="col-md-5">
            <div class="well">
                <div class="panel panel-default">
                  <div class="panel-heading"><span data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false">FAQ</span><span class="glyphicon glyphicon-menu-up glypbuttons FAQpanelhead"></span></div>
                  <div class="panel-body FAQpanelbody"  data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false" style="display:none;">
                    <?php
                    $query = 'SELECT * FROM FAQ WHERE Module_ID= "'.$_SESSION['moduleID'].'"';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row1 = mysqli_fetch_assoc($result)){
                      $question = $row1['Question'];
                      $answer = $row1['Answer'];
                      echo '<p>Q:'.$question.'</p>
                         <p>A:'.$answer.'</p>';
                   }
                    ?>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">Deadlines<span class="glyphicon glyphicon-menu-up glypbuttons Deadlinepanelhead"></span></div>
                  <div class="panel-body Deadlinepanelbody" style="display:none;">
                    <?php
                    $query = 'SELECT * FROM MODULE WHERE Module_ID="'.$_SESSION['moduleID'].'"';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)){
                      $deadline = $row['Deadline'];
                      echo "<p>Coursework Deadline<span class='date-deadline'>".$deadline."</span></p>";
                    }
                      ?>
                    </div>
                </div>
            </div>


    <div class="panel panel-default">
    <div class="panel-heading">Lecturer<span class="glyphicon glyphicon-menu-up glypbuttons LecturerPanelhead"></span></div>
    <div class="panel-body Lecturerpanelbody" style="display:none;">
    <?php
      $query = 'SELECT Lecturer_ID FROM LECTURERS_IN_MODULE WHERE Module_ID="'.$_SESSION['moduleID'].'"';
      $result = mysqli_query($db, $query) or die(mysqli_error($db));
      while ($row = mysqli_fetch_assoc($result)){
        $lectID = $row['Lecturer_ID'];
        
      }
      $query2 = 'SELECT * FROM LECTURER WHERE Lecturer_ID="'.$lectID.'"';
      $result = mysqli_query($db, $query2) or die(mysqli_error($db));
      while ($row = mysqli_fetch_assoc($result)){
        $lectName = $row['Lecturer_NAME'];
        $lectOffice = $row['Office'];
      echo "<p>Lecturer Name<span class='LecturerPanel'>".$lectName."</span></p>";
      echo "<p>Lecturer Office<span class='LecturerPanel'>".$lectOffice."</span></p>";
    }
        ?>
      </div>
  </div>
  </div>
  </div>

  </div>

    <!-- Modal -->
  <div class="modal fade" id="LectureModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        <?php
        $materialQuery = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION['moduleID'].'"';
        $result = mysqli_query($db, $materialQuery);
        while ($row = mysqli_fetch_assoc($result)){
        $materialTitle = $row['Material_TITLE'];
        $file = $row['File'];
        $_SESSION['materialID'] = $row['Material_ID'];
        echo "<div class='modal-body'>
       <h4 class='modal-title'> ".$materialTitle." </h4>
          <div>
              <iframe src=".$file." width='80%;' height='350px;'></iframe>
          </div>";
        }?>

                </div>
              </div>
            </div>
    </div>
  </div>

    <!-- Modal 2-->
  <div class="modal fade" id="FAQModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">FAQ</h4>
        </div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
function commentalert(){
  alert("Your comment has been posted!");
}
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
    </script>

</body>

</html>
