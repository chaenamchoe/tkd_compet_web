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
	height: 90vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
.row.top{
	background-color: #241b04; 
	width: 100vw;
	height: 10vh;
	position: relative;
	margin : 0px 0px;
	padding : 10px 0px;
}
.col-md-6{
	padding: 0px 0px;
	border:0px solid gray;
}
.blue{
	padding: 0px 0px;
	border:10px solid blue;
}
.red{
	padding: 0px 0px;
	border:10px solid red;
}
.bar{
    position: absolute;
    top: 0;
    left: 50px;
    width: 100%;
    height: 5px;
}
.single_video{
	width: 100vw;
	height: 85vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
#overlay {
  position: fixed;
  display: none;
  width: 1000px;
  height: 200px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  background-color: rgba(0,0,255,0.8);
  z-index: 2;
  cursor: pointer;
}

#text{
  margin: auto;
  font-size: 40px;
  color: white;
}
#send_msg{
	font-size: 3em;
	font-weight: bold;
	color : white;
	background-color:blue;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script type="text/javascript">
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}
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
			console.log(json_obj);
			if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
				if(json_obj[2] == '0'){
					off();
					window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
				}
				if(json_obj[2] == '1'){
					window.location.href = "<?php echo site_url('video/show_lists/')?>";
				}
				if(json_obj[2] == '2'){
					window.location.href = "<?php echo site_url('video/play_videos/')?>";
				}
				if(json_obj[2] == '3'){
					window.location.href = "<?php echo site_url('video/show_lists/')?>";
				}
				if(json_obj[2] == '4'){
					window.location.href = "<?php echo site_url('video/team_results/')?>";
				}
				if(json_obj[2] == '90'){
				$.ajax({
					type: 'POST',
					url: "<?php echo site_url('video/get_tv_message')?>",
					dataType: 'json',
					data:{id: json_obj[7]},
					success: function(result)
					{
						var msg = result['post'];
						msg = msg.replace(/(\n|\r\n)/g, '<br>');
						document.getElementById("send_msg").innerHTML = msg;
					},
					error:function(request,status,error){
						alert("code:"+request.status+"\n"+"error:"+error);
					}
				});
				on();
				}
				if(json_obj[2] == '91'){
					off();
				}
			}
		});
</script>
<script type="text/javascript">
	//$(document).ready(function() {
	$("#video1").show();
	$("#video2").show();
	$("#video3").show();
	$("#video4").show();
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
	//});
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
		player1.playVideo();
	}
	function onPlayerReady2(event) {
		player2.playVideo();
	}
	function onPlayerReady3(event) {
		player3.playVideo();
	}
	function onPlayerReady4(event) {
		player4.playVideo();
	}
	function onPlayerError1(event){
		console.log('Player1 error...');
	}
	function onPlayerError2(event){
		console.log('Player2 error...');
	}
	function onPlayerError3(event){
		console.log('Player3 error...');
	}
	function onPlayerError4(event){
		player4.stopVideo();
		console.log('Player4 error...');
	}
	function onPlayerStateChange1(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video1").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video1").hide();
		}
	}
	function onPlayerStateChange2(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video2").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video2").hide();
		}
	}
	function onPlayerStateChange3(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video3").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video3").hide();
		}
	}
	function onPlayerStateChange4(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video4").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video4").hide();
		}
	}
	//});
