<style>
body{
	color : white;
	background-color : black;
}
div{
	border: 1px;
}
h1.name{
	color : yellow;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h1.total{
	color : #33C4FF;
}
h3.center{
	color : orange;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
}
h3.points{
	color : #96FF33;
}
.container-fluid{
	margin : 0px 0px;
	padding : 0px 0px;
}
span.top_line{
	margin-top : 10px;
	margin-bottom : 20px;
	color : orange;
}
span.step {
  background-color: yellow;
}
.row{
	width: 100vw;
	height: 90vh;
	position: relative;
	margin : 0px 0px;
	padding : 0px 0px;
}
.row.top{
	background-color: #241b04; 
	width: 100vw;
	height: 10vh;
	position: relative;
	margin : 0px 0px;
	padding : 10px 0px;
}
.col-md-6{
	padding: 0px 0px;
	border:0px solid gray;
}
.blue{
	padding: 0px 0px;
	border:10px solid blue;
}
.red{
	padding: 0px 0px;
	border:10px solid red;
}
.bar{
    position: absolute;
    top: 0;
    left: 50px;
    width: 100%;
    height: 5px;
}
.single_video{
	width: 100vw;
	height: 100vh;
	position: absolute;
	margin : 0px 0px;
	padding : 0px 0px;
}
#overlay {
  position: fixed;
  display: none;
  width: 1000px;
  height: 200px;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  background-color: rgba(0,0,255,0.8);
  z-index: 2;
  cursor: pointer;
}

#text{
  margin: auto;
  font-size: 40px;
  color: white;
}
#send_msg{
	font-size: 3em;
	font-weight: bold;
	color : white;
	background-color:blue;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script type="text/javascript">
//$(document).ready(function() {
	$("#video1").show();
	var tag = document.createElement('script');
	tag.src = "http://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	var player1;
	var player_cnt = 0;
	var done_cnt = 0;
	var error_cnt = 0;
	//});
	function onYouTubeIframeAPIReady() {
		player1 = new YT.Player('video1', {
			events: {'onReady': onPlayerReady1, 'onStateChange': onPlayerStateChange1, 'onError':onPlayerError1}
		});
	}
	function onPlayerReady1(event) {
		player1.playVideo();
	}
	function onPlayerError1(event){
		console.log('Player1 error...');
	}
	function onPlayerStateChange1(event) {
		if (event.data == YT.PlayerState.PLAYING) {
			$("#video1").show();
		}
		if (event.data == YT.PlayerState.ENDED) {
			$("#video1").hide();
			window.history.back();
		}
	}
//});
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6" id="youTubePlayer1">
			<iframe class="single_video" id="video1" width="100%" height="100%" src="<?=$video_id?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
		</div>
	</div>	
