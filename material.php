<?php session_start();
include_once("config.php");
include_once("menu.php");

$query = "SELECT * FROM MATERIAL WHERE Material_ID = '".$_GET['matID']."'";
$checkMaterialID = mysqli_query($db, $query);
if(mysqli_num_rows($checkMaterialID) <= 0){
    header('location: error.html');}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
  <!-- Firebase -->
  <script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>

  <!-- CodeMirror -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.2.0/codemirror.css" />

  <!-- Firepad -->
  <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.2.0/firepad.css" />
  <script src="https://cdn.firebase.com/libs/firepad/1.2.0/firepad.min.js"></script>

  <style>
    html { height: 100%; }
    body { margin: 0; height: 100%; position: relative; }
      /* Height / width / positioning can be customized for your use case.
         For demo purposes, we make firepad fill the entire browser. */
    #firepad-container {
      width: 50%;
      height: 50%;
      position: absolute;
      left: 50%;
      top: 70%;
      z-index: 100;
    }
  </style>
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
<div id="firepad-container"></div>
<?php $id= $_SESSION['username'];?>
  <script>
    function init() {
      //// Initialize Firebase.
      //var firepadRef = getExampleRef();
      // TODO: Replace above line with:
      var firePadID = '<?php echo $id ?>';
      var url = 'intellekt.firebaseio.com/firepads/';
      var store = url.concat(firePadID);
      var firepadRef = new Firebase(store);
      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), { lineWrapping: true });
      //// Create Firepad (with rich text toolbar and shortcuts enabled).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true });
      //// Initialize contents.
      firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setHtml('<span style="font-size: 24px;">Group Six <span style="color: red">MSR Page!</span></span><br/><br/>Collaborative-editing made easy.\n');
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
      return ref;
    }
    init();
  </script>
<?php
$_SESSION['username'] = $_SESSION['username'];
/*if(!isset($moduleID)){
  $moduleID = $_GET['id'];
}
else{
  $_SESSION['moduleID'] = $moduleID;
}

$_SESSION['moduleID'] = $moduleID;*/
?>

        <?php
        $materialQuery = 'SELECT * FROM MATERIAL WHERE Material_ID="'.$_GET['matID'].'"';
        $result = mysqli_query($db, $materialQuery);
        while ($row = mysqli_fetch_assoc($result)){
        $materialTitle = $row['Material_TITLE'];
        $file = $row['File'];
        //$_SESSION['materialID'] = $row['Material_ID'];
        echo "<div class='modal-body'>
       <h4 class='modal-title'> ".$materialTitle." </h4>
          <div>
              <iframe src=".$file." width='80%;' height='350px;'></iframe>
          </div>";
        }
        $_SESSION['material'] = $_GET['matID'];
        
          echo "
            <div class='col-sm-6 '>
              <div class='panel panel-default lectureComments'>
                 <div class='panel-heading'>Comments</div>
                 <div class='panel-body'>";
                  $query = 'SELECT * FROM MATERIAL_COMMENTS WHERE Material_ID="'.$_GET['matID'].'"';
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
                     <form id="formComments" action="comments.php" method="post">
                         <input type="text" name="comment" id="comment" placeholder="Enter comment">
                         <button type="submit">Post Comment</button>
                     </form>
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
      </div>

    </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
    </script>

</body>

</html>