</script>
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center top">
		<?php if($game_step <> ''){ ?>
		<span class="top_line badge badge-primary"><h2 style="color:white; font-size:40px"><b><?=$game_step?></b></h2></span>&nbsp
		<?php } ?>
		<span class="top_line"><h2 style="font-size:40px"><b><?=$jongmok?></b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:white; font-size:40px"><b>(<?=$category.' '.$jo ?>)</b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:yellow; font-size:40px"><b><?=$pumsae?></b></h2></span>
	</div>
	<?php if($rec_cnt === 1) { ?>
	<div class="row">
		<?php if($game_kind == 0){ ?> 
		<div class="col-md-6 blue" id="youTubePlayer1">
		<?php }else{ ?>
		<div class="col-md-6" id="youTubePlayer1">
		<?php } ?>
			<div id="video1_info" class="bar" style="color:white">
				<table class="table table-bordered">
				<tr>
					<td rowspan="2"><img class="fit-picture" width="150px" height="90px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
					<td><h1 class="name"><b>&nbsp; <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<?php if(strlen($video_uid[0]) === 11){ ?>
			<iframe class="single_video" id="video1" width="100%" height="100%" src="<?=$video_id[0]?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br></br></br>
				<h3 class="center">No Video!</h3></br>
			</div>
			<?php } ?>	
		</div>
	</div>	
	<?php } else { ?>
	<div class="row justify-content-center">
		<?php if($game_kind == 0){ ?> 
		<div class="col-md-6 blue" id="youTubePlayer1">
		<?php }else{ ?>
		<div class="col-md-6" id="youTubePlayer1">
		<?php } ?>
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2"><img class="fit-picture" width="150px" height="90px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
					<td><h1 class="name"><b>&nbsp; 1. <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<?php if(strlen($video_uid[0]) === 11){ ?>
			<iframe id="video1" width="100%" height="100%" src="<?=$video_id[0]?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br></br></br>
				<h3 class="center">No Video!</h3></br>
			</div>
			<?php } ?>	
		</div>
		<?php if ($rec_cnt > 1) { ?>
		<?php if($game_kind == 0){ ?> 
		<div class="col-md-6 red" id="youTubePlayer1">
		<?php }else{ ?>
		<div class="col-md-6" id="youTubePlayer1">
		<?php } ?>
			<div id="video2_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2"><img class="fit-picture" width="150px" height="90px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png">
					<td><h1 class="name"><b>&nbsp; 2. <?=$a_name[1]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[1]?>/<?=$c_name[1]?></h3></td>
				</tr>
				</table>
			</div>
			<?php if(strlen($video_uid[1]) === 11){ ?>
			<iframe id="video2" width="100%" height="100%" src="<?=$video_id[1]?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br></br></br>
				<h3 class="center">No Video!</h3></br>
			</div>
			<?php } ?>	
		</div>
		<?php } ?>
	</div>
	<?php if ($rec_cnt > 2) { ?>
	<div class="row justify-content-center">
		<div class="col-md-6" id="youTubePlayer3">
			<div id="video3_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2"><img class="fit-picture" width="150px" height="90px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[2]?>.png">
					<td><h1 class="name"><b>&nbsp; 3. <?=$a_name[2]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[2]?>/<?=$c_name[2]?></h3></td>
				</tr>
				</table>
			</div>
			<?php if(strlen($video_uid[2]) === 11){ ?>
			<iframe id="video3" width="100%" height="100%" src="<?=$video_id[2]?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br></br></br>
				<h3 class="center">No Video!</h3></br>
			</div>
			<?php } ?>	
		</div>
		<?php if ($rec_cnt > 3) { ?>
		<div class="col-md-6" id="youTubePlayer4">
			<div id="video4_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2"><img class="fit-picture" width="150px" height="90px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[3]?>.png">
					<td><h1 class="name"><b>&nbsp; 4. <?=$a_name[3]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[3]?>/<?=$c_name[3]?></h3></td>
				</tr>
				</table>
			</div>
			<?php if(strlen($video_uid[3]) === 11){ ?>
			<iframe id="video4" width="100%" height="100%" src="<?=$video_id[3]?>?rel=0&autoplay=1&enablejsapi=1" 
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br></br></br>
				<h3 class="center">No Video!</h3></br>
			</div>
			<?php } ?>	
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
	<!-- Button trigger modal -->
	<div style="display:none;">
		<button id="msg_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></button>
	</div>
	<!-- Modal -->
	<div class="row justify-content-center">
	<div class="modal fade text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel">알림</h4>
			<button id="close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div id="send_msg" class="modal-body">
		  </div>
		</div>
	  </div>
	</div>
	</div>
