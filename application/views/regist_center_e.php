<script type="text/javascript">
    $(document).ready(function() {
		var uniq_no = Math.floor(+ new Date());
		$("#c_guid").val(uniq_no);
    });
	$('#area_name').keyup(function(){
		if ($(this).val().length > $(this).attr('maxlength')){
			alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); 
		} 
	});

	
</script>

<div class="container">
	<br>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5">Gym(Dojang) register</h1>
		  <hr class="my-4">
		  <p style="color:red; font-weight:bold">* Can not duplicate. Use same name as originaly registed your assocation.
		  </p>
		</div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/add_center")?> method="post">
    <div class="row justify-content-center">
            <input id="c_guid" name="c_guid" type="hidden"/>
			<input type="hidden" id="ath_count" name="ath_count" value="1"/>
		<div class="col-sm-4">
            <p>
				<input id="center_name" name="center_name" class="form-control" type="text" placeholder="Enter Gym(Dojang) name..." required >
			</p>
            <p>
				<input id="c_name" name="c_name" class="form-control" type="text" placeholder="Representative..." required >
			</p>
            <p>
				<input id="mobile" name="mobile" class="form-control" type="text" placeholder="Phone number..." required>
			</p>
            <p>
				<input id="email" name="email" class="form-control" type="email" placeholder="E-mail(Login ID)..." required>
			</p>
            <p>
				<input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="Password..." required>
			</p>
            <p>
				<input id="area_name" name="area_name" class="form-control" type="text" maxlength="100" placeholder="Address..." required>
			</p>
            <!--
			<p>
				<input id="recommander" name="recommander" class="form-control" type="text" placeholder="Recommander...">
			</p>
            <p>
				<input id="recommander_tel" name="recommander_tel" class="form-control" type="text" placeholder="Recommander tel...">
			</p>
			-->
            <p>
				<select class="form-control" name="country" id="country">
					<option value="" selected="">Country(selection)</option>
					<?php 
					foreach($country as $row) {
						$id=$row['ID'];
						$country_name = $row['COUNTRY_NAME'];
						$country_code = $row['COUNTRY_ENG'];
						$country_mix = $country_name.'['.$country_code.']';
						?>	
					<option value="<?=$id?>"><?=$country_mix?></option>
					<?php } ?>
				</select>
			</p>
        </div> 
    </div>    
	<div class="row justify-content-center">
		<div class="col-sm-2"> 
		<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</div>	
    </form>
</div>