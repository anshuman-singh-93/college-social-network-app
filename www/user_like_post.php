<?php
include_once"functions.php";

//u_id is the handle of url

$wall_id=mysqli_real_escape_string($con,$_POST['wall_id']);
$u_id=mysqli_real_escape_string($con,$_POST['u_id']);

$who_id=mysqli_real_escape_string($con,$_POST['who_id']);

$q="SELECT id FROM wall_like WHERE wall_id='$wall_id' AND u_id='$u_id' AND who_liked='$who_id'";
$r=mysqli_query($con,$q);
$num=mysqli_num_rows($r);
if($num>0)
{
	$result=array('can_like'=>0);
			echo json_encode($result);

}
else
{
$q="SELECT user_name FROM  user WHERE u_id='$who_id'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_name=$row['user_name'];
$q1="INSERT INTO wall_like(wall_id,u_id,who_liked,who_user) VALUES('$wall_id','$u_id','$who_id','$u_name')";
$r1=mysqli_query($con,$q1);
//count total like and save in total_like table

$q="SELECT id FROM wall_like WHERE wall_id='$wall_id' AND u_id='$u_id'";
$r=mysqli_query($con,$q);
$num=mysqli_num_rows($r);

$q2="INSERT INTO total_wall_like(u_id,wall_id,like_count) VALUES('$u_id','$wall_id','$num')";
$r2=mysqli_query($con,$q2);
   $result=array('can_like'=>1);
			echo json_encode($result);

}

?>