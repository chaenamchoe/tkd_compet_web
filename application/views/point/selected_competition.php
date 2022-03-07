<div class="container">
	<form id="findform" action=<?php echo site_url("point/save_competition/");?> method="post">
		<div class="row justify-content-center">
			<div class="col text-center">
				<p><h3 class="alert alert-success"> <?=$compet_name?> </h3></p>
			</div>
		</div>	
		<div class="row justify-content-center">
			<table>
				<tr>
					<td><h4>비밀번호 : </h4></td>
					<td>
						<input type="password" class="form-control" placeholder="비밀번호" name="compet_pass" id="compet_pass" required>
					</td>
				</tr>
				<tr>
					<td><h4>코트선택 : </h4></td>
					<td>
						<select name="coat" id="coat" class="form-control" required>
						<option value="" selected="">코트(선택)</option>
						<option value="1">1코트</option>
						<option value="2">2코트</option>
						<option value="3">3코트</option>
						<option value="4">4코트</option>
						</select>
					</td>
				</tr>
				<tr>				
					<td><h4>부심선택 : </h4></td>
					<td>
						<select name="judge" id="judge" class="form-control" required>
						<option value="" selected="">부심(선택)</option>
						<option value="1">1 심</option>
						<option value="2">2 심</option>
						<option value="3">3 심</option>
						<option value="4">4 심</option>
						<option value="5">5 심</option>
						</select>
					</td>
				</tr>	
			</table>	
		</div>	
		<hr>
		<div class="row justify-content-center">
			<div class="col text-center">
			<input type="submit" class="btn btn-primary btn-lg" value=" 로 그 인 ">
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col text-center">
				<h4>
					코트와 부심위치를 선택한후<br>
					로그인을 클릭하세요.<br>
					대회 채점심판 비밀번호를<br>
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