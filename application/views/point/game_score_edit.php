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
		var data_str = data.msg;
		var json_obj = data_str.split("|");
		console.log(json_obj);
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == "0"){
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}else if(json_obj[2] == "11"){
				window.location.href = "<?php echo site_url('point/point/')?>";
			}else if(json_obj[2] == "12"){
				window.location.href = "<?php echo site_url('point/point/')?>";
			}else if(json_obj[2] == "14"){
				window.location.href = "<?php echo site_url('point/point/')?>";
			}else if(json_obj[2] == "16"){
				window.location.href = "<?php echo site_url('point/point4/')?>";
			}
		}
    });
});
</script>
<div class="container">
	<div class="row">
		<div class="col text-center">
			<p><h3 class="alert alert-success"><?=$jongmok?></h3>
			<h4 class="alert alert-info">코트: <?=$_SESSION['coat_no'] ?> 부심: <?=$_SESSION['judge_no'] ?> </h4>
			</p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-8">
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
					foreach ($result as $row):
						$idx = $idx+1;
						$id = $row['ID'];
						$oid = $row['A_ORDERNO'];
						$name = $row['A_NAME'].'-'.$row['A_CENTER'];
						$point = $row['J'.$judge_no.'_POINT'];
					?>
				<?php if($game_kind > 0 ){ ?>
					<tr>
						<td style="display:none;" id="<?=$id?>"></td>
						<td class="col_no"><h4><?=$oid?></h4></td>
						<td class="col_name"><h4><?=$name ?></h4></td>
						<td class="col_point"><h4><b><?=number_format($point,2)?></b></h4></td>
						<td><a href=<?php echo site_url('point/score_edit/'.$id)?> class="btn btn-primary">입력</a></td>
					</tr>
				<?php }else{if($idx==1){$col = '청';}else{$col = '홍';}?>
					<tr>
						<td style="display:none;" id="<?=$id?>"></td>
						<td class="col_no"><h4><?=$col?></h4></td>
						<td class="col_name"><h4><?=$name ?></h4></td>
						<td class="col_point"><h4><b><?=number_format($point,2)?></b></h4></td>
						<td><a href=<?php echo site_url('point/score_edit/'.$id)?> class="btn btn-primary">입력</a></td>
					</tr>
				<?php } endforeach; ?>
			</table>
			<div class="text-center">
				<a href=<?php echo site_url('point/wait_game/') ?> class="btn btn-warning btn-lg"> 새로고침 </a>
			</div>
		</div>
	</div>
