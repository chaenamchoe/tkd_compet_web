<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CCNS Chat</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
	<h3>CCNS Socket.io Chat</h3>
	</div>
    <div class="row justify-content-center">
    <form class="form-inline" id="sendForm" methode="POST">
      <div class="form-group">
        <label for="msgForm">Message: </label>
        <input type="text" class="form-control" id="msgForm" name="msgForm">
        <button type="submit" class="btn btn-primary" id="sendBtn" name="sendBtn">Send</button>
      </div>
    </form>
    </div>
    <div id="chatLogs"></div>
  </div>
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
		var message = data.msg;
		$("#chatLogs").append("<div><strong>Receive : " + today + "</strong><br>" + 
				message + '<br></div>'
		);
    });
    // Send 버튼이 클릭되면
    $("form").submit(function(e) {
		e.preventDefault();
		var $msgForm = $("#msgForm");
		// 서버로 메시지를 전송한다.
		socket.emit("chat", { msg: $msgForm.val() });
		$msgForm.val("");
    });
  });
</script>
</body>
</html>