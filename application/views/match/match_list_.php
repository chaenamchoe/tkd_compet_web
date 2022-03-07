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
			window.location.href = "<?php echo site_url('match/match_list/')?>" + jongmok_id;
        });
        $('#category').change(function() {
			var jongmok_id = $('#jongmok').val();
            var category_id = $('#category').val();
			window.location.href = "<?php echo site_url('match/match_list/')?>" + jongmok_id + '/' + category_id;
        });
    });
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center">
        <h1><?php echo $_SESSION['competition_name']?></h1>
    </div>
	<br>
    <div class="row justify-content-center">
		<div class="col-sm-3">
  			<div class="form-group row">
				<select class="form-control" name="jongmok" id="jongmok">
					<?php 
					foreach($jongmok as $row) {
						$j_id=$row['ID'];
						$jongmok_name = $row['JONGMOK_NAME'];
						$applied_cnt = $row['APPLIED_CNT'];
						?>	
					<option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name . " - " . $applied_cnt."명" ?></option>
					<?php } ?>
				</select>
			</div>	
  			<div class="form-group row">
				<select class="form-control" name="category" id="category">
					<?php foreach($category as $row) { 
						$c_id=$row['ID'];
						$category_name = $row['CATEGORY_NAME'];
						$applied_cnt2 = $row['APPLIED_CNT'];
					?>	
					<option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name . " - " . $applied_cnt2."명" ?></option>
					<?php } ?>
				</select>
            </div>
			<form id="find-form" action=<?php echo site_url("match/find_athlete/");?> method="post">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="선수명입력" name="a_name" id="a_name">
				<div class="input-group-append">
				  <button type="submit" class="btn btn-primary">검색</button>
				</div>
			  <br>
			</div>
			<div class="logo">
				<a href="https://smartsm.co.kr/"><img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img></a>
			</div>
			</form>
        </div>
        <div class="col-sm-9">    
            <table class="table table-bordered table-response table-sm" id="athlete">
				<thead class="thead-dark">
				<tr>
				  <th scope="col" width="50px" style="text-align: center">조No</th>
				  <?php if($game_methode != 1){
					  echo '<th scope="col" width="30px" style="text-align: center">강수</th>';
				  } ?>
				  <th scope="col" width="30px" style="text-align: center">구분</th>
				  <?php if($_SESSION['is_international']==1){ ?>
				  <th scope="col" width="30px" style="text-align: center">국가</th>
				  <?php } ?>
				  <th scope="col" width="150px">선수명</th>
				  <th scope="col" width="200px">도장명</th>
				  <?php if($game_methode != 1){
					echo '<th scope="col" width="50px" style="text-align: center">승/패</th>';
				  }else{
					echo '<th scope="col" width="50px" style="text-align: center">순위</th>';
				  } ?>
				  <th scope="col" width="50px">비디오</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						foreach($match_list as $match){ 
							if($match['GAME_STEP'] > 0){ 
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
								  case 2: $step = '결승'; break;
								  case 3: $step = '4강';	break;
								  case 4: $step = '8강';	break;
								  case 5: $step = '16강';	break;
								  case 6: $step = '32강';	break;
								  case 7: $step = '64강';	break;
								  case 8: $step = '예선';	break;
								}
							?>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td rowspan="2" style="text-align: center; vertical-align: middle;"><h3 style="color:blue"><b><?=$step?></b></h3></td>
								<td style="text-align: center; background-color:blue; color:white; vertical-align: middle;"><b>청</b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['COUNTRY_ID_B'])){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$match['COUNTRY_ID_B'] ?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="vertical-align: middle;"><?php if(isset($match['NAME_B'])){echo($match['NAME_B']);} ?></td>
								<td style="vertical-align: middle;">
									<?php if(isset($match['CENTER_NAME_B'])){
										echo ($match['CENTER_NAME_B']);
									} ?>
								</td>
								<!--<td style="text-align: center; vertical-align: middle;"><?=$b_win?></td>-->
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['VIDEO_ID_B'])){?>
									<p style="text-align: center; vertical-align: middle;">Y</p>
									<?php } ?>
								</td>
								</tr>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td style="text-align: center; background-color:red; color:white; vertical-align: middle;"><b>홍</b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['COUNTRY_ID_R'])){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$match['COUNTRY_ID_R']?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="vertical-align: middle;"><?php if(isset($match['NAME_R'])){echo $match['NAME_R']; } ?></td>
								<td style="vertical-align: middle;">
									<?php if(isset($match['CENTER_NAME_R'])){ ?>
										<p><?=$match['CENTER_NAME_R']?></p>
									<?php }else{ ?>
									<p></p>
									<?php } ?>
								</td>
								<!--<td style="text-align: center; vertical-align: middle;"><?=$r_win?></td>-->
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['VIDEO_ID_R'])){?>
									<p style="text-align: center; vertical-align: middle;">Y</p>
									<?php } ?>
								</td>
								</tr>
							<?php }else{ ?>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td style="text-align: center; vertical-align: middle;"><b><?=$match['GAME_ID']?></b></td>
								<?php if($_SESSION['is_international']==1){ ?>
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['COUNTRY_ID_B'])){ ?>
									<img class="fit-picture" src="http://ccnplaza.com/tkd_compet/uploads/country_flag_no/<?=$match['COUNTRY_ID_B']?>.png">
									<?php } ?>
								</td>
								<?php } ?>
								<td style="text-align: center; vertical-align: middle;"><?php if(isset($match['NAME_B'])){echo $match['NAME']; } ?></td>
								<td style="text-align: center; vertical-align: middle;"><?php if(isset($match['CENTER_NAME_B'])){echo $match['CENTER_NAME_B']; } ?></td>
								<!--<td style="text-align: center; vertical-align: middle;"><?php if($match['B1_WIN'] > 0){echo $match['B1_WIN'];}?></td>-->
								<td style="text-align: center; vertical-align: middle;">
									<?php if(isset($match['VIDEO_ID_B'])){?>
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
	
