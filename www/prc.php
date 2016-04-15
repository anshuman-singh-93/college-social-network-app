<?php
include_once 'functions.php';

session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
	if(!isset($_SESSION['user_name']))
	$_SESSION['user_name']=$_COOKIE['user_name'];
	
$user = $_SESSION['user_name'];
$loggedin = TRUE;

}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>College Folks</title>
<link rel="stylesheet" href="css/semantic.min.css"/>
<link rel="stylesheet" href="t.css"/>
<link href="css/style.css" rel="stylesheet" type="text/css">


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


<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target: '#output2',   // target element(s) to be updated with server response 
			beforeSubmit: beforeSubmit2,  // pre-submit callback 
			success: afterSuccess2,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm2').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
}); 

function afterSuccess2()
{
	$('#submit-btn2').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit2(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#imageInput2').val()) //check empty input filed
		{
			$("#output2").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#imageInput2')[0].files[0].size; //get file size
		var ftype = $('#imageInput2')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#output2").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>10485760) 
		{
			$("#output2").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
			return false
		}
				
		$('#submit-btn2').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output2").html("");  
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#output2").html("Please upgrade your browser, because your current browser lacks some new features we need!");
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
<style>
#seg1{  height:100%;}
#reg_span_click{cursor:pointer;}
body{overflow-x:hidden;}
</style>
</head>

<body>

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
	
<div class="ui inverted attached red segment"  >
    
	
	
	
	<div class="ui basic left floated segment"  ">
				<div class="ui buttons" >
        <div class="ui yellow button" id="feeds_btn" style="width:130px;">Feeds</div>
        <div class="or"></div>
        <a href="search.php"><div class="ui positive button" id="search_btn"  style="width:130px;">Search</div></a>
        </div><!--close ui buttons -->
	</div>

	
	    

		
<?php
$q="SELECT u_id FROM user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
if(!mysqli_num_rows($r))
{
?>
  
  	<div class="ui basic right floated segment" >
	<div class="ui buttons" >
        <div class="ui teal button sign_btn "  style="width:130px;" >Sign In</div>
        <div class="or"></div>
        <div class="ui  blue button signup_btn"   style="width:130px;" >Sign Up</div>
        </div><!--close ui buttons -->
		
	</div>
<?php
}
else
{
?>
  	<div class="ui basic right floated segment" style="position:relative; top:-15px;">

<div class="ui secondary   menu">
  <a class="active item">
    <i class="home icon"></i> Home
  </a>
  <a class="item" href="profile.php">
        <i class="block layout icon"></i>
        Profile
      </a>
	  
	 
  <a class="item new_user" >
    <i class="mail icon"></i> Message
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
   " <i class='male icon' style='position:relative; left:-10px; top:2px;'>". 
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
   " <i class='female icon' style='position:relative; left:-10px; top:2px;'>". 
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
<?php
}
?>
<div class="ui small modal" id="ui_model1">
 <div class="ui green header ">
 Login
 </div>
 <div class="ui grid">
    <div class="one column row">
        <div class="ui padded grid">
            <div class="one column row">
                <div class="column">
                    <div class="ui segment">
                        <h4 class="ui dividing header">Account Info</h4>
             
						<form class="ui form" name="login_form" method="POST" id="form1" >
                            <div class="field">
                                <label for="email">Email: </label>
                                <div class="ui icon input">
                                    <input type="text" placeholder="Email" name="email" id="login_email">
                                    <i class="user icon"></i>
                                </div>
                            </div>
                            <div class="field">
                                <label for="password">Password: </label>
                                <div class="ui icon input">
                                    <input type="password" placeholder="Password" name="password" id="login_pass">
                                    <i class="lock icon"></i>
                                </div>
                            </div>
							<div class="ui error message">
    <div class="header" id="reg_span_click">We noticed some issues</div>
  </div>
  
                   <div class="three fields">
        <div class="field">

            <input type="submit" name="submit" class="ui green submit button" id="login_btn">
        </div>
        <div class="field">

     <div class="ui  teal button"> <a href="" style="color:white">forget password</a></div>

        </div>
		
		 <div class="field">

     <div class="inline field">
    <div class="ui toggle checkbox">
      <input type="checkbox" id="rem"/>
      <label>Remember me</label>
    </div>
  </div>

        </div>
      </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- close ui model first -->





<div class="ui small modal" id="ui_model2">
 <div class="ui green header ">
 Sign-Up
 </div>
 <div class="ui grid">
    <div class="one column row">
        <div class="ui padded grid">
            <div class="one column row">
                <div class="column">
                    <div class="ui segment">
                        
  
  
						<form class="ui form" name="signup_form" method="POST" id="form2">
                            <div class="two fields">
        <div class=" required field">
		       <label for="first-name">First Name: </label>

          <input type="text" name="first-name" placeholder="First Name" id="f_name">
		  <i class="people icon"> </i>
        </div>
        <div class="required field">
		 <label for="last-name">Last Name: </label>

          <input type="text" name="last-name" placeholder="Last Name" id="l_name">
		  		  <i class="people icon"> </i>

        </div>
      </div>
	            <div class="two fields">

	  <div class="required field">
      <label>Username</label>
      <div class="ui icon input">
        <input type="text" placeholder="Username" name="user-name" id="u_name">
        <i class="user icon"></i>
      </div>
    </div>
	<div class=" required field">
                                <label for="password">Password: </label>
                                <div class="ui icon input">
                                    <input type="password" placeholder="Password" name="password" id="password">
                                    <i class="lock icon"></i>
                                </div>
                            </div>
	</div>
	
	
	
	 <div class="two fields">

	 <div class="required field">
                                <label for="email">Email: </label>
      <div class="ui mail input">
        <input type="text" placeholder="Email" name="email" id="email">
      </div>
    </div>
	<div class="field">  
<label>School</label>
    <select class="ui dropdown" name="school" id="u_school">
      <option value="">Whats Your School</option>
      <option value="soe">School of Engineering</option>
      <option value="shss">School Humanities & Social Science</option>
	        <option value="sms">School Of Management Sciences </option>
      <option value="sos">School Of Science </option>

    </select>
  </div>
  </div>
	
                            
							<div class="two fields">
							<div class="field">
    <label>Gender</label>
    <select class="ui dropdown" name="gender" id="u_gen">
      <option value="">Gender</option>
      <option value="1">Male</option>
      <option value="2">Female</option>
    </select>
  </div>
   <div class="field">
    <label>Department</label>
    <select class="ui search dropdown" name="dept" id="dept">
	      <option value="">Whats Your Department</option>

      <option value="cse">CSE</option>
	        <option value="ece">ECE</option>
      <option value="food">FOOD</option>

	  
	  </select>
	  
	  </div>
  </div>
 
  				<div class="ui error message">
    <div class="header" id="reg_span_click2">We noticed some issues</div>
  </div>
  
					<div class="field">
                            <input type="submit" name="submit" class="ui green submit fluid button" id="submit_btn">
							</div>
							
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- close ui model second .... signup form-->
    
	
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

<!-- close model of upload -->
	  </div><!--close ui red segement top div -->

	  
	  <!-- start second segment -->
	  
	  <div class="ui attached segment" >
	  
	  <div class="ui vertical segment">

  <div class="column">
    <div class="ui horizontal segment">
     	  <h1 class="ui header" style="color:teal; font-size:50px; text-align:center; position:relative; left:17px;">Explore Your College</h1>
    </div>
  </div>

</div>
	 
	  
	 </div> <!-- close vertical segment -->
		 
		
    <div class="ui vertical segment" style="background:url(images/bg.jpg) repeat top left;">
      
	 	  <h3 class="ui header" style="color:teal; font-size:30px;text-align:center">New Faces</h1>
		    <div id="polaroid" style="width:100%;"> <!--place the everything inside a div and give it an id or class for styling-->

		  <?php
		 $q="SELECT *  FROM user ORDER BY u_id DESC LIMIT 7";
		  $r=mysqli_query($con,$q);
		  $row_num=mysqli_num_rows($r);
		  while($row_num>0)
		  {
		  $row=mysqli_fetch_row($r);
		  $u_id=$row[0];
		  $u_name=$row[1];
		  $u_dept=$row[8];
		  $u_gen=$row[6];
		  $f_name=$row[4];
		  $l_name=$row[5];
		  $q2="SELECT dp FROM profile_dp WHERE u_id='$u_id'";
		  $r2=mysqli_query($con,$q2);
		  if(mysqli_num_rows($r2)>0)
		  {
		  $dp=mysqli_fetch_assoc($r2);
		  $dp_path=$dp['dp'];
		  		  
		  
		  echo "<a href='userprofile.php?handle="."$u_name"."'".">".
"<figure>".
"<img src='$dp_path' width='140' height='140'  class='new_user'  data-content='You Will be dislayed here only when you upload dp  '/>". 
"<figcaption>".$f_name. " ".$l_name."<br>".$u_dept."</figcaption>". 
"</figure>".
"</a>";
}
		  $row_num--;
		  }

		  ?>
		  </div> <!--end polaroid-->


</div>
    </div><!-- close second segment  container -->
	<div class="ui green inverted vertical segment" style="text-align:center; font-size:35px">TimeLine
</div>

	<div class="ui  vertical segment" style="position:relative; top:50px;">
	
	  <?php 
	  if(!empty($user))
include_once'wall.php';
else
{
	echo "<div class='ui compact red inverted segment'style='position:relative;top:-30px;font-size:20px; margin:0 auto'>"."You Must Log In To Access  TimeLine"."</div>";

}
?>
	  </div>
</body>
<script>
$(document).ready(function(){
$('.ui.dropdown')
  .dropdown()
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
$('#lb.sidebar')
  .sidebar('setting', 'transition', 'Scale Down')
  .sidebar('toggle')
;
})

$("#feeds_btn").click(function(){
$('#rb.sidebar')
  .sidebar('setting', 'transition', 'Scale Down')
  .sidebar('toggle');
;
});


$(".sign_btn").click(function(){
$('#ui_model1').modal('show')
;
});
$("#upload_pic").click(function(){
$("#ui_upload_model").modal('show')
;
});


$("#change_dp").click(function(){
$("#ui_upload_mode2").modal('show')
;
});



$(".signup_btn").click(function(){
$('#ui_model2').modal('show')
;
});



$("#reg_span_click").click(function(){
$('#ui_model1').modal('hide')
$('#ui_model2').modal('show')


});

$("a").click(function(){
$("a").removeClass("active");
$(this).addClass("active teal");

});



 var login_obj_valid={   
  
    email: {
      identifier : 'email',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a email'
        },{
          type   : 'email',
          prompt : 'Please enter a valid email'
        }
		
      ]
    },
    password: {
      identifier : 'password',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a password'
        },
        {
          type   : 'length[6]',
          prompt : 'Your password must be at least 6 characters'
        }
      ]
    },
   
  };
  
  
  
  
  
  //signup object
  
  
 var signup_obj_valid={   
  
    first_name: {
      identifier : 'first-name',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a first name'
        }
      ]
    },
	
    last_name: {
      identifier : 'last-name',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a last name'
        }
      ]
    },
	 user_name: {
      identifier : 'user-name',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a user name'
        },
		{
          type   : 'length[6]',
          prompt : 'Your user must be at least 6 characters'
        }
      ]
    },
	    email: {
      identifier : 'email',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a valid email'
        }
      ]
    },
	gender: {
      identifier  : 'gender',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please select a gender'
        }
      ]
    },
	department: {
      identifier  : 'dept',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please select a department'
        }
      ]
    },

    password: {
      identifier : 'password',
      rules: [
        {
          type   : 'empty',
          prompt : 'Please enter a password'
        },
        {
          type   : 'length[6]',
          prompt : 'Your password must be at least 6 characters'
        }
      ]
    },
   
  };
  
  $('#form1').form(login_obj_valid,{
  inline:true,
  on: 'blur',
    transition: 'scale',duration:550, 
    onSuccess: process1
  });
 
 
   
  $('#form2').form(signup_obj_valid,{
  inline:true,
  on: 'blur',
    transition: 'scale',duration:550, 
    onSuccess: process2
  });
  
