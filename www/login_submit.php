<?php
require_once 'functions.php';
$email=mysqli_real_escape_string($con,$_POST['email']);
	
$pass=mysqli_real_escape_string ($con,$_POST['pass']);
$rem=mysqli_real_escape_string ($con,$_POST['rem']);
function is_valid_email($email)
 {
 	if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	 
 		return true;
	else 
 	
		return false;
 	
}

if(!is_valid_email($email))
{
	$result=array('response'=>0,'email_valid'=>0);
		echo json_encode($result);
		return;
}

if(!empty($email)&&!empty($pass))
{
$q="SELECT u_id FROM user WHERE email='$email' AND pass='$pass'";
$r= mysqli_query($con,$q);
if(mysqli_num_rows($r)==0)
{
	$result=array('response'=>1,'email_valid'=>0);
		echo json_encode($result);
		return;
}
else
{
$q="SELECT user_name FROM user WHERE email='$email' AND pass='$pass'";
$r= mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u=$row['user_name'];
	session_start();
	$_SESSION['user_name']=$u;
	$_SESSION['pass']=$pass;
	
	$q3="SELECT u_id FROM user WHERE user_name='$u'";
	$r3=mysqli_query($con,$q3);
	$row=mysqli_fetch_assoc($r3);
	$id=$row['u_id'];
	$date = date('Y-m-d H:i:s');
	$q4="UPDATE track SET login_date='$date' WHERE u_id='$id'";
	$r4=mysqli_query($con,$q4);
	$q5="UPDATE track SET online='$date' WHERE u_id='$id'";
	$r5=mysqli_query($con,$q5);
	if($rem==1)
	{
		setcookie('user_name',$_SESSION['user_name'],time()+864000);
	}
	$result=array('response'=>1,'email_valid'=>1);
		echo json_encode($result);
		
		
}
}

?>