<script>
	function myFunction() {
		var e = document.getElementById("assoc_id");
		var assoc = e.options[e.selectedIndex].value;
		if (assoc > 0) {
			window.location.href = "<?php echo site_url()?>compet/regist_center/"+assoc;
		}else{
			alert('�Ҽ���ȸ�� ���� �����ϼ���.');
			document.getElementById("assoc_id").focus();
		}
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5"><?php echo $_SESSION['site_title'] ?></h1>
		  <p class="lead">�¶��� ��ȸ��� ����Ʈ�� ���Ű��� ȯ���մϴ�.</p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="card col-sm-4 shadow m-0 p-0">
		<form id="login-form" action=<?php echo site_url("compet/check_login")?> method="post">
			<div class="card-header bg-primary text-white"><h5 class="card-title text-center">����� �α���</h5></div>	
			<div class="card-body">
				<p class="text-center" style="color:red; font-weight:bold">����� �̸��ϰ� ��й�ȣ�� �α����ϼ���.<br>
					���� ����(��ü)�� �űԵ���� ���� �ϼ���.</p>
				<?php if($_SESSION['assoc_id'] == 0){ ?>
				<p>
					<label>�Ҽ���ȸ�� �����ϼ���.</label>
					<select class="form-control" name="assoc_id" id="assoc_id" required>
					<?php if(count($result) > 1){
						echo "<option value=0>--�Ҽ���ȸ�� �����ϼ���--</option>";
						foreach($result as $row) {
							$a_id=$row['ID'];
							$a_name = $row['A_NAME'];
							echo "<option value=". $a_id . ">".$a_name."</option>";
						}
					}else{
						$a_id=$result[0]['ID'];
						$a_name = $result[0]['A_NAME'];
						echo "<option value=". $a_id . ">".$a_name."</option>";
					}?>	
					</select>
				</p>
				<?php } ?>
				<p>
					<label>�α��ξ��̵�(�̸���)�� �Է��ϼ���.</label>
					<input id="login_id" name="login_id" class="form-control" type="text" placeholder="�̸����ּҸ� �Է��ϼ���." required>
				</p>
				<p>
					<label>��й�ȣ�� �Է��ϼ���.</label>
					<input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="��й�ȣ�� �Է��ϼ���." required>
				</p>
			</div> 
			<div class="card-footer text-center">
				<button id="submit" type="submit" class="btn btn-primary"> �α��� </button>
			</div>
		</div>
		<div class="row justify-content-center mt-5">
			<div class="col-sm-4">
				<p style="color:red; font-weight:bold">ũ�Һ������� ����Ͽ� �Է��ϼ���. IE�� ����Ͻø� ���������� �Է��� �ȵǴ� �������� ���� �� �ֽ��ϴ�.</p>
			</div>
		</div>	
		</form>
	</div>
	</div>