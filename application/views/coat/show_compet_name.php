<style>
/* Chrome, Safari and Opera syntax */
:-webkit-full-screen {
  background-color: black;
}

/* Firefox syntax */
:-moz-full-screen {
  background-color: black;
}

/* IE/Edge syntax */
:-ms-fullscreen {
  background-color: black;
}

/* Standard syntax */
:fullscreen {
  background-color: black;
}
body{
	background-color: black;
}
div{
	color : white;
	font-weight: bold; 
}
.container{
	height: 100vh;
}
#line1{
	margin-top : 150px;
}
#line2{
	margin-top : 100px;
}
#line3{
	margin-top : 50px;
}
#line4{
	fore-color : yellow;
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
		var compet_id1 = "<?php echo $_SESSION['competition_id'] ?>";
		var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
		var message = data.msg;
		var result = message.split(",");
		var compet_id2 = result[0];
		var coat_no2 = result[1];
		var action = result[2];
		//alert('id1:'+ compet_id1 + ' id2:' + compet_id2 + ' cno1:'+ coat_no1 + ' cno2:'+ coat_no2 + ' act:'+action);
		if(compet_id1 == compet_id2 && coat_no1 == coat_no2 && action == "1"){
			window.location.href = "<?php echo site_url('video/show_athletes/')?>";
		}
		if(compet_id1 == compet_id2 && coat_no1 == coat_no2 && action == "2"){
			window.location.href = "<?php echo site_url('video/play_videos/')?>";
		}
		if(compet_id1 == compet_id2 && coat_no1 == coat_no2 && action == "3"){
			window.location.href = "<?php echo site_url('video/show_lists/')?>";
		}
    });
  });

</script>
<div class="container">
	<?php 
		foreach ($results as $row){
			$compet_name = $row['C_NAME'];
			$compet_place = $row['C_PLACE'];
			$compet_owner = $row['C_OWNER'];
			$compet_support = $row['C_SUPPORT'];
		}
	?>
	<div class="row" id="line1">
		<div class="col text-center">
			<h1 style="font-size:4vw; color:yellow;"><?=$compet_name ?></h1>
		</div>	
	</div>	
	<div class="row" id="line2">
		<div class="col text-center">
			<h3 style="font-size:4vw;color:gray"><?=$compet_place ?></h3>
		</div>
	</div>	
	<div class="row" id="line3">
		<div class="col text-center">
			<h4 style="font-size:3vw; color:cyan"><?=$compet_owner ?></h4>
		</div>
	</div>	
	<div class="row" id="line4">
		<div class="col text-center">
			<h4 style="font-size:3vw; color:cyan"><?=$compet_support ?></h4>
		</div>
	</div>
