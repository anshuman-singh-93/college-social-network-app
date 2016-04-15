
<?php
include_once"functions.php";
session_start();
if (isset($_SESSION['user_name'])||isset($_COOKIE['user_name']))
{
	if(!isset($_SESSION['user_name']))
	$_SESSION['user_name']=$_COOKIE['user_name'];
	
$user = $_SESSION['user_name'];
}

if (isset($_POST['handle']))
$handle=$_POST['handle'];





if(isset($_POST['action']))
$num=$_POST['action'];
if($num==1)
{
//get live user 
$q="SELECT * FROM  user WHERE user_name='$user'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$live_u_id=$row['u_id'];


$q="SELECT * FROM  user WHERE user_name='$handle'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];

$fetch="SELECT * FROM user_wall WHERE u_id='$u_id' ORDER BY date DESC LIMIT 8 ";
$res=mysqli_query($con,$fetch);
$fet_num=mysqli_num_rows($res);
while($fet_num>0)
{
$fet_row=mysqli_fetch_assoc($res);
$who_id=$fet_row['who_id'];

$wall=$fet_row['wall_text'];
$date=$fet_row['date'];
$wall_id=$fet_row['wall_id'];
$handle_id=$fet_row['u_id']; //id of that user on whom wall u r posting

 //get name who posted
 
 $name="SELECT * FROM  user WHERE u_id='$who_id'";
$name_r=mysqli_query($con,$name);
$row5=mysqli_fetch_assoc($name_r);
 $f_name=$row5['f_name'];
		$l_name=$row5['l_name'];
//get dp of user
$s="SELECT * FROM profile_dp WHERE u_id='$who_id'";
$s_r=mysqli_query($con,$s);
$p_r=mysqli_fetch_assoc($s_r);
$path=$p_r['dp'];
$c_user_name=$p_r['user_name'];
//close dp
   
//get like
$l="SELECT like_count FROM total_wall_like WHERE wall_id='$wall_id' AND u_id='$u_id'";
$l_r=mysqli_query($con,$l);
$like_row=mysqli_fetch_assoc($l_r);
$like_count=$like_row['like_count'];
//chech whether u liked

$q="SELECT id FROM wall_like WHERE wall_id='$wall_id' AND u_id='$u_id' AND who_liked='$who_id'";
$r=mysqli_query($con,$q);
$u_liked=mysqli_num_rows($r);
?>


  
  <div class="ui compact teal  segment" style="  margin:0 auto; position:relative; top:10px; margin-top:20px; margin-bottom:20px; width:45%;" >
<div class="ui feed" >
 <div class="event">
      <img src="<?php echo "$path"?>" width="35 !important" height="35" style="position:relative;">
   
    <div class="content">
      <div class="summary">
 <?php  
	 echo "<a class='author' href='userprofile.php?handle=".$c_user_name."'".">"."$f_name"." "."$l_name"."</a>"."  "."Posted on Your Timeline";
	 ?>        <div class="date">
          <?php  echo"$date"?>
        </div>
      </div>
      <div class="extra text">
	  <?php  echo "$wall";?>
      </div>
      <div class="meta">
	  <?php 
	  if($u_liked>0)
	  {
	  ?>
         <a class=' active like <?php echo"$wall_id"."$u_id"?>' wall_id="<?php echo"$wall_id"?>" handle_id="<?php echo"$u_id"?>" who_id="<?php  echo"$live_u_id"?>"  >
          <i class="like icon"></i><?php echo"$like_count"?> Likes
        </a>
		<?php
          }
		  else if($u_liked==0)
		  {
		  ?>
		     <a class='like <?php echo"$wall_id"."$u_id"?>' wall_id="<?php echo"$wall_id"?>" handle_id="<?php echo"$handle_id"?>" who_id="<?php  echo"$live_u_id"?>"  >
          <i class="like icon"></i><?php echo"$like_count"?> Likes
        </a>
    <?php 
	}
	?>
      </div>
    </div>
  </div>

  <div class="ui comments <?php echo"$wall_id" ?>" id="comment_section" >
  <h3 class="ui dividing header <?php  echo"$wall_id" ?>">Comments</h3>
  <?php
  
  //get comment

$com="SELECT * FROM wall_comment WHERE wall_id='$wall_id' AND u_id='$handle_id'";
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
  <div class="comment" comment_id="<?php echo"$comment_id"?>">
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
  <form class="ui reply form <?php  echo"$wall_id"?>">
    <div class="field">
     <input type="text" name="last-name" placeholder="Reply Here" class="cmnt_box <?php  echo"$wall_id" ?>" >
    </div>
    <div class="ui blue labeled submit icon button <?php  echo"$wall_id" ?>"   wall_id="<?php  echo"$wall_id"?>" handle_id="<?php echo"$handle_id"?>" who_id="<?php echo"$live_u_id"?>" >
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


$q="SELECT * FROM  user WHERE user_name='$handle'";
$r=mysqli_query($con,$q);
$row=mysqli_fetch_assoc($r);
$u_id=$row['u_id'];
$live_like_user=$u_id;

$fetch2="SELECT * FROM user_wall WHERE u_id='$u_id' ORDER BY date DESC LIMIT 1 ";
$res2=mysqli_query($con,$fetch2);
$fet_num=mysqli_num_rows($res2);

$fet_row=mysqli_fetch_assoc($res2);
$handle_id=$fet_row['u_id']; //id of that user on whom wall u r posting

$who_id=$fet_row['who_id'];
$wall=$fet_row['wall_text'];
$date=$fet_row['date'];
$wall_id=$fet_row['wall_id'];
 //get name who posted
 
 $name="SELECT * FROM  user WHERE u_id='$who_id'";
$name_r=mysqli_query($con,$name);
$row5=mysqli_fetch_assoc($name_r);
 $c_f_name=$row5['f_name'];
		$c_l_name=$row5['l_name'];
		$c_user_name=$row5['user_name'];
//get dp of user
$s="SELECT dp FROM profile_dp WHERE u_id='$who_id'";
$s_r=mysqli_query($con,$s);
$p_r=mysqli_fetch_assoc($s_r);
$path=$p_r['dp'];
//close dp

  ?>
 <!-- get only one feed --> 
 
 
   <div class="ui compact teal  segment" style="  margin:0 auto; position:relative; top:10px; margin-top:20px; margin-bottom:20px; width:50%;" >
<div class="ui feed" >
 <div class="event">
      <img src="<?php echo "$path"?>" width="35 !important" height="35" style="position:relative;">
   
    <div class="content">
      <div class="summary">
 <?php  
	 echo "<a class='author' href='userprofile.php?handle="."$c_user_name"."'".">"."$c_f_name"." "."$c_l_name"."</a>"." "."Posted on your Timeline";
	 ?>        <div class="date">
          <?php  echo"$date"?>
        </div>
      </div>
      <div class="extra text">
	  <?php  echo "$wall";?>
      </div>
      <div class="meta">
       <a class="like <?php echo"$wall_id"."$u_id"?>" wall_id="<?php echo"$wall_id"?>" handle_id="<?php echo"$handle_id"?>" who_id="<?php  echo"$live_u_id"?>"  >
          <i class="like icon"></i> 0 Likes
        </a>
      </div>
    </div>
  </div>

  <div class="ui comments <?php echo"$wall_id" ?>" id="comment_section" >
  <h3 class="ui dividing header <?php echo"$wall_id" ?>">Comments</h3>
  
  <form class="ui reply form <?php echo"$wall_id"?>">
    <div class="field">
     <input type="text" name="last-name" placeholder="Reply Here" class="cmnt_box <?php  echo"$wall_id" ?>" >
    </div>
    <div class="ui blue labeled submit icon button <?php  echo"$wall_id" ?>"   wall_id="<?php  echo"$wall_id"?>" handle_id="<?php echo"$handle_id"?>" who_id="<?php echo"$live_u_id"?>" >
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
    $(".ui.blue.labeled.submit.icon.button").click(function(){
  var wall_id=$(this).attr("wall_id");
	  var u_id=$(this).attr("handle_id");
  var who_id=$(this).attr("who_id");

var cmnt= $.trim($('.cmnt_box.'+wall_id).val());
if(cmnt!="")
{

	   $.ajax({
            type:"POST",
			dataType:"json",
			beforeSend: function() {
        // setting a timeout
      $('.ui.blue.labeled.submit.icon.button.'+wall_id).addClass("loading");
    },
            data: 'who_id='+who_id+'&wall_id='+wall_id+'&u_id='+u_id+'&cmnt='+cmnt,
            url:"user_comment.php",
            success: function (data) {
        $('.ui.blue.labeled.submit.icon.button.'+wall_id).removeClass("loading");
         $('.cmnt_box.'+wall_id).val('');
			 
	   $.ajax({
            type:"POST",
			dataType:"html", 
            data: 'who_id='+who_id+'&wall_id='+wall_id+'&u_id='+u_id+'&cmnt='+cmnt,

			beforeSend: function() {
        // setting a timeout
        $(this).addClass('loading');
		},
          
            url:"user_instant_comment.php",
            success: function (data) {
			$('.ui.reply.form.'+wall_id).before(data);

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


$(".like").click(function(){

var u_id=$(this).attr("handle_id");
var wall_id=$(this).attr("wall_id");
var who_id=$(this).attr("who_id");
var cur_like_id=$(this).attr("id");
 $.ajax({
            type:"POST",
			dataType:"json", 
            data: 'who_id='+who_id+'&wall_id='+wall_id+'&u_id='+u_id,
          
            url:"user_like_post.php",
            success: function (data) {
			
			if(data.can_like==1)
			{
			$('.like.'+wall_id+who_id).addClass('active');
             }
			 else if(data.can_like==0)
			 {
			 			$('.like.'+wall_id+who_id).removeClass('active');

			 }
			},//close success
			error: function(xhr, status, error) {
			alert(xhr+status+error);
			     }
			})
}) 
  })
  </script>
 