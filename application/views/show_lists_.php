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
.row{
	width: 100vw;
	height: 50vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
.col-md-6{
	padding: 0px 0px;
	border:1px solid gold;
}
</style>
<script>
	function autoRefresh(){
		$.ajax({
			type : "GET",
			url : "<?php echo site_url('video/get_video_action/')?>",
			dataType : "text",
			error : function(){
				alert('ajax onerror called...');
			},
			success : function(data){
				if(data=="0"){
					window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
				};
				if(data=="1"){
					window.location.href = "<?php echo site_url('video/play_videos/')?>";
				};
				if(data=="3"){
					window.location.href = "<?php echo site_url('video/play_video_done/')?>";
				};
			}
		});
	}
	setInterval(function(){
		autoRefresh();
	}, 5000);
</script>
<div class="container-fluid">
	
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer1">
			<div id="video1_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>1. <?=$a_name[0]?></b></h1><h3 class="center"><?=$c_name[0]?></h3></br>
				<h1 class="total"><b><?=$totals[0]?></b></h1>
				<h3 class="points"><?=$points[0]?></h3>
				<?php if($win_kind[0] > 0){ ?>
				<h1 class="win"><b><?=$win_kind[0]?></b></h1>
				<?php } ?>
			</div>
		</div>
		<div class="col-md-6" id="youTubePlayer2">
			<div id="video2_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>2. <?=$a_name[1]?></b></h1><h3 class="center"><?=$c_name[1]?></h3></br>
				<h1 class="total"><b><?=$totals[1]?></b></h1>
				<h3 class="points"><?=$points[1]?></h3>
				<?php if($win_kind[1] > 0){ ?>
				<h1 class="win"><b><?=$win_kind[1]?></b></h1>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if ($rec_cnt > 2) { ?>
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer3">
			<div id="video3_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>3. <?=$a_name[2]?></b></h1><h3 class="center"><?=$c_name[2]?></h3></br>
				<h1 class="total"><b><?=$totals[2]?></b></h1>
				<h3 class="points"><?=$points[2]?></h3>
				<?php if($win_kind[2] > 0){ ?>
				<h1 class="win"><b><?=$win_kind[2]?></b></h1>
				<?php } ?>
			</div>
		</div>
		<?php if ($rec_cnt > 3) { ?>
		<div class="col-md-6" id="youTubePlayer4">
			<div id="video4_info" class="text-center">
				</br></br></br>
				<h1 class="name"><b>4. <?=$a_name[3]?></b></h1><h3 class="center"><?=$c_name[3]?></h3></br>
				<h1 class="total"><b><?=$totals[3]?></b></h1>
				<h3 class="points"><?=$points[3]?></h3>
				<?php if($win_kind[3] > 0){ ?>
				<h1 class="win"><b><?=$win_kind[3]?></b></h1>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>