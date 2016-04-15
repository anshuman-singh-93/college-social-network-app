<?php
include_once"functions.php";

$lost_id=mysqli_real_escape_string($con,$_POST['found_id']);
$u_id=mysqli_real_escape_string($con,$_POST['u_id']);
$q="SELECT * FROM  user WHERE u_id='$u_id'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$f_name=$row['f_name'];
		$l_name=$row['l_name'];
$com="SELECT * FROM found_comment WHERE lost_id='$lost_id' AND who_id='$u_id' ORDER BY date DESC LIMIT 1";
$com_r=mysqli_query($con,$com);
$is_any_commented=mysqli_num_rows($com_r);
$c_row=mysqli_fetch_assoc($com_r);
$who_commented=$c_row['who_id'];
$comment_id=$c_row['comment_id'];

$c_date=$c_row['date'];
$comment=$c_row['comment_text'];
//get dp who commented
$s1="SELECT dp FROM profile_dp WHERE u_id='$who_commented'";
$s_r1=mysqli_query($con,$s1);
$p_r1=mysqli_fetch_assoc($s_r1);
$c_path=$p_r1['dp'];

 




?>

 <div class="comment" comment_id2="<?php echo"$comment_id"?>">
    <a class="avatar" style="height:35px; width:35px;">
      <img src="<?php echo"$c_path" ?>" width="35 !important" height="35 !important" style="position:relative;">
    </a>
    <div class="content">
      <a class="author"><?php echo"$f_name  $l_name" ?></a>
      <div class="metadata">
        <span class="date"><?php echo"$c_date" ?></span>
      </div>
      <div class="text">
        <?php echo"$comment" ?>
      </div>
   
    </div>
  </div>