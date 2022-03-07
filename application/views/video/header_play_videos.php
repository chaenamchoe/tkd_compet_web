<style>
.compet_name{
	display:grid;
	grid-template-columns: auto auto auto auto auto;
	height: 9.8vh;
	background: #004ba0;
	justify-content:center;
	align-content:center;
}
.school{
	display:grid;
	font-size: 3em;
	font-weight: bold;
	justify-content:start;
	margin: 5px;
	padding: 10px;
	text-shadow: 1px 1px 0 black, 5px 5px 5px black, -1px 1px 0 black, -1px -1px 0 black;
}
.school.step{
	color : orange;
	background: #003c8f; 
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
.school.jo{
	color : orange;
}
h1 {font-size:1rem;} /*1rem = 16px*/
h2 {font-size:1rem;} /*1rem = 16px*/
h3 {font-size:1rem;} /*1rem = 16px*/
/* Small devices (landscape phones, 544px and up) */
@media (min-width: 360px) {  
  h1 {font-size:1rem;} /*1rem = 16px*/
  h2 {font-size:1rem;} /*1rem = 16px*/
  h3 {font-size:1rem;} /*1rem = 16px*/
  img {width:50px; height:30px;}
}

/* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
@media (min-width: 768px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:100px; height:45px;}
}
 
/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  img {width:150px; height:90px;}
}
 
/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {  
  h1 {font-size:2.5rem;} /*1rem = 16px*/    
  h2 {font-size:2rem;} /*1rem = 16px*/    
  h3 {font-size:2rem;} /*1rem = 16px*/    
  img {width:100px; height:70px;}
}
</style>
<div class="compet_name">
    <?php if($game_step <> ''){ ?>
	<div class="school step"><?=$game_step?></div>
	<?php } ?>
    <div id="jongmok" class="school jongmok"><?=$jongmok?></div>
    <div id="year" class="school year"><?=$category?></div>
    <div id="pumsae" class="school pumsae"><?=$pumsae?></div>
    <div id="jo" class="school jo"><?=$jo ?></div>
</div>
<?php if($_SESSION['use_animation']==1){ ?>
<script src="http://ccnplaza.com/gsap-public/minified/gsap.min.js"></script>
<script>
	gsap.from(".compet_name", {duration: 1, y: -100});
	//gsap.from(".video_info", {duration: 1, y: 100, scale:0});
</script>	
<?php } ?>