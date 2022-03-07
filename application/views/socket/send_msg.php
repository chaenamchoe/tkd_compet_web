<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script>
	$(document).ready(function(){
		var socket = io.connect('http://ccnplaza.com:8888');
		socket.emit("login", {
			name: 'user01',
			userid: "user01@gmail.com"
		});
		socket.on("login", function(data) {
			$("#chatLogs").append("<div><strong>" + data + "</strong> has joined</div>");
		});
		socket.on("chat", function(data) {
			$("#chatLogs").append("<div>" + data.msg + " : from <strong>" + data.from.name + "</strong></div>");
		});
		var coat = "<?php echo $compet . ',' . $coat . ',' . $action; ?>";
		// 서버로 메시지를 전송한다.
		//socket.emit("chat", { msg: $msgForm.val() });
		socket.emit("chat", { msg: coat});
		//window.location.href = "<?php echo site_url('video/video/')?>";
	});
</script>

  <div class="container">
    <h3>Socket.io Chat Example</h3>
    <form class="form-inline">
      <div class="form-group">
        <label for="msgForm">Message: </label>
        <input type="text" class="form-control" id="coat" value="<?php echo $compet.','.$coat.','.$action ?>">
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
    </form>
    <div id="chatLogs"></div>
  </div>
