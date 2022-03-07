<style>
td.title {
	width: 200px;
}
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 544px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  h4 {font-size:1rem;} /*1rem = 16px*/
}	
</style>
<div class="container">
	<div class="alert alert-primary text-center mt-3">
		<h1>�¶��� ��ȸ���� </h1>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-12">
			<?php 
				$compet_id = $result->ID;
				$compet_name = $result->C_NAME;
				$compet_place = $result->C_PLACE;
				$compet_sdate = $result->S_DATE;
				$compet_edate = $result->E_DATE;
				$compet_reg_sdate = $result->REG_SDATE;
				$compet_reg_edate = $result->REG_EDATE;
				$compet_owner = $result->C_OWNER;
				$compet_owner2 = $result->C_OWNER2;
				$compet_support = $result->C_SUPPORT;
				$compet_contact = $result->C_CONTACT;
				$compet_meeting = $result->C_MEETING;
				$compet_weight_check = $result->WEIGHT_CHECK;
				if ($compet_sdate <> $compet_edate){
					$compet_date = $compet_sdate . ' ~ ' . $compet_edate;
				}else{
					$compet_date = $compet_sdate;
				}
			?>
				<h5>
				<table class="table table-bordered ">
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� &nbsp ȸ &nbsp ��</font></td>
						<td><?php echo $compet_name ?></br></td>
					</tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� ȸ �� ��</font></td>
						<td><?php echo $compet_date ?></td>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� &nbsp &nbsp &nbsp &nbsp ��</font></td>
						<td><?php echo $compet_place ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�ְ� / ����</font></td>
						<td><?php echo $compet_owner2 ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� &nbsp &nbsp �� 1</font></td>
						<td><?php echo $compet_owner ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� &nbsp &nbsp �� 2</font></td>
						<td><?php echo $compet_support ?></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� û �� ��</font></td>
						<td><?php echo $compet_reg_sdate ?> ~ <?php echo $compet_reg_edate ?></br></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">��ǥ��ȸ��</font></td>
						<td><?php echo $compet_meeting ?></td>
					</tr>
					<tr>
						<td style="background-color:#f4edf5;" class="text-center title"><font style="color:blue">�� �� �� ü</font></td>
						<td><?php echo $compet_weight_check ?></br></td>
					</tr>
				</table>
				</h5>
				<p class="text-center" >
				��������� �Ϸ��� �α����� �ؾ� �մϴ�. �������� �ȵǽ� �е��� ��ü(����)����� ���� �ϼ���.<br>
				��ܸ޴����� <a href="<?php echo site_url('compet/find_center')?>">����˻�</a>�� Ŭ���Ͽ� ��Ͽ��θ� Ȯ���� ������.
				</p>	
		</div>
	</div>
	<div class="row justify-content-center text-center">	
		<div class="col-sm-8">
			<?php if($_SESSION['login_user_approved'] > 0){ ?>
				<p><a href=<?php echo site_url("compet/loginout");?> class="btn btn-primary"> �α׾ƿ� </a>
				<a href=<?php echo site_url('compet/registed_athlete')?> class="btn btn-primary">�������/��ȸ</a>
				</p>
			<?php }else{ ?>
				<p><a href=<?php echo site_url("compet/login");?> class="btn btn-primary"> �α��� </a>
				<a href=<?php echo site_url('compet/regist_center')?> class="btn btn-primary">��ü(����)���</a></p>
			<?php } ?>
		</div>
		<br/>
	</div>