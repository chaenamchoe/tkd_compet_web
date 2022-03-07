<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
.modal.modal-fullscreen .modal-dialog {
  width:100vw;
  height:100vh;
  margin:0;
  padding:0;
  max-width:none;
}
.modal.modal-fullscreen .modal-content {
  height:auto;
  height:100vh;
  border-radius:0;
  border:none;
}
.modal.modal-fullscreen .modal-body {
  overflow-y:auto;
}

h1 {font-size:3rem;} /*1rem = 16px*/
img.fit-picture{width:30px; height:20px;}
div.logo {width:30px; height:20px;}
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 1024px) {  
	div.logo {
		display:none;
	}
	h1 {font-size:2rem;}	
}
</style>
<script src="http://ccnplaza.com/tkd_compet/jquery.rowspanizer.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".rwspan").each(function () {
            $('table').rowspanizer({
			  columns: [0],
			  vertical_align:'middle'
			});
        });
		$('#jongmok').change(function() {
            $("#category > option").remove();
            var jongmok_id = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('match/get_category/')?>" + jongmok_id,
                success: function(category)
                {
					$.each(category, function(ID, CATEGORY_NAME){
						var opt = $('<option />');
						opt.val(ID);
						opt.text(CATEGORY_NAME[0] + '/' + ID);
						$('#category').append(opt);
					});
                }
            });
			window.location.href = "<?php echo site_url('match/match_list_e/')?>" + jongmok_id;
        });
        $('#category').change(function() {
			var jongmok_id = $('#jongmok').val();
            var category_id = $('#category').val();
			window.location.href = "<?php echo site_url('match/match_list_e/')?>" + jongmok_id + '/' + category_id;
        });
    });
