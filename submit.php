<?php

  // Start/continue the session.
  session_start();
  include_once("config.php");
  // User must be authenticated to post.
  // $testUID = 1445555;
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  else die("Error: User not authenticated.");

  // *** MYSQL STUFF ***

  // Connect to the database. (Left here for testing purposes. Put these into an external file, e.g. config.php.)

  // *** END MYSQL STUFF ***

 if (isset($_GET['mID'])) {
    // We have to know this in all cases. Error out if not set.
    // Any way this can be submitted via POST, so that there isn't any requirement for GET arguments?
    $moduleID = $_GET['mID'];
 }
 else die("Error: No module ID.");

 if (isset($_GET['pID'])) {
    // This might not be set if the user is posting a new topic.
    $postID = $_GET['pID'];
 }

  function post($uid, $mid, $title, $body) {

  	$uid = mysqli_real_escape_string($GLOBALS['db'], $uid);
  	$mid = mysqli_real_escape_string($GLOBALS['db'], $mid);
  	$title = mysqli_real_escape_string($GLOBALS['db'], $title);
  	$body = mysqli_real_escape_string($GLOBALS['db'], $body);

  	$query = "INSERT INTO TOPIC (User_ID, Module_ID, Subject, Body, Topic_DATE)
  				    VALUES ('$uid', '$mid', '$title', '$body', NOW())";

  	if ($result = mysqli_query($GLOBALS['db'], $query)) {

      $newPostID = mysqli_insert_id($GLOBALS['db']);
      mysqli_close($GLOBALS['db']);
      // Redirects to new topic page. Is this the best way to redirect? Or would using JS be better? (Wouldn't work for people with JS turned off.)
      header("Location: viewTopic.php?mID=".$mid."&pID=".$newPostID);
      die();
  	}
  	else {
      echo (mysqli_error($GLOBALS['db']));
  	}
  }

  function postReply($uid, $mid, $pid, $replyBody) {

    $uid = mysqli_real_escape_string($GLOBALS['db'], $uid);
    $mid = mysqli_real_escape_string($GLOBALS['db'], $mid);
    $pid = mysqli_real_escape_string($GLOBALS['db'], $pid);
    $replyBody = mysqli_real_escape_string($GLOBALS['db'], $replyBody);

    $query = "INSERT INTO REPLY (User_ID, Module_ID, Topic_ID, Message, Reply_DATE)
              VALUES ('$uid', '$mid', '$pid', '$replyBody', NOW())";

    if ($result = mysqli_query($GLOBALS['db'], $query)) {
      mysqli_close($GLOBALS['db']);
      // Redirects back to topic page. Is this the best way to redirect? Or would using JS be better? (Wouldn't work for people with JS turned off.)
      header("Location: viewTopic.php?mID=".$mid."&pID=".$pid);
      die();
    }
    else {
      echo (mysqli_error($GLOBALS['db'])); 
    }
  }


/*  function editTopic($uid, $mid, $pid, $newBody) {
    // Must amend DATE to NOW().
    if (is_null($pid)) {
      return;
    }

  }

  function editReply($uid, $mid, $pid, $rid, $newReplyBody) {
    // Must amend DATE to NOW().
    if (is_null($pid)) {
      return;
    }

  }

  function deleteTopic($uid, $mid, $pid) {
    if (is_null($pid)) {
      return;
    }
  }

  function deleteReply($uid, $mid, $pid, $rid) {
    if (is_null($pid)) {
      return;
    }
  }

  function likeTopic($uid, $mid, $pid, $upOrDown) {
    if (is_null($pid)) {
      return;
    }
    // How will checking be implemented in order to make sure that the same user cannot vote/like twice?
    // Will there be a requirement for a separate "who voted/liked" table within the database in order to keep track?
  }*/


  if ((isset($_POST["title"])) && (isset($_POST["body"]))) {
  	post($username, $moduleID, $_POST["title"], $_POST["body"]);
  }
  else if (isset($_POST["reply"])) {
    postReply($username, $moduleID, $postID, $_POST["reply"]);
  }

  mysqli_close($con);

?>