<?php
session_start();


echo "<script>window.open('login.php?logged_out=Logged out successfully!','_self')</script>";

session_destroy();
?>