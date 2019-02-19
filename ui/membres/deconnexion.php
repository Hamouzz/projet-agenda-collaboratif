<?php
session_start();
$_session['user']="";
session_destroy(); 
header('Location: ../index.php');
?>