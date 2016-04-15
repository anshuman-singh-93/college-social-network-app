<?php

$result=array();
require_once 'functions.php';
$first_name=mysqli_real_escape_string($con,$_POST['f_name']);
	
$last_name=mysqli_real_escape_string ($con,$_POST['l_name']);
$user_name=mysqli_real_escape_string($con,$_POST['u_name']);
	
$pass=mysqli_real_escape_string ($con,$_POST['pass']);
$email=mysqli_real_escape_string($con,$_POST['email']);
	
$dept=mysqli_real_escape_string ($con,$_POST['dept']);
$gen=mysqli_real_escape_string($con,$_POST['gen']);
$school=mysqli_real_escape_string($con,$_POST['school']);
	
function is_valid_email($email)
 {
 	if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
 		return true;
	} else {
 		return false;
 	}
}

if((isset($first_name)&&!empty($first_name))&&(isset($user_name)&&!empty($user_name))&&(isset($last_name)&&!empty($last_name))&&(isset($email)&&!empty($email))&&(isset($dept)&&!empty($dept))&&(isset($pass)&&!empty($pass))&&!empty($gen))
{
	if(!is_valid_email($email))
	{
		
		$result=array('response'=>1,'email_valid'=>0,'email_exist'=>1,'user_exist'=>1);
		echo json_encode($result);
		
	}
	$q1="SELECT u_id FROM user WHERE user_name='$user_name'"; 
	$r1=mysqli_query($con,$q1);
	if(mysqli_num_rows($r1))
	{
		$result=array('response'=>1,'email_valid'=>1,'email_exist'=>1,'user_exist'=>0);
		echo json_encode($result);
		
		

	}
	else 
	{
	$q="SELECT u_id FROM user WHERE email='$email'"; 
	$r=mysqli_query($con,$q);
	if(mysqli_num_rows($r))
	{
		$result=array('response'=>1,'email_valid'=>1,'email_exist'=>0,'user_exist'=>1);
		echo json_encode($result);
		

	}
	else
	{
	
	$q2="INSERT INTO user(user_name,pass,email,f_name,l_name,gen,school,dept) VALUES ('$user_name','$pass','$email','$first_name','$last_name','$gen','$school','$dept')";
	$r=mysqli_query($con,$q2);
	session_start();
	$_SESSION['user_name']=$user_name;
	$_SESSION['pass']=$pass;
	$q3="SELECT u_id FROM user WHERE user_name='$user_name'";
	$r3=mysqli_query($con,$q3);
	$row=mysqli_fetch_assoc($r3);
	$id=$row['u_id'];
	$date = date('Y-m-d H:i:s');
	$q4="INSERT INTO track(u_id,reg_date,login_date,online) VALUES ('$id','$date','$date','$date')";
	$r4=mysqli_query($con,$q4);
		$result=array('response'=>1,'email_valid'=>1,'email_exist'=>1,'user_exist'=>1);
		echo json_encode($result);
	}
	}
	

	
	
}

else
{
		$result=array('response'=>0,'email_valid'=>0,'email_exist'=>0,'user_exist'=>0);
		echo json_encode($result);
}

?>