<?php
session_start();


echo "<script>window.open('login.php?logged_out=Logged Out Successfully, Come Back Soon!','_self')</script>";

session_destroy();
?>