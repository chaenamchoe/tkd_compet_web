<style>
body{
	color : white;
	background-color : black;
}
div{
	border: 1px;
}
h1.name{
	margin-top: 3px;
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
span.stopwatch{
	font-size: 2em;
	margin-top : 10px;
	margin-bottom : 20px;
	margin-left: 100px;
	margin-right: 5px;
	color : white;
	text-align:right;
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
	background-color: #712adb; 
	width: 100vw;
	height: 10vh;
	position: relative;
	margin : 0px 0px;
	padding : 10px 0px;
}
.col-md-6{
	margin : 0px 0px;
	padding: 0px 0px;
	border:0px solid gray;
}
.blue{
	margin : 0px 0px;
	padding: 0px 0px;
	border:10px solid blue;
}
.red{
	margin : 0px 0px;
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
	height: 70vh;
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
timer{
	color:cyan;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
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

h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
img {width:40px; height:30px;}
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 544px) {  
  h1 {font-size:1.5rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:40px; height:30px;}
}
 
/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
  img {width:100px; height:70px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  img {width:120px; height:90px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
  img {width:130px; height:100px;}
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script type="text/javascript">
function on(){
  document.getElementById("msg_btn").click();
}
function off(){
  document.getElementById("close_btn").click();
}
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
		if(compet_id1 == json_obj[0] && json_obj[1] == '0'){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[7];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
			}
		}
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '21'){
				window.location.href = "<?php echo site_url('video/play_videos_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '22'){
				window.location.href = "<?php echo site_url('video/play_videos_tonament/')?>";
			}
			if(json_obj[2] == '221'){
				window.location.href = "<?php echo site_url('video/play_videos_tonament1/')?>";
			}
			if(json_obj[2] == '222'){
				window.location.href = "<?php echo site_url('video/play_videos_tonament2/')?>";
			}
			if(json_obj[2] == '24'||json_obj[2] == '25'||json_obj[2] == '26'){
				window.location.href = "<?php echo site_url('video/play_videos_cutoff/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '31'){
				window.location.href = "<?php echo site_url('video/result_cutoff_team/')?>";  //개별영상결과
			}
			if(json_obj[2] == '32'){
				window.location.href = "<?php echo site_url('video/result_tonament/')?>";  //토너먼트 결과표출
			}
			if(json_obj[2] == '321'){
				window.location.href = "<?php echo site_url('video/result_tonament_one/')?>";  //토너먼트 결과표출
			}
			if(json_obj[2] == '34'||json_obj[2] == '35'||json_obj[2] == '36'){
				window.location.href = "<?php echo site_url('video/result_cutoff/')?>" + json_obj[2]; //컷오프 결과표출
			}
			if(json_obj[2] == '80'){
				console.log(data_str);
				if (json_obj[6] == '1'){
					if(player1.getPlayerState() == 1){
						player1.pauseVideo();
					}
					if(player1.getPlayerState() == 2){
						player1.playVideo();
					}
					if(player1.getPlayerState() == 0){
						player1.playVideo();
					}
				}
				if (json_obj[6] == '2'){
					if(player2.getPlayerState() == 0){
						player2.playVideo();
					}
					if(player2.getPlayerState() == 1){
						player2.pauseVideo();
					}
					if(player2.getPlayerState() == 2){
						player2.playVideo();
					}
				}
			}
			if(json_obj[2] == '81'){	//-5초 이전으로
				if (json_obj[6] == '1'){
					var ctime = $("#timer1").text();
					var seconds = ctime.slice(-2, ctime.length); 
					if(parseInt(seconds) > 3){
						player1.setCurrentTime(parseInt(seconds) - parseInt(json_obj[3]));
					}
				}
			}
			if(json_obj[2] == '82'){	//5초 앞으로
				if (json_obj[6] == '1'){
					var ctime = $("#timer1").text();
					var seconds = ctime.slice(-2, ctime.length); 
					player1.setCurrentTime(parseInt(seconds) + parseInt(json_obj[3]));
				}
			}
			if(json_obj[2] == '83'){	//처음으로
				if (json_obj[6] == '1'){
					player1.seekTo(0, true);
				}
				if (json_obj[6] == '2'){
					player2.seekTo(0, true);
				}
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
});	
</script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script type="text/javascript">
$(function() {
	var timer1 = $("#timer1");
	var iframe1 = $('#video1')[0];
	var player1 = new Vimeo.Player(iframe1);
	player1.on('timeupdate', function(data) {
		var ts1 = Math.floor(data.seconds);
		var min1 = parseInt((ts1%3600)/60);
		var sec1 = ts1 % 60;
		if(min1 < 10){min1 = "0" + min1;}
		if(sec1 < 10){sec1 = "0" + sec1;}
		timer1.html('<h2 class="timer">' + min1 + ":" + sec1 + '</h2>');
	});
	player1.on('ended', function(){
		console.log('done...');
		$('#video1').hide();	
		document.getElementById("msg_btn").click();
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('video/update_player_status')?>",
			dataType: 'json',
			data:{done: done_cnt},  //여기의 id가 콘트롤러의 $this->input-post('id')값으로 들어온다.
			success: function(result)
			{
				console.log(result['post']);
			},
			error:function(request,status,error){
			}
		});
	});
});	
</script>
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-12 blue" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['is_international']==1 && isset($country[0])){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<?php if($_SESSION['is_international']==1 && isset($country[0])){ ?>
					<td><h3 class="center">&nbsp; <?=$country[0]?></h3></td>
					<?php }else{ ?>
					<td><h3 class="center">&nbsp; <?=$c_name[0]?></h3></td>
					<?php } ?>
				</tr>
				<tr>
					<td id="timer1"><h1 class="name">0:00</h1></td>
				</tr>
				</table>
			</div>
			<?php if($unattend[0] == 0 && (strlen($video_id[0]) > 5)){ ?>
			<iframe id="video1" src="https://player.vimeo.com/video/<?=$video_id[0]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
				frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
			</iframe>
			<?php }else{ ?>
			<div id="video1_info" class="bar" style="color:white">
				</br></br></br></br></br></br>
				<h1 class="center">불참</h1></br>
			</div>
			<?php } ?>	
		</div>
	</div>
	<!-- Button trigger modal -->
	<div style="display:none;">
		<button id="msg_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
	</div>
	<!-- Modal -->
	<div class="row justify-content-center">
	<div class="modal fade text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel"></h4>
			<button id="close_btn" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
			  <!--<span aria-hidden="true">&times;</span>-->
			</button>
		  </div>
		  <?php if($_SESSION['is_international']==1){ ?>
		  <div id="send_msg" class="modal-body blink">Calculating...</div>
		  <?php }else{ ?>
		  <div id="send_msg" class="modal-body blink">Calculating...</div>
		  <?php } ?>
		</div>
	  </div>
	</div>
	</div>
