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
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score_break/"+id+"/"+pno;
}
function CancelPoint(){
	window.history.back();
}
function CalcNumber(n_value){
	var pno = $("#point").text();
	if (pno == "0"){
		pno = n_value;
	}else {
		pno = pno + n_value;
	}
	if (pno.length < 5){
		//var new_val = pno + n_value;
		$("#point").html('<h2><font style="color:red">'+pno+'</font></h2>');
	}
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
		<div id="match_id" class="id d-none"><h4><?=$id ?></h4></div>
		<div id="point"><h2><font style="color:red">0</font></h2></div>
	</div>
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="CalcNumber('1'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>1</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('2'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>2</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('3'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>3</h2></button>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="CalcNumber('4'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>4</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('5'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>5</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('6'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>6</h2></button>
		</div>
	</div>	
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="CalcNumber('7'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>7</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('8'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>8</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('9'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>9</h2></button>
		</div>
	</div>		
	<div class="row justify-content-center">
		<div class="col-3">
			<button onClick="clearInput(); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>C</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('0'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>0</h2></button>
		</div>
		<div class="col-3">
			<button onClick="CalcNumber('.'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h2>.</h2></button>
		</div>
	</div>	
		<hr>
	<div class="row justify-content-center">
		<div class="col-4">
			<button onClick="CancelPoint(); return false;" class="btn btn-danger btn-lg btn-block"><h2>취소</h2></button>
		</div>
		<div class="col-4">
			<button onClick="UpdatePoint(); return false;" class="btn btn-success btn-lg btn-block"><h2>저장</h2></button>
		</div>  
	</div>
</div>	

