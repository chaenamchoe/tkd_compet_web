function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}


$(document).ready(function(){
    var socket = io.connect('http://ccnplaza.com:8888');
	socket.emit("login", {
      name: "app_user1",
      userid: "ccnplaza@gmail.com"
    });
    socket.on("chat", function(data) {
		var compet_id1 = "<?php echo $_SESSION['competition_id'] ?>";
		var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
		var msg_obj = eval("("+data.msg+")");
		var arr_str = data.msg.split(',');
		if(compet_id1 == msg_obj.compet && coat_no1 == msg_obj.coat){
			if(msg_obj.action == '0'){
				off();
				window.location.href = "<?php echo site_url('video/show_compet_name/')?>";
			}
			if(msg_obj.action == '1'){
				window.location.href = "<?php echo site_url('video/show_athletes/')?>";
			}
			if(msg_obj.action == '2'){
				window.location.href = "<?php echo site_url('video/play_videos/')?>";
			}
			if(msg_obj.action == '3'){
				window.location.href = "<?php echo site_url('video/show_lists/')?>";
			}
			if(msg_obj.action == '10'){
				var notice = arr_str[3].replace(/(\r?\n)/g, '<br>');
				document.getElementById("text").setAttribute("style", "margin:20px");
				document.getElementById("text").innerHTML = notice;
				on();
			}
			if(msg_obj.action == '11'){
				off();
			}
		}
    });
});