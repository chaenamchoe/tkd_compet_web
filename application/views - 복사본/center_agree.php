<div class="container">
	<form action=<?php echo site_url("compet/save_agree")?> method="post">
	<div class="row">
		<div>
		<p><h3>�������� ����/�̿�/��3�� ���� ���Ǽ�</h3></p>
		<p>�� <?php echo $_SESSION['site_title']; ?>�� ����������ȣ���� �ǰ��� ���������� ��ȣ�ϱ� ���� ���������� ������ �̿뿡 ���� ������ �Ʒ��� ���� �����մϴ�. 
			<?php echo $_SESSION['site_title']; ?>�� ������ ��� ���� ������ <?php echo $_SESSION['active_competition_name']; ?>�� ���� �� �� �� ���� ������ ���� ���� �̿ܿ��� ���� �� ������, 
			���������� �������� �뵵�� ����� ��쿡 ���Ͽ��� ���Ǹ� ���� ���Դϴ�. 
			����������ȣ������ �����ϴ� ���ֿ� ���� �ʴ� ���ֿ� ������ ���� �� �߰��� ���� ��� ���Ͽ��� ������ ���� �˷��帳�ϴ�. 
			���� ������ �о�� ��, ���ǿ��ο� ���� üũ �� ������ ���ֽñ� �ٶ��ϴ�.
		</p>
		</div>
		<div>
			<p><b>�� �������� ����/�̿� ����</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>��������</th>
				<th>�������̿��ϴ� ���������� �׸�</th>
				<th>��������</th>
				<th>�����Ⱓ</th>
				</thead>
				<tr>
					<td>�ʼ�</td>
					<td>�б�(����)��, ����(����)��, ����(����)�޴���ȭ, �б�(����)�ּ�, ��(���߰�),<br>�������г�, �����ڼ���, �����ڰܷ��(ü��), �����ڽù�������(����)</td>
					<td>��ȸ���� �� ���� �ĺ� ���� �� ������ �Ա�Ȯ��,<br>��ȸ ����ó��, ���غ��谡��</td>
					<td>1��</td>
				</tr>
				<tr>
					<td>����</td>
					<td>����, �����ڼ���, �������б���, �����</td>
					<td>�������� �߱�</td>
					<td>3��</td>
				</tr>
			</table>
			<div>
			<p>�� ���� �������� ����?�̿뿡 ���� ���Ǹ� �ź��� �Ǹ��� �ֽ��ϴ�. �׷��� �ʼ��׸� ���Ǹ� �ź��� ��� ��Ȱ�� ��ȸ ������ ������ ���� �� ������, 
				�����׸� ���Ǹ� �ź��� ��� �������� �߱��� �Ұ����� �˷��帳�ϴ�.
			</p>
			</div>
			<div>
			<table class="table table-bordered">
				<tr>
					<td><b>�� ���� ���� (�ʼ�)�׸� ���������� �������̿��ϴµ� �����Ͻʴϱ�?</b></td>
					<td>
						  <input type="radio" name="agree1" value="1" checked>
						  <label for="agree1">��</label>
						  <input type="radio" name="agree1" value="0">
						  <label for="agree1">�ƴϿ�</label>
					</td>
				</tr>
				<tr>
					<td><b>�� ���� ���� (����)�׸� ���������� �������̿��ϴµ� �����Ͻʴϱ�?</b></td>
					<td>
						  <input type="radio" name="agree2" value="1" checked>
						  <label for="agree2">��</label>
						  <input type="radio" name="agree2" value="0">
						  <label for="agree2">�ƴϿ�</label>
					</td>
				</tr>
			</table>			
			</div>
		</div>
		<div>
			<p><b>�� �����ĺ�����(�ֹε�Ϲ�ȣ) ���� ����(�ʼ�����)</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>�׸�</th>
				<th>��������</th>
				<th>�����Ⱓ</th>
				</thead>
				<tr>
					<td>�ֹε�Ϲ�ȣ (�ܷ�⡤ǰ�����ù�.�±�ü��)</td>
					<td>������ ���谡��</td>
					<td>���谡�� �� ��� �ı�</td>
				</tr>
			</table>
			<p>�� ���� �����ĺ�����(�ֹε�Ϲ�ȣ) ������ ���� ���Ǹ� �ź��� �Ǹ��� �ֽ��ϴ�. �׷��� ���Ǹ� �ź��� ��� ��ȸ ������ ������ ���� �� �ֽ��ϴ�.</p>
			<table class="table table-bordered">
				<tr>
					<td><b>�� ���� ���� �����ĺ�����(�ֹε�Ϲ�ȣ)�� ó���ϴµ� �����Ͻʴϱ�?</b></td>
					<td>
						  <input type="radio" name="agree3" value="1" checked>
						  <label for="agree3">��</label>
						  <input type="radio" name="agree3" value="0">
						  <label for="agree3">�ƴϿ�</label>
					</td>
				</tr>
			</table>
		</div>
		<div>
			<p><b>�� �������� ��3�� ���� ����(�ʼ�����)</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>�����޴� ���</th>
				<th>��������</th>
				<th>�����ϴ� �׸�</th>
				<th>�����Ⱓ</th>
				</thead>
				<tr>
					<td>����ȸ��</td>
					<td>��ȸ ������ ���谡��</td>
					<td>�����ڼ���, �������ֹε�Ϲ�ȣ</td>
					<td>���谡�� �� ���谡�� ��������ڴ� ��� �ı�, û���� ���� DB�����Ⱓ �ؿ���</td>
				</tr>
			</table>
			<p>�� ���� �������� ������ ���� ���Ǹ� �ź��� �Ǹ��� �ֽ��ϴ�. �׷��� ���Ǹ� �ź��� ��� ���� ������ �Ұ��Ͽ� ��ȸ ������ ������ ���� �� �ֽ��ϴ�.</p>
			<table class="table table-bordered">
				<tr>
					<td><b>�� ���� ���� �����ĺ�����(�ֹε�Ϲ�ȣ)�� �����ϴµ� �����Ͻʴϱ�?</b></td>
					<td>
						  <input type="radio" name="agree4" value="1" checked>
						  <label for="agree4">��</label>
						  <input type="radio" name="agree4" value="0">
						  <label for="agree4">�ƴϿ�</label>
					</td>
				</tr>
			</table>
		</div>
		<div>
			<b> - ���� ���� ���������� �������̿��ϴµ� �����Ͻʴϱ�? </b>
			  <input type="radio" name="agree5" value="1" checked>
			  <label for="agree5">��</label>
			  <input type="radio" name="agree5" value="0">
			  <label for="agree5">�ƴϿ�</label>
		</div>
	</div>
		<hr>
	<div class="row justify-content-center">
		<button type="submit" class="btn btn-primary">Ȯ�� �� ����</button>
	</div>
	</form>
</div>