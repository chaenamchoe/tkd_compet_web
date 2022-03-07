<style>

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
		if(compet_id1 == compet_id2 && coat_no1 == coat_no2 && action == "0"){
			window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
		}
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
<div class="container-fluid">
	<div class="row justify-content-center top">
  		<h1><?php echo $_SESSION['competition_name'] ?></h1>
	</div>
	<div class="row justify-content-center">
  		<div class="col-sm-6">
		  <div><h2>Coat 1</h2></div>
		<table class="table table-bordered table-striped table-response text-center">
		<?php 
			$i = 0;
			foreach ($results as $row){
				$i++;
				$a_id = $row['ID'];
				$jo = $row['GAME_SET'];
				$g_id = $row['GAME_ID'];
				$category_name = $row['CATEGORY_NAME'];
				$blue_name = $row['BLUE_NAME'];
				$totals = $row['B1_TOTAL'];
				$win_kind = $row['WINNER'];
			?>
			<tr>
				<td width="5%" style="vertical-align:middle">
					<h1 class="no" style="font-size:20px"><b><?=$jo?></b></h1>
				</td>
				<td width="5%" style="vertical-align:middle">
					<h1 class="no" style="font-size:20px"><b><?=$g_id?></b></h1>
				</td>
				<td width="20%" style="vertical-align:middle">
					<h1 class="name" style="font-size:20px"><b><?=$category_name?></b></h1>
				</td>
				<td width="35%" style="vertical-align:middle">
					<h1 class="center" style="color : blue;font-size:20px"><?=$blue_name?></h1>
				</td>
				<td width="10%" style="vertical-align:middle">
					<h1 class="total" style="font-size:20px"><b><?=$totals?></b></h1>
				</td>
				<td width="5%" style="vertical-align:middle">
					<h1 class="win" style="font-size:20px"><b class="badge badge-info"><?=$win_kind?></b></h1>
				</td>
			</tr>	
			<?php } ?>
		</table>	
		</div>
		<div class="col-sm-6">
		<div><h2>Coat 2</h2></div>
		<table class="table table-bordered table-striped table-response text-center">
		<?php 
			$i = 0;
			foreach ($results2 as $row){
				$i++;
				$a_id = $row['ID'];
				$category_name = $row['CATEGORY_NAME'];
				$blue_name = $row['BLUE_NAME'];
				$totals = $row['B1_TOTAL'];
				$win_kind = $row['WINNER'];
			?>
			<tr>
				<td width="5%" style="vertical-align:middle">
					<h1 class="no" style="font-size:20px"><b><?=$jo?></b></h1>
				</td>
				<td width="5%" style="vertical-align:middle">
					<h1 class="no" style="font-size:20px"><b><?=$g_id?></b></h1>
				</td>
				<td width="20%" style="vertical-align:middle">
					<h1 class="name" style="font-size:20px"><b><?=$category_name?></b></h1>
				</td>
				<td width="35%" style="vertical-align:middle">
					<h1 class="center" style="color : blue;font-size:20px"><?=$blue_name?></h1>
				</td>
				<td width="10%" style="vertical-align:middle">
					<h1 class="total" style="font-size:20px"><b><?=$totals?></b></h1>
				</td>
				<td width="5%" style="vertical-align:middle">
					<h1 class="win" style="font-size:20px"><b class="badge badge-info"><?=$win_kind?></b></h1>
				</td>
			</tr>	
			<?php } ?>
		</table>	
		</div>
	</div>
</div>