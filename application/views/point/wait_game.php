<style>
img {
   max-width:100%;
   height:auto;
   max-height:100%;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script>
  $(document).ready(function(){
    var socket = io.connect('http://ccnplaza.com:8888');
	socket.emit("login", {
      name: "app_user1",
      userid: "ccnplaza@gmail.com"
    });
    socket.on("chat", function(data) {
		var compet_id1 = "<?php echo $_SESSION['compet_id'] ?>";
		var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
		var data_str = data.msg;
		var json_obj = data_str.split("|");
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('point/show_jongmok/')?>";
			}
			if(json_obj[2] == '99'){
				window.location.href = "<?php echo site_url('point/check_connection/')?>";
			}
			if((json_obj[2] == "11") || 
				(json_obj[2] == "12") || 
				(json_obj[2] == "14") || 
				(json_obj[2] == "141") || 
				(json_obj[2] == "15") || 
				(json_obj[2] == "16") || 
				(json_obj[2] == "17"))
			{
				window.location.href = "<?php echo site_url('point/show_point/');?>" + json_obj[2];
			}
		}
    });
  });
</script>
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col">
			<br>
            <?php if($_SESSION['is_international'] == 1){ ?>
			<h3 class="alert alert-success"><?php echo $_SESSION['competition_name_e']; ?></h3>
			<?php }else{ ?>
            <h3 class="alert alert-success"><?php echo $_SESSION['competition_name'];?></h3>
			<?php } ?>
        </div>
	</div>	
	<div class="row justify-content-center text-center">
		<div class="col" style="color:blue">
			<h4>Court No: <?php echo $_SESSION['coat_no']; ?></h4>
			<h4>Judge No: <?php echo $_SESSION['judge_no']; ?></h4>
        </div>
	</div>
	<hr>
	<div class="row justify-content-center text-center">
        <div  class="col">
		<p><h4>The game is being prepared.</br>
				Please wait a moment.</br>
				When the match starts, the screen automatically switches. </br>
		</h4></p>
		<!--<p><a class="btn btn-primary" href=<?php echo site_url('point/refresh_point_input')?>>Refresh</a></p>-->
		<p>
			<img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img>
		</p>
	   </div>
	<br/>
    </div>  
  