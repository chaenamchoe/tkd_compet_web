<style type="text/css">

</style>
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
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
			<table class="table table-bordered">
			<?php 
				$compet_id = $_SESSION['compet_id'];
				$coat_no = $_SESSION['coat_no'];
				$country = $_SESSION['country'];
				$judge_no = $_SESSION['judge_no']; 
			?>
	        <tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>compet/login" class="btn btn-primary btn-lg btn-block">��ȸ�������</a></td>
				<td style="vertical-align: middle;">��ȸ ���������� ����մϴ�.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>match/matches/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">����ǥ��ȸ</a></td>
				<td style="vertical-align: middle;">��ȸ ����ǥ�� ��ȸ�մϴ�.<br>���񺰷� ������ �����մϴ�.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>point/points/<?=$compet_id?>/<?=$coat_no?>/<?=$judge_no?>" class="btn btn-primary btn-lg btn-block">���ä��(����)</a></td>
				<td style="vertical-align: middle;">������ ������ �Է��մϴ�.<br>���Ǹ� �����մϴ�(��й�ȣ �Է�)</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>process/save_competition/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">��������Ȳ</a></div>
				<td style="vertical-align: middle;">���� ��� �����Ȳ�� ��ȸ�մϴ�.<br>�ڵ����� ȭ�齺ũ���� �˴ϴ�.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>video/assoc/<?=$compet_id?>" class="btn btn-primary btn-lg btn-block">��⿵�󺸱�</a></div>
				<td style="vertical-align: middle;">��⿵���� ���ϴ�.</td>
			</tr>	
			</table>
	    </div>    
    </div>    
        