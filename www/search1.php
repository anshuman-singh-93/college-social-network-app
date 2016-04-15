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
	
	  
	<div class="ui teal attached vertical segment" style="height:auto !important">
	
	<div class="ui left red floated segment" style="height:auto !important">
	
	<form class="ui form">
  <div class="ui fluid category search">
    <div class="ui icon input">
      <input class="prompt" type="text" placeholder="Search people...">
      <i class="search icon"></i>
    </div>
    <div class="results"></div>
  </div>
    <h4 class="ui dividing header">School</h4>
	 <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="soe" checked>
      <label>engineering </label>
    </div>
  </div>  
   <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals"  value="shss" >
      <label>humanities and social science </label>
    </div>
  </div>  
	  <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="sms">
      <label>management science </label>
    </div>
  </div>  
  <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="sos">
      <label>science</label>
    </div>
  </div>

  <h4 class="ui dividing header">Department</h4>

  <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="cse" checked>
      <label>copmputer science </label>
    </div>
  </div>  
   <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals"  value="ece" >
      <label>Electronics </label>
    </div>
  </div>  
	  <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="civil">
      <label>Civil </label>
    </div>
  </div>  
  <div class="field">
    <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="mecha">
      <label>Mechanical</label>
    </div>
	</div>
	  <div class="field">

	   <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="food">
      <label>Food Technology</label>
    </div>
	</div>
	  <div class="field">

	   <div class="ui checkbox">
      <input class="check_all" type="checkbox" name="hot-deals" value="ele">
      <label>Eletrical</label>
    </div>
	</div>

 
  <h4 class="ui dividing header">Sex</h4>


  <div class="field">
    <div class="ui toggle checkbox">
      <input class="check_all" type="checkbox" name="top-posts" value="b">
      <label>Boy</label>
    </div>
  </div>
  <div class="field">
    <div class="ui toggle checkbox">
      <input class="check_all"  type="checkbox" name="hot-deals" value="g" checked>
      <label>Girl</label>
    </div>
  </div>
 

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>

</form>
		</div>

	<div class="ui left red  floated segment"  style="display:none; position:relative; top:-14px;"id="s_container">
		   <div id="polaroid" class="search_result"> <!--place the everything inside a div and give it an id or class for styling-->
		  </div> <!--end polaroid-->

		
	</div> <!-- LEFT FLOATTED SEGMENT2 -->
	  </div>
	  </div>
	  </body>
	  <script>
$(document).ready(function(){

var f=1;
function get_default()
{

 data = $('.check_all:checked').map(function()
            {
                return $(this).val();
            }).get();
			
			
			
 $.ajax({
            type:"POST",
			dataType:"html",
            url:"get_search.php",
			beforeSend: function() {
			$("#s_container").css("display","block").addClass("loading");
        // setting a timeout
    },
      data: { id: data },
            success: function (data) {
			$("#s_container").removeClass("loading");
f++;
   $(".search_result").html(data);
            },error: function(xhr, status, error) {

         alert(xhr+status+error);
        }
		});	
			
			
}//get_default
$('select.dropdown')
  .dropdown()
;
$('.ui.checkbox')
  .checkbox()
;
$('.ui.search')
  .search({
   
  });

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


if(f==1)
get_default();

       var data; 
        $('.check_all').change(function () {
     data = $('.check_all:checked').map(function()
            {
                return $(this).val();
            }).get();
	
	


 $.ajax({
            type:"POST",
			dataType:"html",
            url:"get_search.php",
			beforeSend: function() {
			$("#s_container").css("display","block").addClass("loading");
        // setting a timeout
    },
      data: { id: data },
            success: function (data) {
			$("#s_container").removeClass("loading");

   $(".search_result").html(data);
            },error: function(xhr, status, error) {

         alert(xhr+status+error);
        }
		});	
       
    
    })//close check change


});
</script>

	  </html>