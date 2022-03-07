<div class="container">
    <br/>  
    <div class="row justify-content-center">
        <div class="col text-center">
        <h4>Search Gym(Dojang)</h4>
        <hr>
        </div>
	</div>	
    <div class="row justify-content-center">
		<div class="col-sm-4">
			<form class="form-inline" id="login-form" action=<?php echo site_url("Compet/find_center")?> method="post">
				<div class="form-group">
					<div class="input-group">
						  <input type="text" id="center_name" name="center_name" class="form-control" placeholder="Enter gym(dojang) name." required>
					</div>
					&nbsp;	
					<div class="input-group">
						<button class="btn btn-primary" type="submit">Search Gym</button>
					</div>
				</div>
			</form>
		</div>
		<hr>
	</div>
	<div class="row justify-content-center">
		<div class="col text-center">
		</br>
		<h5>You can enter part of gym(dojang) name.</h5>
		</br>		
		</div>
		<hr>
	</div>	
        