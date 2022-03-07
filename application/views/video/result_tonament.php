<style>
body{
	color : white;
	background-color : #111111;
}
div{
	border: 1px;
}
.table{
	margin : 0px 10%;
	width: 40vw;
}
h1.name{
	color : white;
	margin : 0px 10%;
}
h1.total{
	font-size:4em;
	color : #33C4FF;
}
h3.center{
	color : orange;
}
.points{
	width: 80vw;
	font-size:1.5em;
	color : #96FF33;
}
.container-fluid{
	margin : 0px 0px;
	padding : 0px 0px;
}
span.top_line{
	margin-top : 5px;
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
.blue_red:nth-child(1){
	margin : 0px 0px;
	padding: 0px 0px;
	border:10px solid blue;
}
.blue_red:nth-child(2){
	margin : 0px 0px;
	padding: 0px 0px;
	border:10px solid red;
}
.win_blue{
	font-size:4em;
	margin : 1px 300px 1px;
	background-color:blue; 
	color : white;
}
.win_red{
	font-size:4em;
	margin : 1px 300px 1px;
	background-color:red; 
	color : white;
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
.blink {
  animation: blinker 1.5s linear infinite;
}

@keyframes blinker {  
  50% { opacity: 0; }
}

h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
img {width:50px; height:30px;}
img.ath-picture{width:100px; height:150px;}
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 360px) {  
  h1 {font-size:1.5rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:50px; height:30px;}
  img.ath-picture{width:100px; height:150px;}
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
  img {width:100px; height:45px;}
  img.ath-picture{width:100px; height:150px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  img {width:150px; height:90px;}
  img.ath-picture{width:100px; height:150px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
  img {width:120px; height:80px;}
  img.ath-picture{width:200px; height:250px;}
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
			if(json_obj[2] == '14'||json_obj[2] == '141'||json_obj[2] == '15'||json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '150'){
				window.location.href = "<?php echo site_url('video/play_adver_videos/')?>" + json_obj[6];
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
	<div class="row justify-content-center">
	<?php 
	$compet_id = $_SESSION['compet_id'];
	$i=0;
	foreach ($lists as $row){
		$i++;
		$a_id = $row['A_ID'];
		$a_name = $row['A_NAME'];
		$c_name = $row['A_CENTER'];
		$point1_1 = number_format($row['J1_POINT2'], 2);
		$point2_1 = number_format($row['J2_POINT2'], 2);
		$point3_1 = number_format($row['J3_POINT2'], 2);
		$point4_1 = number_format($row['J4_POINT2'], 2);
		$point5_1 = number_format($row['J5_POINT2'], 2);
		$point1_2 = number_format($row['J1_POINT3'], 2);
		$point2_2 = number_format($row['J2_POINT3'], 2);
		$point3_2 = number_format($row['J3_POINT3'], 2);
		$point4_2 = number_format($row['J4_POINT3'], 2);
		$point5_2 = number_format($row['J5_POINT3'], 2);
		$min_idx1 = $row['MIN_IDX2'];
		$max_idx1 = $row['MAX_IDX2'];
		$min_idx2 = $row['MIN_IDX3'];
		$max_idx2 = $row['MAX_IDX3'];
		$win_kind = $row['WIN_KIND'];
		$avg1_total = number_format($row['AVG2_TOTAL'], 2);
		$avg2_total = number_format($row['AVG3_TOTAL'], 2);
		
		$avg_all = number_format($avg1_total + $avg2_total, 2);
		//$totals = $row['TXT_TOTAL'] == "0.00" ? "" : $row['TXT_TOTAL'];
		//$points = $row['TXT_TOTAL'] == "0.00" ? "" : $row['TXT_POINTS'];
		if($a_id > 0) {
			$country_data = $this->tkd_model->get_country_by_aid($row['A_ID']);
			$country = $country_data->COUNTRY_ENG;
			$ath_data = $this->tkd_model->get_athlete_byid($row['A_ID']);
			if(strlen($ath_data->A_PICTURE) > 2){
				$picture = $ath_data->A_PICTURE;
			}else{
				$picture = '';
			}
		}?>
	<div class="col-sm-6 blue_red" id="youTubePlayer1">
		<div id="video1_info" class="text-center">
			</br></br>
			<?php if($_SESSION['is_international'] && isset($country)){ ?>
				<div>
				<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/<?=$country?>.png"><br>
				<p></p>
				</div>
			<?php } ?>
			<?php if($i===1){?>
				<?php if($win_kind==1){ ?>
				<h1 class="name blink" style="background-color:blue; padding:10px;"><b><?=$a_name?></b></h1>
				<?php }else{ ?>
				<h1 class="name" style="background-color:blue; padding:10px;"><b><?=$a_name?></b></h1>
				<?php } ?>
			<?php } else { ?>
				<?php if($win_kind==1){ ?>
				<h1 class="name blink" style="background-color:red; padding:10px;"><b><?=$a_name?></b></h1>
				<?php }else{ ?>
				<h1 class="name" style="background-color:red; padding:10px;"><b><?=$a_name?></b></h1>
				<?php } ?>
			<?php }?>
			<?php if($_SESSION['show_centername']==1){ ?>
			<h3 class="center"><?=$c_name?></h3>
			<?php } ?>
			</br>
			<div>
				<?php if($_SESSION['use_athlete_picture']==1){
					if((strpos(strtolower($picture), '.jpg') !== false) ||
						(strpos(strtolower($picture), '.jpeg') !== false) ||
						(strpos(strtolower($picture), '.png') !== false)){?>
				<span> <img class="ath-picture img-thumbnail" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$picture?>"></span>
				<?php }else{ ?>
				<span> <img class="ath-picture" src="http://ccnplaza.com/tkd_compet/uploads/unknown2.png"></span>
				<?php }} ?>
			</div>
			<?php if($win_kind==1){ ?>
				<div>
				<h1 class="total blink"><b><?=$avg_all?></b></h1>
				</div>
			<?php }else{ ?>	
				<div>
				<h1 class="total"><b><?=$avg_all?></b></h1>
				</div>
			<?php } ?>	
			<table class="table table-striped table-dark">
			<tr>
				<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>Average</td>
			</tr>
			<tr>
				<td class="points" <?php if($min_idx1==1){ echo 'style="color:red"';} if($max_idx1==1){ echo 'style="color:orange"';} ?>><?=$point1_1?></td>
				<td class="points" <?php if($min_idx1==2){ echo 'style="color:red"';} if($max_idx1==2){ echo 'style="color:orange"';} ?>><?=$point2_1?></td>
				<td class="points" <?php if($min_idx1==3){ echo 'style="color:red"';} if($max_idx1==3){ echo 'style="color:orange"';} ?>><?=$point3_1?></td>
				<td class="points" <?php if($min_idx1==4){ echo 'style="color:red"';} if($max_idx1==4){ echo 'style="color:orange"';} ?>><?=$point4_1?></td>
				<td class="points" <?php if($min_idx1==5){ echo 'style="color:red"';} if($max_idx1==5){ echo 'style="color:orange"';} ?>><?=$point5_1?></td>
				<td class="points" style="color:yellow; font-weight:bold"><?=$avg1_total?></td>
			</tr>
			<tr>
				<td class="points" <?php if($min_idx2==1){ echo 'style="color:red"';} if($max_idx2==1){ echo 'style="color:orange"';} ?>><?=$point1_2?></td>
				<td class="points" <?php if($min_idx2==2){ echo 'style="color:red"';} if($max_idx2==2){ echo 'style="color:orange"';} ?>><?=$point2_2?></td>
				<td class="points" <?php if($min_idx2==3){ echo 'style="color:red"';} if($max_idx2==3){ echo 'style="color:orange"';} ?>><?=$point3_2?></td>
				<td class="points" <?php if($min_idx2==4){ echo 'style="color:red"';} if($max_idx2==4){ echo 'style="color:orange"';} ?>><?=$point4_2?></td>
				<td class="points" <?php if($min_idx2==5){ echo 'style="color:red"';} if($max_idx2==5){ echo 'style="color:orange"';} ?>><?=$point5_2?></td>
				<td class="points" style="color:yellow; font-weight:bold"><?=$avg2_total?></td>
			</tr>
			</table>
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
			<h4 class="modal-title" id="exampleModalLabel">Notice</h4>
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
