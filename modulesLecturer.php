<?php 
/*
 * Group 6
 * 2016 Intelekt.
 *
 */

/**
 * The "modulesLecturer" implements the lecturers functionality:
 *    -View module information
 *    -Upload/delete file
 *    -View material
 *    -View student comments on material
 * 
 * Issues to be resolved in the future:
 *    -Student comments are displayed in an annoying manner
 *
 * Future extentions:
 *    -Improve the consistency of the code
 *    -Update material functionality
 *    -Manage module information
 *    -Allow video and achive type files to be uploaded
 *    -Implement set assignments functionality
 */

session_start();

// Includes other scripts
include_once("config.php");
include_once("lectMenu.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link href="masterStyle.css" rel="stylesheet">
        <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <title>Modules</title>

     <!-- script that shows/hides the uplaod container -->
    <script>
        $(document).ready(function(){
            $(".btnUpload").click(function(){
                $(".toUpload").show();
                $(".lecturesPreview").hide();
            });
        });
        $(document).ready(function(){
            $(".hideUpload").click(function(){
                $(".toUpload").hide();
                $(".lecturesPreview").show();
            });

          /* Allow selection of files with only specific extentions. 
           * #element corresponds to a "file" field in input form.
           */
          $('#element').click(function() {
            if($('#radio_button1').is(':checked')) {
              $('#element').attr('accept', 'application/pdf');
             }
            if($('#radio_button2').is(':checked')) {
              $('#element').attr('accept', 'image/* , application/pdf');

            }
          });
        });
    </script>

</head>

<body>

<?php
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

    <!-- where the lectures that are uplaoded will be listed and when clicked will display/preview the lecture in the iframe  -->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 lecturesUploaded">
                <div class="well">

                    <h3><?php echo $_SESSION['moduleID'] ?></h3>
                  <h4>Module Title</h4>
                  <?php
                    
                    $query = 'SELECT * FROM MODULE WHERE Module_ID = "'.$_SESSION['moduleID'].'"';
                    $result = mysqli_query($db, $query);

                    /* 
                 * Retrieves and prints module information
                 */
                    while ($row = mysqli_fetch_assoc($result)){
                      $moduleTitle = $row['Module_TITLE'];
                      $moduleDesc = $row['Module_DESCRIPTION'];
                      echo"<p>".$moduleTitle."</p><br>";
                      echo"<h4> Module Description</h4>";
                      echo "<p>".$moduleDesc."</p>";
                  }

                  echo"<h4>Lecture Material</h4>";
                  $query = 'SELECT * FROM MATERIAL WHERE Module_ID = "'.$_SESSION['moduleID'].'" AND Material_TYPE = "pdf"';
                    $result = mysqli_query($db, $query);
                    $i = 1;

                    /* 
                 * Retrieves and displays lecture slides titles
                 */
                    while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE'];
                      $materialLink = $row['File'];
                      $access = $row['Access_DATE'];     
                      echo"
                      <div class='modules-lect-button'>
                      <a href='' data-toggle='modal' data-target='#LectureModal'  data-backdrop='static' data-keyboard='false'>".$i.".".$materialTitle." </a>
                      <form action='cloud_delete.php' method='post'>
                      <input name='del' type='hidden' value='".$materialTitle."'>
                      <input type='submit' value='Delete'>
                      </form>
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

                  /* 
                 * Retrieves and displays other material titles
                 */ 
                  while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE'];
                      $materialLink = $row['File'];
                      $access = $row['Access_DATE'];     
                      echo"
                      <div class='modules-lect-button'>
                      <a href='' data-toggle='modal' data-target='#LectureModal'  data-backdrop='static' data-keyboard='false'>".$i.".".$materialTitle." </a>
                      <form action='cloud_delete.php' method='post'>
                      <input name='del' type='hidden' value='".$materialTitle."'>
                      <input type='submit' value='Delete'>
                      </form>
                      </div>";
                      $i++;
                      if($access > date("Y-m-d")){
                        echo "Set to be accessible from " . $access;
                      }
                  }
                  ?>

                <h4>Student Feedback</h4>
                <a href="lecturerFeedbackForm.php"><button class="btn-md">Module Feedback</button></a>
                   <input hidden type='text' id='moduleID' name='moduleID' value= <?php $moduleID ?>>
            </div>
        </div>

                <h3>Upload Lecture Material</h3>
                 
              <!-- File upload form -->
                <form action="cloud_upload.php" method="post">
                  Enter a title: 
            <input type="text" name="title"><br>
              Make slides accessable from (optional): 
              <?php echo"
              <input type='date' min='".date("Y-m-d")."' value='".date("Y-m-d")."' max='2050-01-01' name='access'><br>"?>
              Upload as:<br>
                    <input type="radio" name="type" value="pdf" id="radio_button1" checked="checked" > Lecture slides ( .pdf only)<br>
                    <input type="radio" name="type" value="oth" id="radio_button2"> Other material ( images, .pdf )<br>
                    <input type="file" name="upload" id="element"><br>
                    <input type="submit" value='Upload'>
                </form>

            </div>
            </div>

            <!-- iframe that will be used for lectures display-->
            <!-- Modal -->
      <div class="modal fade" id="LectureModal" role="dialog">
          <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <?php

              /* 
                 * Retrieves and displays lecture slides and other material inside iframe
                 */ 
              $materialQuery = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION['moduleID'].'"  AND Material_TYPE = "pdf"';
              $result = mysqli_query($db, $materialQuery);

              while ($row = mysqli_fetch_assoc($result)){
                  $materialTitle = $row['Material_TITLE'];
                  $file = $row['File'];
                  $_SESSION['materialID'] = $row['Material_ID'];
                
                  echo "<div class='modal-body'>
                  <h4 class='modal-title'> ".$materialTitle." </h4>";
                  echo "<div><iframe src=".$file." width='80%;' height='350px;'></iframe></div>";
              }

              $materialQuery = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION['moduleID'].'"  AND Material_TYPE = "oth"';
              $result = mysqli_query($db, $materialQuery);

              while ($row = mysqli_fetch_assoc($result)){
                  $materialTitle = $row['Material_TITLE'];
                  $file = $row['File'];
                  $_SESSION['materialID'] = $row['Material_ID'];
                
                  echo "<div class='modal-body'>
                  <h4 class='modal-title'> ".$materialTitle." </h4>";
                  echo "<div><img src=".$file." height='350px' width='80%'></div>";
              }
              
              echo "
              <div class='col-sm-6 '>
                  <div class='panel panel-default lectureComments'>
                      <div class='panel-heading'>Comments</div>
                      <div class='panel-body'>";
                      $query = 'SELECT * FROM MATERIAL_COMMENTS WHERE Module_ID="'.$_SESSION['moduleID'].'"';
                      $result = mysqli_query($db, $query);

                      /* 
                     * Retrieves and displays comments on lecture material
                     */ 
                      while ($row = mysqli_fetch_assoc($result)){
                          $comment = $row["Comment"];
                          $user = $row["User_ID"];
                          echo "
                          <div class='media'>
                              <div class='media-left'>
                              <span class='media-object'><b>".$user."</b></span>
                              </div>
                          <div class='media-body'>
                          <p>".$comment."</p>
                        </div>
                        </div>";
                      }
              ?>
                          
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>

          </div>
      </div>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

          <script>
          </script>


              </div>
          </div>

          <script>
          </script>


</body>

</html>