<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
<style>
html, body{
	margin: 0;
	padding: 0;
	overflow:hidden;
}  
.compet_name{
	display:grid;
	grid-template-columns: auto auto auto auto;
	height: 9.8vh;
	background: #004d40;
	justify-content:start;
}
.school{
	display:grid;
	font-size: 3em;
	font-weight: bold;
	justify-content:start;
	margin: 5px;
	padding: 10px;
}
.school.step{
	color : blue;
	background: white; 
}
.school.jongmok{
	color : white;
}
.school.year{
	color : yellow;
}
.school.pumsae{
	color : white;
}
.container{
	background: black;
	display:grid;
	height: 90vh;
	grid-template-columns: repeat(4, 1fr);
	grid-template-areas:
		"p1 p1 p2 p2"
		". p3 p3 . ";
}
.player{
	display:grid;
	width: 49.9vw;
	background: black;
	border: 1px solid white;
}
.player:nth-child(1){
	grid-area: p1;
}
.player:nth-child(2){
	grid-area: p2;
}
.player:nth-child(3){
	grid-area: p3;
}

.video_info{
	display:grid;
	grid-column: 1;
	grid-row:1;
	width:100%;
	height: 45vh;
}	
.ath_info{
	display:grid;
	grid-template-columns: 60px 60px 1fr auto;
	column-gap:2px;
	grid-column: 1;
	grid-row:1;
	height: 50px;
	width:80%;
	font-size: 1.5em;
	font-weight: bold;
	color : white;
	border: 0px solid green;
	text-shadow: 1px 1px 0 black, 1px -1px 0 black, -1px 1px 0 black, -1px -1px 0 black;
	z-index: 2;
	margin-left:10%;
	justify-content:start;
}
.ath{
	border: 0px solid red;
}
.ath.timer{
	color:cyan;
}
.country_flag{
	padding: 2px;
	width:50px;
	height:35px;
}
</style>
</head>
<body>
  <div class="compet_name">
    <div class="school step">8강</div>
    <div class="school jongmok">품새/개인</div>
    <div class="school year">남자/초1학년부</div>
    <div class="school pumsae">태극1장/고려 대극1장</div>
  </div>
  <div class="container">
    <div class="player">
		<div class="ath_info">
			<div class="ath country">KOR</div>
			<div><img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/kor.png" ></div>
			<div class="ath ath_name">1. 홍길동(경기대학교 한국대지부 1223)</div>
			<div class="ath timer">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video1" src="https://player.vimeo.com/video/581296727?autoplay=1&autopause=0"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	</div>
    <div class="player">
		<div class="ath_info">
			<div class="ath country">KOR</div>
			<div><img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/kor.png" ></div>
			<div class="ath ath_name">2. 강감찬(한국체육대학교)</div>
			<div class="ath timer">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video2" src="https://player.vimeo.com/video/581060637?autoplay=1&autopause=0"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	</div>
    <div class="player">
		<div class="ath_info">
			<div class="ath country">KOR</div>
			<div><img class="country_flag" src="http://ccnplaza.com/tkd_compet/uploads/country_flag/kor.png" ></div>
			<div class="ath ath_name">3. 이순신(용인대학교)</div>
			<div class="ath timer">00:00</div>
		</div>
		<div class="video_info">
			<div class="video">
				<iframe id="video3" src="https://player.vimeo.com/video/577147298?autoplay=1&autopause=0"  width="100%" height="100%"
					frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
				</iframe>
			</div>
		</div>
	</div>
  </div>  
</body>
</html>