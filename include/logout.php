<?php   
include('connection.php');
session_start();

if(session_destroy()){
unset($_SESSION['username']);
header("Location: ../index.php");
exit();
}
