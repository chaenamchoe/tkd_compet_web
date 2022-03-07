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
.fit-picture{
	//background-size: cover;
	width:"300px";
	height:"400px"
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
			if(json_obj[2] == '14'||json_obj[2] == '141'||json_obj[2] == '15'||json_obj[2] == '16'||json_obj[2] == '17'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
			}
		}
    });
  });
</script>
<div class="container">
	<div class="line1 mt-5 pt-3 text-center" style="height: 80px;"><h1>JUDGES</h1></div>	
	<div class="row justify-content-evenly">
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
		</div>
		<div class="card" style="width: 330px; height: 520px;">
		<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/kuysc/bj_kim.jpg" width="300px" height="400px"> 
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
	