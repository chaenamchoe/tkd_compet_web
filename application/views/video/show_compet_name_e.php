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
	background-image: url(http://ccnplaza.com/tkd_compet/public/image/tkd_bg2.jpg);
	position: absolute;
	background-size: cover;
	top: 0;
	left: 0;
	z-index: -1;
	opacity: 0.2;
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
	width: 100%;
	margin-top : 100px;
	font-size: 3em;
	font-weight: bold;
	color : yellow;
}
#line2{
	margin-top : 10px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : gray;
}
#line3{
	margin : 0 0 0 0px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 2em;
	font-weight: bold;
	color : orange;
}
#line4{
	margin : 0 0 0 0px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : cyan;
}
#overlay {
  position: fixed;
  display: none;
  width: 1000px;
  height: 300px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  background-color: rgba(0,0,255,1);
  z-index: 2;
  cursor: pointer;
}

#text{
  margin: auto;
  font-size: 50px;
  color: yellow;
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
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
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
			if(json_obj[2] == '14'||json_obj[2] == '15'||json_obj[2] == '16'){
				window.location.href = "<?php echo site_url('video/athletes_cutoff/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '17'){
				window.location.href = "<?php echo site_url('video/athletes_fight/')?>" + json_obj[2];  //show_athletes
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
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

<div class="cont">
	<?php 
		foreach ($results as $row){
			$compet_name = $row['C_NAME'];
			$compet_place = $row['C_PLACE'];
			$compet_owner = $row['C_OWNER'];
			$compet_support = $row['C_SUPPORT'];
			$is_international = $row['IS_INTERNATIONAL'];
			$compet_name_e = $row['C_NAME_E'];
			$compet_place_e = $row['C_PLACE_E'];
			$compet_owner_e = $row['C_OWNER_E'];
			$compet_support_e = $row['C_SUPPORT_E'];
		}
	?>
		<div class="row" id="line1">
			<div class="col text-center"><?=$compet_name_e ?><br></div>	
		</div>	
		<div class="row" id="line2">
			<div class="col text-center"><?=$compet_place_e ?></div>
		</div>	
		<div class="row" id="line3">
			<div class="col text-center"><p><?=$compet_owner_e ?></p><p><?=$compet_support_e ?></p></div>
		</div>	
	<div class="row" id="line4">
		<div class="col text-center">Court : <?=$coat_no?></div>
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
