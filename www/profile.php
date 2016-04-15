<?php
include_once'header.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>College Folks</title>

<link rel="stylesheet" href="css/semantic.min.css"/>
<link rel="stylesheet" href="t.css"/>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/cover.css" rel="stylesheet" type="text/css">
<link href="css/profile.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="poloroid.css"/>
<script src="js/jquery_min.js"></script>

<script src="js/semantic.min.js"></script>
<script src="js/modernizr.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target: '#output',   // target element(s) to be updated with server response 
			beforeSubmit: beforeSubmit,  // pre-submit callback 
			success: afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
}); 

function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput')[0].files[0].size; //get file size
		var ftype = $('#imageInput')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>10485760) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

</script>
</head>
<body style="background-image:url(image/f6.jpg); background-size:cover">

	 
	
	<!-- right sidebar -->
	
	 <div class="ui purple inverted labeled icon left inline vertical medium sidebar menu" id="rb">
	    <a class="item new_user" id="upload_pic" data-content="uploaded photo will be visible to only in your personal profile timeline">
    <i class="upload icon"></i> Upload photo
  </a>
  
  <?php
  if($user=="")
  {
  ?>
	  <div class="item green header">You Must Log-In </div>
	
	  
	  <?php
	  
	  }
	  else
	  {
	  $q="SELECT * FROM user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$school=$row['school'];
$nav_dept=$row['dept'];

if($school=="soe")//school of engineering
{
if($nav_dept=="CSE")
$nav_dept="Computer Science And Engineering";
if($nav_dept=="ECE")
$nav_dept="Electronics &comm. And Engineering";
if($nav_dept=="CIVIL")
$nav_dept="Civil Engineering";
if($nav_dept=="Food")
$nav_dept="Food Engineering";
if($nav_dept=="Mecha")
$nav_dept="Mechanical Engineering";
if($nav_dept=="ELECT")
$nav_dept="Electrical Engineering";

	  ?>
	  
	   <div class="item">
	  <div class="ui small active green inverted header"><?php echo "$nav_dept";?></div>
	  <a class="item">
        <i class="university icon"></i>
        Year One
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Two
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Three
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Four
      </a>
	
	  </div><!-- close div class=item -->
	  
	 
	  
	  <?php
	  }
	 
	 if($school=="shss")//school of humanities and social science
{
if($nav_dept=="CS")//cultural studies
$nav_dept="Cultural Studies ";
if($nav_dept=="efl")
$nav_dept="English and Foreign Language ";
if($nav_dept=="mass")
$nav_dept="Mass Communication and Journalism ";
if($nav_dept=="socio")
$nav_dept="Sociology";
if($nav_dept=="hindi")
$nav_dept="Hindi";

	  ?>
	  
	   <div class="item">
	  <div class="ui small active green inverted header"><?php echo "$nav_dept";?></div>
	  <a class="item">
        <i class="university icon"></i>
        Year One
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Two
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Three
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Four
      </a>
	
	  </div><!-- close div class=item -->
	  
	 
	  
	  <?php
	  }
	  //
	  if($school=="sms")//school of management science 
{
if($nav_dept=="mba")
$nav_dept="M.B.A";
if($nav_dept=="m_com")
$nav_dept="M.com";
if($nav_dept=="ma_econo")
$nav_dept="M.A in Economics";
if($nav_dept=="msc_econo")
$nav_dept="M.sc in Economics";
if($nav_dept=="mca")
$nav_dept="M.C.A";
if($nav_dept=="ma_psycho")
$nav_dept="M.A in psychology";
if($nav_dept=="ma_socio")
$nav_dept="M.A in sociology";
if($nav_dept=="ma_social_w")
$nav_dept="M.A in social work";
if($nav_dept=="ma_cul")
$nav_dept="M.A in Cultural Studies";

	  ?>
	  
	   <div class="item">
	  <div class="ui small active green inverted header"><?php echo "$nav_dept";?></div>
	  <a class="item">
        <i class="university icon"></i>
        Year One
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Two
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Three
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Four
      </a>
	
	  </div><!-- close div class=item -->
	  
	 
	  
	  <?php
	  }
	  //
	  if($school=="sos")//school of science
{
if($nav_dept=="che_sci")
$nav_dept="Chemical Science";
if($nav_dept=="mt_sci")
$nav_dept="Mathematical Science";
if($nav_dept=="mbbt")
$nav_dept="Molecular Biology and Biotechnology ";
if($nav_dept=="evs")
$nav_dept="Environmental Science ";
if($nav_dept=="phy")
$nav_dept="Physics";

	  ?>
	  
	   <div class="item">
	  <div class="ui small active green inverted header"><?php echo "$nav_dept";?></div>
	  <a class="item">
        <i class="university icon"></i>
        Year One
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Two
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Three
      </a>
      <a class="item">
        <i class="university icon"></i>
        Year Four
      </a>
	
	  </div><!-- close div class=item -->
	  
	 
	  
	  <?php
	  }
	 
	  }
	
	  ?>
	   <div class="item green header">Important Links </div>
		<a class="item">
		<div class="ui green button">College</div>
		</a>
		<a class="item">
		<div class="ui green button">Library</div>
		</a>
		<a class="item">
		<div class="ui green button">Webmail</div>
		</a>
    </div> <!-- close sidebar -->
	
	<div class="ui small modal" id="ui_msg_model">

