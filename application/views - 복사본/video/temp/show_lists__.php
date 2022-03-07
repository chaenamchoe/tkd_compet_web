<style>
body{
	color : white;
	background-color : black;
}
div{
	border: 1px;
}
h1.name{
	color : yellow;
}
h1.total{
	color : #33C4FF;
}
h3.center{
	color : orange;
}
h3.points{
	color : #96FF33;
}
.container-fluid{
	margin : 0px 0px;
	padding : 0px 0px;
}
span.top_line{
	margin-top : 10px;
	margin-bottom : 20px;
	color : orange;
}
span.step {
  background-color: yellow;
}
.row{
	width: 100vw;
	height: 45vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
.row.top{
	background-color: #0080ff;
	width: 100vw;
	height: 10vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
.col-md-6{
	padding: 0px 0px;
	border:1px solid gray;
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
		var compet_id1 = "<?php echo $_SESSION['competition_id'] ?>";
		var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
		var message = data.msg;
		var result = message.split(",");
		var compet_id2 = result[0];
		var coat_no2 = result[1];
		var action_kind = result[2];
		var action_no = result[3];
		if(compet_id1 == compet_id2 && coat_no1 == coat_no2 && action_kind == "2"){
			if(action_no == "2"){
				window.location.href = "<?php echo site_url('video/play_videos/')?>";
			};
		}
    });
  });
</script>
<div class="container-fluid">
	<div class="row justify-content-center top">
		<?php if($game_step <> ''){ ?>
		<span class="top_line step"><h1 style="color:black"> [<?=$game_step?>] </h1></span>&nbsp
		<?php } ?>
		<span class="top_line"><h1 style="color:yellow"><?=$jongmok?></h1></span>&nbsp;
		<span class="top_line"><h1 style="color:white">(<?=$category.' '.$jo ?>)</h1></span>&nbsp;
		<span class="top_line"><h1 style="color:yellow"><?=$pumsae?></h1></span>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer1">
			<div id="video1_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>1. <?=$a_name[0]?></b></h1>
				<h5 class="center"><?=$c_name[0]?></h5></br>
				<h1 class="total"><b><?=$totals[0]?></b></h1>
				<h3 class="points"><?=$points[0]?></h3>
				<?php if($game_kind==1){?>
					<h1 class="win"><b class="badge badge-info"><?=$win_kind[0]?></b></h1>
				<?php }else{ ?>
					<h1 class="win"><b class="badge badge-primary"><?=$win_kind[0]?></b></h1>
				<?php } ?>
			</div>
		</div>
		<?php if ($rec_cnt > 1) { ?>
		<div class="col-md-6" id="youTubePlayer2">
			<div id="video2_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>2. <?=$a_name[1]?></b></h1>
				<h5 class="center"><?=$c_name[1]?></h5></br>
				<h1 class="total"><b><?=$totals[1]?></b></h1>
				<h3 class="points"><?=$points[1]?></h3>
				<?php if($game_kind==1){?>
					<h1 class="win"><b class="badge badge-info"><?=$win_kind[1]?></b></h1>
				<?php }else{ ?>
					<h1 class="win"><b class="badge badge-primary"><?=$win_kind[1]?></b></h1>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php if ($rec_cnt > 2) { ?>
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer3">
			<div id="video3_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>3. <?=$a_name[2]?></b></h1>
				<h5 class="center"><?=$c_name[2]?></h5></br>
				<h1 class="total"><b><?=$totals[2]?></b></h1>
				<h3 class="points"><?=$points[2]?></h3>
				<h1 class="win"><b class="badge badge-info"><?=$win_kind[2]?></b></h1>
			</div>
		</div>
		<?php if ($rec_cnt > 3) { ?>
		<div class="col-md-6" id="youTubePlayer4">
			<div id="video4_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>4. <?=$a_name[3]?></b></h1>
				<h5 class="center"><?=$c_name[3]?></h5></br>
				<h1 class="total"><b><?=$totals[3]?></b></h1>
				<h3 class="points"><?=$points[3]?></h3>
				<h1 class="win"><b class="badge badge-info"><?=$win_kind[3]?></b></h1>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>