<script type="text/javascript">
	 function OnloadImg(url, img){
		window.location.href = url + '/compet/request_image_view/' + img;
	 }
</script>

<div class="container">
	<br/>
	<div class="row">
		<div class="col-sm-5">
            <p><h3>���༭ ���ε� �ȳ�</h3></p>
            <p>
                ��� ���� ���� �Ǵ� �б��� ���༭�� �����ؾ� �մϴ�.<br />
                ��ȸ�䰭�� ���Ե� ���༭ �κ��� ����Ͽ� �ۼ��� �� ÷���ϼ���.<br />
                ÷�������� �̹��� ������ *.jpg, *.png ���·θ� ����� �����մϴ�.<br />
            </p>
            <p>
                ���༭ �̹��������� ����� �̰��� ���ε� �ϼ���.<br />
            </p>
            <form id="login-form" action=<?php echo site_url("compet/upload_request_suyaksu");?> method="post" enctype="multipart/form-data">
                <p>
                    <input id="file_name" name="file_name" class="form-control" type="file" required>
                </p>
                <p><input type='submit' name='submit' class='btn btn-primary' value='���ε� ' /></p>
            </form>    
        </div>
        <div class="col-sm-7">
			<p><h3>������û�� ���ε� ����Ʈ</h3></p>
			<div class="table-responsive">
				<?php
					$no = 0;
					foreach ($doc_info as $row):
						$no++;
						$id = $row['ID'];
						$d_date = $row['D_DATE'];
						$org_filename = $row['ORG_FILENAME'];
						$uniq_filename = $row['UNIQ_FILENAME'];
						if(isset($uniq_filename)){
							echo '<img src="http://ccnplaza.com/tkd_compet/uploads/'.$uniq_filename.'" width="auto" height="500px">';
						}else{
							echo '<p>��ϵ� �ڷ� ����...</p>';
						}	
					endforeach;
				?>
            </div>
		<br/>
		</div>
    </div>