<div class="wall_container">
<div style=" background-color:teal; width:100%">
<p style="color:white;position:relative;text-align:center"><strong>Write a message</strong></p>
</div>
<div class="">

 <div class="field">
    <textarea style="margin-left:57px; width: 489px; height: 194px; resize:none; border-width:2px; border-style:solid; box-shadow:1px 1px 1px white;
	 outline-style:none;" id="post_text"></textarea>
  </div>
<div class="post_btn_container">
<div class="ui red button" style=" position:relative; left:225px; top:5px; width:140px">POST
</div>
</div>
</div>


</div><!-- close wall container -->
</div>

<!-- nudge windows -->
	<div class="ui small modal" id="ui_model_nudge">

	<div class="ui vertical segment"  style="text-align:center; font-size:20px;">
	User Who Nudged You
	</div>
	<div class="ui vertical segment" id="ui_model_nudge_container" style="text-align:center; font-size:20px;">
	User Who Nudged You
	</div>
	
</div>


<div class="">
<div class="ui inverted   segment"  style="background-image: url(image/f2.jpg); background-size: cover" " >

  
	
	<div class="ui basic left floated segment"  style="position:relative;">
				<div class="ui buttons" >
        <div class="ui yellow button" id="menu_btn" style="width:130px;">Feeds</div>
        <div class="or"></div>
        <a href="search.php"><div class="ui positive button" id="search_btn"  style="width:130px;">Search</div></a>
        </div><!--close ui buttons -->
	</div>

	
	    

		



  	<div class="ui basic right floated segment" style="position:relative; top:-15px;" >

<!-- <img src="/images/a.jpg" data-title="Elliot Fu" data-content="Elliot has been a member since July 2012" class="ui avatar image" width="120" height="120"> -->
<div class="ui secondary   menu" style=" position:relative; left:30px;">
  <a class="active item" href="index.php" style="color: white; font-size: medium">
    <i class="home icon"></i> Home
  </a>
 <a class="item" href="profile.php" style="color: white; font-size: medium">
        <i class="block layout icon"></i>
        Profile
      </a>
	 
	  
	  <a class="item new_user" style="color: white; font-size: medium">
    <i class="mail icon"></i> Messages
  </a>
  
 <?php
$q="SELECT * FROM user WHERE user_name='$user'";
		$r=mysqli_query($con,$q);
		$row=mysqli_fetch_assoc($r);
		$u_id=$row['u_id'];
		$f_name=$row['f_name'];
		$l_name=$row['l_name'];
		$email=$row['email'];
		$website=$row['website'];
		$mob=$row['mob'];
		$dept=$row['dept'];
		$y="SELECT * FROM track WHERE u_id='$u_id'";
		$y_r=mysqli_query($con,$y);
		$row1=mysqli_fetch_assoc($y_r);
		$join=$row1['reg_date'];
		$login=$row1['login_date'];
		$u_gen=$row['gen'];
		 $q2="SELECT dp FROM profile_dp WHERE u_id='$u_id'";
		  $r2=mysqli_query($con,$q2);
		  if(mysqli_num_rows($r2)>0)
		  {
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];
		   echo "<a class='item new_user' >".
   " <i style='position:relative; left:-10px; top:2px;'>"."<img src='$dp_path' width='20' height='20' alt='Red mushroom' class='new_user'  data-content='Add users to your feed'/>". 
"</i>"."<div class='ui inline dropdown'style='position:relative; top:-5px;'>".
      "<div class='text'>Account</div>".
      "<i class='dropdown icon'></i>".
      "<div class='menu'>".
        "<div class='item'  >Edit Profile</div>".
        "<div class='item' id='change_dp'>Change Dp</div>".
        "<div class='item'  id='logout_btn' data-content=$join>LogOut</div>".
      "</div>"."</div>";
	  }
