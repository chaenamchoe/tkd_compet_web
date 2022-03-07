<div class="container">
	<form id="findform" action=<?php echo site_url("point/check_password/");?> method="post">
		<div class="row justify-content-center">
			<div class="col text-center">
				<p><h3 class="alert alert-success"> 대회 PASSWORD 입력 </h3></p>
			</div>
		</div>	
		<div class="row justify-content-center">
			<table>
				<tr>
					<td><h4>비밀번호 : </h4></td>
					<td>
						<input type="password" class="form-control" placeholder="비밀번호" name="compet_pass" id="compet_pass" required>
						<input type="hidden" name="compet_id" id="compet_id" value="<?=$compet_id?>">
						<input type="hidden" name="coat_no" id="coat_no" value="<?=$coat_no?>">
						<input type="hidden" name="judge_no" id="judge_no" value="<?=$judge_no?>">
					</td>
				</tr>
			</table>	
		</div>	
		<hr>
		<div class="row justify-content-center">
			<div class="col text-center">
			<input type="submit" class="btn btn-primary btn-lg" value=" 확  인 ">
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col text-center">
				<h4>
					대회 심판 비밀번호를<br>
					입력해야 합니다.<br>
					비밀번호를 모르실 경우<br>
					스마트에스엠으로 문의하세요.<br>
				</h4>
			</div>
		</div>	
		<div class="row justify-content-center">
			<div class="col text-center">
				<img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img>
			</div>
		</div>
	</form>	
</div>