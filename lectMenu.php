<?php
// This code is the systems navigation bar.
// It is specific to the lecturer users navigation with the links going to 
// their own pages that they can upload material too rather than the students view.
echo "<link rel='stylesheet' href='style.css'>";
echo"    
    <div class='container-fluid'>
        <nav class='navbar navbar-default'>
          <div class='container-fluid'>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class='navbar-header'>
                <a href='module-lect.php'><img src='logo.png'></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <form action='' method='POST'>
            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
              <ul class='nav navbar-nav intelekt-nav-left'>
                <li><a href='module-lect.php'><img src='ModulesIcon.png' width='50%'></a></li>
                <li><a href='Working_MSR_With_userlist.php'?moduleID=".$_SESSION['moduleID']."><img src='MSRicon.png' width='50%'></a></li>             
                <li><a href='listing.php'><img src='forumsicon.png' width='50%'></a></li>
                <FORM><INPUT Type='button' VALUE='Back' onClick='history.go(-1);return true;'></FORM>
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