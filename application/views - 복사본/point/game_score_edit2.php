<script>
	/*
	function autoRefresh()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefresh()', 5000);
	*/
</script>
<div class="container">
	<div class="row">
		<div class="col text-center">
			<p><h4><?=$jongmok?></h4></p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-12 col-md-10 col-lg-4">
		<form class="form-inline" action=<?php echo site_url("Compet/compet_point/")?> method="post">
		<div class="input-group">
			<div class="input-group-prepend">
				<label class="input-group-text" for="coat_no">��Ʈ</label>
			</div>
			<select class="custom-select" id="coat_no" name="coat_no">
				<option value="1" <?php if ($coat_no == "1") echo "SELECTED";?>>1��Ʈ</option>
				<option value="2" <?php if ($coat_no == "2") echo "SELECTED";?>>2��Ʈ</option>
				<option value="3" <?php if ($coat_no == "3") echo "SELECTED";?>>3��Ʈ</option>
				<option value="4" <?php if ($coat_no == "4") echo "SELECTED";?>>4��Ʈ</option>
				<option value="5" <?php if ($coat_no == "5") echo "SELECTED";?>>5��Ʈ</option>
			</select>
			&nbsp;
			<div class="input-group-prepend">
				<label class="input-group-text" for="judge_no">�ν�</label>
			</div>
			<select class="custom-select" id="judge_no" name="judge_no">
				<option value="1" <?php if ($judge_no == "1") echo "SELECTED";?>>�ν�1</option>
				<option value="2" <?php if ($judge_no == "2") echo "SELECTED";?>>�ν�2</option>
				<option value="3" <?php if ($judge_no == "3") echo "SELECTED";?>>�ν�3</option>
				<option value="4" <?php if ($judge_no == "4") echo "SELECTED";?>>�ν�4</option>
				<option value="5" <?php if ($judge_no == "5") echo "SELECTED";?>>�ν�5</option>
			</select>
			&nbsp;
			<div>
			<button id="refresh" type="submit" class="btn btn-primary btn-big">Ȯ��</button>
			</div>
		</div>	
		</form>
		</div>
	</div>
	</br>
	<div class="row justify-content-center">
		<div class="col-sm-12 col-md-10">
			<table class="table table-reponsible">
				<thead class="thead-dark">
				<tr>
					<th style="text-align:center">No</th>
					<th>������</th>
					<th style="text-align:left">����</th>
					<th style="text-align:center">�Է�</th>
					<th style="display:none;">guid</th>
				</tr>
				</thead>
				<?php
					$no = 0;
					$tprice = 0;
					foreach ($result as $row):
						$no++;
						$id = $row['A_NO'];
						$kind = $row['GAME_KIND'];
						$b_name = $row['BLUE_NAME'];
						$r_name = $row['RED_NAME'];
						$jongmok_name = $row['JONGMOK_NAME'];
						if($judge_no==1){
							$bpoint = $row['B_J1'];
							$rpoint = $row['R_J1'];
						}
						if($judge_no==2){
							$bpoint = $row['B_J2'];
							$rpoint = $row['R_J2'];
						}
						if($judge_no==3){
							$bpoint = $row['B_J3'];
							$rpoint = $row['R_J3'];
						}
						$match_id = $row['MATCH_ID'];
					?>
				<tr>
					<td style="text-align:center"><?=$id?></td>
					<td><?=$b_name ?></br></br><?=$r_name ?></td>
					<td><h3><font style="color:red"><b><?=number_format($bpoint,2)?></b></font></h3></td>
					<td style="text-align:center">
					<a href=<?php echo site_url('compet/score_edit/'.$match_id.'/1/'.$b_name)?> class="btn btn-primary btn-sm">�Է�</a></br></br>
					<a href=<?php echo site_url('compet/score_edit/'.$match_id.'/2/'.$r_name)?> class="btn btn-primary btn-sm">�Է�</a>
					</td>
					<td style="display:none;"><?=$match_id?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>	
</div>