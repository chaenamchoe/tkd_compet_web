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
			if(json_obj[2] == '1'){
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
			<form action="<?php echo site_url('point/save_point_break/')?>" method="post">
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th width="50px">No</th>
						<th>선수명</th>
						<!--<th width="70px">실격</th>-->
						<th width="70px">횟수</th>
					</tr>
				</thead>
					<tr>
						<input type="hidden" name="id" value="<?=$_SESSION['match_id']?>">
						<td style="vertical-align: middle;" class="col_no"><?php echo $_SESSION['judge_no']; ?></td>
						<td style="vertical-align: middle;" class="ath_name"><?php echo $result[0]['A_NAME'].' - '.$result[0]['A_CENTER'] ?></td>
						<td style="vertical-align: middle;">
							<input type="number" name="point">
						</td>
					</tr>
			</table>
			<div class="text-center">
				<input type="submit" value="저장" class="btn btn-primary btn-lg">
			</div>
			</form>
		</div>
	</div>
