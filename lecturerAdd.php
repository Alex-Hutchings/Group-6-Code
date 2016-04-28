<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="icon.ico"/>
    <title>Admin Page</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link href="masterStyle.css" rel="stylesheet">
</head>
<body style="background:#eee;">
    <div class="container">
    	<br/>
        <br/>
  		<div class="row">
  			<div class="col-md-3"></div>
  			<div class="col-md-6">
  				<div class="panel panel-default">
    				<div class="page-header">
                		<center><img id="logo" src="logo.png" width="275" alt="logo"/></center>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form"  id="lAdder" name ="lAdder" method="post" action="addLecturer.php" >
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="LID">Lecturer ID: </label>
						    <div class="col-sm-10">
						      <input class="form-control" type="text" name="LID" id="LID" placeholder="Enter leturer ID">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="name">Lecturer First Name: </label>
						    <div class="col-sm-10"> 
						      <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
						    </div>
						  </div>
  						 <div class="form-group">
						    <label class="control-label col-sm-2" for="lname">Lecturer Last Name: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="lname" id="lname" class="form-control" placeholder="Enter last name">
						    </div>
						  </div>
						 <div class="form-group">
						    <label class="control-label col-sm-2" for="email">Lecturer Email Address: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="email" id="email" class="form-control" placeholder="Enter email">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2" for="office">Lecturer Office: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="office" id="office" class="form-control" placeholder="Enter office">
						    </div>
						  </div>
  						  <div class="form-group">
						    <label class="control-label col-sm-2" for="mod">Module Code: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="mod" id="mod" class="form-control" placeholder="Enter module">
						    </div>
						  </div>
  						  <div class="form-group">
						    <label class="control-label col-sm-2" for="title">Module Title: </label>
						    <div class="col-sm-10"> 
						      <input type="text"name="title" id="title" class="form-control" placeholder="Enter title">
						    </div>
						  </div>
						  <div class="form-group"> 
						    <div class="col-sm-offset-5 col-sm-10">
						      <button type="submit" name="add" id="add" value="add" class="btn btn-default">Submit</button>
						    </div>
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <center><a href="lecturerMenu.html">Back</a><br><br>
        <a href="studentMenu.html">Switch to student details</a><br><br><br><br>
        <a href="login.php" style="color:black;"><button class="btn btn-md">Log out</button></a><center>
      </div>
    </div>
    </div>
	<br/>
</body>
</html>