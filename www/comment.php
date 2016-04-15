<?php
include_once"functions.php";



$cmnt=mysqli_real_escape_string($con,$_POST['cmnt']);
$wall_id=mysqli_real_escape_string($con,$_POST['wall_id']);
$u_id=mysqli_real_escape_string($con,$_POST['u_id']);
if(empty($cmnt))
{
	$result=array('response'=>0);
			echo json_encode($result);
}			
			
	$date = date('Y-m-d H:i:s');
	
	//check number of comment 
	
$chk="SELECT comment_id FROM wall_comment WHERE wall_id='$wall_id' AND who_id='$u_id' AND u_id='$u_id'";
$chk_r=mysqli_query($con,$chk);
$chk_num=mysqli_num_rows($chk_r);
$chk_num++;
	//number of comment
$c_post="INSERT INTO wall_comment(wall_id,u_id,comment_id,who_id,comment_text,date) VALUES('$wall_id','$u_id','$chk_num','$u_id','$cmnt','$date')";
$c_post_r=mysqli_query($con,$c_post);
	$result=array('response'=>1);
			echo json_encode($result);





?>