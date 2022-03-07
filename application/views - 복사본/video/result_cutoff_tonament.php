<style>
html, body{
	color : white;
	box-sizing: border-box;
	background : #263238;
}
h1.name{
	color : white;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h1.center{
	color : yellow;  //00251a;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h3.point{
	color : white;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h3.total{
	color : white;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.container{
	margin : 10px 10px 10px 200px;
	padding : 0;
	display: grid;
	grid-gap: 10px;
	justify-content:start;
}
.player{
	//padding-left: 10px;
	display: grid;
	grid-template-columns: 90px auto auto auto auto 1fr 100px;
	grid-gap: 5px;
	height: 10vh;
	width:75vw;
	min-width: 75vw;
	background: #1976d2;
	justify-content:start;
	align-content:center;
	box-shadow: 5px 5px #00251a;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
}
.order_no{
	display: grid;
	margin: 10px;
	justify-items:center;
	background: #004ba0;
	align-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.country{
	display: grid;
	justify-items:center;
	align-content:center;
	font-size: 2em;
	color: orange;
	font-weight: bold;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.picture{
	display: grid;
	//background: #00251a;
	justify-items:center;
	align-content:center;
}
.c_name{
	display: grid;
	justify-items:center;
	align-content:center;
}
.a_name{
	display: grid;
	justify-items:center;
	align-content:center;
}
.totals{
	display: grid;
	font-weight: bold;
	justify-items:end;
	align-content:center;
}
.points{
	display: grid;
	justify-items:end;
	align-content:center;
}
.winkind{
	display: grid;
	margin: 10px;
	justify-items:end;
	background: #004ba0;
	color: yellow;
	justify-items:center;
	align-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
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
#send_msg{
	font-size: 3em;
	font-weight: bold;
	color : white;
	background-color:blue;
}
img{
	margin: 0px;
	padding: 0px;
	object-fit: fill;
}
img.ath-picture {width:80px; height:60px;}
img.fit-picture{width:80px; height:60px;}
h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 360px) {  
  h1 {font-size:1.5rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img.ath-picture{width:50px; height:30px;}
  img.fit-picture{width:50px; height:30px;}
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
  img.ath-picture {width:80px; height:60px;}
  img.fit-picture{width:80px; height:60px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  img.ath-picture {width:80px; height:60px;}
  img.fit-picture{width:80px; height:60px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:2.5rem;} /*1rem = 16px*/    
  h2 {font-size:2.5rem;} /*1rem = 16px*/    
  h3 {font-size:2.5rem;} /*1rem = 16px*/    
  img.ath-picture {width:80px; height:60px;}
  img.fit-picture{width:80px; height:60px;}
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
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('video/show_jongmok/')?>" + json_obj[2];
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/athletes_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/athletes_tonament/')?>";
			}
			if(json_obj[2] == '14'||json_obj[2] == '15'||json_obj[2] == '16'||json_obj[2] == '17'){
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
	<div class="container">
	<?php 
		$compet_id = $_SESSION['compet_id'];
		$i = 0;
		foreach ($lists as $row){
			$i++;
			$a_id = $row['A_ID'];
			$order_no = $row['A_ORDERNO'];
			$video_url = $row['VIDEO_ID'];
			$video_id = "https://www.youtube.com/embed/" . $video_url;
			$a_name = $row['A_NAME'];
			$c_name = $row['A_CENTER'];
			$totals = $row['TXT_TOTAL'] == "0.00" ? "" : $row['TXT_TOTAL'];
			$points = $row['TXT_TOTAL'] == "0.00" ? "" : $row['TXT_POINTS'];
			$failed = $row['FAILED'];
			$unattend = $row['UNATTEND'];
			$win_str = '';
			if($_SESSION['compet_id']==37){   //37
				if($row['WIN_KIND']==1){
					$win_str = '금';
				}else if($row['WIN_KIND']==2){
					$win_str = '은';
				}else if($row['WIN_KIND'] > 2){
					$win_str = '동';
				}
			}else{
				$win_str = $row['WIN_KIND'];
			}
			$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
			$country = $country_data->COUNTRY_ENG;
			$ath_data = $this->tkd_model->get_athlete_byid($row['A_ID']);
			if(strlen($ath_data->A_PICTURE) > 10){
				$picture_id = $ath_data->A_PICTURE;
			}else{
				$picture_id = '';
			}
			if($failed == 1){
				$totals = '';
				$points = '실격';
			}else{
				$win_kind = $row['TXT_TOTAL'] == "0.00" ? "" : $win_str;
			}
		?>
		<div class="player">
			<div class="order_no">
				<h1 class="no"><b><?=$order_no?></b></h1>
			</div>
			<div class="country">
			<?php if($_SESSION['is_international']){ ?>
				<span><?=$country?> <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country?>.png">
				</span>
			<?php } ?>
			</div>
			<div class="picture">
				<?php if((strpos(strtolower($picture_id), '.jpg') !== false) ||
						(strpos(strtolower($picture_id), '.jpeg') !== false) ||
						(strpos(strtolower($picture_id), '.png') !== false)){?>
				<span> <img class="ath-picture" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$picture_id?>"></span>
				<?php } ?>
			</div>
			<div class="a_name">
				<h1 class="name"><b><?=$a_name?></b></h1>
			</div>
			<div class="c_name">
				<?php if($_SESSION['show_centername']==1){ ?>
					<?php if($unattend==1){ ?>
						<h1 class="center"><b><?=$c_name?>(불참)</b></h1>
					<?php }else{ ?>
						<h1 class="center"><b><?=$c_name?></b></h1>
					<?php } ?>
				<?php }else{ ?>
					<?php if($unattend==1){ ?>
						<h1 class="center"><b>(불참)</b></h1>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="totals">
				<h3 class="total"><span><?=$points?></span></br><span style="color:orange"><b><?=$totals?></b></span></h3>
			</div>
			<div class="winkind">
				<?php if($failed == 0){ ?>
				<h1 class="win"><b><?=$win_str?></b></h1>
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
	<?php if($_SESSION['use_animation']==1){ ?>
	<script src="http://ccnplaza.com/gsap-public/minified/gsap.min.js"></script>
	<script>
		gsap.from(".player", 1, {opacity: 0, x:1500, stagger:0.3});
	</script>	
	<?php } ?>