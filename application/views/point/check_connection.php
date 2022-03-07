<style>
img {
   max-width:100%;
   height:auto;
   max-height:100%;
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
			if(json_obj[2] == '1'){
				window.location.href = "<?php echo site_url('point/show_jongmok/')?>";
			}
			if(json_obj[2] == '99'){
				window.location.href = "<?php echo site_url('point/check_connection/')?>";
			}
			if((json_obj[2] == "11") || 
				(json_obj[2] == "12") || 
				(json_obj[2] == "13") || 
				(json_obj[2] == "33") || 
				(json_obj[2] == "16") || 
				(json_obj[2] == "114") || 
				(json_obj[2] == "116"))
			{
				window.location.href = "<?php echo site_url('point/show_point/');?>" + json_obj[2];
			}
		}
    });
  });
</script>
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col">
			<br>
            <h3 class="alert alert-success"><?php echo $_SESSION['competition_name']; ?></h3>
        </div>
	</div>	
	<div class="row justify-content-center text-center">
		<div class="col" style="color:blue">
			<h4>코트No: <?php echo $_SESSION['coat_no']; ?></h4>
			<h4>부심No: <?php echo $_SESSION['judge_no']; ?></h4>
        </div>
	</div>
	<hr>
	<div class="row justify-content-center text-center">
        <div  class="col">
        <p><h4>메시지 수신이 정상적으로 되었습니다. </br>
			아래 버튼을 클릭하여 회신을 하세요.</br></br>
		</h4></p>
		<p>
			<a href=<?php echo site_url('point/return_response')?> class="btn btn-primary">응답회신</a>
		</p>
	   </div>
	<br/>
    </div>  
  