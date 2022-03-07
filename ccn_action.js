function on(){
  document.getElementById("msg_btn").click();
}
function off(){
  document.getElementById("close_btn").click();
}
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
		if(compet_id1 == json_obj[0] && json_obj[1] == '0'){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
			}
		}
		if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
			if(json_obj[2] == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(json_obj[2] == '11'){
				window.location.href = "<?php echo site_url('video/show_results/1/')?>";  //show_athletes
			}
			if(json_obj[2] == '41'){
				window.location.href = "<?php echo site_url('video/show_results/5/')?>";  //개별영상결과
			}
			if(json_obj[2] == '12'){
				window.location.href = "<?php echo site_url('video/show_athletes_tonament/')?>";
			}
			if(json_obj[2] == '42'){
				window.location.href = "<?php echo site_url('video/show_results/3/')?>";  //토너먼트 결과표출
			}
			if(json_obj[2] == '13'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";  //show_athletes
			}
			if(json_obj[2] == '14'){
				window.location.href = "<?php echo site_url('video/show_results/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '33'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";  //show_athletes
			}
			if(json_obj[2] == '34'){
				window.location.href = "<?php echo site_url('video/show_results/4/')?>";  //show_athletes
			}
			if(json_obj[2] == '21'){
				window.location.href = "<?php echo site_url('video/play_videos/1/')?>";
			}
			if(json_obj[2] == '22'){
				window.location.href = "<?php echo site_url('video/play_videos/2/')?>";
			}
			if(json_obj[2] == '24'){
				//window.location.href = "<?php echo site_url('video/play_videos/4')?>";
				window.location.href = "<?php echo site_url('video/play_videos_cutoff/')?>";
			}
			if(json_obj[2] == '50'){
				window.location.href = "<?php echo site_url('video/play_special_videos/')?>" + json_obj[6];
			}
			if(json_obj[2] == '60'){
				window.location.href = "<?php echo site_url('video/show_image/')?>" + json_obj[7];
			}
			if(json_obj[2] == '3'){
				window.location.href = "<?php echo site_url('video/show_results/')?>";
			}
			if(json_obj[2] == '4'){
				window.location.href = "<?php echo site_url('video/team_results/')?>";
			}
			if(json_obj[2] == '90'){
				$.ajax({
					type: 'POST',
					url: "<?php echo site_url('video/get_tv_message')?>",
					dataType: 'json',
					data:{id: json_obj[7]},
					success: function(result)
					{
						var msg = result['post'];
						msg = msg.replace(/(\n|\r\n)/g, '<br>');
						document.getElementById("send_msg").innerHTML = msg;
					},
					error:function(request,status,error){
						alert("code:"+request.status+"\n"+"error:"+error);
					}
				});
				on();
			}
			if(json_obj[2] == '91'){
				off();
			}
		}
    });
  });
