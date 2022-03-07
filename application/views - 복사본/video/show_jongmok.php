<style>
html, body{
	margin: 0;
	padding: 0;
	background: #263238;
	box-sizing: border-box;
}  
.container{
	margin-top: 100px;
	display: grid;
	grid-gap: 10px;
	justify-content:center;
}
.line{
	width: 70vw;
	height: 2em;
	display: grid;
	font-size: 3em;
	font-weight: bold;
	color : white;
	background: #5e92f3;
	justify-content:center;
	align-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.line1{
	color : white;
	background: #003c8f;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.line2{
	color : yellow;
	background: #1565c0;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.line3{
	color : white;
	background: #42a5f5;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
.line4{
	color : yellow;
	background: #5e92f3;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
	//text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	box-shadow: 5px 5px #00251a;
}
#logo{
	margin-top: 200px;
}
.sm_logo{
	justify-content:center;
	background-size: cover;
	background: white;
	margin-top: 4px;
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
img.fit-picture{width:150px; height:120px;}
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
  img.ath-picture{width:100px; height:70px;}
  img.fit-picture{width:100px; height:70px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
  img.ath-picture {width:120px; height:90px;}
  img.fit-picture{width:120px; height:90px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
  img.ath-picture {width:150px; height:120px;}
  img.fit-picture{width:150px; height:120px;}
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
			if(json_obj[2] == '150'){
				window.location.href = "<?php echo site_url('video/play_adver_videos/')?>" + json_obj[6];
			}
		}
    });
  });
</script>

<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>

<div class="container">
	<div class="line line1"><?=$jongmok ?>
	<?php if($game_step <> '') { 
		echo '('.$game_step . ')';
	}?>
	</div>	
	<div class="line line2"><?=$category ?></div>
	<?php if($pumsae <> ''){ ?>
	<div class="line line3"><?=$pumsae?></div>
	<?php } ?>
	<div class="line line4"><?=$man_cnt?>/<?=$jo_cnt?> Group(<?=$jo?>)</div>
	<div class="row justify-content-center" id="logo">
		<div class="col-12 text-center">
		<?php foreach ($sponsor as $row){ 
			$s_name = $row['SPONSOR_LOGO'];
			$url = site_url('/public/image/').$s_name;
		?>
			<img id="sm_logo" class = "sm_logo" src="<?=$url?>" height="120px" width="200px">
		<?php } ?>	
			<img id="sm_logo" class = "sm_logo" src="<?php echo site_url('/public/image/sm_logo_s.jpg')?>" height="100px" width="200px">
		</div>
	</div>
	<?php if($_SESSION['use_animation']==1){ ?>
	<script src="http://ccnplaza.com/gsap-public/minified/gsap.min.js"></script>
	<script>
		gsap.from(".line:nth-child(odd)", {duration: 1.5, x: "-100vw"});
		gsap.from(".line:nth-child(even)", {duration: 1.5, x: "100vw"});
		gsap.from(".sm_logo", {duration: 1.5, y: 500});
	</script>	
	<?php } ?>
</div>