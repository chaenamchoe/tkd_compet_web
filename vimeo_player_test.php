<!DOCTYPE html>
<html>
<head>
	<title><?=$_SESSION['site_title']?></title>
	<meta charset="EUC-KR">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 </head>
<body>
<style>
body, html {
	width: 100%; 
	height: 100%; 
	margin: 0; 
	padding: 0
	color : white;
	background-color : black;
}
.first-row {position: absolute;top: 0; left: 0; right: 0; height: 100px; background-color: lime;}
.second-row {position: absolute; top: 100px; left: 0; right: 0; bottom: 0; background-color: red }
aiframe {
	display: block; 
	width: 100%; 
	height: 100%; 
	border: none;
}
.col-sm-6{
	padding: 0px 0px;
	border:0px solid white;
}
#video1{
	overflow:hidden;
	overflow-x:hidden;
	overflow-y:hidden;
	position:absolute;
	display: block; 
	width: 50vw;
	height: 49vh;
	padding: 0px 0px;
	margin: 0px 0px;
}
#video2{
	display: block; 
	width: 50vw;
	height: 49vh;
	padding: 0px 0px;
	margin: 0px 0px;
}
#video3{
	display: block; 
	width: 50vw;
	height: 49vh;
	padding: 0px 0px;
	margin: 0px 0px;
}
#video4{
	display: block; 
	width: 50vw;
	height: 49vh;
	padding: 0px 0px;
	margin: 0px 0px;
}
</style>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<iframe id="video1" src="https://player.vimeo.com/video/577068742?autoplay=1&autopause=0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</div>
		<div class="col-sm-6" id="youTubePlayer1">
			<iframe id="video2" src="https://player.vimeo.com/video/577068726?autoplay=1&autopause=0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</div>	
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-6" id="youTubePlayer1">
			<iframe id="video3" src="https://player.vimeo.com/video/577068712?autoplay=1&autopause=0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</div>
		<div class="col-sm-6" id="youTubePlayer1">
			<iframe id="video4" src="https://player.vimeo.com/video/577068694?autoplay=1&autopause=0" allow="autoplay; fullscreen" allowfullscreen></iframe>
		</div>	
	</div>
	<script src="https://player.vimeo.com/api/player.js"></script>
	<script>
		var iframe1 = document.querySelector('#video1');
		var iframe2 = document.querySelector('#video2');
		var iframe3 = document.querySelector('#video3');
		var iframe4 = document.querySelector('#video4');
		var player1 = new Vimeo.Player(iframe1);
		var player2 = new Vimeo.Player(iframe2);
		var player3 = new Vimeo.Player(iframe3);
		var player4 = new Vimeo.Player(iframe4);

		player1.on('play', function() {
		  console.log('Played the video1');
		});
		player1.on('ended', function(){
			console.log('player1 is ended...');	
		});
		player1.on('timeupdate', function(data) {
		  //console.log(data.seconds + 'Played...');
		});
		player2.on('play', function() {
		  console.log('Played the video2');
		});
		player2.on('ended', function(){
			console.log('player2 is ended...');	
		});
	</script>
	
</div>	
</html>