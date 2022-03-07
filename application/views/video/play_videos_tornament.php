<style>
body{
	margin : 0;
	padding : 0;
	background-color : black;
	//overflow:hidden;
} 
.container{
	display:grid;
	height: 90vh;
	grid-template-columns: 1fr 1fr;
	grid-template-rows: 1fr 1fr;
	justify-items: center;
	justify-content: center;
}
.player:nth-child(1){
	display:grid;
	width: 49.9vw;
	height: 90vh;
	background: black;
	border: 10px solid blue;
	align-items: center;
}
.player:nth-child(2){
	display:grid;
	width: 49.9vw;
	height: 90vh;
	background: black;
	border: 10px solid red;
	align-items: center;
}
.video_info{
	display:grid;
	grid-column: 1;
	grid-row:1;
	width:100%;
	height: 90vh;
}	
.ath_info{
	display:grid;
	grid-template-columns: 10% auto 100px;
	column-gap:2px;
	grid-column: 1;
	grid-row:1;
	height: 50px;
	width:80%;
	font-size: 2em;
	font-weight: bold;
	color : white;
	border: 0px solid green;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	z-index: 2;
	margin-left:10%;
	justify-content:stretch;
	align-self: start;
}
.ath{
	border: 0px solid red;
}
.ath.timer{
	color:cyan;
}
.country_flag{
	padding: 2px;
	width:80px;
	height:50px;
}
span.step {
  background-color: yellow;
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
.blink {
  animation: blinker 1.5s linear infinite;
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
	var iframe1 = $("#video1");
	var player1 = new Vimeo.Player(iframe1);
	var iframe2 = $("#video2");
	var player2 = new Vimeo.Player(iframe2);

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
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('video/show_jongmok/')?>" + json_obj[2];
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/athletes_team/')?>";  //cutoff team single
			}
			//if(json_obj[2] == '12'){
			//	window.location.href = "<?php echo site_url('video/athletes_tonament/')?>";
			//}
			if(json_obj[2] == '14'||json_obj[2] == '15'||json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
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
				window.location.href = "<?php echo site_url('video/result_cutoff_team/')?>";  //媛쒕퀎??곴껐怨?
			}
			if(json_obj[2] == '32'){
				window.location.href = "<?php echo site_url('video/result_tonament/')?>";  //??덈㉫??寃곌낵?쒖텧
			}
			if(json_obj[2] == '321'){
				window.location.href = "<?php echo site_url('video/result_tonament_one/')?>";  //?혻?혞癒쇳듌寃곌낵?혵異?
			}
			if(json_obj[2] == '34'||json_obj[2] == '35'||json_obj[2] == '36'){
				window.location.href = "<?php echo site_url('video/result_cutoff/')?>" + json_obj[2]; //而룹삤??寃곌낵?쒖텧
			}
			if(json_obj[2] == '84'){
				console.log(data_str);
				if (json_obj[6] == '1'){
					player1.pause();
				}
				if (json_obj[6] == '2'){
					player2.pause();
				}
			}
			if(json_obj[2] == '86'){
				console.log(data_str);
				if(json_obj[3]==1){
					player1.setPlaybackRate(0.5);
					player1.play();
					player2.setPlaybackRate(0.5);
					player2.play();
				}
				if(json_obj[3]==2){
					player1.setPlaybackRate(0.75);
					player1.play();
					player2.setPlaybackRate(0.75);
					player2.play();
				}
				if(json_obj[3]==3){
					player1.setPlaybackRate(1.0);
					player1.play();
					player2.setPlaybackRate(1.0);
					player2.play();
				}
				if(json_obj[3]==4){
					player1.setPlaybackRate(1.25);
					player1.play();
					player2.setPlaybackRate(1.25);
					player2.play();
				}
				if(json_obj[3]==5){
					player1.setPlaybackRate(1.5);
					player1.play();
					player2.setPlaybackRate(1.5);
					player2.play();
				}
				if(json_obj[3]==6){
					player1.setPlaybackRate(2.0);
					player1.play();
					player2.setPlaybackRate(2.0);
					player2.play();
				}
			}
			if(json_obj[2] == '80'){
				console.log(data_str);
				if (json_obj[6] == '1'){
					player1.play();
				}
				if (json_obj[6] == '2'){
					player2.play();
				}
			}
			if(json_obj[2] == '81'){	//-5珥??댁쟾?쇰?
				if (json_obj[6] == '1'){
					var ctime = $("#timer1").text();
					var seconds = ctime.slice(-2, ctime.length); 
					if(parseInt(seconds) > 3){
						player1.setCurrentTime(parseInt(seconds) - parseInt(json_obj[3]));
					}
				}
				if (json_obj[6] == '2'){
					var ctime2 = $("#timer2").text();
					var seconds = ctime2.slice(-2, ctime2.length); 
					if(parseInt(seconds) > 3){
						player2.setCurrentTime(parseInt(seconds) - parseInt(json_obj[3]));
					}
				}
			}
			if(json_obj[2] == '82'){	//5珥???쇰?
				if (json_obj[6] == '1'){
					var ctime = $("#timer1").text();
					var seconds = ctime.slice(-2, ctime.length); 
					player1.setCurrentTime(parseInt(seconds) + parseInt(json_obj[3]));
				}
				if (json_obj[6] == '2'){
					var ctime = $("#timer2").text();
					var seconds = ctime.slice(-2, ctime.length); 
					player2.setCurrentTime(parseInt(seconds) + parseInt(json_obj[3]));
				}
			}
			if(json_obj[2] == '83'){	//泥??쇰?...
				if (json_obj[6] == '1'){
					player1.setCurrentTime(0);
				}
				if (json_obj[6] == '2'){
					player2.setCurrentTime(0);
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
	var timer2 = $("#timer2");
	var iframe1 = $('#video1')[0];
	var iframe2 = $('#video2')[0];
	var player1 = new Vimeo.Player(iframe1);
	var player2 = new Vimeo.Player(iframe2);
	var done_cnt = 0;
	var buffer_cnt = 0;

	player1.on('bufferend', function() {
	  //player1.pause();
	  buffer_cnt ++ ;
	  //console.log(buffer_cnt);
	  //if (buffer_cnt == 2){
		player1.play();
		player2.play();
	  //} 
	});
	player2.on('bufferend', function() {
	  //player2.pause();
	  buffer_cnt ++ ;
	  console.log(buffer_cnt);
	  //if (buffer_cnt == 2){
		player1.play();
		player2.play();
	  //} 
	});
	player1.on('timeupdate', function(data) {
	  //console.log(data.seconds + 'Played...');
		var ts1 = Math.floor(data.seconds);
		var min1 = parseInt((ts1%3600)/60);
		var sec1 = ts1 % 60;
		if(min1 < 10){min1 = "0" + min1;}
		if(sec1 < 10){sec1 = "0" + sec1;}
		timer1.html('<h2 class="timer">' + min1 + ":" + sec1 + '</h2>');
	});
	player2.on('timeupdate', function(data) {
	  //console.log(data.seconds + 'Played...');
		var ts2 = Math.floor(data.seconds);
		var min2 = parseInt((ts2%3600)/60);
		var sec2 = ts2 % 60;
		if(min2 < 10){min2 = "0" + min2;}
		if(sec2 < 10){sec2 = "0" + sec2;}
		timer2.html('<h2 class="timer">' + min2 + ":" + sec2 + '</h2>');
	});
	player1.on('ended', function(){
		done_cnt++;
		$('#video1').hide();	
		console.log(done_cnt);
		if (done_cnt == 2){
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url('video/update_player_status')?>",
				dataType: 'json',
				data:{done: done_cnt},  //?ш린??id媛 肄?몃·?ъ쓽 $this->input-post('id')媛?쇰? ?ㅼ뼱?⑤?
				success: function(result)
				{
					console.log(result['post']);
				},
				error:function(request,status,error){
				}
			});
			document.getElementById("msg_btn").click();
		}
	});
	player2.on('ended', function(){
		done_cnt++;
		$('#video2').hide();	
		console.log(done_cnt);
		if (done_cnt == 2){
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url('video/update_player_status')?>",
				dataType: 'json',
				data:{done: done_cnt},  //?ш린??id媛 肄?몃·?ъ쓽 $this->input-post('id')媛?쇰? ?ㅼ뼱?⑤?
				success: function(result)
				{
					console.log(result['post']);
				},
				error:function(request,status,error){
				}
			});
			document.getElementById("msg_btn").click();
		}
	});
});	
</script>
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
  <div class="container">
	<div class="player">
		<div class="ath_info">
			<?php if($_SESSION['is_international']==1 && isset($country[0])){ ?>
			<div class="ath country"><?=$country[0]?>
				<img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
			</div>
			<?php }else{ ?>
			<div></div>
			<?php } ?>
			<div class="ath ath_name"><?=$a_name[0]?></div>
			<div class="ath timer" id="timer1">00:00</div>
		</div>
	<?php if($unattend[0] == 0){ ?>
		<div class="video_info">
			<div class="video">
				<iframe id="video1" src="https://player.vimeo.com/video/<?=$video_id[0]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	<?php }else{ ?>	
		<div id="video1_info" class="bar" style="color:white">
			</br></br></br></br></br></br>
			<h1 class="center"> [ unattend ] </h1></br>
		</div>
	<?php } ?>	
	</div>
	<div class="player">
		<div class="ath_info">
			<?php if($_SESSION['is_international']==1 && isset($country[1])){ ?>
			<div class="ath country"><?=$country[1]?>
				<img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png" >
			</div>
			<?php }else{ ?>
			<div></div>
			<?php } ?>
			<div class="ath ath_name"><?=$a_name[1]?></div>
			<div class="ath timer" id="timer2">00:00</div>
		</div>
	<?php if($unattend[1] == 0){ ?>
		<div class="video_info">
			<div class="video">
				<iframe id="video2" src="https://player.vimeo.com/video/<?=$video_id[1]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	<?php }else{ ?>	
		<div id="video1_info" class="bar" style="color:white">
			</br></br></br></br></br></br>
			<h1 class="center"> [ unattend ] </h1></br>
		</div>
	<?php } ?>	
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
			<button id="close_btn" type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
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
