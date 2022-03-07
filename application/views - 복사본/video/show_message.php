<!-- test -->
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
	font-size: 5em;
	font-weight: bold;
	color : yellow;
}
#line2{
	margin-top : 10px;
	width: 100%;
	font-size: 4em;
	font-weight: bold;
	color : gray;
}
#line3{
	margin : 0 0 0 0px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : white;
}
#line4{
	margin : 0 0 0 0px;
	padding: 0 0 0 0 px;
	width: 100%;
	font-size: 3em;
	font-weight: bold;
	color : cyan;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script>
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
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '1'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";
			}
			if(json_obj[2] == '2'){
				window.location.href = "<?php echo site_url('video/play_videos/')?>";
			}
			if(json_obj[2] == '3'){
				window.location.href = "<?php echo site_url('video/show_results/')?>";
			}
			if(json_obj[2] == '10'){
				var notice = json_obj[5].replace(/(\r?\n)/g, '<br>');
				document.getElementById("text").setAttribute("style", "margin:20px");
				document.getElementById("text").innerHTML = notice;
				on();
			}
			if(msg_obj.action == '11'){
				off();
			}
		}
    });
  });

</script>
<div class="cont">
	<div class="row" id="line1">
		<div class="col text-center"><?=$_SESSION['competition_name'] ?></div>	
	</div>	
	<div class="row" id="line3">
		<?php $tldr_clean = str_replace("\n", '<br />', $message) ?>
		<div class="col text-center"><?=$tldr_clean ?></div>
	</div>	
