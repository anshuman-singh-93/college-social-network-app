<?php
include_once'functions.php';
session_start();
$h_id=mysqli_real_escape_string ($con,$_POST['h_id']);

if(!empty($h_id))
{
$user=$_SESSION['user_name'];
$q="SELECT u_id FROM user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$q1="SELECT id FROM verify WHERE who_id='$u_id' AND u_id='$h_id'";
$r1=mysqli_query($con,$q1);
$num=mysqli_num_rows($r1);
if($num>0)
{
//already voted
$result=array('response'=>1,'voted'=>0);
		echo json_encode($result);

}

else
{
$s="INSERT INTO verify(u_id,who_id) VALUES('$h_id','$u_id')";
$s_r=mysqli_query($con,$s);

//if vote>5 put in is_verified table

$t="SELECT id FROM verify WHERE u_id='$h_id'";
$t_r=mysqli_query($con,$t);
$count=mysqli_num_rows($t_r);
if($count==5)
{
$in="INSERT INTO is_verified(u_id) VALUES('$h_id')";
$in_r=mysqli_query($con,$in_r);
}

$result=array('response'=>1,'voted'=>1);
		echo json_encode($result);
}


}//if not empty

else
{
$result=array('response'=>0,'voted'=>0);
		echo json_encode($result);
}
?>