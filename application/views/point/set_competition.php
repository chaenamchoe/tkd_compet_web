<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 alert alert-success text-center">
        <h1> ��ȸ/��Ʈ/�ν� ���� </h1>
        </div>
    </div>
    <hr>
	<form id="find-form" action=<?php echo site_url("point/set_competition/");?> method="post">
		<h2>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">��ȸ�ڵ�: </label>
				<input type="number" class="form-control" placeholder="��ȸ�ڵ�" name="compet_id" id="compet_id" style="font-size:20px" required>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">��Ʈ��ȣ:</label>
				<input type="number" class="form-control" placeholder="�ڵ��ȣ" name="coat" id="coat" style="font-size:20px" required>			
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">�νɹ�ȣ:</label>
				<input type="number" class="form-control" placeholder="���ǹ�ȣ" name="judge" id="judeg" style="font-size:20px" required>			
			</div>
		</div>	
		<hr>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6 text-center">
				<input class="btn btn-primary btn-lg" type="submit" value="Ȯ��">
			</div>
		</div>	
		</h2>
	</div>	
	</form>
</div>