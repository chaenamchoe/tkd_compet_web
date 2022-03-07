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
	h3{
		font-weight: bold;
	}
	.col-2{
		width: auto;
		margin: 0 0 0 0;
		padding-right: 0px;
		padding-left: 2px;
	}
	.col-3{
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
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score_jump2/"+id+"/"+pno;
}
function CancelPoint(){
	window.history.back();
}
function AddNumber(val){
	var pno = $("#point").text();
	pno = parseInt(pno) + val;
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
}
function SubNumber(val){
	var pno = $("#point").text();
	if (pno > 0){
		pno = pno - val;
	}
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
}

function clearInput(){
	var pno = $("#point").text();
	$("#point").html('<h2><font style="color:red">0</font></h2>');
}

</script>

<div class="container">
	<div class="row">
		<div class="col text-center">
			<div id="jongmok"><h3 class="alert alert-success"><?php echo $jongmok ?></h3></div>
		</div>	
	</div>
	<div class="row">
		<div class="col text-center">
			<div><h4 class="alert alert-info"><?php echo $a_name ?></h4></div>
		</div>	
	</div>	
	<div class="row justify-content-center">
		<div class="col-3 text-center">
			<div id="match_id" class="id d-none"><h4><?=$id ?></h4></div>
			<div id="point"><h1><font style="color:red">0</font></h1></div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="SubNumber(1); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>-1</h2></button>
		</div>
		<div class="col-3">
			<button onClick="AddNumber(1); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>+1</h2></button>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="SubNumber(5); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>-5</h2></button>
		</div>
		<div class="col-3">
			<button onClick="AddNumber(5); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>+5</h2></button>
		</div>
	</div>
	</br>
	<hr>
	<div class="text-center">
		<h3>성공 횟수만 카운트 하세요.</h3>
	</div>
	<hr>
	</br>
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="CancelPoint(); return false;" class="btn btn-danger btn-lg btn-block"><h2>취소</h2></button>
		</div>
		<div class="col-3">
			<button onClick="UpdatePoint(); return false;" class="btn btn-success btn-lg btn-block"><h2>저장</h2></button>
		</div>  
	</div>
</div>	

