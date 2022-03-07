<style>
html, body{
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
}  
* {
  box-sizing: border-box;
}
body{
	background-color: #111111;
	width: 100%;
	height: 100vh;
	text-align: center;
	position: relative;
	background-size: cover;
	background-size: 100% 100%;
	z-index: 1;
}
body::after{
	background-color: #111111;
	width: 100vw;
	height: 100vh;
	content: "";
	//background-image: url(http://ccnplaza.com/tkd_compet/public/image/tkd_bg2.jpg);
	background-image: url(http://ccnplaza.com/tkd_compet/public/image/ktmca_bg.jpg);
	position: absolute;
	background-size: cover;
	top: 0;
	left: 0;
	z-index: -1;
	opacity: 0.7;
}
.cont{
	display: flex;
	flex-wrap: wrap;
	height: 100vh;
	width: 100%;
	justify-content:center;
}
.row{
	align-items: center;
}
#line1{
	margin-top : 150px;
	width: 100%;
	font-size: 6em;
	font-weight: bold;
	color : yellow;
}
#line2{
	margin-top : 30px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : orange;
}
#line3{
	margin-top : 50px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 2em;
	font-weight: bold;
	color : gray;
}
#line4{
	margin-top : 30px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 2em;
	font-weight: bold;
	color : gray;
}
#line5{
	margin-top : 30px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : cyan;
}
.sm_logo{
	justify-content:center;
	background-size: cover;
	background: white;
	margin-top: 24px;
	padding: 2px;
	width: 200px;
	height: 120px;
	box-shadow: 5px 5px black;
	grid-gap: 2px;
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
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('video/show_jongmok/')?>" + json_obj[2];
			}
			if(json_obj[2] == '103' || json_obj[2] == '104'){
				window.location.href = "<?php echo site_url('video/show_judge/')?>" + json_obj[2];
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/athletes_team/')?>";  //cutoff team single
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/athletes_tonament/')?>";
			}
			if(json_obj[2] == '14'||
				json_obj[2] == '141'||
				json_obj[2] == '15'||
				json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '17'){
				window.location.href = "<?php echo site_url('video/athletes_fight/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '24'||json_obj[2] == '25'||json_obj[2] == '26'){
				window.location.href = "<?php echo site_url('video/play_videos_cutoff/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '34'||json_obj[2] == '35'||json_obj[2] == '36'){
				window.location.href = "<?php echo site_url('video/result_cutoff/')?>" + json_obj[2]; //?Œë£¹Â˜?½Â”? å¯ƒê³Œ????°Âœ
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
			}
			if(json_obj[2] == '150'){
				window.location.href = "<?php echo site_url('video/play_adver_videos/')?>" + json_obj[6];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
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
	<?php 
		foreach ($results as $row){
			$is_international = $row['IS_INTERNATIONAL'];
			$compet_name = $_SESSION['country']==0 ? $row['C_NAME'] : $row['C_NAME_E']; 
			$compet_place = $_SESSION['country']==0 ? $row['C_PLACE'] : $row['C_PLACE_E'];
			$compet_owner = $_SESSION['country']==0 ? $row['C_OWNER'] : $row['C_OWNER_E'];
			$compet_support = $_SESSION['country']==0 ? $row['C_SUPPORT'] : $row['C_SUPPORT_E'];
		}
	?>
	<div class="row" id="line1">
		<?php if($_SESSION['compet_id']==51){ ?>
		<div class="col text-center">´ëÇÑÃ¼À°È¸<br><?=$compet_name?><br></div>
		<?php }else{ ?>
		<div class="col text-center"><?=$compet_name?><br></div>
		<?php } ?>	
	</div>	
	<div class="row" id="line2">
		<div class="col text-center"><?=$compet_place?><br></div>
	</div>	
	<div class="row" id="line3">
		<div class="col text-center"><?=$compet_owner?></p></div>
	</div>	
	<div class="row" id="line4">
		<div class="col text-center"><?=$compet_support?></p></div>
	</div>	
	<div class="row" id="line5">
		<?php if($coat_no > 10){
			$coat_no = $coat_no - 10;
		} ?>
		<div class="col text-center">Court <?=$coat_no?></div>
	</div>
	</br>
	</br>
	<div class="row justify-content-center" id="logo">
		<div class="col-md-12 text-center">
		<?php 
		foreach ($sponsor as $row){ 
			$s_name = $row['SPONSOR_LOGO'];
			$url = site_url('/public/image/').$s_name;
		?>
			<img id="sm_logo" class="sm_logo" src="<?=$url?>" height="150px" width="200px">
		<?php } ?>	
			<img id="sm_logo" class="sm_logo" src="<?php echo site_url('/public/image/sm_logo_s.jpg')?>" height="100px" width="200px">
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
	<?php if($_SESSION['use_animation']==1){ ?>
	<script src="http://ccnplaza.com/gsap-public/minified/gsap.min.js"></script>
	<script>
		gsap.from("#sm_logo", {duration: 2, y: 500});
		gsap.from("#line1", {duration: 1, x: "-100vw"});
		gsap.from("#line2", {duration: 1, x: "100vw"});
		gsap.from("#line3", {duration: 1, x: "-100vw"});
		gsap.from("#line4", {duration: 1, x: "100vw"});
		gsap.from("#line5", {duration: 1, y: 500});
	</script>	
	<?php } ?>