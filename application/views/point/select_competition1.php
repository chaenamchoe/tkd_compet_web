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
					<td><h4>��й�ȣ : </h4></td>
					<td>
						<input type="password" class="form-control" placeholder="��й�ȣ" name="compet_pass" id="compet_pass" required>
					</td>
				</tr>
				<tr>
					<td><h4>��Ʈ���� : </h4></td>
					<td>
						<select name="coat" id="coat" class="form-control" required>
						<option value="" selected="">��Ʈ(����)</option>
						<option value="1">1��Ʈ</option>
						<option value="2">2��Ʈ</option>
						<option value="3">3��Ʈ</option>
						<option value="4">4��Ʈ</option>
						</select>
					</td>
				</tr>
				<tr>				
					<td><h4>�νɼ��� : </h4></td>
					<td>
						<select name="judge" id="judge" class="form-control" required>
						<option value="" selected="">�ν�(����)</option>
						<option value="1">1 ��</option>
						<option value="2">2 ��</option>
						<option value="3">3 ��</option>
						<option value="4">4 ��</option>
						<option value="5">5 ��</option>
						</select>
					</td>
				</tr>	
			</table>	
		</div>	
		<hr>
		<div class="row justify-content-center">
			<div class="col text-center">
			<input type="submit" class="btn btn-primary btn-lg" value=" �� �� �� ">
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col text-center">
				<h4>
					��Ʈ�� �ν���ġ�� ��������<br>
					�α����� Ŭ���ϼ���.<br>
					��ȸ ä������ ��й�ȣ��<br>
					�Է��ؾ� �մϴ�.<br>
					��й�ȣ�� �𸣽� ���<br>
					����Ʈ���������� �����ϼ���.<br>
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