else if($u_gen==1)
{    echo "<a class='item new_user' >".
   " <i class='male icon' style='position:relative; left:-10px; top:1px;'>". 
"</i>"."<div class='ui inline dropdown'style='position:relative; top:1px;'>".
      "<div class='text'>Account</div>".
      "<i class='dropdown icon'></i>".
      "<div class='menu'>".
        "<div class='item'  >Edit Profile</div>".
        "<div class='item' id='change_dp'>Change Dp</div>".
        "<div class='item'  id='logout_btn' data-content=$join>LogOut</div>".
      "</div>"."</div>";
}
else{

   echo "<a class='item new_user' >".
   " <i class='female icon' style='position:relative; left:-10px; top:1px;'>". 
"</i>"."<div class='ui inline dropdown'style='position:relative; top:1px;'>".
      "<div class='text'>Account</div>".
      "<i class='dropdown icon'></i>".
      "<div class='menu'>".
        "<div class='item'  >Edit Profile</div>".
        "<div class='item' id='change_dp'>Change Dp</div>".
        "<div class='item'  id='logout_btn' data-content=$join>LogOut</div>".
      "</div>"."</div>";
}

?>


</div>

</div>





    
	
	<div class="ui big modal" id="ui_upload_model">
	<div id="upload-wrapper">
<div align="center">
<h3>Upload New Photo</h3>
<form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input name="image_file" id="imageInput" type="file" />
<input type="submit"  id="submit-btn" value="Upload" />
<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>
<div id="output"></div>
</div>
</div>
</div>
<!-- close model of upload -->

	
	<div class="ui big modal" id="ui_upload_mode2">
	<div id="upload-wrapper">
<div align="center">
<h3>Change Your profile pic</h3>
<form action="change_dp.php" method="post" enctype="multipart/form-data" id="MyUploadForm2">
<input name="image_file2" id="imageInput2" type="file" />
<input type="submit"  id="submit-btn2" value="Upload" />
<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>
<div id="output2"></div>
</div>
</div>
</div>
	  </div><!--close ui red segement top div -->
	  
  
	  
	 
		  <div class="ui vertical segment" style="width:100%;  position:relative; top:-13px;background:url(images/f6.jpg) repeat top left;
 ">

	  <div class="ui  teal segment" style="  position:relative; width:70%;  margin:0 auto; background-image:url(image/d1.jpg); background-size:cover	  " >
	  <div class=""  style=" height:200px ; width:100%;">
	  
	  <div class="ui basic left compact floated segment" style="width:180px; height:180px; left:-20px;">
	      <?php
if($dp_path=="")
{
?>

  <div id="polaroid" style="width:100%; padding:0px 0px;position:relative; top:-40px;"> <!--place the everything inside a div and give it an id or class for styling-->

<a>

<figure> <!--use figure to contain each image and caption-->
<i class="male large icon" style="width:140px; height:140px; text-align:center;"><br>NO Photo</i>
<figcaption style="font-size:12px;"><?php echo"last online:"."<br>"."$login";?> </figcaption> <!--the caption that appears below the image-->
</figure>

</a>
</div>
<div class="ui star rating" data-rating="7" data-max-rating="10" style="position:relative; left:25px; top:-40px;"></div>

<?php 
  }
  else
  {
?>

  <div id="polaroid" style="width:100%; padding:0px 0px; position:relative; top:-40px;"> <!--place the everything inside a div and give it an id or class for styling-->

<a>

<figure> <!--use figure to contain each image and caption-->
<img src="<?php echo " $dp_path";?>" width="140" height="140" alt="<?php echo"$f_name"." "."$l_name";?>" class="new_user"  data-content="More Functions Are Coming Soon"/> <!--the image-->
<figcaption style="font-size:12px;"><?php echo"last online:"."<br>"."$online";?> </figcaption> <!--the caption that appears below the image-->
</figure>

</a>
</div>
<div class="ui star rating" data-rating="7" data-max-rating="10" style="position:relative; left:25px; top:-40px;"></div>

<?php
}

?>
	  </div>
	  
	  	  <div class="ui basic left floated segment" style="position:relative; left:-60px">

	  <div class="ui header" style="position:relative;top:1px; left:0px; font-size:22px;">
	  <ul>
	  <li><?php echo"$f_name"." "."$l_name";?>
	  </li>
	  <li style="font-size:13px; position:relative; left:15px; top:-7px;">
	  <i class="university icon" style="top:4px"></i><span style="position:relative;left:-2px;">(<?php echo"$dept";?>)</span>
	  </li>
	  </ul>
	  </div> 
	  
	  </div><!-- close ui left segment -->
	  
	<div class="ui basic right floated segment">

	<div>
	<?php
	
	$x="SELECT u_id FROM user WHERE user_name='$user'";
