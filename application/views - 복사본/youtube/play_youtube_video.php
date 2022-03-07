<style>
body{
	color : white;
	background-color : black;
	margin: 10px 0px 10px 0;
	pading: 0;
}
div.col-md-12{
	padding: 0px 0px;
	width: 95vw;
	height: 95vh;
	
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>

<div class="container">
	<div class="row justify-content-center">
		<div class="tab-content">
		  <div class="tab-pane fade show active" id="1">
				<div class="col-md-12" id="youTubePlayer1">
					<iframe class="single_video" id="video1" width="100%" height="100%" src="<?=$video_url?>?rel=0&autoplay=1&enablejsapi=1"
						frameborder="0" allow="autoplay" allowfullscreen>
					</iframe>
				</div>
		  </div>
		</div>
	</div>	
</div>
