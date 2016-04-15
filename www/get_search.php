
<?php
include_once "functions.php";

$school=array();
$dept=array();

$gen=array();
	if (in_array('soe', $_POST['id'])) 
	   $school[0]="'soe'";
	  	if (in_array('shss', $_POST['id'])) 
    $school[1]="'shss'";
	  
	  	if (in_array('sms', $_POST['id'])) 
   $school[2]="'sms'";
	  
	  	if (in_array('sos', $_POST['id'])) 
   $school[3]="'sos'";

  //department
   	if (in_array('cse', $_POST['id'])) 
 $dept[0]="'cse'";

   	if (in_array('ece', $_POST['id'])) 
 $dept[1]="'ece'";

   	if (in_array('mecha', $_POST['id'])) 
    $dept[2]="'mecha'";

   	if (in_array('food', $_POST['id'])) 
   $dept[3]="'food'";
   	if (in_array('ele', $_POST['id'])) 
   $dept[4]="'ele'";
  	if (in_array('civil', $_POST['id'])) 
  $dept[5]="'civil'";
	    
		//sex
			if (in_array('b', $_POST['id'])) 
  $gen[0]="'1'";
	    if (in_array('g', $_POST['id'])) 
  $gen[1]="'2'";
	    
		
		if(count($gen)==0)
		{
		echo '<div class="ui vertical segment">'.
	'Make Sure You That Have Selected Either Boy Or Female'.
	'</div>';
		}
		else if(count($school)>0&&count($dept)>0&&count($gen)>0)
		{
	
		$q = "SELECT * FROM user WHERE school IN (".implode(',', $school).") AND dept IN (".implode(',', $dept).") AND gen IN (".implode(',', $gen).")";
	$r = mysqli_query($con, $q) ;

		$num1=mysqli_num_rows($r);
				if($num1==0)
		{
		echo '<div class="ui vertical segment">'.
	'No Result Found'.
	'</div>';
	return;
		}
	while($num1>0)
	{
	$row=mysqli_fetch_assoc($r);
	$u_id=$row['u_id'];
		$u_name=$row['user_name'];
		$u_dept=$row['dept'];

	$f_name=$row['f_name'];
		$l_name=$row['l_name'];
  $q2="SELECT dp FROM profile_dp WHERE u_id='$u_id'";
		  $r2=mysqli_query($con,$q2);
		
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];
	?>

		 <a href="userprofile.php?handle=<?php echo $u_name; ?>">
<figure>
<img src=" <?php echo $dp_path ;?>" width="140" height="140"  class="new_user"  data-content="You Will be dislayed here only when you upload dp "/>
<figcaption> <?php echo "$f_name"." "."$l_name"."<br>"."$u_dept" ?></figcaption>
</figure>
</a>

		
	<?php
	$num1--;
	}
	}
		else if(count($school)==0&&count($gen)>0)
		{
				$q = "SELECT * FROM user WHERE  dept IN (".implode(',', $dept).") AND gen IN (".implode(',', $gen).")";
	$r = mysqli_query($con, $q) ;

		$num=mysqli_num_rows($r);
				$num1=mysqli_num_rows($r);
				if($num1==0)
		{
		echo '<div class="ui vertical segment">'.
	'No Result Found'.
	'</div>';
	return;
		}
	while($num1>0)
	{
	$row=mysqli_fetch_assoc($r);
	$u_id=$row['u_id'];
		$u_name=$row['user_name'];
		$u_dept=$row['dept'];

	$f_name=$row['f_name'];
		$l_name=$row['l_name'];
  $q2="SELECT dp FROM profile_dp WHERE u_id='$u_id'";
		  $r2=mysqli_query($con,$q2);
		
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];
	?>

		 <a href="userprofile.php?handle=<?php echo $u_name; ?>">
<figure>
<img src=" <?php echo $dp_path ;?>" width="140" height="140"  class="new_user"  data-content="You Will be dislayed here only when you upload dp "/>
<figcaption> <?php echo "$f_name"." "."$l_name"."<br>"."$u_dept" ?></figcaption>
</figure>
</a>

		
	<?php
	$num1--;
	}
		?>
	
	<?php
	
	}
		else if(count($dept)==0 &&count($gen)>0)
		{
			$q = "SELECT * FROM user WHERE school IN (".implode(',', $school).") AND gen IN (".implode(',', $gen).")";
	$r = mysqli_query($con, $q) ;

			$num=mysqli_num_rows($r);
				$num1=mysqli_num_rows($r);
						if($num1==0)
		{
		echo '<div class="ui vertical segment">'.
	'No Result Found'.
	'</div>';
	return;
		}
	while($num1>0)
	{
	$row=mysqli_fetch_assoc($r);
	$u_id=$row['u_id'];
		$u_name=$row['user_name'];
		$u_dept=$row['dept'];

	$f_name=$row['f_name'];
		$l_name=$row['l_name'];
  $q2="SELECT dp FROM profile_dp WHERE u_id='$u_id'";
		  $r2=mysqli_query($con,$q2);
		
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];
	?>

		 <a href="userprofile.php?handle=<?php echo $u_name; ?>">
<figure>
<img src=" <?php echo $dp_path ;?>" width="140" height="140"  class="new_user"  data-content="You Will be dislayed here only when you upload dp "/>
<figcaption> <?php echo "$f_name"." "."$l_name"."<br>"."$u_dept" ?></figcaption>
</figure>
</a>

		
	<?php
	$num1--;
	}
	
	?>
	
	<?php
	}
	else
	{
	
	?>
	<div class="ui vertical segment">
	No Result Found!
	</div>
	
	<?php
	}
	?>