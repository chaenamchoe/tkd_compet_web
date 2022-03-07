<style>
body{
	color : white;
	background-color : #111111;
}
div{
	border: 1px;
}
h1.name{
	color : white;
	margin : 0px 10%;
	
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
	padding : 0px 0px;
}
.col-md-6{
	padding: 0px 0px;
	border:0px solid gray;
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
  font-size: 50px;
  color: white;
}
table{
	width : 50vw;
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
  /*img {width:50px; height:30px;}*/
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
  /*img {width:100px; height:45px;}*/
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  /*img {width:150px; height:90px;}*/
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
  /*img {width:150px; height:90px;}*/
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script>
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
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/athletes_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/athletes_tonament/')?>";
			}
			if(json_obj[2] == '14'||json_obj[2] == '15'||json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
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
			if(json_obj[2] == '34'||json_obj[2] == '35'||json_obj[2] == '36'){
				window.location.href = "<?php echo site_url('video/result_cutoff/')?>" + json_obj[2]; //컷오프 결과표출
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
<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center top">
		<span class="top_line"><h1 style="color:yellow;"><b><?=$jongmok?></b></h1></span>&nbsp;
		<span class="top_line"><h1 style="color:white; "><b>(<?=$category.' '.$jo ?>)</b></h1></span>&nbsp;
		<span class="top_line"><h1 style="color:yellow;"><b><?=$pumsae?></b></h1></span>
	</div>
	<div class="row justify-content-center">
	<?php 
		$compet_id = $_SESSION['compet_id'];
		$i=0;
		foreach ($lists as $row){
			$i++;
			$a_id = $row['A_ID'];
			$video_url = $row['VIDEO_ID'];
			$video_id = "https://www.youtube.com/embed/" . $video_url;
			$a_name = $row['A_NAME'];
			$c_name = $row['A_CENTER'];
			$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
			$country = $country_data->COUNTRY_ENG;
			$ath_data = $this->tkd_model->get_athlete_byid($row['A_ID']);
			if(strlen($ath_data->A_PICTURE) > 10){
				$picture_id = $ath_data->A_PICTURE;
			}else{
				$picture_id = '';
			}
			
		?>
		<div class="col-md" id="youTubePlayer1">
			<div id="video1_info" class="text-center">
				</br></br></br>
				<?php if($_SESSION['judge_count'] == 1){ ?>
					<?php if($_SESSION['is_international']==1){ ?>
					<img class="fit-picture" width="150px" height="80px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country?>.png"><br>
					<?php } ?>
					<h1 class="name"><b><?=$a_name?></b></h1>
					<h3 class="center"><?=$c_name?></h3></br>
					<?php if(strpos($picture_id, '.jpg') !== false){?>
					<img class="ath-picture" width="240px" height="320px" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$picture_id?>">
					<?php } ?>
				<?php }else{ ?>
					<?php if($_SESSION['is_international']==1){ ?>
					<img class="fit-picture" width="150px" height="80px" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country?>.png"><br>
					<?php } ?>
					<h1 class="name"><b><?=$a_name?></b></h1>
					<h3 class="center"><?=$c_name?></h3></br>
					<?php if(strpos($picture_id, '.jpg') !== false){?>
					<img class="ath-picture img-thumbnail" width="240px" height="320px" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$picture_id?>">
					<?php } ?>
					</h1>
				<?php } ?>	
			</div>
		</div>
	<?php } ?>
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
