<?php
include_once'functions.php';
session_start();
$h_id=mysqli_real_escape_string ($con,$_POST['h_id']);

if(!empty($h_id))
{
$user=$_SESSION['user_name'];
	$date = date('Y-m-d');

$q="SELECT u_id FROM user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$q1="SELECT id FROM nudge WHERE who_id='$u_id' AND date='$date' AND u_id='$h_id'";
$r1=mysqli_query($con,$q1);
$num=mysqli_num_rows($r1);
if($num>0)
{
//already nudge today try tomorrow
$result=array('response'=>1,'nudged'=>0);
		echo json_encode($result);

}

else if($num==0)
{
$s="INSERT INTO nudge(u_id,who_id,date) VALUES('$h_id','$u_id','$date')";
$s_r=mysqli_query($con,$s);



$result=array('response'=>1,'nudged'=>1);
		echo json_encode($result);
}


}//if not empty

else
{
$result=array('response'=>0,'nudged'=>0);
		echo json_encode($result);
}
?>