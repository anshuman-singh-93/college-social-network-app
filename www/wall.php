
<?php
include_once"functions.php";
?>

<div class="ui  vertical segment" style="text-align:center;box-shadow:none !important; width:60%; margin:0 auto">
 <div class="field">
    <textarea rows="9" cols="75" style="resize:none;border:1px solid black; outline:0px;  "  placeholder="Write on Wall" id="wall_text"></textarea>
  </div>

</div>

<div class="ui labeled red  icon button"style="margin:0 auto; position:relative; margin-left:44%; " id="post_btn">
  <i class="send icon"></i>POST ON WALL
 
</div>
<div class="ui  vertical segment" id="data_came">

  </div> <!-- close ui segment container -->
  <script>
  $(document).ready(function(){
  
  //GETTING AJAX WALL
  var action=1;
					   $.ajax({
            type:"POST",
			dataType:"html",
			data: 'action='+action,

            url:"wall_post_get.php",
            success: function (data) {
			  $("#data_came").append(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#post_btn").removeClass('loading');
					alert(xhr+status+error);}
});//  
  
  //close
  
  $("#post_btn").click(function(){
  
  var wall_text=$.trim($("#wall_text").val());
  if(wall_text=="")
{
  alert("please write something");
			  $("#wall_text").css("border-color","red");
			  
}

  else
  
  {
  var action=2;
  
        $.ajax({
            type:"POST",
			dataType:"json",
            url:"wall_post.php",
			beforeSend: function() {
        // setting a timeout
        $("#post_btn").addClass('loading');
    },
            data: 'wall_text='+wall_text,
            success: function (data) {
			  $("#post_btn").removeClass('loading');
			  if(data.response==0)
			  {
			  alert("please write something");
			  $("#wall_text").css("border-color","red")
			  }
			  else
			  {
			        $("#post_btn").val("");
					
					//second ajax to fetch content
					   $.ajax({
            type:"POST",
			dataType:"html",
            url:"wall_post_get.php", 
			data: 'wall_text='+wall_text+'&action='+action,

            success: function (data) {
			  $("#data_came").prepend(data);
			 

			},//close success
			error: function(xhr, status, error) {
			        $("#post_btn").removeClass('loading');
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
  
 
 