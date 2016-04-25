<?php session_start();
include_once("config.php");
include_once("lectMenu.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <link rel="stylesheet" href="style.css">

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
        });
    </script>

</head>

<body>

<?php
//$_SESSION['username'] = $_SESSION['username'];
if(!isset($moduleID)){
  $moduleID = $_GET['id'];
  $_SESSION['moduleID'] = $moduleID;
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
                    $query = 'SELECT * FROM MODULE WHERE Module_ID="'.$_SESSION['moduleID'].'"';  //$_SESSION['moduleID']
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
              $query = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION['moduleID'].'"';
                    $result = mysqli_query($db, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE'];
                      $materialLink = $row['File'];
                    echo"
                    <div class='modules-lect-button'>
                    <a href='' data-toggle='modal' data-target='#LectureModal'  data-backdrop='static' data-keyboard='false'>".$i.". ".$materialTitle."</a>
                    </div>";
                    $i++;
                    // ADD echo"<a href='cloud_delete.php?file=".$materialLink."><button>Delete</button></a>";
             
              }
                ?>

                <h4>Other Material</h4>
                <a href="lecturerFeedbackForm.php"><button class="btn-md">Module Feedback</button></a>
                   <input hidden type='text' id='moduleID' name='moduleID' value= <?php $moduleID ?>>
            </div>
        </div>






                <!-- button for uplaod... it hides the upload button and iframe and it shows the upload form/window -->
               <!-- <button class="btn-default btnUpload">Upload file</button> -->
               <h3>Upload Lecture Material</h3>
                <form action="cloud_upload.php" method="post">

                  Enter a title: 
                  <input type="text" name="title"><br>

                   Make slides accessable from (optional): 
                    <input type="date" min="2016-01-01" max="2050-01-01" name="access"><br>
                 
                  <input type="file" name="pdf" accept="application/pdf"><br>
                  Upload as:<br>
                  <input type="radio" name="type" value="pdf"> Lecture slides(.pdf)<br>
                  <input type="radio" name="type" value="oth"> Other material(.png; .jpeg; .zip)<br>
                  <input type="file" name="pdf" accept="application/pdf"><br> <!-- The accept value needs to depend on the radio button selected, or perhaps removed -->
                  <input type="submit" value="upload">
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
        }
        
          echo "
            <div class='col-sm-6 '>
              <div class='panel panel-default lectureComments'>
                 <div class='panel-heading'>Comments</div>
                 <div class='panel-body'>";
                  $query = 'SELECT * FROM MATERIAL_COMMENTS WHERE Module_ID="'.$_SESSION['moduleID'].'"';
                  $result = mysqli_query($db, $query);
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
                    <div id="formCommentsBox">
                     <form id="formComments" action="comments.php" method="post" onSubmit="commentalert()">
                         <input type="text" name="comment" placeholder="Enter comment">
                         <button type="submit">Make Comment</button>
                     </form>
                   </div>

                </div>
              </div>
            </div>

            <div class="col-sm-6 ">
              <div class="panel panel-default lectureNotes">
                  <div class="panel-heading">Personal Notes</div>
                  <div class="panel-body">

                      <div ng-app="">
                        <label>Write your personal notes:</label>
                        <p><textarea type="text" class="textnotes" rows="3" ng-model="name"></textarea>
                        <button type="submit" class="btn btn-sm">Send</button>
                        <div ng-bind="name"></div>

                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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







            <!-- upload container which is shown only when upload button is clicked and hidden when a file has been uploaded or
or the operation has been cancelled -->
            <!--<div class="col-sm-8 toUpload" style="display:none;">
                <div class="well">
                    <p>Browse files to upload</p>
                    <div class="fileUpload">
                        <table width="100%">
                            <thead>
                                <th width="70%">File name</th>
                                <th width="20%">Date</th>
                                <th width="10%">Type</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name.ext</td>
                                    <td>20/03/2001</td>
                                    <td>text</td>
                                </tr>
                                <tr>
                                    <td>Name.ext</td>
                                    <td>20/03/2001</td>
                                    <td>text</td>
                                </tr>
                            </tbody>
                        </table>
                        <form class="form-inline formInlineMargin" role="form">
                          <div class="form-group formInlineUp">
                            <label for="email">File name:</label>
                            <input type="text" class="form-control" id="fileName">
                          </div>
                          <button type="submit" class="btn btn-default hideUpload">Upload</button>
                          <button type="button" class="btn btn-default hideUpload">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>-->


        </div>
    </div>

    <script>
    </script>


</body>

</html>