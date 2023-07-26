<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com/
*/

session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: index"); // Redirecting To Home Page
}
?>