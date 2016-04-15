<?php
error_reporting(0);
$dbhost = 'localhost';
$dbname = 'college_mate'; 
$dbuser = 'root';
$pass="";
$con=mysqli_connect($dbhost, $dbuser, $pass,$dbname) ;
if(!$con)
echo"could not connect to mysql"." ".mysqli_connect_error()."\n"; 
mysqli_select_db($con,$dbname) or die(mysql_error());

function destroySession()
{
if (isset($_SESSION['user_name']) || isset($_COOKIE['user_name']))
setcookie('user_name', $_SESSION['user_name'], time()-25920000);
session_destroy();
header('Location: index.php');}
function secure_data($var)
{
	$var=trim($var);
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return mysql_real_escape_string($var);
}
?>