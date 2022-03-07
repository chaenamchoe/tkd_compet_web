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
			<h4>��ƮNo: <?php echo $_SESSION['coat_no']; ?></h4>
			<h4>�ν�No: <?php echo $_SESSION['judge_no']; ?></h4>
        </div>
	</div>
	<hr>
	<div class="row justify-content-center text-center">
        <div  class="col">
        <p><h4>�޽��� ������ ���������� �Ǿ����ϴ�. </br>
			�Ʒ� ��ư�� Ŭ���Ͽ� ȸ���� �ϼ���.</br></br>
		</h4></p>
		<p>
			<a href=<?php echo site_url('point/return_response')?> class="btn btn-primary">����ȸ��</a>
		</p>
	   </div>
	<br/>
    </div>  
  