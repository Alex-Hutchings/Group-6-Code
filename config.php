<?php
$server = "csmysql.cs.cf.ac.uk";
$user = "group6.2015"; 
$password = "bhF54FWzyq"; 
$database = "group6_2015";
$db = mysqli_connect($server,$user,$password,$database); 
if( $db === FALSE ){
	header( "Location: error.html" ); die();
}
?>