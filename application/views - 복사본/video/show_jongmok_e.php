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
	width: 50vw;
	display: grid;
	font-size: 3em;
	font-weight: bold;
	color : white;
	background: #5e92f3;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.line1{
	color : white;
	background: #003c8f;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.line2{
	color : yellow;
	background: #1565c0;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.line3{
	color : white;
	background: #5e92f3;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
.line4{
	color : yellow;
	background: #42a5f5;
	justify-content:center;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
#logo{
	margin-top : 100px;
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

<div id="overlay" onclick="off()" class="text-center justify-content-center">
  <div id="text" style="margin:auto">Overlay Text</div>
</div>

<div class="container">
	<div class="line line1"><?=$jongmok ?>
	<?php if($game_step <> '') { 
		echo '('.$game_step . ')';
	}?></div>	
	<div class="line line2"><?=$category ?></div>
	<?php if($pumsae <> ''){ ?>
	<div class="line line3"><?=$pumsae?></div>
	<?php } ?>
	<div class="line line4"><?=$man_cnt?> / <?=$jo_cnt?> Game(<?=$jo?>)</div>
	<div class="row justify-content-center">
		<div class="col-md-10 text-center">
			</br>
			<?php if($judge){ 
				if($judge_count > 1){
					$width = "20%";
				}else{
					$width = "33%";
				}
			?>
			<!--
			<table class="table table-striped table-bordered table-dark">
				<tr>
					<td class="col-3 line6">何缴1</td>
					<td class="col-3 line6">何缴2</td>
					<td class="col-3 line6">何缴3</td>
					<?php if($judge_count > 1) { ?>
					<td class="col-3 line6">何缴4</td>
					<td class="col-3 line6">何缴5</td>
					<?php } ?>
				</tr>
				<tr>
				<?php if(isset($judge->J_NAME) || $judge->J_NAME <> ''){ ?>
					<td class="col-3 line5">
						<?=$judge->J_NAME?>
					</td>
				<?php } ?>
				<?php if(isset($judge->J_NAME1) || $judge->J_NAME1 <> ''){ ?>
					<td class="col-3 line5">
						<?=$judge->J_NAME1?>
					</td>	
				<?php } ?>
				<?php if(isset($judge->J_NAME2) || $judge->J_NAME2 <> ''){ ?>
					<td class="col-3 line5">
						<?=$judge->J_NAME2?><br>
					</td>	
				<?php } ?>
				<?php if($judge_count > 1) {	//1=3judges, 2=5judges...
					if(isset($judge->J_NAME3) || $judge->J_NAME3 <> ''){ ?>
					<td class="col-3 line5">
						<?=$judge->J_NAME3?>
					</td>
				<?php } ?>
				<?php if(isset($judge->J_NAME4) || $judge->J_NAME4 <> ''){ ?>
					<td class="col-3 line5">
						<?=$judge->J_NAME4?>
					</td>	
				<?php }} ?>
					</td>
				</tr>
				<?php if($show_judge_picture == 1){ ?> 
				<tr>
				<?php if(isset($judge->JUDGE_ID1)){ ?>
					<td class="col-3">
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID1.'.jpg' ?>" 
						onerror="this.src='http://ccnplaza.com/tkd_compet/judge/no_image.png';">
					</td>
				<?php } ?>
				<?php if(isset($judge->JUDGE_ID2)){ ?>
					<td class="col-3">
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID2.'.jpg'?>"
						onerror="this.src='http://ccnplaza.com/tkd_compet/judge/no_image.png';">
					</td>	
				<?php } ?>
				<?php if(isset($judge->JUDGE_ID3)){ ?>
					<td class="col-3">
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID3.'.jpg'?>"
						onerror="this.src='http://ccnplaza.com/tkd_compet/judge/no_image.png';">
					</td>	
				<?php } ?>
				<?php if($judge_count > 1) {	//1=3judges, 2=5judges...
					if(isset($judge->JUDGE_ID4)){ ?>
					<td class="col-3">
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID4.'.jpg'?>"
						onerror="this.src='http://ccnplaza.com/tkd_compet/judge/no_image.png';">
					</td>
				<?php } ?>
				<?php if(isset($judge->JUDGE_ID5)){ ?>
					<td class="col-3">
						<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/judge/<?=$judge->JUDGE_ID5.'.jpg'?>"
						onerror="this.src='http://ccnplaza.com/tkd_compet/judge/no_image.png';">
					</td>	
				<?php }} ?>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>
		</div>	
		-->
	</div>
	<div class="row justify-content-center" id="logo">
		<div class="col text-center">
			<!--<img src="<?php echo site_url('/public/image/ntad.png')?>" height="100px" width="300px">-->
			<img class="sm_logo" src="<?php echo site_url('/public/image/sm_logo_s.jpg')?>" height="100px" width="300px">
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
	<script>
		gsap.from(".line:nth-child(odd)", {duration: 1, x: "-100vw", ease: "bounce"});
		gsap.from(".line:nth-child(even)", {duration: 1, x: "100vw", ease: "bounce"});
		gsap.from(".sm_logo", {duration: 1, y: 500});
	</script>	