$x_r=mysqli_query($con,$x);
$r2=mysqli_fetch_assoc($x_r);
$u_id=$r2['u_id'];

$q="SELECT * FROM profile_view WHERE u_id='$u_id'";
$r=mysqli_query($con,$q);
$num=mysqli_num_rows($r);
$c=0;
if($num>0)
{
while($num>0)
{
$get=mysqli_fetch_assoc($r);
$c=$c+$get['view'];
$num--;

}
}
else
$c="no view ";
	?>
	
<div class="ui teal animated fade button"  id="pro" >
  <div class="visible  content">Profile Views</div>
  <div class="hidden content">
  <?php echo "$c";?>
  </div>
</div>
	
	<a href="album.php?handle=<?php echo"$user";?>" style="color:white"><div class="ui red button">Album</div></a>
	
	<?php

$q1="SELECT id FROM verify WHERE u_id='$u_id'";
$r1=mysqli_query($con,$q1);
$nudge_num=mysqli_num_rows($r1);
	?>
	<div class="ui blue animated fade button" id="nudged_user_list">
  <div class="visible  content">Nudge</div>
  <div class="hidden content">
    <?php  echo $nudge_num;?>
  </div>
</div>
	
	</div>
	
</div>
			  
	  </div>
	  
<div class="ui vertical segment" style=" position:relative:top:50px; ">

	



<div class="ui top red attached tabular  menu">

	    <a class=" active item" data-tab="first">Status</a>

    <a class=" item" data-tab="second">About Me</a>
    <a class="item" data-tab="three">Favorites</a>
    <a class="item" data-tab="four">Contact Me</a>
	    <a class="item" data-tab="five">Activity</a>


  </div>
  <!-- put class loading instead of active  while ajax-->
<div class="ui bottom attached active tab segment" data-tab="first">

  <?php

$t="SELECT id FROM is_verify WHERE u_id='$u_id'";
$t_r=mysqli_query($con,$t);
$count=mysqli_num_rows($t_r);
if($count)
{
?>
 <div class='ui red  button new_user' data-content="Your profile Has been verified by <?php echo $count; ?>">Verified</div>


   </div>
   
   <?php
   }
   
   else
   {
   ?>
   <div class='ui red  button new_user' data-content="Your profile will be verified as soon as you get 5 hit by other users">Not-Verified</div>


   </div> 
   <?php
   
   
   }
   
   ?>
   <?php
   $p="SELECT *FROM user_info WHERE u_id='$u_id'";
   $p_r=mysqli_query($con,$p);
   $row=mysqli_fetch_assoc($p_res);
   if($row>0)
   {
   $roll=$row['roll'];
   $sem=$row['sem'];
   $hostel=$row['hostel'];
   $home=$row['hometown'];
   $dob=$row['dob'];
   $r_ship=$row['r_ship'];
   $nick=$row['nick_name'];
   $school=$row['school'];
   }
   ?>
<div class="ui bottom  attached tab segment" data-tab="second">
 
<ul>
  <li style="margin-top:5px;">
                            <p>
                                <strong class="flLt"><i class="list layout icon" style="top:4px"></i>Roll no.: </strong>
                                <span class="add-details"><?php echo"$roll";?>	</span>
                            </p>
                        </li>
						
						
						 <li style="margin-top:5px;">
                          
                            <p>
                                <strong class="flLt"><i class="university icon" style="top:4px"></i>School: </strong>
                                <span class="add-details"><?php echo"$school";?></span>
                            </p>
                        </li>
						
						
						 <li style="margin-top:5px;">
                            
                            <p>
                                <strong class="flLt"><i class="hospital icon" style="top:4px"></i>Hostel: </strong>
                                <span class="add-details"><?php echo"$hostel";?>	</span>
                            </p>
                        </li>
						
						
						
						
  <li style="margin-top:5px;">
                            <p>
                                <strong class="flLt"> <i class="birthday icon" style="top:4px"></i>
