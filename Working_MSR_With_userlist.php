<!doctype html>
<?php
/*
 * Group 6
 * 2016 Intelekt.
 * The "summary page" implements the summary page for each module so that users can:
 *  add their own notes to the page - assisting the learning of other students
 *  Links and pictures can be uploaded 
 *  Gives more students well read about certain topics to help other students
 *  real time collaborative editing

 * Issues to be resolved in the future:
 *    Change user list to replicate student ids that will help monitoring the system
 *   
 */
?>
<!-- See http://www.firepad.io/docs/ for detailed embedding docs. -->
<html>
<?php
session_start();
$moduleID = $_SESSION['moduleID'];
$mid = $_SESSION['moduleID'];
$sid = $_SESSION['username'];
if($_SESSION['lecturer'] == true) {
    $query = 'SELECT * FROM LECTURERS_IN_MODULE WHERE Lecturer_ID="'.$_SESSION['username'].'"';
    include_once("lectMenu.php");
}else{
    $query = 'SELECT * FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_SESSION["username"].'"';
    include_once("menu.php");
}
?>

<head>
  <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link href="masterStyle.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styleUpdate.css">
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> AJAX-->
  <meta charset="utf-8" />
  <!-- Firebase -->
  <script src="https://cdn.firebase.com/js/client/2.3.2/firebase.js"></script>

  <!-- CodeMirror -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.css" />

  <!-- Firepad -->
  <link rel="stylesheet" href="firepad.css" />
  <script src="https://cdn.firebase.com/libs/firepad/1.3.0/firepad.min.js"></script>

  <!-- Include example userlist script / CSS.
  Can be downloaded from: https://github.com/firebase/firepad/tree/master/examples/ -->
  <script src="firepad-userlist.js"></script>
  
  
</head>

<body>
  <!-- Include example userlist script / CSS-->
  <script src="firepad-userlist.js"></script>
  <link rel="stylesheet" href="firepad-userlist.css" />
  <div id = "firepad-container">
  <div id="userlist"></div>
  <div id="firepad"></div>
  </div>

<div class="container-fluid" align="center"> 

  <script>
    function init() {
      //// Initialize Firebase.
      var firepadUserID = '<?php echo $sid ?>';
      var firePadID = '<?php echo $mid ?>';
      var url = 'intellekt.firebaseio.com/firepads/';
      var store = url.concat(firePadID);
      var firepadRef = new Firebase(store);
      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad'), { lineWrapping: true });
      // Create a random ID to use as our user ID (we must give this to firepad and FirepadUserList).
      var userId = Math.floor(Math.random() * 9999999999).toString();
      //// Create Firepad (with rich text features and our desired userId).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true, userId: userId});
      //// Create FirepadUserList (with our desired userId).
      var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'),
          document.getElementById('userlist'), userId);
      //// Initialize contents.
        firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setText('Welcome to the module summary page!');
        }
      });
    }
    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = new Firebase('https://firepad.firebaseio-demo.com');
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key(); // add it as a hash to the URL.
      }
      if (typeof console !== 'undefined')
        console.log('Firebase data: ', ref.toString());
      return ref;
    }
    init();
  </script>

</body>
</html>
