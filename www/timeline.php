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
<body>

	 
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
<div class="">
<div class="ui inverted  red segment"  >
  
	
	<div class="ui basic left floated segment"  style="position:relative;">
				<div class="ui buttons" >
        <div class="ui yellow button" id="menu_btn" style="width:130px;">Feeds</div>
        <div class="or"></div>
        <div class="ui positive button" id="feeds_btn"  style="width:130px;">Search</div>
        </div><!--close ui buttons -->
	</div>

	
	    

		



  	<div class="ui basic right floated segment" style="position:relative; top:-15px;" >

<!-- <img src="/images/a.jpg" data-title="Elliot Fu" data-content="Elliot has been a member since July 2012" class="ui avatar image" width="120" height="120"> -->
<div class="ui secondary   menu" style=" position:relative; left:30px;">
  <a class="active item" href="index.php">
    <i class="home icon"></i> Home
  </a>
 <a class="item" href="profile.php">
        <i class="block layout icon"></i>
        Profile
      </a>
	   <a class="item" href="timeline.php?handle=<?php echo "$user"; ?>">
        <i class="block layout icon"></i>
        Timeline
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
		  
  echo "<a class='item new_user' id='logout_btn' data-content=$join>".
   " <i>"."<img src='$dp_path' width='20' height='20' alt='Red mushroom' class='new_user'  data-content='Add users to your feed'/>". 
"</i>"." <span style='position:relative; top:-5px;'>"." Logout"."</span>";

}

else if($u_gen==1)
{
  echo "<a class='item new_user' id='logout_btn' data-content='You joined on 30th feb 2015'>".
   " <i class='male icon'>" . 
"</i>"." <span style='position:relative; '>"." Logout"."</span>";
}
else
{
 echo "<a class='item new_user' id='logout_btn' data-content= 'last loggedin at"." "."$login"."'".">".
   " <i class='female icon'>" . 
"</i>"." <span style='position:relative; '>"." Logout"."</span>";
}
	?>
</div>

</div>
<?php

?>
 
</div>

</div>





    
	
	<div class="ui big modal" id="ui_upload_model">
	<div id="upload-wrapper">
<div align="center">
<h3>Change Your profile pic</h3>
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
	  </div><!--close ui red segement top div -->
	  
	  
	  
	  <div class="ui attached inverted segment" style="height:auto;background-color:rgba(152, 21, 21, 0.68)!important">
	    <div class="ui vertical segment">
	
		
		
		<?php
		$handle=$_GET['handle'];
		$q="SELECT * FROM user WHERE user_name='$handle'";
		$r=mysqli_query($con,$q);
		$row=mysqli_fetch_assoc($r);
		$id=$row['u_id'];
		$f_name=$row['f_name'];
		$l_name=$row['l_name'];
		$q1="SELECT * FROM upload WHERE u_id='$id' ORDER BY date DESC";
		$r1=mysqli_query($con,$q1);
		$r_num=mysqli_num_rows($r1);
		echo "<div class='ui header' style='text-align:center; font-size:30px;'>"."$f_name $l_name"."</div>".
		"</div>";
		if($r_num==0)
		echo"<div class='ui vertical segment' style='font-size:24px; text-align:center;'>"."User has not posted anything!"."</div>";
				
				else
				
				{
				echo'<section id="cd-timeline">';

		while($r_num>0)
		{
		$path=mysqli_fetch_assoc($r1);
		$big_pic=$path['big_pic'];
		$info = getimagesize("images/a.jpg"); 
			$width=$info[0];
			$height=$info[1];
		$date=$path['date'];
		echo '<div class="cd-timeline-block">'.
		'<div class="cd-timeline-img">'.
			'<img src="img/cd-icon-picture.svg" alt="Picture">'.
		'</div>'.
 
		'<div class="cd-timeline-content">'.
			'<h2>Title of section 1</h2>'.
						'<img src="'.$big_pic.'"'. 'alt="Picture"'.'>';

			echo"<span class='cd-date'>"."$date"."</span>".
		"</div>".
	"</div>";



$r_num--;
		}
		echo '</section>';
		}
		?>

		</div><!-- ui attached -->

	  </div><!-- close push -->
	  </body>
	  <script>
$(document).ready(function(){
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