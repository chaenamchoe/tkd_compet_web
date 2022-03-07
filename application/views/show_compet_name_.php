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
<script>
	function autoRefresh(){
		$.ajax({
			type : "GET",
			url : "<?php echo site_url('video/get_video_action/')?>",
			dataType : "text",
			error : function(){
				alert('ajax onerror called...');
			},
			success : function(data){
				if(data=="3"){
					window.location.href = "<?php echo site_url('video/show_lists/')?>";
				};
			}
		});
	}
	setInterval(function(){
		autoRefresh();
	}, 5000);
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
