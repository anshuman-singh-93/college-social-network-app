<?php
include_once"functions.php";

$wall=mysqli_real_escape_string($con,$_POST['wall_text']);
if(empty($wall))
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


if (isset($_POST['handle']))
{
	$handle = $_POST['handle'];
}

$get_handle_id="SELECT u_id FROM  user WHERE user_name='$handle'";
$h_r=mysqli_query($con,$get_handle_id);
$row=mysqli_fetch_assoc($h_r);
$handle_user_id=$row['u_id'];
$q1="SELECT id FROM USER_WALL WHERE u_id='$handle_user_id'";
$r1=mysqli_query($con,$q1);
$num=mysqli_num_rows($r1);
$num++;
	$date = date('Y-m-d H:i:s');
	
$q="SELECT u_id FROM  user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];

$q2="INSERT INTO USER_WALL(u_id,wall_id,who_id,wall_text,date) VALUES('$handle_user_id','$num','$u_id','$wall','$date')";
$r2=mysqli_query($con,$q2);
	$result=array('response'=>1);
			echo json_encode($result);
}
	
	

?>