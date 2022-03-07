<div class="container">
    <br/>  
    <div class="row justify-content-center">
        <div class="col text-center">
        <h4>등록도장 검색</h4>
        <hr>
        </div>
	</div>	
    <div class="row justify-content-center">
		<div class="col-sm-4">
			<form class="form-inline" id="login-form" action=<?php echo site_url("Compet/find_center")?> method="post">
				<div class="form-group">
					<div class="input-group">
						  <input type="text" id="center_name" name="center_name" class="form-control" placeholder="도장명을 입력하세요." required>
					</div>
					&nbsp;	
					<div class="input-group">
						<button class="btn btn-primary" type="submit">도장명검색</button>
					</div>
				</div>
			</form>
		</div>
		<hr>
	</div>
	<div class="row justify-content-center">
		<div class="col text-center">
		</br>
		<h5>도장명의 일부만 입력해도 검색 됩니다.</h5>
		</br>		
		</div>
		<hr>
	</div>	
        