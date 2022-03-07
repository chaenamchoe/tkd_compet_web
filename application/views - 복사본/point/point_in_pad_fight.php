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
		font-size: 3em;
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
			if(json_obj[2] == '0'){
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}
			if(json_obj[2] == '101' || json_obj[2] == '102'){
				window.location.href = "<?php echo site_url('point/show_jongmok/')?>";
			}
			if(json_obj[2] == '99'){
				window.location.href = "<?php echo site_url('point/check_connection/')?>";
			}
			if((json_obj[2] == "11") || 
				(json_obj[2] == "12") || 
				(json_obj[2] == "14") || 
				(json_obj[2] == "141") || 
				(json_obj[2] == "15") || 
				(json_obj[2] == "16") || 
				(json_obj[2] == "17"))
			{
				window.location.href = "<?php echo site_url('point/show_point/');?>" + json_obj[2];
			}
			if(json_obj[2] == '37'){
				window.location.href = "<?php echo site_url('point/wait_game/')?>";
			}
		}
    });
  });
</script>

<script>
function UpdatePoint(){
	var pno = $("#point").text();
	var id = $("#match_id").text();
	window.location.href = "http://ccnplaza.com/tkd_compet/index.php/point/update_score_fight/"+id+"/"+pno;
}
function CancelPoint(){
	window.history.back();
}
function AddNumber(val){
	new Audio("http://ccnplaza.com/tkd_compet/public/image/click_sound.wav").play()
	var id = $("#match_id").text();
	var pno = $("#point").text();
	pno = parseInt(pno) + val;
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
	$.ajax({
		type: 'POST',
		url: "<?php echo site_url('point/update_score_fight2/')?>",
		dataType: 'json',
		data:{id: id, point: pno},
		success: function(result)
		{
			console.log(result);
		},
		error:function(request,status,error){
			//alert("code:"+request.status+"\n"+"error:"+error);
		}
	});	
}
function SubNumber(val){
	new Audio("http://ccnplaza.com/tkd_compet/public/image/click_sound.wav").play()
	var id = $("#match_id").text();
	var pno = $("#point").text();
	if (pno > 0){
		pno = pno - val;
	}
	$("#point").html('<h1><font style="color:red"><b>'+pno+'</b></font></h1>');
	$.ajax({
		type: 'POST',
		url: "<?php echo site_url('point/update_score_fight2/')?>",
		dataType: 'json',
		data:{id: id, point: pno},
		success: function(result)
		{
			console.log(result);
		},
		error:function(request,status,error){
			//alert("code:"+request.status+"\n"+"error:"+error);
		}
	});	
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
			<div id="jongmok"><h3 class="alert alert-success"><?php echo $jongmok ?></h3></div>
		</div>	
	</div>
	<div class="row">
		<div class="col text-center">
			<div><h4 class="alert alert-info"><?php echo $a_name ?></h4></div>
		</div>	
	</div>	
	<div class="row justify-content-center">
		<table class="table table-responsive">
		<tr>
		<td colspan="2">
			<div class="d-grid text-center">
				<div id="match_id" class="id d-none"><h4><?=$id ?></h4></div>
				<div id="point"><h1><font style="color:red"><?=$result->J1_POINT ?></font></h1></div>
			</div>
		</td>
		</tr>
		<tr>
			<td><div class="d-grid gap-2" style="height:100px"><button onClick="AddNumber(3); return false;" type="button" class="btn btn-primary btn-block"><h2>+3</h2></button></div></td>
			<td><div class="d-grid gap-2" style="height:100px"><button onClick="AddNumber(1); return false;" type="button" class="btn btn-primary btn-block"><h2>+1</h2></button></div></td>
		</tr>
		<tr>
			<td><div class="d-grid gap-2" style="height:100px"><button onClick="AddNumber(5); return false;" type="button" class="btn btn-primary btn-block"><h2>+5</h2></button></div></td>
			<td><div class="d-grid gap-2" style="height:100px"><button onClick="AddNumber(2); return false;" type="button" class="btn btn-primary btn-block"><h2>+2</h2></button></div></td>
		</tr>
		<tr>
			<td colspan="2"><div class="d-grid gap-2"><button onClick="clearInput(); return false;" type="button" class="btn btn-success btn-block"><h2>Reset</h2></button></div></td>
		</tr>
		</table>
	</div>
</div>	

