<?php
  
  // ND.
  // Start/continue the session.
  session_start();
  $moduleID = $_SESSION['moduleID'];
  include_once("config.php");
  if($_SESSION['lecturer'] == true) {
    $query = 'SELECT * FROM LECTURERS_IN_MODULE WHERE Lecturer_ID="'.$_SESSION['username'].'"';
    include_once("lectMenu.php");

}else{
    $query = 'SELECT * FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_SESSION["username"].'"';
    include_once("menu.php");
}
  // Connect to the database. (Left here for testing purposes. Put these into an external file, e.g. config.php.)

  //// User must be logged in to view & to post.
  // if (!isset($_SESSION['username'])) {
    //// Develop this later - maybe redirect to an error page, or a page showing no content ("access denied"?)
    //die("User not logged in.");
  //}

  // For this page to work, GET variables must be such that website.com/forumNew.php?mID=[moduleID].
  if (isset($_SESSION['moduleID'])) {
    $moduleID = mysqli_real_escape_string($db, $_SESSION['moduleID']); // website.com/forumNew2.php?mID=CM1000
  }
else{
  header('location: error.html');
}// REDIRECT TO ERROR PAGE!

  // If no results are returned (null) then the module ID must be invalid - kill the script/redirect to error.
  $query = "SELECT Module_TITLE FROM MODULE WHERE Module_ID = '$moduleID'";

  if ($result = mysqli_query($db, $query)) {
    if (mysqli_num_rows($result) >= 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        $moduleName = $row["Module_TITLE"];
      }
    }
    else{
  header('location: error.html');
} //REDIRECT TO ERROR PAGE!
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="forums.css">

	<title>Intellekt Forum - <?php echo $moduleName; ?> </title>

	<!--  -->

	<style type="text/css" media="all">
  @import "forumCSS/widgEditor.css";
</style>

</head>

<body>

	<div class="container">
        <div class="well">
        <h3> Forum - <span><?php echo $moduleName; ?></span> 
          <button type="button" class="btn btn-md askbtn" data-toggle="modal" data-target="#askModel" data-backdrop="static" data-keyboard="false">Ask a new question</button></h3>
          <br>

        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-7">
              <?php

                // ND.

                // Use LIMIT for pagination (if we have time to implement pagination). Somehow must ORDER BY Reply_DATE and Topic_DATE (descending, whichever is latest) without duplicating columns...
                $query = "SELECT Topic_ID, Subject FROM TOPIC WHERE Module_ID = '$moduleID' ORDER BY Topic_DATE DESC";

                if (!$result = mysqli_query($db, $query)) {
                  echo mysqli_error($db);
                }

                if (mysqli_num_rows($result) >= 1) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<p><a href='viewTopic.php?mID=".$moduleID."&pID=".$row['Topic_ID']."''>".mb_strimwidth($row['Subject'], 0, 40, "...")."</a></p>";
                  }
                }
                else echo "<p>There are no topics. Create one by using the button located above.</p>";

              ?>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-3">
              <?php

                $query = "SELECT Topic_DATE FROM TOPIC WHERE Module_ID = '$moduleID' ORDER BY Topic_DATE DESC";

                if (!$result = mysqli_query($db, $query)) {
                  echo mysqli_error($db);
                }

                if (mysqli_num_rows($result) >= 1) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<p>".$row['Topic_DATE']."</p>";
                  }
                }

              ?>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-2">
              <?php

                $query = "SELECT Topic_ID FROM TOPIC WHERE Module_ID = '$moduleID' ORDER BY Topic_DATE DESC";

                if (!$result = mysqli_query($db, $query)) {
                  echo mysqli_error($db);
                }

                if (mysqli_num_rows($result) >= 1) {
                  while($row = mysqli_fetch_assoc($result)) {
                    // Needs implementing - href to submit.php, send like variable in POST.
                    // Ideally, this needs to be done in JS - with the button becoming depressed and the text "Liked" instead of "Like" being displayed.
                    echo "<button type='button' class='btn btn-xs forumlike'>Like</button> <br>";
                  }
                }

              ?>
            </div>

        </div>
        </div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
     <!-- Modal -->
  <div class="modal fade" id="askModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ask a Question</h4>
        </div>
        <div class="modal-body">
          <div id="experimentInfo">

  <form method="post" action=<?php echo "\"submit.php?mID=".$moduleID."\"" ?> onsubmit="return confirm('Do you really want to post the following topic?\n\n' + document.getElementById('title').value);">
  <div class="input-group input-group-lg">
      <input type="text" name="title" class="form-control" placeholder="Question Title" aria-describedby="sizing-addon1"/>
    </div>
      <fieldset>
        <br>
        <textarea id="noise" name="body" class="widgEditor nothing" cols="60" rows="3" placeholder="Add your question here..."></textarea>
      </fieldset>
  </div>
        </div>
        <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-default"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  </form>

<!--toolscript -->
<script type="text/javascript" src="scripts/widgEditor.js"></script>

</body>

</html>