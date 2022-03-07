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
	margin : 0px 0px;
	padding: 0px 0px;
	border:0px solid gray;
}
.blue{
	margin : 0px 0px;
	padding: 0px 0px;
	border:10px solid blue;
}
.red{
	margin : 0px 0px;
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
	height: 85vh;
	position: relative;
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

h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 544px) {  
  h1 {font-size:1.5rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
}
 
/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:2rem;} /*1rem = 16px*/
  h3 {font-size:2rem;} /*1rem = 16px*/
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2.5rem;} /*1rem = 16px*/
  h2 {font-size:2.5rem;} /*1rem = 16px*/
  h3 {font-size:2.5rem;} /*1rem = 16px*/
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:3rem;} /*1rem = 16px*/    
  h2 {font-size:3rem;} /*1rem = 16px*/    
  h3 {font-size:3rem;} /*1rem = 16px*/    
}
</style>
<div class="container-fluid">
	<div class="row justify-content-center top">
		<?php if($game_step <> ''){ ?>
		<span class="top_line badge badge-primary"><h2 style="color:white;"><b><?=$game_step?></b></h2></span>&nbsp
		<?php } ?>
		<span class="top_line"><h2><b><?=$jongmok?></b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:white;"><b>(<?=$category.' '.$jo ?>)</b></h2></span>&nbsp;
		<span class="top_line"><h2 style="color:yellow;"><b><?=$pumsae?></b></h2></span>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-6 blue" id="youTubePlayer1">
			<div id="video1_info" class="bar" style="color:white">
			</div>
			<iframe id="video1" width="100%" height="100%" src="<?=$youtube_url1?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
		</div>
		<div class="col-sm-6 red" id="youTubePlayer2">
			<div id="video2_info" class="bar" style="color:white">
			</div>
			<iframe id="video2" width="100%" height="100%" src="<?=$youtube_url2?>?rel=0&autoplay=1&enablejsapi=1"
				frameborder="0" allow="autoplay" allowfullscreen>
			</iframe>
		</div>
	</div>
</div>
