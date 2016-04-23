<!DOCTYPE html>
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
<?php
session_start();
include_once('config.php');
include_once('lectMenu.php');

$q1terribleCount = 0;
$q1BadCount = 0;
$q1OkCount = 0;
$q1goodCount = 0;
$q1Excellent = 0;
$q2terribleCount = 0;
$q2BadCount = 0;
$q2OkCount = 0;
$q2goodCount = 0;
$q2Excellent = 0;
$q3terribleCount = 0;
$q3BadCount = 0;
$q3OkCount = 0;
$q3goodCount = 0;
$q3Excellent = 0;
$DDisagreeCount = 0;
$disagree= 0;
$na = 0;
$agree = 0;
$dAgreeCount = 0;
$ten = 0;
$thirty = 0;
$fifty = 0;
$seventy =0;
$ninety =0;
$command = 'SELECT * FROM MODULE_FEEDBACK WHERE Module_ID ="'.$_SESSION['moduleID'].'"';
$result = mysqli_query($db, $command);
while($row1 = mysqli_fetch_assoc($result)){
	$Q1 = $row1['Q1'];
	$Q2 = $row1['Q2'];
	$Q3 = $row1['Q3'];
	$Q4 = $row1['Q4'];
	$Q5 = $row1['Q5'];
	$AdditionalComments = $row1['Additional_COMMENTS'];
    $array[] = $AdditionalComments;
    //$arrayFeedback = print_r(array_unique($row1));

    if($Q1 == "terrible"){
        $q1terribleCount = $q1terribleCount+1;
    }
   if($Q1 == "bad"){
        $q1BadCount = $q1BadCount+1;
    }
    if($Q1 == "ok"){
        $q1OkCount = $q1OkCount+1;
    }
    if($Q1 == "good"){
        $q1goodCount = $q1goodCount+1;
    }
    if($Q1 == "excellent"){
        $q1Excellent = $q1Excellent+1;
    }
    if($Q2 == "terrible"){
        $q2terribleCount = $q2terribleCount+1;
    }
   if($Q2 == "bad"){
        $q2BadCount = $q2BadCount+1;
    }
    if($Q2 == "ok"){
        $q2OkCount = $q2OkCount+1;
    }
    if($Q2 == "good"){
        $q2goodCount = $q2goodCount+1;
    }
    if($Q2 == "excellent"){
        $q2Excellent = $q2Excellent+1;
    }
    if($Q3 == "terrible"){
        $q3terribleCount =  $q3terribleCount+1;
    }
   if($Q3 == "bad"){
        $q3BadCount = $q3BadCount+1;
    }
    if($Q3 == "ok"){
        $q3OkCount = $q3OkCount +1;
    }
    if($Q3 == "good"){
        $q3goodCount = $q3goodCount+1;
    }
    if($Q3 == "excellent"){
        $q3Excellent = $q3Excellent+1;
    }
    if($Q4 == "DDisagree"){
        $DDisagreeCount = $DDisagreeCount+1;
    }
    if($Q4 == "disagree"){
        $DisagreeCount = $DisagreeCount+1;
    }
    if($Q4 == "N/A"){
        $na = $na+1;
    }
    if($Q4 == "agree"){
        $agree = $agree+1;
    }
    if($Q4 == "DAgree"){
        $dAgreeCount = $dAgreeCount+1;
    }
    if($Q5 == "10"){
        $ten = $ten+1;
    }
    if($Q5 == "30"){
        $thirty = $ten+1;
    }
    if($Q5 == "50"){
        $fifty = $ten+1;
    }
    if($Q5 == "70"){
        $seventy = $ten+1;
    }
    if($Q5 == "90"){
        $ninety = $ten+1;
    }
   
	echo "<br>";

}
echo "The results for question one are: ", "terrible = ", $q1terribleCount, " & bad = ", $q1BadCount, " & ok = ", $q1OkCount, "& good =" ,$q1goodCount, "& excellent =", $q1Excellent ,"<br>";
echo "The results for question two are: ", "terrible = ",$q2terribleCount, "& bad = ",$q2BadCount, "& ok = ",$q2OkCount, "& good =" ,$q2goodCount, "& excellent =",$q2Excellent,"<br>";
echo "The results for question three are: ","terrible = ", $q3terribleCount,"& bad = ", $q3BadCount,"& ok = ", $q3OkCount, "& good =" ,$q3goodCount, "& excellent =",$q3Excellent,"<br>";
echo "The results for question four are: ", "Definitely Disagree =", $DDisagreeCount, "& Disagree = ", $disagree, "& Neither agree or disagree = ", $na, "& agree =", $agree, "& Definitely Agree = ",$dAgreeCount,"<br>";
echo "The results for question five are: ", "0-20% =", $ten, " & 20-40% = ",  $thirty, " & 40-60% = ", $fifty, "& 60-80% = ",$seventy, "& 80-100% = ",$ninety,"<br>";
echo "<br>";
echo "Some additional comments from students: <br>";
for ($key_Number = 0; $key_Number < sizeof($array); $key_Number++) {
print $array[$key_Number];
echo "<br>";

}

?>


