<script>
/*
function send(){
	var socket = io.connect('http://ccnplaza.com:8888');
	socket.emit("login", {
		name: "test_user",
		userid: "ungmo2@gmail.com"
	});
	console.log('loaded...');
	socket.on("login", function(data) {
		$("#chatLogs").append("<div><strong>" + data + "</strong> has joined</div>");
	var msgForm = $("#msgForm");
	//socket.emit("chat", { msg: msgForm.val() });
	socket.emit("chat", { msg: msgForm.val()});
	});
}
*/
$(function(){
		var socket = io.connect('http://ccnplaza.com:8888');
		socket.emit("login", {
			name: "test_user",
			userid: "ungmo2@gmail.com"
		});
		socket.on("login", function(data) {
			$("#chatLogs").append("<div><strong>" + data + "</strong> has joined</div>");
		var msgForm = $("#msgForm");
		//socket.emit("chat", { msg: msgForm.val() });
		socket.emit("chat", { msg: msgForm.val()});
    });
	$("form").submit(function(e){
		e.preventDefault();
		var msgForm = $("#msgForm");
		// 서버로 메시지를 전송한다.
		socket.emit("chat", {msg: msgForm.val()});
		msgForm.val("");
    });
});
</script>
<div class="container">
<div class="row justify-content-center">
<h3>CCNS Socket.io Chat</h3>
</div>
<div class="row justify-content-center">
<form class="form-inline" id="sendForm">
  <div class="form-group">
	<label for="msgForm">Message: </label>
	<input type="text" class="form-control" id="msgForm" name="msgForm" value="<?=$cmd ?>">
	<button type="submit" class="btn btn-primary" id="sendBtn" name="sendBtn">Send</button>
  </div>
</form>
</div>
<div id="chatLogs"></div>
</div>
