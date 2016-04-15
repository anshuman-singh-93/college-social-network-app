
<?php
include_once"functions.php";
session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
	if(!isset($_SESSION['user_name']))
	$_SESSION['user_name']=$_COOKIE['user_name'];
	
$user = $_SESSION['user_name'];
}
 $name1="SELECT * FROM  user WHERE user_name='$user'";
$name_r1=mysqli_query($con,$name1);
$row51=mysqli_fetch_assoc($name_r1);
 $live_id=$row51['u_id'];
 
 
if(isset($_POST['action']))
$num=$_POST['action'];
if($num==1)
{


$fetch="SELECT * FROM found ORDER BY date DESC  ";
$res=mysqli_query($con,$fetch);
$fet_num=mysqli_num_rows($res);
while($fet_num>0)
{
$fet_row=mysqli_fetch_assoc($res);
$lost_id=$fet_row['id'];
$who_id=$fet_row['who_id'];
$lost_text=$fet_row['lost_text'];
$date=$fet_row['date'];
//get name who posted
 
 $name="SELECT * FROM  user WHERE u_id='$who_id'";
$name_r=mysqli_query($con,$name);
$row5=mysqli_fetch_assoc($name_r);
 $f_name=$row5['f_name'];
		$l_name=$row5['l_name'];
		$c_user_name=$row5['user_name'];



//get dp of user
$s="SELECT * FROM profile_dp WHERE u_id='$who_id'";
$s_r=mysqli_query($con,$s);
$p_r=mysqli_fetch_assoc($s_r);
$path=$p_r['dp'];
//close dp
   

?>


  
  <div class="ui  teal segment" style="  margin:0 auto; position:relative; top:10px; margin-top:20px; margin-bottom:20px;" >
<div class="ui feed" >
 <div class="event">
      <img src="<?php echo "$path"?>" width="35 !important" height="35" style="position:relative;">
   
    <div class="content">
      <div class="summary">
 <?php  
	 echo "<a class='author' href='userprofile.php?handle=".$c_user_name."'".">"."$f_name"." "."$l_name"."</a>";
	 ?>        <div class="date">
          <?php  echo"$date"?>
        </div>
      </div>
      <div class="extra text">
	  <?php  echo "$lost_text";?>
      </div>
    
    </div>
  </div>

  <div class="ui comments <?php echo"$lost_id" ?>" id="comment_section" >
  <h3 class="ui dividing header <?php  echo"$lost_id" ?>">Comments</h3>
  <?php
  
  //get comment

$com="SELECT * FROM found_comment WHERE lost_id='$lost_id' ";
$com_r=mysqli_query($con,$com);
$is_any_commented=mysqli_num_rows($com_r);


  if($is_any_commented>0)
  {
  while($is_any_commented>0)
  {
  $c_row=mysqli_fetch_assoc($com_r);
$who_commented=$c_row['who_id'];
$c_date=$c_row['date'];
$comment=$c_row['comment_text'];
$comment_id=$c_row['comment_id'];
//get dp who commented
$s1="SELECT * FROM profile_dp WHERE u_id='$who_commented'";
$s_r1=mysqli_query($con,$s1);
$p_r1=mysqli_fetch_assoc($s_r1);
$c_path=$p_r1['dp'];
$c_user_name=$p_r1['user_name'];
//close dp of who commented
//get name of who commented
$q22="SELECT * FROM  user WHERE u_id='$who_commented'";
$r22=mysqli_query($con,$q22);
$row22=mysqli_fetch_assoc($r22);
$c_f_name=$row22['f_name'];
		$c_l_name=$row22['l_name'];
		//close name 
//close comment

  ?>
  <div class="comment" comment_id2="<?php echo"$comment_id"?>">
    <a class="avatar" style="height:35px; width:35px;">
      <img src="<?php echo"$c_path" ?>" width="35 !important" height="35 !important" style="position:relative;">
    </a>
    <div class="content">
     <?php  
	 echo "<a class='author' href='userprofile.php?handle="."$c_user_name"."'".">"."$c_f_name"." "."$c_l_name"."</a>";
	 ?>
      <div class="metadata">
        <span class="date"><?php echo"$c_date" ?></span>
      </div>
      <div class="text">
        <?php echo"$comment" ?>
      </div>
   
    </div>
  </div>
  <?php
  $is_any_commented--;
  }
  } //close if 
  else
  {
  ?>
  
  <?php 
  }
  ?>
  <form class="ui reply form <?php  echo"$lost_id"."555"?>">
    <div class="field">
     <input type="text" name="last-name" placeholder="Reply Here" class="cmnt_box <?php  echo"$lost_id" ?>" >
    </div>
    <div class="ui blue labeled submit icon button 555"  u_id="<?php echo $live_id;?>" lost_id="<?php  echo"$lost_id"?>"  >
      <i class="icon edit"></i> Add Reply
    </div>
  </form>
  </div><!-- ui comments -->
  
  </div><!-- ui feeds-->
  </div><!-- compact segment-->
  
  <?php
   $fet_num--;

  }
  
  }//close if
  
