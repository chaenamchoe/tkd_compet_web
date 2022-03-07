<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 alert alert-success text-center">
        <h1> 대회/코트/부심 선택 </h1>
        </div>
    </div>
    <hr>
	<form id="find-form" action=<?php echo site_url("point/set_competition/");?> method="post">
		<h2>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">대회코드: </label>
				<input type="number" class="form-control" placeholder="대회코드" name="compet_id" id="compet_id" style="font-size:20px" required>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">코트번호:</label>
				<input type="number" class="form-control" placeholder="코드번호" name="coat" id="coat" style="font-size:20px" required>			
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="form-group col-sm-6">
				<label class="control-label">부심번호:</label>
				<input type="number" class="form-control" placeholder="심판번호" name="judge" id="judeg" style="font-size:20px" required>			
			</div>
		</div>	
		<hr>
		<div class="row justify-content-center">
			<div class="form-group col-sm-6 text-center">
				<input class="btn btn-primary btn-lg" type="submit" value="확인">
			</div>
		</div>	
		</h2>
	</div>	
	</form>
</div>