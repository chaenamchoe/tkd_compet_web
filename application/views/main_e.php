<style>
td.title {
	width: 200px;
}
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 544px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  h4 {font-size:1rem;} /*1rem = 16px*/
}	
</style>
<div class="container">
	<br/>
	<div class="alert alert-primary text-center">
		<h1><?=$_SESSION['site_title']?> Online regist </h1>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<?php 
					$compet_id = $result->ID;
					$compet_name = $result->C_NAME_E;
					$compet_place = $result->C_PLACE_E;
					$compet_sdate = $result->S_DATE;
					$compet_edate = $result->E_DATE;
					$compet_reg_sdate = $result->REG_SDATE;
					$compet_reg_edate = $result->REG_EDATE;
					$compet_owner = $result->C_OWNER_E;
					$compet_owner2 = $result->C_OWNER2_E;
					$compet_support = $result->C_SUPPORT_E;
					$compet_contact = $result->C_CONTACT_E;
					$compet_meeting = $result->C_MEETING_E;
					$compet_weight_check = $result->WEIGHT_CHECK_E;
					if ($compet_sdate <> $compet_edate){
						$compet_date = $compet_sdate . ' ~ ' . $compet_edate;
					}else{
						$compet_date = $compet_sdate;
					}
			?>
				<h5>
				<table class="table table-bordered">
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>1. Contest name : </b></font></td>
						<td><?php echo $compet_name ?></br></td>
					</tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>2. Date : </b></font></td>
						<td><?php echo $compet_date ?></td>
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>3. Location : </b></font></td>
						<td><?php echo $compet_place ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>4. Hosted by : </b></font></td>
						<td><?php echo $compet_owner2 ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>5. Executor : </b></font></td>
						<td><?php echo $compet_owner ?></br></td>
					</tr>
					<!--
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>6. Sponsor : </b></font></td>
						<td><?php echo $compet_support ?></td>
					</tr>
					-->
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>6. Regist period : </b></font></td>
						<td><?php echo $compet_reg_sdate ?> ~ <?php echo $compet_reg_edate ?></br></td>
					</tr>
					<!--
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>8. Masters meeting : </b></font></td>
						<td><?php echo $compet_meeting ?></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5" class="text-center"><font style="color:blue"><b>9. Weight check: </b></font></td>
						<td><?php echo $compet_weight_check ?></br></td>
					</tr>
					-->
				</table>
				</h5>
				<?php if(!$_SESSION['login_user_approved'] > 0){ ?>
				<p class="text-center" style="color:red">
				You must log-in to regist athletes.
				</p>
				<?php } ?>
				<hr>	
		</div>
	</div>
	<div class="row justify-content-center text-center">	
		<div class="col">
			<?php if($_SESSION['login_user_approved'] > 0){ ?>
				<p><a href=<?php echo site_url("compet/loginout");?> class="btn btn-primary"> Logout </a>
				<a href=<?php echo site_url('compet/registed_athlete')?> class="btn btn-primary">Show Register</a>
				</p>
			<?php }else{ ?>
				<p><a href=<?php echo site_url("compet/login");?> class="btn btn-primary"> Login </a>
				<a href=<?php echo site_url('compet/regist_center')?> class="btn btn-primary">Register association</a></p>
			<?php } ?>
		</div>
		<br/>
	</div>