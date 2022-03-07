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
	height: 45vh;
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
.col-sm-6{
	padding: 0px 0px;
	border:1px solid white;
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
	height: 90vh;
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

h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 360px) {  
  h1 {font-size:1.5rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:50px; height:30px;}
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
  img {width:100px; height:45px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  img {width:150px; height:90px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
  img {width:150px; height:90px;}
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
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/show_lists/1/')?>";  //show_athletes
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/show_lists/2/')?>";  //show_athletes
			}
			if(json_obj[2] == '13'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";  //show_athletes
			}
			if(json_obj[2] == '14'){
				window.location.href = "<?php echo site_url('video/show_lists/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '33'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";  //show_athletes
			}
			if(json_obj[2] == '34'){
				window.location.href = "<?php echo site_url('video/show_lists/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/show_lists/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '21'){
				window.location.href = "<?php echo site_url('video/play_videos/1/')?>";
			}
			if(json_obj[2] == '22'){
				window.location.href = "<?php echo site_url('video/play_videos/2/')?>";
			}
			if(json_obj[2] == '24'){
				window.location.href = "<?php echo site_url('video/play_videos/4/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[7];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
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
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center top">
		<?php if($game_step <> ''){ ?>
		<span class="top_line badge badge-primary"><h2 style="color:white;"><b><?=$game_step?></b></h2></span>&nbsp
		<?php } ?>
		<span class="top_line"><h2><b><?=$jongmok?></b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:white;"><b>(<?=$category.' '.$jo ?>)</b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:yellow;"><b><?=$pumsae?></b></h2></span>
	</div>
	<?php if($rec_cnt === 1) { ?>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 1. <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[0]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[0]?>">
			<?php } ?>
			</div>
		</div>
	</div><?php } ?>
	<?php if($rec_cnt === 2) { ?>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 1. <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[0]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[0]?>">
			<?php } ?>
			</div>
		</div>
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video2_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 2. <?=$a_name[1]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[1]?>/<?=$c_name[1]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[1]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[1]?>">
			<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if ($rec_cnt === 3) { ?>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 1. <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[0]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[0]?>">
			<?php } ?>
			</div>
		</div>
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video2_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 2. <?=$a_name[1]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[1]?>/<?=$c_name[1]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[1]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[1]?>">
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer3">
			<div id="video3_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[2]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 3. <?=$a_name[2]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[2]?>/<?=$c_name[2]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[2]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[2]?>">
			<?php } ?>
			</div>
		</div>
	</div><?php } ?>	
	<?php if ($rec_cnt === 4) { ?>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[0]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 1. <?=$a_name[0]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[0]?>/<?=$c_name[0]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[0]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[0]?>">
			<?php } ?>
			</div>
		</div>
		<div class="col-sm-6" id="youTubePlayer1">
			<div id="video2_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[1]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 2. <?=$a_name[1]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[1]?>/<?=$c_name[1]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[1]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[1]?>">
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer3">
			<div id="video3_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[2]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 3. <?=$a_name[2]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[2]?>/<?=$c_name[2]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[2]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[2]?>">
			<?php } ?>
			</div>
		</div>
		<div class="col-sm-6" id="youTubePlayer4">
			<div id="video4_info" class="bar" style="color:white">
				<table>
				<tr>
					<td rowspan="2">
						<?php if($_SESSION['country']==1){ ?>
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country[3]?>.png">
						<?php } ?>
					<td><h1 class="name"><b>&nbsp; 4. <?=$a_name[3]?></b></h1></td>
				</tr>
				<tr>
					<td><h3 class="center">&nbsp; <?=$country[3]?>/<?=$c_name[3]?></h3></td>
				</tr>
				</table>
			</div>
			<div>
			<?php if(strlen($picture_id[3]) === 11){ ?>
			<img id="picture1" width="360px" height="200%" src="http://ccnplaza.com/tkd_compet/uploads/<?=$picture_id[3]?>">
			<?php } ?>
			</div>
		</div>
	</div>
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
