<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
        <h2> ��ȸ/��Ʈ/�ν� ���� </h2>
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
				<label class="control-label">��й�ȣ: </label>
				<input type="text" class="form-control" placeholder="��й�ȣ" name="compet_pass" id="compet_pass" required>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="form-group">
				<label class="control-label">��Ʈ��ȣ:</label>
				<select name="coat" id="coat">
					<option value="" selected="">��Ʈ(����)</option>
					<option value="1">1��Ʈ</option>
					<option value="2">2��Ʈ</option>
					<option value="3">3��Ʈ</option>
					<option value="4">4��Ʈ</option>
				</select>
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="form-group">
				<label class="control-label">�νɹ�ȣ:</label>
				<select name="judge" id="judge">
					<option value="" selected="">�ν�(����)</option>
					<option value="1">1 ��</option>
					<option value="2">2 ��</option>
					<option value="1">3 ��</option>
					<option value="1">4 ��</option>
					<option value="1">5 ��</option>
				</select>
			</div>
		</div>	
	</div>	
	</form>
	<?php endforeach; ?>
</div>