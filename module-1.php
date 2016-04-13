<?php session_start() ?>
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
session_start();
$_SESSION['username'] = $_SESSION['username'];
$_SESSION['moduleID'] = $_POST['moduleID'];
//echos out the entire menu bar. Created in PHP so that session variables can be used throughout the menu
//line 55 uses the sessions module ID to create the link to the relevant Module Summary page, taking users to the correct firepad.
//Each button has their own image link that is used as an icon for the menu bar.
echo "
    <div class='container-fluid'>
        <nav class='navbar navbar-default'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <a href><img src='logo.png'></a>
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
                <h3><?php echo $_SESSION["moduleID"] //displays the module id as the title of the module?></h3>
                <h4>Module Title</h4>
                <?php
                //establishes database connection
                    $DBserver = "csmysql.cs.cf.ac.uk"; //mysql server
                    $DBuser = "group6.2015"; //mysql username
                    $DBpass = "bhF54FWzyq"; //mysql password
                    $DBdatabase = "group6_2015"; //mysql database name
                    $db = mysqli_connect($DBserver,$DBuser,$DBpass,$DBdatabase);
                    if( $db === FALSE ){
                      header( "Location: error.html" ); //redirects to an error page in case of an error.
                      die();
                    }//the sql query selects everything from the module table where the module ID is the same
                    //as the module id located in the current session array
                    $query = 'SELECT * FROM MODULE WHERE Module_ID="'.$_SESSION["moduleID"].'"';
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)){
                      $moduleTitle = $row['Module_TITLE']; //initialises the moduletitle variable to be the module title from the database
                      $moduleDesc = $row['Module_DESCRIPTION'];//initialises the module description variable to the module description retrieved from the database
                echo"
                <p>".$moduleTitle."</p> 
                <br>";//prints out the module title 
                echo"<h4> Module Description</h4>";
                echo "<p>".$moduleDesc."</p>"; //prints out the module description
              }
              echo"<h4>Lecture Material</h4>";
            //this query retrieves everything from the material table that has the same moduleID as the moduleID stored in the session array
              $query = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION["moduleID"].'"';
                    $result = mysqli_query($db, $query);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)){
                      $materialTitle = $row['Material_TITLE']; //initialises the materialTitle variable to be that of the material title retrieved from the database
                      $materialLink = $row['File']; //initialises the materiallink variable to be that of the file filed in the database
                	  echo"
                	  <div class='modules-lect-button'>
                	  <a href='' data-toggle='modal' data-target='#LectureModal'  data-backdrop='static' data-keyboard='false'>".$i.". ".$materialTitle."</a>
                	  </div>";
                	  $i++; //increments i by 1 each time a new material is added to the result array
              }
                ?>

                <h4>Other Material</h4>
                <button class="btn-md">View</button>
            </div>
        </div>

        <div class="col-md-5">
            <div class="well">
                <div class="panel panel-default">
                  <div class="panel-heading"><span data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false">FAQ</span><span class="glyphicon glyphicon-open glypbuttons" data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false"></span><span class="glyphicon glyphicon-menu-up glypbuttons FAQpanelhead"></span></div>
                  <div class="panel-body FAQpanelbody"  data-toggle="modal" data-target="#FAQModal"  data-backdrop="static" data-keyboard="false" style="display:none;">
                    <?php
                    //deals with the FAQ section of the module
                    //retrieves every FAQ stored in the module under the current moduleID stored in the session array.
                    $query = 'SELECT * FROM FAQ WHERE Module_ID= "'.$_SESSION["moduleID"].'"';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row1 = mysqli_fetch_assoc($result)){
                      $question = $row1['Question']; //sets the question variable to be the question field retrieved from the database
                      $answer = $row1['Answer']; //sets the answer variable to be the answer field retrieved from the database
                      echo '<p>Q:'.$question.'</p> 
                         <p>A:'.$answer.'</p>'; //prints out the answer variable
                        //prints out the question variable
                   }
                    ?>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">Deadlines<span class="glyphicon glyphicon-menu-up glypbuttons Deadlinepanelhead"></span></div>
                  <div class="panel-body Deadlinepanelbody" style="display:none;">
                    <?php
                    //retrieves the deadlines set for important material for each module
                    //query retrieves everything from the module table that is the same as the moduleID stored in the session array
                    $query = 'SELECT * FROM MODULE WHERE Module_ID="'.$_SESSION["moduleID"].'"';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)){
                      $deadline = $row['Deadline']; //sets the deadline variable to be the result of the query from the field Deadline
                      echo "<p>Coursework Deadline<span class='date-deadline'>".$deadline."</span></p>"; //prints out the deadline that has been retrieved
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
        //deals with the lecture material
        //query retrieves all the material files stored in the material table that have the same moduleID as the session stored moduleID
        //displays the retrieved lecture material in an iframe
        //each material retrieved also has their title displayed
        $materialQuery = 'SELECT * FROM MATERIAL WHERE Module_ID="'.$_SESSION["moduleID"].'"';
        $result = mysqli_query($db, $materialQuery);
        while ($row = mysqli_fetch_assoc($result)){
        $materialTitle = $row['Material_TITLE']; //sets the material title from the result retrieved in the results array
        $file = $row['File']; //sets the file variable from the result retrieved in the results array
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
                 //query retrieves the comments stored in the material comments table that have the same moduleID as the session array
                 //retrieves any comments from the database and stores them in the results array
                 //displays these results with the comment and the userID of the comment 
                  $query = 'SELECT * FROM MATERIAL_COMMENTS WHERE Module_ID="'.$_SESSION["moduleID"].'"';
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
                     <form class="form-inline"> <!--form that deals with making comments about the lecture material -->
                         <input type="text" class="form-control form-comments" placeholder="Enter comment">
                         <button type="submit" class="btn btn-sm">Send</button>
                     </form>

                </div>
              </div>
            </div>

            <div class="col-sm-6 ">
              <div class="panel panel-default lectureNotes">
                  <div class="panel-heading">Personal Notes</div>
                  <div class="panel-body">

                      <div ng-app="">
                          <!--This section allows students to write their own notes onto the lecture material -->
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
    </script>

</body>

</html>
