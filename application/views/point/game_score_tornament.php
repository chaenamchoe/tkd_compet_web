<style>
input[type='number']{
    width: 80px;
	font-size: 1.5rem;
	color: red;
} 
.col_no{
	color: blue;
	text-align: center;
}
.col_point{
	color: red;
	text-align: center;	
}
th {
	text-align: center;	
}
td {
	padding: 15px;	
  vertical-align: middle;
}

h1 {font-size:2rem;} /*1rem = 16px*/
h2 {font-size:2rem;} /*1rem = 16px*/
h3 {font-size:1.5rem;} /*1rem = 16px*/
h4 {font-size:1.5rem;} /*1rem = 16px*/
@media (max-width: 544px) {  
	.col_no{
		font-size:1.5rem;
	}
	.ath_name {
		font-size:1.5rem;
	}
	.col_point {
		font-size:1.5rem;
	}
}
@media (min-width: 545px) {  
	.col_no{
		font-size:1.5rem;
	}
	.ath_name {
		font-size:1.5rem;
	}
	.col_point {
		font-size:1.5rem;
	}
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
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == "0"){
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('point/show_jongmok/')?>";
			}
			if((json_obj[2] == "11") || 
				(json_obj[2] == "12") || 
				(json_obj[2] == "14") || 
				(json_obj[2] == "15") || 
				(json_obj[2] == "16"))
			{
				window.location.href = "<?php echo site_url('point/show_point/')?>" + json_obj[2];
			}
		}
    });
});
</script>
<div class="container">
	<div class="row">
		<div class="col text-center">
			<p><h3 class="alert alert-success"><?php echo $_SESSION['jongmok_name']; ?></h3>
			<h3 class="alert alert-info">Court: <?php echo $_SESSION['coat_no']; ?> Judge: <?php echo $_SESSION['judge_no']; ?> </h3>
			</p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col">
			<form action="<?php echo site_url('point/save_point_torn/')?>" method="post">
			<table class="table table-bordered table-reponsible-md">
				<thead class="thead-dark">
					<tr>
						<th width="50px">No</th>
						<th>Name</th>
						<th width="70px">Point</th>
						<!--<th width="70px">Point1(4)</th>-->
						<!--<th width="70px">Point2(6)</th>-->
					</tr>
				</thead>
				<?php
					$cnt = count($result);
					$judge_no = $_SESSION['judge_no'];
					$bid = $result[0]['ID'];
					$boid = $result[0]['A_ORDERNO'];
					$bname = $result[0]['A_NAME'];
					$rid = $result[1]['ID'];
					$roid = $result[1]['A_ORDERNO'];
					$rname = $result[1]['A_NAME'];
				?>
				<tr>
					<input type="hidden" name="bid" value="<?=$bid?>">
					<td style="vertical-align: middle; background-color:blue; color:white" class="col_no">B</td>
					<td style="vertical-align: middle;" class="ath_name"><?=$bname ?></td>
					<td style="vertical-align: middle;"><input type="number" step="0.01" name="bpoint1"></td>
					<!--<td style="vertical-align: middle;"><input type="number" step="0.01" name="bpoint2"></td>-->
				</tr>
				<tr>
					<input type="hidden" name="rid" value="<?=$rid?>">
					<td style="vertical-align: middle; background-color:red; color:white" class="col_no">R</td>
					<td style="vertical-align: middle;" class="ath_name"><?=$rname ?></td>
					<td style="vertical-align: middle;"><input type="number" step="0.01" name="rpoint1"></td>
					<!--<td style="vertical-align: middle;"><input type="number" step="0.01" name="rpoint2"></td>-->
				</tr>
			</table>
			<div class="text-center">
				<input type="submit" value="SAVE" class="btn btn-primary btn-lg">
			</div>
		</div>
	</div>
