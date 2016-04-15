<?php
include_once"functions.php";

$lost_text=mysqli_real_escape_string($con,$_POST['lost_text']);
if(empty($lost_text))
{
	$result=array('response'=>0);
			echo json_encode($result);

}


else
{

session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
	if(!isset($_SESSION['user_name']))
	$_SESSION['user_name']=$_COOKIE['user_name'];
	
$user = $_SESSION['user_name'];
}
	$date = date('Y-m-d H:i:s');
$q="SELECT u_id FROM  user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];

$q2="INSERT INTO found(lost_text,who_id,date) VALUES('$lost_text','$u_id','$date')";
$r2=mysqli_query($con,$q2);
	$result=array('response'=>1);
			echo json_encode($result);
}
	
	

?>