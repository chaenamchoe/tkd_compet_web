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
	height: 100vh;
	position: absolute;
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
		console.log(json_obj);
		if(compet_id1 == json_obj[0] && json_obj[1] == '0'){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
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
			if(json_obj[2] == '1'){
				window.location.href = "<?php echo site_url('video/show_jongmok/')?>";
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/athletes_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '41'){
				window.location.href = "<?php echo site_url('video/result_cutoff_team/')?>";  //개별영상결과
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/athletes_tonament/')?>";
			}
			if(json_obj[2] == '42'){
				window.location.href = "<?php echo site_url('video/result_tonament/')?>";  //토너먼트 결과표출
			}
			if(json_obj[2] == '13'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>";  //show_athletes
			}
			if(json_obj[2] == '14'){
				window.location.href = "<?php echo site_url('video/result_cutoff')?>";  //show_athletes
			}
			if(json_obj[2] == '33'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";  //show_athletes
			}
			if(json_obj[2] == '34'){
				window.location.href = "<?php echo site_url('video/show_results/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '21'){
				window.location.href = "<?php echo site_url('video/play_videos/1/')?>";
			}
			if(json_obj[2] == '22'){
				window.location.href = "<?php echo site_url('video/play_videos_tonament/')?>";
			}
			if(json_obj[2] == '24'){
				window.location.href = "<?php echo site_url('video/play_videos_cutoff/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
			}
			if(json_obj[2] == '3'){
				window.location.href = "<?php echo site_url('video/show_results/')?>";
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
});	
</script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var iframe1 = $('#video1')[0];
	var player1 = new Vimeo.Player(iframe1);
	//$("#video1").show();
	//});
	player1.on('ended', function(){
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('video/update_video_status')?>",
			dataType: 'json',
			data:{done: 1},  //여기의 id가 콘트롤러의 $this->input-post('id')값으로 들어온다.
			success: function(result)
			{
				console.log(result['post']);
			},
			error:function(request,status,error){
			}
		});
		$("#video1").hide();
	});
});
</script>
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6" id="youTubePlayer1">
			<iframe class="single_video" id="video1" src="https://player.vimeo.com/video/<?=$video_id?>?autoplay=1&autopause=0&portrait=0&controls=0"  width="100%" height="100%"
				frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
			</iframe>
		</div>
	</div>	
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
