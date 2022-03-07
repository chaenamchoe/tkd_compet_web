<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
        <h2> 대회/코트/부심 선택 </h2>
        </div>
    </div>
    <hr>
	<?php
	foreach ($compet_list as $row):
		$id = $row['ID'];
		$c_name = $row['C_NAME'];
		$c_place = $row['C_PLACE'];
	?>
	<form id="find-form" action=<?php echo site_url("point/save_competition/".$id);?> method="post">
		<div class="row justify-content-center">
			<p><h3 class="alert alert-success"> <?=$c_name?> </h3></p>
		</div>	
		<div class="row justify-content-center">
			<div class="form-group form-inline col-sm-2">
				<label class="control-label">비밀번호: </label>
				<input type="text" class="form-control" placeholder="비밀번호" name="compet_pass" id="compet_pass" required>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="form-group">
				<label class="control-label">코트번호:</label>
				<select name="coat" id="coat">
					<option value="" selected="">코트(선택)</option>
					<option value="1">1코트</option>
					<option value="2">2코트</option>
					<option value="3">3코트</option>
					<option value="4">4코트</option>
				</select>
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="form-group">
				<label class="control-label">부심번호:</label>
				<select name="judge" id="judge">
					<option value="" selected="">부심(선택)</option>
					<option value="1">1 심</option>
					<option value="2">2 심</option>
					<option value="1">3 심</option>
					<option value="1">4 심</option>
					<option value="1">5 심</option>
				</select>
			</div>
		</div>	
	</div>	
	</form>
	<?php endforeach; ?>
</div>