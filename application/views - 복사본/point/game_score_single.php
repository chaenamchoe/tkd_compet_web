<style>
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
h3 {font-size:2rem;} /*1rem = 16px*/
h4 {font-size:2rem;} /*1rem = 16px*/
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
		font-size:2rem;
	}
	.ath_name {
		font-size:2rem;
	}
	.col_point {
		font-size:2rem;
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
			<h3 class="alert alert-info">코트: <?php echo $_SESSION['coat_no']; ?> 부심: <?php echo $_SESSION['judge_no']; ?> </h3>
			</p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col">
			<table class="table table-bordered table-reponsible-md">
				<thead class="thead-dark">
					<tr>
						<th width="50px">No</th>
						<th>선수명</th>
						<th width="70px">점수</th>
						<th width="70px">입력</th>
					</tr>
				</thead>
				<?php
					$idx = 0;
					$judge_no = $_SESSION['judge_no'];
					foreach ($result as $row):
						$idx = $idx+1;
						$id = $row['ID'];
						$oid = $row['A_ORDERNO'];
						$name = $row['A_NAME']; //.'-'.$row['A_CENTER'];
						$point = $row['J'.$judge_no.'_POINT'];
					?>
					<tr>
						<td style="display:none;" id="<?=$id?>"></td>
						<td style="vertical-align: middle;" class="col_no"><?=$oid?></td>
						<td style="vertical-align: middle;" class="ath_name"><?=$name ?></td>
						<td style="vertical-align: middle;" class="col_point"><?=number_format($point,2)?></td>
						<td style="vertical-align: middle;"><a href=<?php echo site_url('point/score_edit/'.$id)?> class="btn btn-primary">입력</a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>
