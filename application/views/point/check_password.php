<div class="container">
	<form id="findform" action=<?php echo site_url("point/check_password/");?> method="post">
		<div class="row justify-content-center">
			<div class="col text-center">
				<p><h3 class="alert alert-success"> ��ȸ PASSWORD �Է� </h3></p>
			</div>
		</div>	
		<div class="row justify-content-center">
			<table>
				<tr>
					<td><h4>��й�ȣ : </h4></td>
					<td>
						<input type="password" class="form-control" placeholder="��й�ȣ" name="compet_pass" id="compet_pass" required>
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
			<input type="submit" class="btn btn-primary btn-lg" value=" Ȯ  �� ">
			</div>
		</div>
		<br>
		<div class="row justify-content-center">
			<div class="col text-center">
				<h4>
					��ȸ ���� ��й�ȣ��<br>
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