<style>
html, body{
	background: black;
	margin: 0;
	padding: 0;
	overflow:hidden;
}  
.container{
	margin: 0;
	padding:0;
	display:grid;
	height: 90vh;
	min-width:100%;
	grid-template-columns: repeat(4, 1fr);
	grid-template-areas:
		"p1 p1 p2 p2"
		". p3 p3 . ";
}
.player{
	display:grid;
	width: 50vw;
	background: black;
	border: 1px solid white;
}
.player:nth-child(1){
	grid-area: p1;
}
.player:nth-child(2){
	grid-area: p2;
}
.player:nth-child(3){
	grid-area: p3;
}

.video_info{
	display:grid;
	grid-column: 1;
	grid-row:1;
	width:100%;
	height: 44.5vh;
}	
.ath_info{
	display:grid;
	grid-template-columns: 10% auto 100px;
	column-gap:2px;
	grid-column: 1;
	grid-row:1;
	height: 50px;
	width:90%;
	font-size: 1.5em;
	font-weight: bold;
	color : white;
	border: 0px solid green;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	z-index: 2;
	margin-left:20px;
	justify-content:stretch;
}
.ath{
	border: 0px solid red;
}
.ath.timer{
	color:cyan;
	z-index: 3;
}
.country_flag{
	padding: 2px;
	width:50px;
	height:35px;
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
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 360px) {  
  h1 {font-size:1rem;} /*1rem = 16px*/
  h2 {font-size:1rem;} /*1rem = 16px*/
  h3 {font-size:1rem;} /*1rem = 16px*/
  img {width:50px; height:30px;}
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:100px; height:45px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:150px; height:90px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:2.5rem;} /*1rem = 16px*/    
  h2 {font-size:2rem;} /*1rem = 16px*/    
  h3 {font-size:2rem;} /*1rem = 16px*/    
  img {width:100px; height:70px;}
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
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
	var iframe3 = $("#video3");
	var player3 = new Vimeo.Player(iframe3);
	
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
			if(json_obj[2] == '21'){
				window.location.href = "<?php echo site_url('video/play_videos_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '22'){
				window.location.href = "<?php echo site_url('video/play_videos_tonament/')?>";
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
			if(json_obj[2] == '34'||json_obj[2] == '345'||json_obj[2] == '35'||json_obj[2] == '36'){
				window.location.href = "<?php echo site_url('video/result_cutoff/')?>" + json_obj[2]; //컷오프 결과표출
			}
			if(json_obj[2] == '84'){
				console.log(data_str);
				if (json_obj[6] == '1'){
					player1.pause();
				}
				if (json_obj[6] == '2'){
					player2.pause();
				}
				if (json_obj[6] == '3'){
					player3.pause();
				}
			}
			if(json_obj[2] == '86'){
				console.log(data_str);
				if(json_obj[3]==1){
					player1.setPlaybackRate(0.5);
					player1.play();
					player2.setPlaybackRate(0.5);
					player2.play();
					player3.setPlaybackRate(0.5);
					player3.play();
				}
				if(json_obj[3]==2){
					player1.setPlaybackRate(0.75);
					player1.play();
					player2.setPlaybackRate(0.75);
					player2.play();
					player3.setPlaybackRate(0.75);
					player3.play();
				}
				if(json_obj[3]==3){
					player1.setPlaybackRate(1.0);
					player1.play();
					player2.setPlaybackRate(1.0);
					player2.play();
					player3.setPlaybackRate(1.0);
					player3.play();
				}
				if(json_obj[3]==4){
					player1.setPlaybackRate(1.25);
					player1.play();
					player2.setPlaybackRate(1.25);
					player2.play();
					player3.setPlaybackRate(1.25);
					player3.play();
				}
				if(json_obj[3]==5){
					player1.setPlaybackRate(1.5);
					player1.play();
					player2.setPlaybackRate(1.5);
					player2.play();
					player3.setPlaybackRate(1.5);
					player3.play();
				}
				if(json_obj[3]==6){
					player1.setPlaybackRate(2.0);
					player1.play();
					player2.setPlaybackRate(2.0);
					player2.play();
					player3.setPlaybackRate(2.0);
					player3.play();
				}
			}
			if(json_obj[2] == '80'){
				console.log(data_str);
				if (json_obj[6] == '0'){
					player1.play();
					player2.play();
					player3.play();
				}else{
					if (json_obj[6] == '1'){
						player1.play();
					}
					if (json_obj[6] == '2'){
						player2.play();
					}
					if (json_obj[6] == '3'){
						player3.play();
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
				if (json_obj[6] == '2'){
					var ctime2 = $("#timer2").text();
					var seconds = ctime2.slice(-2, ctime2.length); 
					if(parseInt(seconds) > 3){
						player2.setCurrentTime(parseInt(seconds) - parseInt(json_obj[3]));
					}
				}
				if (json_obj[6] == '3'){
					var ctime3 = $("#timer3").text();
					var seconds = ctime3.slice(-2, ctime3.length); 
					if(parseInt(seconds) > 3){
						player3.setCurrentTime(parseInt(seconds) - parseInt(json_obj[3]));
					}
				}
			}
			if(json_obj[2] == '82'){	//5초 앞으로
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
				if (json_obj[6] == '3'){
					var ctime = $("#timer3").text();
					var seconds = ctime.slice(-2, ctime.length); 
					player3.setCurrentTime(parseInt(seconds) + parseInt(json_obj[3]));
				}
			}
			if(json_obj[2] == '83'){	//처음으로...
				if (json_obj[6] == '1'){
					player1.setCurrentTime(0);
				}
				if (json_obj[6] == '2'){
					player2.setCurrentTime(0);
				}
				if (json_obj[6] == '3'){
					player3.setCurrentTime(0);
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
<script type="text/javascript">
$(function() {
	var timer1 = $("#timer1");
	var timer2 = $("#timer2");
	var timer3 = $("#timer3");
	var iframe1 = $('#video1')[0];
	var iframe2 = $('#video2')[0];
	var iframe3 = $('#video3')[0];
	var player1 = new Vimeo.Player(iframe1);
	var player2 = new Vimeo.Player(iframe2);
	var player3 = new Vimeo.Player(iframe3);
	var done_cnt = 0;
	var buffer_cnt = 0;
	player1.play();
	player2.play();
	player3.play();
	/*
	player1.on('bufferend', function() {
	  player1.pause();
	  buffer_cnt ++ ;
	  console.log(buffer_cnt);
	  if (buffer_cnt == 3){
		player1.play();
		player2.play();
		player3.play();
	  } 
	});
	player2.on('bufferend', function() {
	  player2.pause();
	  buffer_cnt ++ ;
	  console.log(buffer_cnt);
	  if (buffer_cnt == 3){
		player1.play();
		player2.play();
		player3.play();
	  } 
	});
	player3.on('bufferend', function() {
	  player3.pause();
	  buffer_cnt ++ ;
	  console.log(buffer_cnt);
	  if (buffer_cnt == 3){
		player1.play();
		player2.play();
		player3.play();
	  } 
	});
	*/
	player1.on('ended', function(){
		done_cnt++;
		$('#video1').hide();	
		console.log(done_cnt);
		if (done_cnt == 3){
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
			document.getElementById("msg_btn").click();
		}
	});
	player2.on('ended', function(){
		done_cnt++;
		$('#video2').hide();	
		console.log(done_cnt);
		if (done_cnt == 3){
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
			document.getElementById("msg_btn").click();
		}
	});
	player3.on('ended', function(){
		done_cnt++;
		$('#video3').hide();	
		console.log(done_cnt);
		if (done_cnt == 3){
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
			document.getElementById("msg_btn").click();
		}
	});
	player1.on('timeupdate', function(data) {
		var ts1 = Math.floor(data.seconds);
		var min1 = parseInt((ts1%3600)/60);
		var sec1 = ts1 % 60;
		if(min1 < 10){min1 = "0" + min1;}
		if(sec1 < 10){sec1 = "0" + sec1;}
		timer1.html('<h2 class="timer">' + min1 + ":" + sec1 + '</h2>');
	});
	player2.on('timeupdate', function(data) {
		var ts2 = Math.floor(data.seconds);
		var min2 = parseInt((ts2%3600)/60);
		var sec2 = ts2 % 60;
		if(min2 < 10){min2 = "0" + min2;}
		if(sec2 < 10){sec2 = "0" + sec2;}
		timer2.html('<h2 class="timer">' + min2 + ":" + sec2 + '</h2>');
	});
	player3.on('timeupdate', function(data) {
		var ts3 = Math.floor(data.seconds);
		var min3 = parseInt((ts3%3600)/60);
		var sec3 = ts3 % 60;
		if(min3 < 10){min3 = "0" + min3;}
		if(sec3 < 10){sec3 = "0" + sec3;}
		timer3.html('<h2 class="timer">' + min3 + ":" + sec3 + '</h2>');
	});
});	
</script>
  <div class="container">
	<div class="player">
		<div class="ath_info">
			<?php if($_SESSION['is_international']==1){ ?>
			<div class="ath country"><?=$country[0]?>
				<img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png" >
			</div>
			<?php }else{ ?>
			<div></div>
			<?php } ?>
			<div class="ath ath_name"><?=$a_orderno[0]?>. <?=$a_name[0]?>
			<?php if($_SESSION['show_centername']==1){ ?>
			/<?=$c_name[0]?>
			<?php } ?>
			</div>
			<div class="ath timer" id="timer1">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video1" src="https://player.vimeo.com/video/<?=$video_id[0]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	</div>
	<div class="player">
		<div class="ath_info">
			<?php if($_SESSION['is_international']==1){ ?>
			<div class="ath country"><?=$country[1]?>
				<img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png" >
			</div>
			<?php }else{ ?>
			<div></div>
			<?php } ?>
			<div class="ath ath_name"><?=$a_orderno[1]?>. <?=$a_name[1]?>
			<?php if($_SESSION['show_centername']==1){ ?>
			/<?=$c_name[1]?>
			<?php } ?>
			</div>
			<div class="ath timer" id="timer2">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video2" src="https://player.vimeo.com/video/<?=$video_id[1]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	</div>
	<div class="player">
		<div class="ath_info">
			<?php if($_SESSION['is_international']==1){ ?>
			<div class="ath country"><?=$country[2]?>
				<img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[2]?>.png" >
			</div>
			<?php }else{ ?>
			<div></div>
			<?php } ?>
			<div class="ath ath_name"><?=$a_orderno[2]?>. <?=$a_name[2]?>
			<?php if($_SESSION['show_centername']==1){ ?>
			/<?=$c_name[2]?>
			<?php } ?>
			</div>
			<div class="ath timer" id="timer3">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video3" src="https://player.vimeo.com/video/<?=$video_id[2]?>?autoplay=1&autopause=0&portrait=0&quality=<?=$video_quality ?>"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
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
		  <div id="send_msg" class="modal-body blink">Calculating Point...</div>
		  <?php }else{ ?>
		  <div id="send_msg" class="modal-body blink">채점중...</div>
		  <?php } ?>
		</div>
	  </div>
	</div>
	</div>
