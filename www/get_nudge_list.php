<?php
include_once'functions.php';
session_start();



$user=$_SESSION['user_name'];
$q="SELECT u_id FROM user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$q1="SELECT * FROM nudge WHERE u_id='$u_id'";
$r1=mysqli_query($con,$q1);
$num=mysqli_num_rows($r1);
if($num==0)
{





}

else
{

while($num>0)
{
$row=mysqli_fetch_assoc($r1);
$nud_id=$row['who_id'];
$nud_date=$row['date'];

 $q5="SELECT *  FROM user WHERE u_id='$nud_id'";
		  $r5=mysqli_query($con,$q5);
		  $row_num=mysqli_fetch_assoc($r5);
		  $user_name=$row_num['user_name'];
		  $f_name=$row_num['f_name'];
		  $l_name=$row_num['l_name'];
		  
$q2="SELECT dp FROM profile_dp WHERE u_id='$nud_id'";
		  $r2=mysqli_query($con,$q2);
		  
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];

?>


<div class="comment">
  <a class="avatar" style="height:35px; width:35px;">
      <img src="<?php echo"$dp_path" ?>" width="35 !important" height="35 !important" style="position:relative;">
    </a>
    <div class="content">
     <?php  
	 echo "<a class='author' href='userprofile.php?handle="."$user_name"."'".">"."$f_name"." "."$l_name"."</a>";
	 ?>
   
        <span style="font-size:15px;">Nudged You on</span>&nbsp &nbsp<span class="date" style="font-size:15px;"><?php echo"$nud_date" ?></span>
    
   
    </div>
	</div>


<?php
$num--;
}
}//close else

?>

