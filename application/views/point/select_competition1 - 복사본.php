<script>
function myFunction(pass) {
		var password = prompt("�н����带 �Է��ϼ���", "");
		const btn = document.getElementsByClassName('btn-primary');
		if (password != null && password == pass) {
			for (let i = 0; i < btn.length; i++) {
			  btn[i].className = "btn btn-primary btn-lg"; 
			}
		} else {
			alert("��й�ȣ�� Ʋ�Ƚ��ϴ�. \n��ȸä���� ������ ���� ��й�ȣ�� �Է��ϼž� \nä���� �Ͻ� �� �ֽ��ϴ�.\n��й�ȣ�� ����Ʈ���������� �����ϼ���.");
		}
	}
</script>	
<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
        <h2> ��ȸ/��Ʈ/�ν� ���� </h2>
        </div>
    </div>
    <hr>
		<div class="row justify-content-center">
			<div class="col-sm-8 text-center">
				<p><h3 class="alert alert-success"> <?=$compet_name?> </h3></p>
				<p><a onclick="myFunction(<?=$online_password?>);" class="btn btn-info btn-lg">��й�ȣ Ȯ��</a></p>
				<p><h3 class="alert alert-info"> 1 ��Ʈ </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/1')?> class="btn btn-primary btn-lg disabled"> 1 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/2')?> class="btn btn-primary btn-lg disabled"> 2 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/3')?> class="btn btn-primary btn-lg disabled"> 3 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/4')?> class="btn btn-primary btn-lg disabled"> 4 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/5')?> class="btn btn-primary btn-lg disabled"> 5 �� </a>
				</p><hr>
				<p><h3 class="alert alert-info"> 2 ��Ʈ </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/1')?> class="btn btn-primary btn-lg disabled"> 1 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/2')?> class="btn btn-primary btn-lg disabled"> 2 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/3')?> class="btn btn-primary btn-lg disabled"> 3 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/4')?> class="btn btn-primary btn-lg disabled"> 4 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/5')?> class="btn btn-primary btn-lg disabled"> 5 �� </a>
				</p><hr>
				<p><h3 class="alert alert-info"> 3 ��Ʈ </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/1')?> class="btn btn-primary btn-lg disabled"> 1 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/2')?> class="btn btn-primary btn-lg disabled"> 2 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/3')?> class="btn btn-primary btn-lg disabled"> 3 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/4')?> class="btn btn-primary btn-lg disabled"> 4 �� </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/5')?> class="btn btn-primary btn-lg disabled"> 5 �� </a>
				</p><hr>
			</div>
		</div>	
</div>