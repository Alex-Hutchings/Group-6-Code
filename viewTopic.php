<?php
  
  // ND.
  // Start/continue the session.
  session_start();
  include_once("config.php");
  include_once("menu.php");
  // Connect to the database. (Left here for testing purposes. Put these into an external file, e.g. config.php.)

  //// User must be logged in to view & to post?
  // if (!isset($_SESSION['username'])) {
    //// Develop this later - maybe redirect to an error page, or a page showing no content ("access denied"?)
    //die("User not logged in.");
  //}

  // For this page to work, GET variables must be such that website.com/forumNew2.php?mID=[moduleID]&pID=[postID].
  if (isset($_GET['mID'])) {
    $moduleID = mysqli_real_escape_string($db, $_GET['mID']); // website.com/forumNew2.php?mID=CM1000
  }
  else die("Error: No module ID.");

  if (isset($_GET['pID'])) {
    $postID = mysqli_real_escape_string($db, $_GET['pID']); // website.com/forumNew2.php?pID=1
  }
  else die("Error: No post ID.");

  $query = "SELECT MODULE.Module_ID, MODULE.Module_TITLE, USER.Forename, USER.Surname, TOPIC.* 
            FROM MODULE, TOPIC, USER 
            WHERE TOPIC.User_ID = USER.User_ID 
            AND MODULE.Module_ID = TOPIC.Module_ID 
            AND TOPIC.Module_ID = '$moduleID' 
            AND TOPIC.Topic_ID = $postID";
  
  // If no results are returned (null) then the module ID must be invalid - kill the script/redirect to error.
  // Can't use mysqli_num_rows when checking for module validity (can be used for post validity though) - what if the module exists, but there is nothing in it?
  if ($result = mysqli_query($db, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
      $moduleName = $row["Module_TITLE"];
      $posterUID = $row["User_ID"];
      $posterName = $row["Forename"]." ".$row["Surname"];
      $postDate = $row["Topic_DATE"];
      $postSubject = $row["Subject"];
      $postBody = $row["Body"];
    }
  }
  else echo mysqli_error($db);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="forums.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Intellekt Forum - <?php echo "$moduleName - \"$postSubject\""?></title>

<style type="text/css" media="all">
  @import "css/widgEditor.css";
</style>
    <!-- Bootstrap -->
  <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- Hide the 'reply' button -->
    <script>
    $(document).ready(function() {$('#replyQ').click(function() {
            $('#experimentInfo').show();
            $('#replyQ').hide();
         });
      });
        
    $(document).ready(function() {$('.answerQ').click(function() {
            $('#experimentInfo').hide();
            $('#replyQ').show();
         });
      });
    </script>

  </head>
  <body>
    <div class="container">
        <div class="well">
        <!-- Had to turn the "button" below into an anchor (a), otherwise it won't be a link (unless I use JS, which I'd rather avoid). However, this seems to have broken the layout as it no longer appears as a button. - Nathan -->
        <a class="btn btn-xs" id="back" href=<?php echo "\"listing.php?mID=".$moduleID."\""; ?> >Back</a> 
        <span id='topic'>Forum - <?php echo $moduleName; ?></span>
        <button type="button" class="btn btn-xs" id="edit">Edit</button><br><br>

<p id="demo">User <?php echo "<b>$posterName</b> ($posterUID) posts: <i>\"$postSubject\"</i> ($postDate) "; ?> </p>
    <div class="responsebody">
        <p>
          " <?php echo nl2br($postBody); // Converts newline characters to html "br" (line break) tags. ?> " 
        </p>
      <br>
      <button type="button" class="btn btn-xs" id="replyQ">Reply</button>
    </div>
    
    </div>
    <br>


  <div class="containeranswer">
    <?php

    $query = "SELECT USER.Forename, USER.Surname, REPLY.Reply_ID, REPLY.User_ID, REPLY.Vote, REPLY.Message, REPLY.Reply_DATE 
              FROM USER, REPLY 
              WHERE USER.User_ID = REPLY.User_ID 
              AND REPLY.Module_ID = '$moduleID'
              AND REPLY.Topic_ID = $postID";

    if ($result = mysqli_query($db, $query)) {
      while ($row = mysqli_fetch_assoc($result)) {
        $replierName = $row["Forename"]." ".$row["Surname"];

        echo "<div class='well'>";
          echo "<div>";
            echo "<span style='margin: 19px;'><b>".$replierName."</b> (".$row['User_ID'].") </span>";
            echo "<span style='margin-left: 66%;'>".$row['Reply_DATE']."</span>";
         // echo "<span style='margin-left: 3%;'>time</span>";
          echo "</div>";
          echo "<p style='margin-left: 2%;'>";
            echo nl2br($row['Message']); // Converts newline characters to html "br" (line break) tags.
          echo "</p>";
        echo "</div>";
      }
    }
    else echo mysqli_error($db);

    ?>
    <!-- John/Tori: Doesn't look like you should need another <div class="containeranswer">...</div> for each answer, am I right? One "containeranswer" should do it. -Nathan -->
    </div>


      </div>
    </div> <!-- What's this closing div tag doing here? -Nathan -->
</div> <!-- What's this closing div tag doing here? -Nathan -->

<div class="container" id="experimentInfo" style="display:none;">

  <!-- Make this section available to lecturers only. --> 
  <!-- \n\n' + document.getElementById('noise').value); (Old JavaScript for return confirm) -->
  <form method="post" action=<?php echo "\"submit.php?mID=".$moduleID."&pID=".$postID."\"" ?> onsubmit="return confirm('Are you sure you want to submit this post?')">
      <fieldset>
        <label for="noise">
          Post a reply:
        </label> 
        <br>
        <textarea id="noise" name="reply" class="widgEditor nothing" cols="80" rows="3" placeholder="Enter your reply..."></textarea>
      </fieldset>
      <fieldset class="submit">
        <input id="submitAns" type="submit" value="Submit" class="answerQ" name="submitPost"/>
        <input type="button" value="Cancel" class="answerQ">
      </fieldset>
    </form>

</div>
<script type="text/javascript" src="scripts/widgEditor.js"></script>

  </body>
</html>