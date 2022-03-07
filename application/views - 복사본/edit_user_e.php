<script type="text/javascript">
	function form_submit() {
		document.getElementById("ADD_Modal").submit();
	} ;
	$(document).ready(function() {
        $("#submit").click(function(event) {
            var pwd = $("#login_pass").val();
            var pwd1 = $("#login_pass2").val();
            if( pwd != pwd1 ) {
                $("#confirm").text("비밀번호확인 오류! 다시 입력하세요.");
                event.preventDefault();
            }
        });
    });
</script>

<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h4><?=$_SESSION['login_user_center'];?> Information</h4>
        <hr>
        </div>
    </div>
    <?php  
        $center_id = $center_info->ID;
        $center_name = $center_info->CENTER_NAME;
		$center_chief = $center_info->C_NAME;
		$center_area = $center_info->C_AREA;
        $center_email = $center_info->EMAIL;
        $center_tel = $center_info->TEL;
		$center_mobile = $center_info->MOBILE;
		$center_pass = $center_info->LOGIN_PASS;
		$center_recommander = $center_info->RECOMMANDER;
		$center_recommander_tel = $center_info->RECOMMANDER_TEL;
		$center_country = $country_name;
    ?>
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p>Represent : <?=$center_chief?></p>
			<p>E-mail : <?=$center_email?></p>
			<p>Location : <?=$center_area?></p>
			<p>Phone : <?=$center_tel?></p>
			<!--<p>Cell Phone : <?=$center_mobile?></p>
			<p>Recommander : <?=$center_recommander?></p>
			<p>Recommander tel : <?=$center_recommander_tel?></p>
			<p>Country : <?=$center_country?></p>
			-->
			<hr>	
        </div>
    </div>    
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<h4><a href="#" data-toggle="modal" data-target="#EDIT_CENTER" class="btn btn-primary">Edit</a></h4>
		</div>
	</div>
	<!-- Modal 수정 -->
	<div class="modal fade" id="EDIT_CENTER" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Group information</h4>
				</div>
				<form action=<?php echo site_url("compet/update_center/".$center_id)?> method="post">
				<div class="modal-body">
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Represent:</label>
						<div class="col-sm-9">
							<input name="c_chief" class="form-control" type="text" value=<?=$center_chief?>>
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">E-mail:</label>
						<div class="col-sm-9">
							<input name="c_email" class="form-control" type="email" value=<?=$center_email?>>
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Location:</label>
						<div class="col-sm-9">
							<input name="c_area" class="form-control" type="text" value=<?=$center_area?>>
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Phone:</label>
						<div class="col-sm-9">
							<input name="c_tel" class="form-control" type="text" value=<?=$center_tel?>>
						</div>
					</div>		
					<!--
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Cell Phone:</label>
						<div class="col-sm-9">
							<input name="c_mobile" class="form-control" type="text" value=<?=$center_mobile?>>
						</div>
					</div>		
					-->
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Password:</label>
						<div class="col-sm-9">
							<input name="c_pass" class="form-control" type="password" value=<?=$center_pass?>>
						</div>
					</div>
					<!--<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Recommander:</label>
						<div class="col-sm-9">
							<input name="recommander" class="form-control" type="text" value=<?=$center_recommander?>>
						</div>
					</div>
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Recommander tel:</label>
						<div class="col-sm-9">
							<input name="recommander_tel" class="form-control" type="text" value=<?=$center_recommander_tel?>>
						</div>
					</div>
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">Country:</label>
						<div class="col-sm-9">
							<select class="form-control" name="country" id="country">
								<?php 
								foreach($country as $row) {
									$id=$row['ID'];
									$country_name = $row['COUNTRY_NAME'];
									$country_code = $row['COUNTRY_ENG'];
									$country_mix = $country_name.'['.$country_code.']';
									?>	
								<option <?php if($center_country == $id){echo "selected";} ?> value="<?=$id?>"><?=$country_mix?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					-->
					<p>	
					<input name="in_edit" class="form-control" type="hidden" value = 2>
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal End -->  