</script>
<div class="container">
  <br/>  
    <div class="row text-center">
        <h2><?php echo $_SESSION['competition_name']?></h2>
		<?php if($_SESSION['compet_id']==36){ ?>
		<h5>2021. 10. 18.(MON) ~ 11. 16.(TUE)</h5>
		<?php } ?>
    </div>
	<br>
    <div class="row justify-content-center">
		<div class="col-sm-3">
  			<div class="form-group row">
				<select class="form-control" name="jongmok" id="jongmok">
					<?php 
					foreach($jongmok as $row) {
						$j_id=$row['ID'];
						$jongmok_name = $row['JONGMOK_NAME_E'];
						$applied_cnt = $row['APPLIED_CNT'];
						?>	
					<option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name . " - " . $applied_cnt ?></option>
					<?php } ?>
				</select>
			</div>	
  			<div class="form-group row">
				<select class="form-control" name="category" id="category">
					<?php foreach($category as $row) { 
						$c_id=$row['ID'];
						$category_name = $row['CATEGORY_NAME_E'];
						$applied_cnt2 = $row['APPLIED_CNT'];
					?>	
					<option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name . " - " . $applied_cnt2 ?></option>
					<?php } ?>
				</select>
            </div>
			<hr>
			<form id="find-form" action=<?php echo site_url("match/find_athlete/");?> method="post">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Type athlete name" name="a_name" id="a_name">
				<div class="input-group-append">
				  <button type="submit" class="btn btn-primary">Search</button>
				</div>
			  <br>
			</div>
			<div class="logo">
				<?php if($_SESSION['compet_id']==36){ ?>
				<br>
				<img src="http://ccnplaza.com/img/foreignaffairs.jpg" width="250px"></img>
				<?php }else{ ?>
				<a href="https://smartsm.co.kr/"><img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img></a>
				<?php } ?>
			</div>
			</form>
        </div>
        <div class="col-sm-9">    
            <table class="table table-bordered table-response table-sm" id="athlete">
				<thead class="thead-dark">
				<tr>
				  <th scope="col" width="50px" style="text-align: center">Group</th>
				  <?php if($game_methode != 1){
					  echo '<th scope="col" width="30px" style="text-align: center">Step</th>';
				  } ?>
				  <th scope="col" width="30px" style="text-align: center">Kind</th>
				  <?php if($_SESSION['is_international']==1){ ?>
				  <th scope="col" width="30px" style="text-align: center">Country</th>
				  <?php } ?>
				  <th scope="col" width="150px">Athlete Name</th>
				  <th scope="col" width="200px">Diplomatic mission</th>
				  <?php if($game_methode != 1){
					echo '<th scope="col" width="50px" style="text-align: center">Win</th>';
				  }else{
					echo '<th scope="col" width="50px" style="text-align: center">Win</th>';
				  } ?>
				  <th scope="col" width="50px">Video</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						foreach($match_list as $match){ 
							$blue_unattend = $match['BLUE_UNATTEND'];
							$red_unattend = $match['RED_UNATTEND'];
							if ($blue_unattend == 1){
								$attend_blue = '(불참)';
							}else{
								$attend_blue = '';
							}
							if ($red_unattend == 1){
								$attend_red = '(불참)';
							}else{
								$attend_red = '';
							}
					
							if($match['GAME_STEP'] > 0){ 
								$blue_id = $match['BLUE_ID'];
								$blue_school_id = $match['BLUE_SCHOOL_ID'];
								$red_id = $match['RED_ID'];
								$red_school_id = $match['RED_SCHOOL_ID'];
								$blue_info = $this->tkd_model->get_athlete_byid($blue_id);
								$blue_center_info = $this->tkd_model->get_center_id($blue_school_id);
								$red_info = $this->tkd_model->get_athlete_byid($red_id);
								$red_center_info = $this->tkd_model->get_center_id($red_school_id);
								if($match['B1_WIN']==2){
									$b_win = 'O';
									$r_win = 'X';
								}else if($match['B1_WIN']==1){
									$b_win = 'X';
									$r_win = 'O';
								}else{
									$b_win = '';
									$r_win = '';
								}
								switch($match['GAME_STEP']){
								  case 2: $step = 'FINAL'; break;
								  case 3: $step = 'SF';	break;
								  case 4: $step = 'QF';	break;
								  case 5: $step = '16th';	break;
								  case 6: $step = '32th';	break;
								  case 7: $step = '64th';	break;
								  case 8: $step = '예선';	break;
								}
							?>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td rowspan="2" style="text-align: center; vertical-align: middle;"><h3 style="color:blue"><b><?=$step?></b></h3></td>
								<td style="text-align: center; background-color:blue; color:white; vertical-align: middle;"><b>Blue</b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($blue_center_info->COUNTRY_ID)){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$blue_center_info->COUNTRY_ID ?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="vertical-align: middle;"><?php if(isset($blue_info->A_NAME)){echo $blue_info->A_NAME; } ?> 
								<span style="background-color:red; color:white"><?=$attend_blue ?></span>
								</td>
								<td style="vertical-align: middle;"><?php if(isset($blue_center_info->CENTER_NAME)){echo $blue_center_info->CENTER_NAME; } ?></td>
								<td style="text-align: center; vertical-align: middle;"><?=$b_win?></td>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($blue_info->VIDEO_ID)){?>
									<p style="text-align: center; vertical-align: middle;">Y</p>
									<?php } ?>
								</td>
								</tr>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td style="text-align: center; background-color:red; color:white; vertical-align: middle;"><b>Red</b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($red_center_info->COUNTRY_ID)){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$red_center_info->COUNTRY_ID?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="vertical-align: middle;"><?php if(isset($red_info->A_NAME)){echo $red_info->A_NAME; } ?>
								<span style="background-color:red; color:white"><?=$attend_red ?></span>
								</td>
								<td style="vertical-align: middle;"><?php if(isset($red_center_info->CENTER_NAME)){echo $red_center_info->CENTER_NAME; } ?></td>
								<td style="text-align: center; vertical-align: middle;"><?=$r_win?></td>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($red_info->VIDEO_ID)){?>
									<p style="text-align: center; vertical-align: middle;">Y</p>
									<?php } ?>
								</td>
								</tr>
							<?php }else{
									$blue_id = $match['BLUE_ID'];
									$blue_school_id = $match['BLUE_SCHOOL_ID'];
									$blue_info = $this->tkd_model->get_athlete_byid($blue_id);
									$blue_center_info = $this->tkd_model->get_center_id($blue_school_id);
								?>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td style="text-align: center; vertical-align: middle;"><b><?=$match['GAME_ID']?></b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($blue_center_info->COUNTRY_ID)){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$blue_center_info->COUNTRY_ID?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="text-align: center; vertical-align: middle;"><?php if(isset($blue_info->A_NAME)){echo $blue_info->A_NAME; } ?>
								<span style="background-color:red; color:white"><?=$attend_blue ?></span>
								</td>
								<td style="text-align: center; vertical-align: middle;"><?php if(isset($blue_center_info->CENTER_NAME)){echo $blue_center_info->CENTER_NAME; } ?></td>
								<td style="text-align: center; vertical-align: middle;"><?php if($match['B1_WIN'] > 0){echo $match['B1_WIN'];}?></td>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($blue_info->VIDEO_ID)){?>
										<p>Y</p>
									<?php } ?>
								</td>
								</tr>
							<?php }?>
						<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>	
	
