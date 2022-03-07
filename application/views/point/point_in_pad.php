<style type="text/css">
	body {
	  width: auto;
	  margin: 20px auto;
	  padding: 0 20px 20px 20px;
	}
	button{
		width: auto;
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
	.col-sm-4{
		width: 100px;
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
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score/"+id+"/"+pno;
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
		$("#point").html('<h1><font style="color:red">'+pno+'</font></h1>');
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
	<div class="row justify-content-center text-center">
		<div id="match_id" class="id d-none"><h4><?=$id ?></h4></div>
		<div id="point"><h1><font style="color:red">0</font></h1></div>
	</div>
	<table class="table table-bordered table-responsive">
	<tr>
	<td>
		<div class="d-grid gap-2">
		<button onClick="CalcNumber('1'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>1</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('2'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>2</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('3'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>3</h1></button>
		</div>
	</td></tr>
	<tr>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('4'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>4</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('5'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>5</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('6'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>6</h1></button>
		</div>
	</td></tr>	
	<tr>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('7'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>7</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('8'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>8</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('9'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>9</h1></button>
		</div>
	</td></tr>		
	<tr>
	<td>
		<div class="d-grid gap-2">
			<button onClick="clearInput(); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>C</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('0'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>0</h1></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CalcNumber('.'); return false;" type="button" class="btn btn-primary btn-lg btn-block"><h1>.</h1></button>
		</div>
	</td></tr>
	</table>
	<table class="table table-bordered table-responsive">
	<tr>
	<td>
		<div class="d-grid gap-2">
			<button onClick="CancelPoint(); return false;" class="btn btn-danger btn-lg btn-block"><h2>취소</h2></button>
		</div>
	</td>
	<td>
		<div class="d-grid gap-2">
			<button onClick="UpdatePoint(); return false;" class="btn btn-success btn-lg btn-block"><h2>저장</h2></button>
		</div>  
	</td></tr>
	</table>
</div>	

