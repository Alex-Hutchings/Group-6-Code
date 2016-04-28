<?php
/*
 * Group 6
 * 2016 Intelekt.
 *
 */

/**
 * The "logout" implements the logout functionality:
 * logout functionality - destroys the session and all its variables
 */
session_start();
session_destroy();
header('location:login.php');
?>