else if($num==2) //get one feed

{


$q="SELECT * FROM  user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$live_like_user=$u_id;

$f_name=$row['f_name'];
		$l_name=$row['l_name'];
$fetch2="SELECT * FROM  lost WHERE who_id='$u_id' ORDER BY date DESC LIMIT 1 ";
$res2=mysqli_query($con,$fetch2);
$fet_num=mysqli_num_rows($res2);

$fet_row=mysqli_fetch_assoc($res2);
$who_id=$fet_row['who_id'];
$lost_text=$fet_row['lost_text'];
$date=$fet_row['date'];
$lost_id=$fet_row['id'];
//get name who posted
 
 $name="SELECT * FROM  user WHERE u_id='$who_id'";
$name_r=mysqli_query($con,$name);
$row5=mysqli_fetch_assoc($name_r);
 $c_f_name=$row5['f_name'];
		$c_l_name=$row['l_name'];
				$c_user_name=$row['user_name'];

//get dp of user
$s="SELECT dp FROM profile_dp WHERE u_id='$who_id'";
$s_r=mysqli_query($con,$s);
$p_r=mysqli_fetch_assoc($s_r);
$path=$p_r['dp'];
//close dp

  ?>
 <!-- get only one feed --> 
 
 
   <div class="ui teal  segment" style="  margin:0 auto; position:relative; top:10px; margin-top:20px; margin-bottom:20px;" >
<div class="ui feed" >
 <div class="event">
      <img src="<?php echo "$path"?>" width="35 !important" height="35" style="position:relative;">
   
    <div class="content">
      <div class="summary">
 <?php  
	 echo "<a class='author' href='userprofile.php?handle="."$c_user_name"."'".">"."$c_f_name"." "."$c_l_name"."</a>";
	 ?>        <div class="date">
          <?php  echo"$date"?>
        </div>
      </div>
      <div class="extra text">
	  <?php  echo "$lost_text";?>
      </div>
     
    </div>
  </div>

  <div class="ui comments <?php echo"$lost_id"."555" ?>" id="comment_section" >
  <h3 class="ui dividing header <?php echo"$lost_id" ?>">Comments</h3>
  
  <form class="ui reply form <?php echo"$lost_id"."555"?>">
    <div class="field">
     <input type="text" name="last-name" placeholder="Reply Here" class="cmnt_box <?php  echo"$lost_id" ?>" >
    </div>
    <div class="ui blue labeled submit icon button 555"   lost_id="<?php  echo"$lost_id"?>"  >
      <i class="icon edit"></i> Add Reply
    </div>
  </form>
  </div><!-- ui comments -->
  
  </div><!-- ui feeds-->
  </div><!-- compact segment-->
  
  
    
  
 <?php
 

 }//close second if
?> 

 
  
 <script>
  $(document).ready(function()
  {
  
  $('form').on("keyup keypress", function(e) {
  var code = e.keyCode || e.which; 
  if (code  == 13) {               
    e.preventDefault();
    return false;
  }
});
    $(".ui.blue.labeled.submit.icon.button).click(function(){
  var lost_id=$(this).attr("lost_id");
    var u_id=$(this).attr("u_id");

var cmnt= $.trim($('.cmnt_box.'+lost_id).val());
if(cmnt!="")
{
	alert("aaa");

	   $.ajax({
            type:"POST",
			dataType:"json",
			beforeSend: function() {
        // setting a timeout
      $('.ui.blue.labeled.submit.icon.button.555').addClass("loading");
    },
            data: 'cmnt='+cmnt+'&lost_id='+lost_id+'&u_id='+u_id,
            url:"lost_comment.php",
            success: function (data) {
        $('.ui.blue.labeled.submit.icon.button.555').removeClass("loading");
         $('.cmnt_box.'+lost_id).val('');
			 
	   $.ajax({
            type:"POST",
			dataType:"html", 
            data: 'cmnt='+cmnt+'&lost_id='+lost_id+'&u_id='+u_id,

			beforeSend: function() {
        // setting a timeout
        $(this).addClass('loading');
		},
          
            url:"lost_instant_comment.php",
            success: function (data) {
			$('.ui.reply.form.'+lost_id+555).before(data);

			},//close success
			error: function(xhr, status, error) {
			$(this).removeClass('loading');
			     }
			})
			},//close upper success
			error: function(xhr, status, error) {
			
			        $(this).removeClass('loading');
					
}
});
}//close if cmnt
  
 });
 
 
 //like post



  })
  </script>
 