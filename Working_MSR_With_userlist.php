<!doctype html>
<!-- See http://www.firepad.io/docs/ for detailed embedding docs. -->
<html>
<?php
session_start();
$mid = $_SESSION['moduleID'];
$sid = $_SESSION['username'];
if($_SESSION['lecturer'] == true) {
    $query = 'SELECT * FROM LECTURERS_IN_MODULE WHERE Lecturer_ID="'.$_SESSION['username'].'"';
    $page = 'module.php';
}else{
    $query = 'SELECT * FROM STUDENT_TAKES_MODULE WHERE Student_ID="'.$_SESSION["username"].'"';
    $page = 'module.php';
}
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
                <li><a href=".$page."><img src='ModulesIcon.png' width='5%'></a></li>
                <li><a href='forumNew.php'><img src='forumsicon.png' width='5%'></a></li>
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

<head>
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
