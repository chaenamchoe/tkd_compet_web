<style type="text/css">
	body {
	  width: auto;
	  margin: 20px auto;
	  padding: 0 20px 20px 20px;
	}
	button{
		width: auto;
		margin: 1px 0px;
	}
	h1{
		font-weight: bold;
		font-size: 5em;
	}
	h3{
		font-weight: bold;
	}
	.col-2{
		width: auto;
		margin: 0 0 0 0;
		padding-right: 1px;
		padding-left: 1px;
	}
	.col-sm-6{
		width: auto;
		margin: 0 0 0 0;
		padding-right: 0px;
		padding-left: 2px;
	}
	#jongmok{
		color:blue;
		font-weight: bold;	
	}
</style>
<script>
function UpdatePoint(){
	var pno = $("#point").text();
	var id = $("#match_id").text();
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/save_point_jump/"+id+"/"+pno;
}
function CancelPoint(){
	window.history.back();
}
function AddNumber(val){
	//var snd = new Audio("http://ccnplaza.com/tkd_compet/public/image/click_sound.wav");
	//snd.currentTime=0;
	//snd.play();
	var id = $("#match_id").text();
	var pno = $("#point").text();
	pno = parseInt(pno) + val;
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
	//window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score_fight2/"+id+"/"+pno;
}
function SubNumber(val){
	//var snd = new Audio("http://ccnplaza.com/tkd_compet/public/image/click_sound.wav");
	//snd.currentTime=0;
	//snd.play();
	var id = $("#match_id").text();
	var pno = $("#point").text();
	if (pno > 0){
		pno = pno - val;
	}
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
}

function clearInput(){
	var pno = $("#point").text();
	$("#point").html('<h1><font style="color:red">0</font></h1>');
}

</script>
<audio id="play" src="http://ccnplaza.com/tkd_compet/public/image/click_sound.wav"></audio>
<div class="container">
	<div class="row">
		<div class="col text-center">
			<div id="jongmok"><h3 class="alert alert-success"><?php echo $_SESSION['jongmok_name']?></h3></div>
			<h3 class="alert alert-info">内飘: <?php echo $_SESSION['coat_no']; ?> 何缴: <?php echo $_SESSION['judge_no']; ?> </h3>
		</div>	
	</div>
	<div class="row">
		<div class="col text-center">
			<div><h4 class="alert alert-info"><?php echo $result[0]['A_NAME'].' - '.$result[0]['A_CENTER'] ?></h4></div>
		</div>	
	</div>	
	<div class="row justify-content-center">
		<table class="table table-bordered table-responsive">
		<tr>
		<td colspan="2">
			<div class="d-grid text-center">
				<div id="match_id" class="id d-none"><h4><?=$_SESSION['match_id']?></h4></div>
				<div id="point"><h1><font style="color:red">0</font></h1></div>
			</div>
		</td>
		</tr>
		<tr>
			<td style="height:200px">
				<div class="d-grid gap-2"><button onClick="SubNumber(1); return false;" style="height:200px" type="button" class="btn btn-primary btn-lg"><h2>-1</h2></button></div>
			</td>
			<td style="height:200px">
				<div class="d-grid gap-2"><button onClick="AddNumber(1); return false;" style="height:200px" type="button" class="btn btn-primary btn-lg"><h2>+1</h2></button></div>
			</td>
		</tr>
		<tr>
			<td><div class="d-grid gap-2"><button onClick="CancelPoint(); return false;" type="button" class="btn btn-danger btn-lg"><h2>秒家</h2></button></div></td>
			<td><div class="d-grid gap-2"><button onClick="UpdatePoint(); return false;" type="button" class="btn btn-success btn-lg"><h2>历厘</h2></button></div></td>
		</tr>
		</table>
	</div>
</div>	