Date of Birth: </strong>
                                <span class="add-details"><?php echo"$dob";?>	</span>
                            </p>
                        </li>
						
						
						
  <li style="margin-top:5px;">
                            
                            <p>
                                <strong class="flLt"><i class="home icon" style="top:4px"></i>Hometown:  </strong>
                                <span class="add-details"><?php echo"$hometown";?>	</span>
                            </p>
                        </li>
						
						  <li style="margin-top:5px;">
                            <i class="sprite-bg talk-icon flLt" style="top:4px"></i>
                            <p>
                                <strong class="flLt"><i class="heart icon" style="top:4px"></i>Relationship Status: </strong>
                                <span class="add-details"><?php echo"$r_ship";?>	</span>
                            </p>
                        </li>
						
						<li style="margin-top:5px;">
                            <i class="sprite-bg talk-icon flLt" style="top:4px"></i>
                            <p>
                                <strong class="flLt">Nickname: </strong>
                                <span class="add-details"><?php echo"$nick";?></span>
                            </p>
                        </li>
												
  <li style="margin-top:5px;">
                            <i class="sprite-bg talk-icon flLt" style="top:4px"></i>
                            <p>
                                <strong class="flLt">Joined: </strong>
                                <span class="add-details"><?php echo"$join";?>	</span>
                            </p>
                        </li>
						
						
												

						</ul>

  </div><!-- ui bottom attached tab segment -->
  
  
  
    
  <div class="ui bottom  attached tab segment" data-tab="three">
    <ul>

	</ul>
  </div><!-- ui bottom attached tab segment -->
  
  
  <div class="ui bottom  attached tab segment" data-tab="four">
    <ul>
							
  <li >
                            <p>
                                <strong class="flLt"> <i class="mail outline icon" style="top:4px"></i>
Email: </strong>
                                <span class="add-details"><?php echo"$email";?></span>
                            </p>
                        </li>
												
  <li style="margin-top:5px;">
                            <p>
                                <strong class="flLt">  <i class="mobile icon" style="top:4px"></i>
Mobile: </strong>
                                <span class="add-details"> <?php echo"$mob";?>	</span>
                            </p>
                        </li>
												
  <li style="margin-top:5px;">
                            <p>
                                <strong class="flLt"> <i class="browser icon" style="top:4px"></i>
Website: </strong>
                                <span class="add-details"><?php echo"$website";?></span>
                            </p>
                        </li>
	</ul>
  </div><!-- ui bottom attached tab segment -->
  
  
  <div class="ui bottom   attached tab segment" data-tab="five">
    <ul>
    <ul>
<li style="margin-top:5px;">
<?php
$p="SELECT id FROM verify WHERE u_id='$u_id'";
$p_r=mysqli_query($con,$p);
$u_got_vote=mysqli_num_rows($p_r);

$p1="SELECT id FROM verify WHERE who_id='$u_id'";
$p_r1=mysqli_query($con,$p1);
$u_did_vote=mysqli_num_rows($p_r1);

?>
                            <p style="color:teal">
							
   <?php echo $u_got_vote;?> people marked and verified You as valid student
                            </p>
                        </li>
												
  <li style="margin-top:5px;">
                            <p style="color:teal">
You have verified <?php echo $u_did_vote;?> student as valid student
                            </p>
                        </li>
	</ul>
	</ul>
  </div><!-- ui bottom attached tab segment -->
  

</div>
 
</div><!-- ui vertical segment -->




	 </div> 
  
	  	 
	  
</div><!-- pushable -->

<?php 
include_once'wall.php';
?>	  
</div><!-- pushable -->





</body>

<script>
$(document).ready(function(){

$('.ui.dropdown')
  .dropdown();
$('.ui.rating')
  .rating()
;
$('.menu .item')
  .tab()
;
$('.new_user').popup();


$("#logout_btn").click(function(){

	window.location = "logout.php";


});
$('.ui.avatar.image').popup();

$('.ui.checkbox')
  .checkbox();
$("#menu_btn").click(function(){

;
$('#rb.sidebar')
  .sidebar('setting', 'transition', 'Scale Down')
  .sidebar('toggle')
;
})



$("#change_dp").click(function(){
$("#ui_upload_mode2").modal('show')
;
});

$("#msg_btn").click(function(){
$('#ui_msg_model').modal('show')
;
});
$("#upload_pic").click(function(){
$("#ui_upload_model").modal('show')
;
});

$(".signup_btn").click(function(){
$('#ui_model2').modal('show')
;
});
$("#nudged_user_list").click(function(){
$('#ui_model_nudge').modal('show')
;




 $.ajax({
            type:"GET",
			dataType:"html",
            url:"get_nudge_list.php", 
		

			beforeSend: function() {
			$("#ui_model_nudge_container").addClass("loading");
        // setting a timeout
    },
            success: function (data) {
							$("#ui_model_nudge_container").removeClass("loading").html(data);
		


            },error: function(xhr, status, error) {

         alert(xhr+status+error);
        }
		});	



});


$("#reg_span_click").click(function(){
$('#ui_model1').modal('hide')
$('#ui_model2').modal('show')


});

$("a").click(function(){
$("a").removeClass("active");
$(this).addClass("active teal");

});



   

});
</script>


</html>