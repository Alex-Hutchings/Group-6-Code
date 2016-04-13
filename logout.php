<?php
//code for a logout button. Destroys the current session removing any session variables from the session array
//redirects users to the login page so they must login once again
session_destroy();
header('location:login-2.php');
?>
