<style>
input {width: 100px;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script>
function UpdatePoint(){
	var pno = $("#point").text();
	var id = $("#match_id").text();
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score/"+id+"/"+pno;
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

$(document).ready(function(){
    var socket = io.connect('http://ccnplaza.com:8888');
	socket.emit("login", {
		name: "app_user1",
		userid: "ccnplaza@gmail.com"
    });
    socket.on("chat", function(data) {
		var sel_compet = "<?php echo $_SESSION['competition_id'] ?>";
		var sel_coat = "<?php echo $_SESSION['coat_no'] ?>";
		var sel_judge = "<?php echo $_SESSION['judge_no'] ?>";

		var data_str = JSON.stringify(data.msg);
		var json_obj = JSON.parse(data_str);
		console.log(json_obj);
		console.log(json_obj.compet['compet_name']);
		console.log(json_obj.athlete[0]['a_name']);
		$("#chatLogs").empty();
		$("#chatLogs").append('<div><h3>' + 
				json_obj.compet['jongmok'] + '(' + 
				json_obj.compet['category'] + ')<br>코트:' + 
				json_obj.compet['coat_no'] + ' 조: ' + 
				json_obj.compet['jo_no'] + 
			'<h3></div>' +
			'<div><table id="ath_list" class="table table-bordered"></table></div>'
		);
		var jpoint = '';
		for(var i=0; i<json_obj.athlete.length; i++){
			if (sel_judge == '1'){jpoint = json_obj.athlete[i]['judge1'];}
			if (sel_judge == '2'){jpoint = json_obj.athlete[i]['judge2'];}
			if (sel_judge == '3'){jpoint = json_obj.athlete[i]['judge3'];}
			$("#ath_list").append(
				'<tr><td style="display:none"><h4>'+json_obj.athlete[i]['a_id'] + '</h4></td>' + 
				'<td style="vertical-align:middle"><h4>'+json_obj.athlete[i]['a_idx'] + '</h4></td>' + 
				'<td><h4>' + json_obj.athlete[i]['a_name'] + '<br>' + json_obj.athlete[i]['c_name'] + '</h4></td>' +
				'<td style="vertical-align:middle"><h4>'+ jpoint + '</h4></td>'+
				'<td style="vertical-align:middle">'+
					'<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-id="' + json_obj.athlete[i]['a_id'] +
					'" data-target="#myModal">점수</td>'+	
				'</tr>'
			);
		}
		$("#ath_list").append(
			'</table></div>'
		);	
    });
});
</script>
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col">
			<br>
            <h3 class="alert alert-success"><?=$_SESSION['competition_name']?></h3>
        </div>
	</div>	
	<div class="row justify-content-center">
		<div id="chatLogs">
			<p><h4>경기 준비중입니다. </br>
				잠시 기다려 주세요.</br></br>
				경기가 시작되면 화면이</br>
				자동으로 전환됩니다.
			</h4></p>
			<p>
				<img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img>
			</p>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">점수입력</h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
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
				<button class="btn btn-danger btn-lg btn-block" data-dismiss="modal"><h2>취소</h2></button>
			</div>
			<div class="col-4">
				<button onClick="UpdatePoint(); return false;" class="btn btn-success btn-lg btn-block"><h2>저장</h2></button>
			</div>  
		</div>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
