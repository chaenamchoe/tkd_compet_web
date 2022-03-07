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
	font-size: 4em;
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
	font-size: 3em;
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
		var compet_id1 = "<?php echo $_SESSION['competition_id'] ?>";
		var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
		var data_str = data.msg;
		var json_obj = data_str.split("|");
		console.log(json_obj);
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			window.location.href = "<?php echo site_url('process/show_list/" + json_obj[4] + "/" + json_obj[6] + "')?>";
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
		}
	?>
	<div class="row" id="line1">
		<div class="col text-center"><?=$compet_name ?></div>	
	</div>	
	<div class="row" id="line2">
		<div class="col text-center"><?=$compet_place ?></div>
	</div>	
	<div class="row" id="line3">
		<div class="col text-center"><p><?=$compet_owner ?></p><p><?=$compet_support?></p></div>
	</div>	
	<div class="row" id="line4">
		<div class="col text-center">ÄÚÆ®: <?=$coat_no?></div>
	</div>
