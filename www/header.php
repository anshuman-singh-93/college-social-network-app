<?php
include_once 'functions.php';
session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
	if(!isset($_SESSION['user_name']))
	$_SESSION['user_name']=$_COOKIE['user_name'];
	
$user = $_SESSION['user_name'];
$loggedin = TRUE;
}
else $loggedin = FALSE;

if(!$loggedin)
header('Location: index.php');
	$date = date('Y-m-d H:i:s');

	
$q11="SELECT * FROM user WHERE user_name='$user'";
$r11=mysqli_query($con,$q11);
$row=mysqli_fetch_assoc($r11);
$current_id=$row['u_id'];
$F_NAME_OF_USER=$row['f_name'];
$L_NAME_OF_USER=$row['l_name'];

$q4="UPDATE track SET online='$date' WHERE u_id='$current_id'";
	$r4=mysqli_query($con,$q4);

?>