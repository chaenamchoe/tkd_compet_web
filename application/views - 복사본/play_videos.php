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
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h1.total{
	color : #33C4FF;
}
h3.center{
	color : orange;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
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
.bar{
    position: absolute;
    top: 0;
    left: 50px;
    width: 100%;
    height: 5px;
}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("#video1").hide();
		$("#video2").hide();
		$("#video3").hide();
		$("#video4").hide();
	});

	var tag = document.createElement('script');
	tag.src = "http://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	var player1;
	var player2;
	var player3;
	var player4;
	var player_cnt = 0;
	var done_cnt = 0;
	var error_cnt = 0;
	function onYouTubeIframeAPIReady() {
		player1 = new YT.Player('video1', {
			events: {'onReady': onPlayerReady1, 'onStateChange': onPlayerStateChange1, 'onError':onPlayerError1}
		});
		player2 = new YT.Player('video2', {
			events: {'onReady': onPlayerReady2, 'onStateChange': onPlayerStateChange2, 'onError':onPlayerError2}
		});
		player3 = new YT.Player('video3', {
			events: {'onReady': onPlayerReady3, 'onStateChange': onPlayerStateChange3, 'onError':onPlayerError3}
		});
		player4 = new YT.Player('video4', {
			events: {'onReady': onPlayerReady4, 'onStateChange': onPlayerStateChange4, 'onError':onPlayerError4}
		});
	}
	function onPlayerReady1(event) {
		player_cnt ++;
		player1.playVideo();
	}
	function onPlayerReady2(event) {
		player_cnt ++;
		player2.playVideo();
	}
	function onPlayerReady3(event) {
		player_cnt ++;
		player3.playVideo();
	}
	function onPlayerReady4(event) {
		player_cnt ++;
		player4.playVideo();
	}
	function onPlayerError1(event){
		error_cnt ++;
		player1.stopVideo();
		if (player_cnt === error_cnt){
			console.log('Player1 error...');
		}
	}
	function onPlayerError2(event){
		error_cnt ++;
		player2.stopVideo();
		if (player_cnt === error_cnt){
			console.log('Player2 error...');
		}
	}
	function onPlayerError3(event){
		error_cnt ++;
		player3.stopVideo();
		if (player_cnt === error_cnt){
			console.log('Player3 error...');
		}
	}
	function onPlayerError4(event){
		error_cnt ++;
		player4.stopVideo();
		if (player_cnt === error_cnt){
			console.log('Player4 error...');
		}
	}
	function onPlayerStateChange1(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video1").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video1").hide();
			done_cnt++;
			if (player_cnt === done_cnt){
				window.location.href = "<?php echo site_url('video/play_video_done/')?>";
			}
		}
	}
	function onPlayerStateChange2(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video2").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video2").hide();
			done_cnt++;
			if (player_cnt === done_cnt){
				window.location.href = "<?php echo site_url('video/play_video_done/')?>";
			}
		}
	}
	function onPlayerStateChange3(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video3").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video3").hide();
			done_cnt++;
			if (player_cnt === done_cnt){
				window.location.href = "<?php echo site_url('video/play_video_done/')?>";
			}
		}
	}
	function onPlayerStateChange4(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video4").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video4").hide();
			done_cnt++;
			if (player_cnt === done_cnt){
				window.location.href = "<?php echo site_url('video/play_video_done/')?>";
			}
		}
	}
	function autoRefresh(){
		$.ajax({
			type : "GET",
			url : "<?php echo site_url('video/get_video_action/')?>",
			dataType : "text",
			error : function(){
				alert('ajax onerror called...');
			},
			success : function(data){
				if(data=="2"){
					window.location.href = "<?php echo site_url('video/show_lists/')?>";
				};
				if(data=="0"){
					window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
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
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br>
				<h1 class="name"><b>1. <?=$a_name[0]?></b></h1><h3 class="center"><?=$c_name[0]?></h3></br>
			</div>
			<iframe id="video1" width="100%" height="100%" src="<?=$video_id[0]?>?rel=0&enablejsapi=1&mute=1"
				frameborder="0" allow="accelerometer" allowfullscreen>
			</iframe>
		</div>
		<div class="col-md-6" id="youTubePlayer2">
			<div id="video2_info" class="bar" style="color:white">
				</br></br></br>
				<h1 class="name"><b>2. <?=$a_name[1]?></b></h1><h3 class="center"><?=$c_name[1]?></h3></br>
			</div>
			<iframe id="video2" width="100%" height="100%" src="<?=$video_id[1]?>?rel=0&enablejsapi=1&mute=1"
				frameborder="0" allow="accelerometer" allowfullscreen>
			</iframe>
		</div>
	</div>
	<?php if ($rec_cnt > 2) { ?>
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer3">
			<div id="video3_info" class="bar" style="color:white">
				</br></br></br>
				<h1 class="name"><b>3. <?=$a_name[2]?></b></h1><h3 class="center"><?=$c_name[2]?></h3></br>
			</div>
			<iframe id="video3" width="100%" height="100%" src="<?=$video_id[2]?>?rel=0&enablejsapi=1&mute=1"
				frameborder="0" allow="accelerometer" allowfullscreen>
			</iframe>
		</div>
		<?php if ($rec_cnt > 3) { ?>
		<div class="col-md-6" id="youTubePlayer4">
			<div id="video4_info" class="bar" style="color:white">
				</br></br></br>
				<h1 class="name"><b>4. <?=$a_name[3]?></b></h1><h3 class="center"><?=$c_name[3]?></h3></br>
			</div>
			<iframe id="video4" width="100%" height="100%" src="<?=$video_id[3]?>?rel=0&enablejsapi=1&mute=1" 
				frameborder="0" allow="accelerometer" allowfullscreen>
			</iframe>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>