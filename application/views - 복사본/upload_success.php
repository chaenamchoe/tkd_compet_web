<div class="container">
	<br/>
	<div class="row">
		<p><h3>������û�� �ٿ�ε� �ȳ�</h3></p>
	</div>
	<br/>
	<div class="row">
        <p>
            ��� ���� ���� �Ǵ� �б��� ������û���� �����ؾ� �մϴ�.<br />
            ÷�������� �̹��� ������ .JPG ���·θ� ����� �����մϴ�.<br />
            ������û�� ���ε� ������ ����� ����� 2���� ����߿��� �ϳ��� �����ϼ���.<br />
        </p>
        <p>
        <ol>    
            <li><b><font style="color:blue">�Ʒ��ѱ��� ����ϴ� ���</font></b></li>
                <ul>
                    <li>�Ʒ��ѱۿ��� �ٿ�ε� �� ������û�� ������ ���ϴ�.</li>
                    <li>������ ��� �Է��ϰ� ������ �մϴ�.</li>
                    <li>�Ʒ��ѱ� ���� �޴����� �ٸ��̸����� �����ϱ⸦ ������ �� ���ϸ��� �Է��ϰ� </li>
                    <li>�������Ŀ��� JPG �̹���(*.jpg)�� �����Ͽ� �����մϴ�.</li>
                    <li>����� jpg �̹��� ������ ã�Ƽ� ����÷�θ� �Ͻø� ����� �Ϸ�˴ϴ�.</li>
                </ul>    
            <li><b><font style="color:blue">����� �ۼ� �� �޴������� ������ ��� ���</font></b></li>
                <ul>    
                    <li>������û���� ������ ��� �Է��մϴ�.</li>
                    <li>������ ī�޶� �Ǵ� �޴������� ������û���� �� ���ĳ��� ������ ����ϴ�.</li>
                    <li>����� ������ ���������� Ȯ���ϼ���.(��κ� ������ Ȯ���ڴ� *.jpg�̳� �ƴ� ��쵵 ����)</li>
                    <li>���� ���������� ���������� jpg ������ �ƴ� ��쿡�� �������� ��ȯ</li>
                    <li>�˾� ���� �������� ��ȯ ���� �̿��Ͽ� ������ jpg�� ���� �� ������ ÷��</li>
                    <li>������</li>
                </ul>
        </ol>
        </p>
        <br />
	</div>
    <div class="row">
    <p><a href="http://ccnplaza.com/img/�ܷ������÷�ο�.hwp" class="btn btn-primary">������û�� �ٿ�ε� </a> &nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo form_open_multipart('welcome/upload_file');?>
        <?php echo "<input type='file' name='userfile' size='20' />"; ?>
        <?php echo "<input type='submit' name='submit' class='btn btn-primary' value='upload' /> ";?>
        <?php echo "</form>"?>
        <?php $errors ; ?>
    </p>    
    </div>
	<br/>
