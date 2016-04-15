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
<div class="ui inverted  red segment"  >
  
	
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
  <a class="active item" href="index.php">
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
	  
  
	 
	
	  
	  <div class="ui left floated vertical segment" id="left_lost" style="position:relative;left:20px;">
 <div class="field">
    <textarea rows="9" cols="75" style="resize:none;border:3px solid teal; outline:0px;  "  placeholder="Write Here If You Have Lost " id="lost_text"></textarea>
 

</div>

<div class="ui labeled red  icon button"style="margin:0 auto; position:relative; margin-left:44%;top:10px; " id="lost_btn">
  <i class="send icon"></i>Lost
 
</div>
	  
	  <div class="ui vertical segment" id="lost_items">
	  </div>
	  
	  </div>
	  
	  
	  <div class="ui right floated vertical segment" id="right_found">
	  
	   <div class="field">
    <textarea rows="9" cols="75" style="resize:none;border:3px solid teal; outline:0px; "  placeholder="Share Here If You Have Found " id="found_text"></textarea>
 

</div>

<div class="ui labeled red  icon button" style="margin:0 auto; position:relative; margin-left:44%; top:10px;" id="found_btn">
  <i class="send icon"></i>Found
 
</div>
	  <div class="ui vertical segment" id="found_items">
	  </div>
	  
	  </div>
	  


	
  
	  	 
	  

 
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
  $(document).ready(function(){
  
  //GETTING AJAX WALL
  var action=1;
					   $.ajax({
            type:"POST",
			dataType:"html",
			data: 'action='+action,

            url:"lost_get.php",
            success: function (data) {
			  $("#lost_items").append(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#post_btn").removeClass('loading');
					alert(xhr+status+error);}
});//  fetch lost
  
 


			   $.ajax({
            type:"POST",
			dataType:"html",
			data: 'action='+1,

            url:"found_get.php",
            success: function (data) {
			  $("#found_items").html(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#found_btn").removeClass('loading');
					alert(xhr+status+error);}
});//  fetch found


 //close

  
  $("#lost_btn").click(function(){
  
  var lost_text=$.trim($("#lost_text").val());
  if(lost_text=="")
{
  alert("please write something");
			  $("#lost_text").css("border-color","red");
			  
}

  else
  
  {
   action=2;
  
        $.ajax({
            type:"POST",
			dataType:"json",
            url:"lost_post.php",
			beforeSend: function() {
        // setting a timeout
        $("#lost_btn").addClass('loading');
    },
            data: 'lost_text='+lost_text,
            success: function (data) {
			  $("#lost_btn").removeClass('loading');
			  if(data.response==0)
			  {
			  alert("please write something");
			  $("#lost_text").css("border-color","red");
			  }
			  else
			  {
			        $("#lost_btn").val("");
					
					//second ajax to fetch content
					   $.ajax({
            type:"POST",
			dataType:"html",
            url:"lost_get.php", 
			data: 'lost_text='+lost_text+'&action='+action,

            success: function (data) {
			  $("#lost_items").prepend(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#lost_btn").removeClass('loading');
					alert(xhr+status+error);}
});//clsoe ajax 2
					
					
					
					
  
			  }

			},//close success
			error: function(xhr, status, error) {
			        $("#post_btn").removeClass('loading');
					alert(xhr+status+error);}
});//clsoe ajax 1			
  }//close else
  
 
  
  })
  
  
  
  //fetch found on click
  
  
  $("#found_btn").click(function(){

  var lost_text=$.trim($("#found_text").val());
  if(lost_text=="")
{
  alert("please write something");
			  $("#found_text").css("border-color","red");
			  
}

  else
  
  {
   action=2;
  
        $.ajax({
            type:"POST",
			dataType:"json",
            url:"found_post.php",
			beforeSend: function() {
        // setting a timeout
        $("#found_btn").addClass('loading');
    },
            data: 'lost_text='+lost_text,
            success: function (data) {
			  $("#found_btn").removeClass('loading');
			  if(data.response==0)
			  {
			  alert("please write something");
			  $("#found_text").css("border-color","red");
			  }
			  else
			  {
			        $("#found_btn").val("");
					
					//second ajax to fetch content
					   $.ajax({
            type:"POST",
			dataType:"html",
            url:"found_get.php", 
			data: 'lost_text='+lost_text+'&action='+action,

            success: function (data) {
			
			  $("#found_items").prepend(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#found_btn").removeClass('loading');
					alert(xhr+status+error);}
});//clsoe ajax 2
					
					
					
					
  
			  }

			},//close success
			error: function(xhr, status, error) {
			        $("#post_btn").removeClass('loading');
					alert(xhr+status+error);}
});//clsoe ajax 1			
  }//close else
  
 
  
  })
  
  
  
  })
  </script>
  
</html>