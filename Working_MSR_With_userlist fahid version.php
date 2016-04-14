<!doctype html>
<!-- See http://www.firepad.io/docs/ for detailed embedding docs. -->
<html>
<?php
session_start();
echo "Welcome to the ".$_SESSION['moduleID']." Module Summary page. Feel free to add notes " .$_SESSION['username']."";
?>
<head>
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
  <link rel="stylesheet" href="firepad-userlist.css" />
</head>

<body>
  <div id="userlist"></div>
  <div id="firepad"></div>
  </div>

<div class="container-fluid" align="center">
  <script>
    function init() {
      //// Initialize Firebase.
      var firepadRef = new Firebase('intellekt.firebaseio.com/firepads/shouldSaveNow');
      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad'), { lineWrapping: true });
      // Create a random ID to use as our user ID (we must give this to firepad and FirepadUserList).
      var userId = Math.floor(Math.random() * 99999999).toString();
      //// Create Firepad (with rich text features and our desired userId).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true, userId: userId});
      //// Create FirepadUserList (with our desired userId).
      var firepadUserList = FirepadUserList.fromDiv(firepadRef.child('users'),
          document.getElementById('userlist'), userId);
      //// Initialize contents.
      firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setText('Check out the user list to the left!');
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
  </div>

</body>
<a href='login-2.php'><button class='btn-md'>Log out</button></a>
</html>