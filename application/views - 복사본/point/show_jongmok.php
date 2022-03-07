<style>
html, body{
	margin: 0px 0px 0px 0px;
	padding: 0px 0px 0px 0px;
}  
* {
  box-sizing: border-box;
}

body{
	background-color: black;
}
table{
	margin-top: 10px;
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
#line_top{
	width: 100%;
	margin-top : 100px;
	font-size: 2em;
	font-weight: bold;
	color : white;
}
#line1{
	width: 100%;
	margin-top : 100px;
	font-size: 2em;
	font-weight: bold;
	color : yellow;
}
#line2{
	margin-top : 10px;
	width: 100%;
	font-size: 2em;
	font-weight: bold;
	color : orange;
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
	font-size: 2em;
	font-weight: bold;
	color : cyan;
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
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('point/show_jongmok/')?>";
			}
			if((json_obj[2] == "11") || 
				(json_obj[2] == "12") || 
				(json_obj[2] == "14") || 
				(json_obj[2] == "15") || 
				(json_obj[2] == "16") || 
				(json_obj[2] == "17"))
			{
				window.location.href = "<?php echo site_url('point/show_point/');?>" + json_obj[2];
			}
		}
    });
  });
</script>

<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 text-center">
			</br>
			<table class="table table-striped table-dark">	
			<?php if($game_step <> '') { ?>
			<tr>
				<td class="col text-center" id="line_top"><?=$game_step ?></td>	
			</tr>	
			<?php } ?>
			<tr>
				<td class="col text-center" id="line1"><?=$jongmok ?></td>	
			</tr>	
			<tr>
				<td class="col text-center" id="line2"><?=$category ?></td>
			</tr>	
			<?php if($pumsae <> ''){ ?>
			<tr>
				<td class="col text-center" id="line3"><?=$pumsae?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="col text-center" id="line4"><?=$man_cnt?> 명 / <?=$jo_cnt?> 게임</td>
			</tr>	
			<tr>
				<td class="col text-center" id="line4"><?=$jo?></td>
			</tr>	
			</table>
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
