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
		  <h1 class="display-5"><?php echo $_SESSION['assoc_name'] ?></h1>
		  <p class="lead">�¶��� ��ȸ��� ����Ʈ�� ���Ű��� ȯ���մϴ�.</p>
		</div>
	</div>
    <form id="login-form" action=<?php echo site_url("compet/check_login")?> method="post">
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p style="color:red; font-weight:bold">����� �̸��ϰ� ��й�ȣ�� �α����ϼ���.<br>
				���� ����(��ü)�� �űԵ���� ���� �ϼ���.</p>
            <p>
                <label>�α��ξ��̵�(�̸���)�� �Է��ϼ���.</label>
                <input id="login_id" name="login_id" class="form-control" type="text" placeholder="�̸����ּҸ� �Է��ϼ���." required>
            </p>
            <p>
                <label>��й�ȣ�� �Է��ϼ���.</label>
                <input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="��й�ȣ�� �Է��ϼ���." required>
            </p>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> �α��� </button>
				<a href="#" onclick="myFunction();" class="btn btn-primary btn-mg">�űԵ�����</a>
            </p>
        </div>    
    </div>    
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p style="color:red; font-weight:bold">ũ�Һ������� ����Ͽ� �Է��ϼ���. IE�� ����Ͻø� ���������� �Է��� �ȵǴ� �������� ���� �� �ֽ��ϴ�.</p>
		</div>
	</div>	
    </form>
        