function process1()
{
				$("#form1").removeClass('error');

var email=$("#login_email").val();
var pass=$("#login_pass").val();
var rem;
			if ($('#rem').is(":checked"))
			rem=1;
			else
			rem=0;

        $.ajax({
            type:"POST",
			dataType:"json",
            url:"login_submit.php",
			beforeSend: function() {
        // setting a timeout
        $("#form1").addClass('loading');
    },
            data: 'email='+email+'&pass='+pass+'&rem='+rem,
            success: function (data) {
			        $("#form1").removeClass('loading');

                //if successful at posting the form via ajax.
				
					if(data.response==0&&data.email_valid==0)
	{
					$("#form1").addClass('error');

		$("#reg_span_click").html("Opps!It doesn't look like Email");
	}
	
	else if(data.response==1&&data.email_valid==0)
	{
				$("#form1").addClass('error');
				
		$("#reg_span_click").html("Opps!Incorrect Email/Password Combinations");


	}
	else if(data.response==1&&data.email_valid==1)
	{
window.location="index.php";
	}

            },error: function(xhr, status, error) {
			        $("#form1").removeClass('loading');
					$("#form1").addClass('error');


         alert(xhr+status+error);
        }
		});
		

     

}//close process1

//start process2
function process2()
{
			$("#form2").removeClass('error');

var email=$("#email").val();
var pass=$("#password").val();
var f_name=$("#f_name").val();
var l_name=$("#l_name").val();
var u_name=$("#u_name").val();
var dept=$("#dept").val();
var gen=$("#u_gen").val();
var school=$("#u_school").val();

        $.ajax({
            type:"POST",
			dataType:"json",
            url:"signup_submit.php",
			beforeSend: function() {
        // setting a timeout
        $("#form2").addClass('loading');
    },
            data: 'email='+email+'&pass='+pass+'&f_name='+f_name+'&l_name='+l_name+'&u_name='+u_name+'&dept='+dept+'&gen='+gen+'&school='+school,
            success: function (data) {
			        $("#form2").removeClass('loading');

                
			 if(data.response==1&&data.email_valid==0&&data.email_exist==1&&data.user_exist==1)
			
			{
			$("#form2").addClass('error');

		$("#reg_span_click2").html("Opps!Email is not well formatted");
			}
			
	else if(data.response==1&&data.email_valid==1&&data.email_exist==1&&data.user_exist==0)

			{

			$("#form2").addClass('error');

		$("#reg_span_click2").html("Opps!User Name is already Taken by other user");
				
				
			}		
		else if(data.response==1&&data.email_valid==1&&data.email_exist==0&&data.user_exist==1)

			{
	
			$("#form2").addClass('error');

		$("#reg_span_click2").html("Opps!Email is already exist");
			
				
			}
			
			else if(data.response==1&&data.email_valid==1&&data.email_exist==1&&data.user_exist==1)
{

	window.location = "index.php";
}
			else if(data.response==0&&data.email_valid==0&&data.email_exist==0&&data.user_exist==0)			{
			alert("last_if");
			$("#form2").addClass('error');

			}

            },error: function(xhr, status, error) {
			        $("#form1").removeClass('loading');
			$("#form2").addClass('error');
        }
		});
		

     
			    window.lock = "locked";

}//close process2

   

});
</script>

<script>
jQuery(document).ready(function($){
	var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});
</script>
</html>
