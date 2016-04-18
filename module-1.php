<?php session_start();
include_once("config.php");
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
           // $(this).toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
        });
    });

    $(document).ready(function(){
        $(".Deadlinepanelhead").click(function(){
            $(".Deadlinepanelbody").toggle();
            $(this).toggleClass('glyphicon-menu-up').toggleClass('glyphicon-menu-down');
        });
    });
    </script>

    <title>Module</title>

    <!--  -->

    <link rel="stylesheet" href="style.css">

</head>

<body>
<?php
$_SESSION['username'] = $_SESSION['username'];
if(!isset($moduleID)){
  $moduleID = $_GET['id'];
}
else{
  $_SESSION['moduleID'] = $moduleID;
}

$_SESSION['moduleID'] = $moduleID;
echo "
    <div class='container-fluid'>
        <nav class='navbar navbar-default'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <img src='logo.png'>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <form action='' method='POST'>
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
              <ul class='nav navbar-nav intelekt-nav-left'>
                <li><a href='module.php'><img src='ModulesIcon.png' width='50%'></a></li>
                <li><a href='Working_MSR_With_userlist.php'?moduleID=".$_SESSION['moduleID']."><img src='MSRicon.png' width='50%'></a></li>             
                <li><a href='forumNew.php'><img src='forumsicon.png' width='50%'></a></li>
              </ul>
              </form>
              
              <div class='nav navbar-nav navbar-right'>
                <span class='glyphicon glyphicon-user'></span>
                <span>Username: </span>
                <span>".$_SESSION['username']."</span>
                <a href='logout.php'>Log out</button></a>
              </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>";
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
              }
                ?>

                <h4>Other Material</h4>
                <a href="moduleFeedbackForm.php"><button class="btn-md">Module Feedback</button></a>
                   <input hidden type='text' id='moduleID' name='moduleID' value= <?php $moduleID ?>>
            </div>
        </div>

        <div class="col-md-5">
            <div class="well">
                <div class="panel panel-default">
                  <div class="panel-heading"><span data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false">FAQ</span><span class="glyphicon glyphicon-open glypbuttons" data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false"></span><span class="glyphicon glyphicon-menu-up glypbuttons FAQpanelhead"></span></div>
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

    <!-- Modal 2-->
  <div class="modal fade" id="FAQModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FAQ</h4>
        </div>
        <div class="modal-body">
            <div class="well">
                
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

</body>

</html>
