<style>
html, body{
	margin: 0;
	padding: 0;
	background-color: #263238;
	box-sizing: border-box;
}  
.container{
	display: grid;
	height: 100vh;
	width: 100vw;
	grid-gap: 10px;
	justify-content:center;
}
.line1{
	color : white;
	background: #003c8f;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.line2{
	color : white;
	background: #1976d2;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.line3{
	color : white;
	background: #003c8f;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
#logo{
	margin-top : 10px;
	padding: 0;
}
img{
	background-size: cover;
}
.sm_logo{
	background-size: cover;
	padding: 0;
	width: 200px;
	height: 100px;
	box-shadow: 5px 5px black;
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
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
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
			if(json_obj[2] == '14'||json_obj[2] == '15'||json_obj[2] == '16'||json_obj[2] == '17'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
			}
		}
    });
  });
</script>
<div class="container">
	<div class="line1 mt-5 pt-3 text-center" style="height: 80px;"><h1>JUDGES</h1></div>	
	<!--
		<div class="line2 pt-3 text-center" style="height: 130px;"><h1>심판위원장: 서효동<br>
														심판부위원장: 박찬호/신흥섭</h1></div>	
	-->													
	<div class="row justify-content-evenly">
			<?php if($judge){ ?>
				<?php if($show_judge_picture == 1){ ?> 
					<div class="card" style="width: 15rem; height: 400px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 1</h3></div>
					  <?php if($judge->JUDGE_ID1){ ?>
					  <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID1.'.jpg' ?>"> 
					  <?php } ?>
					  <div class="card-body">
						<h5 class="card-title text-center" style="color:#003c8f;"><b><?=$judge->J_NAME?></b></h5>
					  </div>
					</div>&nbsp;
					<div class="card" style="width: 15rem; height: 400px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 2</h3></div>
					  <?php if($judge->JUDGE_ID2){ ?>
					  <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID2.'.jpg' ?>" >
					  <?php } ?>
					  <div class="card-body">
						<h5 class="card-title text-center" style="color:#003c8f;"><b><?=$judge->J_NAME1?></b></h5>
					  </div>
					</div>&nbsp;
					<div class="card" style="width: 15rem; height: 400px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 3</h3></div>
					  <?php if($judge->JUDGE_ID3){ ?>
					  <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID3.'.jpg' ?>" >
					  <?php } ?>
					  <div class="card-body">
						<h5 class="card-title text-center" style="color:#003c8f;"><b><?=$judge->J_NAME2?></b></h5>
					  </div>
					</div>&nbsp;
					<?php if($judge->J_NAME3 <> ''){ ?>
					<div class="card" style="width: 15rem; height: 400px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 4</h3></div>
					  <?php if($judge->JUDGE_ID4){ ?>
					  <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID4.'.jpg' ?>" >
					  <?php } ?>
					  <div class="card-body">
						<h5 class="card-title text-center" style="color:#003c8f;"><b><?=$judge->J_NAME3?></b></h5>
					  </div>
					</div>&nbsp;
					<?php } ?>
					<?php if($judge->J_NAME4 <> ''){ ?>
					<div class="card" style="width: 15rem; height: 400px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 5</h3></div>
					  <?php if($judge->JUDGE_ID5){ ?>
					  <img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID5.'.jpg' ?>" >
					  <?php } ?>
					  <div class="card-body">
						<h5 class="card-title text-center" style="color:#003c8f;"><b><?=$judge->J_NAME4?></b></h5>
					  </div>
					</div>
					<?php } ?>
				<?php }else{ ?>
					<div class="card" style="width: 15rem; height: 150px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 1</h3></div>
					  <div class="card-body">
						<h3 class="card-title text-center"><?=$judge->J_NAME?></h3>
					  </div>
					</div>&nbsp;
					<div class="card" style="width: 15rem; height: 150px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 2</h3></div>
					  <div class="card-body">
						<h3 class="card-title text-center"><?=$judge->J_NAME1?></h3>
					  </div>
					</div>&nbsp;
					<div class="card" style="width: 15rem; height: 150px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 3</h3></div>
					  <div class="card-body">
						<h3 class="card-title text-center"><?=$judge->J_NAME2?></h3>
					  </div>
					</div>&nbsp;
					<?php if($judge->J_NAME3 <> ''){ ?>
					<div class="card" style="width: 15rem; height: 150px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 4</h3></div>
					  <div class="card-body">
						<h3 class="card-title text-center"><?=$judge->J_NAME3?></h3>
					  </div>
					</div>&nbsp;
					<?php } ?>
					<?php if($judge->J_NAME4 <> ''){ ?>
					<div class="card" style="width: 15rem; height: 150px;">
					  <div class="card-header text-center" style="background-color:#003c8f; color: white;"><h3>Judge 5</h3></div>
					  <div class="card-body">
						<h3 class="card-title text-center"><?=$judge->J_NAME4?></h3>
					  </div>
					</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
	</div>
	<div class="row justify-content-center" id="logo">
		<div class="col text-center">
			<?php 
			foreach ($sponsor as $row){ 
				$s_name = $row['SPONSOR_LOGO'];
				$url = site_url('/public/image/').$s_name;
			?>
				<img class="sm_logo" src="<?=$url?>" height="100px" width="200px">
			<?php } ?>
			<img class="sm_logo" src="<?php echo site_url('/public/image/sm_logo_s.jpg')?>" height="100px" width="200px">
		</div>
	</div>
	<?php if($_SESSION['use_animation']==1){ ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
	<script>
		gsap.from(".line1", {duration: 1, x: "-100vw"});
		gsap.from(".card", {duration: 1, y: 500});
		gsap.from(".sm_logo", {duration: 1, y: 500});
	</script>	
	<?php } ?>
	