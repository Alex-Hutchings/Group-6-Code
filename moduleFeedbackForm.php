<!DOCTYPE html>
<?php session_start() ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

    <title>Module Feedback</title>

    <!--  -->

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
</script>
<!--creates the navbar and its relevant links -->
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
                <span><?php echo $_SESSION['username']?></span>
                <a href='logout.php'><button>Log out</button></a>
              </div>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>
    
<!--Form for dealing the feedback -->
    <div>

    	<form class="questionForm" action = "moduleFeedback.php" method="POST" onSubmit="alerts()">
             <h2><?php echo $_SESSION['moduleID']?>: Module Feedback</h2>
    	<div class="question">
    		Question1: How would you rate the lecturers for this module?<br>
    		<input type="radio" name="question1" id="question1Ans1" value="terrible" checked>Terrible
    		<input type="radio" name="question1" id="question1Ans2" value="bad">Bad
    		<input type="radio" name="question1" id="question1Ans3" value="ok">Ok
    		<input type="radio" name="question1" id="question1Ans4" value="good">Good
    		<input type="radio" name="question1" id="question1Ans5" value="excellent">Excellent<br><br>
    	</div>
    	<div class="question">
    		Question2: How would you rate the module material provided to you?<br>
    		<input type="radio" name="question2" id="question2Ans1" value="terrible" checked>Terrible
    		<input type="radio" name="question2" id="question2Ans2" value="bad">Bad
    		<input type="radio" name="question2" id="question2Ans3" value="ok">Ok
    		<input type="radio" name="question2" id="question2Ans4" value="good">Good
    		<input type="radio" name="question2" id="question2Ans5" value="excellent">Excellent<br><br>
    	</div>

    	<div class="question">
    		Question3: How would you rate the module lab classes?<br>
    		<input type="radio" name="question3" id="question3Ans1" value="terrible" checked>Terrible
    		<input type="radio" name="question3" id="question3Ans2" value="bad">Bad
    		<input type="radio" name="question3" id="question3Ans3" value="ok">Ok
    		<input type="radio" name="question3" id="question3Ans4" value="good">Good
    		<input type="radio" name="question3" id="question3Ans5" value="excellent">Excellent<br><br>
    	</div>

    	<div class="question">
    		Question 4: Was the lecture material covered in sufficient detail?<br>
    		<input type="radio" name="question4" id="question4Ans1" value="DDisagree" checked>Definitely Disagree
    		<input type="radio" name="question4" id="question4Ans2" value="disagree">Disagree
    		<input type="radio" name="question4" id="question4Ans3" value="N/A">Neither Agree or Disagree
    		<input type="radio" name="question4" id="question4Ans4" value="agree">Agree
    		<input type="radio" name="question4" id="question4Ans5" value="DAgree">Definitely Agree<br><br>  		
    	</div>

    	<div class="question">
    		Question 5: What percentage of the classes provided did you attend?<br>
    		<input type="radio" name="question5" id="question5Ans1" value="10" checked>0-20%
    		<input type="radio" name="question5" id="question5Ans2" value="30">20-40%
    		<input type="radio" name="question5" id="question5Ans3" value="50">40-60%
    		<input type="radio" name="question5" id="question5Ans4" value="70">60-80%
    		<input type="radio" name="question5" id="question5Ans5" value="90">80-100%<br><br>
    	</div>

    	<div class="question">
    		Any other comments please write them below<br>
    		<textarea rows="5" cols="30" name="additionalComments"></textarea><br>
    		<input type="Submit" name="feedbackButton" value="Submit Answers">
    	</div>
    	</form>
    </div>

<script src="alerts.js" type="text/javascript"></script>
</body>
</html>
