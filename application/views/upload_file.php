<script type="text/javascript">
	 function OnloadImg(url, img){
		window.location.href = url + '/welcome/request_image_view/' + img;
	 }
</script>

<div class="container">
	<br/>
	<div class="row">
		<div class="col-sm-5">
            <p><h3>������û�� ���ε� �ȳ�</h3></p>
            <p>
                ��� ���� ���� �Ǵ� �б��� ������û���� �����ؾ� �մϴ�.<br />
                ÷�������� �̹��� ������ *.jpg ���·θ� ����� �����մϴ�.<br />
            </p>
            <p>
                �������� ����� ��� ��ģ �Ŀ��� ������û�� �̹��������� ���� �̰��� ���ε� �ϼ���.<br />
                ���� ��û���� ���� ������ ��쿡�� �ѹ��� �ϳ� �� ��� ������ ÷���ϼž� �մϴ�. 
            </p>
			<p><a href="<?php echo site_url('welcome/do_download') ?>" class="btn btn-primary">������û�� ��� �ٿ�ε� </a></p>
            <hr>
            <br />
            <form id="login-form" action=<?php echo site_url("compet/upload_request_image");?> method="post" enctype="multipart/form-data">
                <p>
                    <input id="subject_name" name="subject_name" class="form-control" type="text" placeholder="������ �Է��ϼ���." required><br />
                    <input id="file_name" name="file_name" class="form-control" type="file" required>
                </p>
                <p><input type='submit' name='submit' class='btn btn-primary' value='���ε� ' /></p>
            </form>    
        </div>
        <div class="col-sm-7">
			<p><h3>������û�� ���ε� ����Ʈ</h3></p>
			<div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align:center">No</th>
                            <th>�������</th>
                            <th>����</th>
                            <th>���ϸ�</th>
							<th style="text-align:center">����</th>
                        </tr>
                    </thead>
                    <?php
                        $no = 0;
                        foreach ($doc_info as $row):
                            $no++;
                            $id = $row['ID'];
                            $doc_name = $row['DOC_NAME'];
                            $d_date = $row['D_DATE'];
                            $org_filename = $row['ORG_FILENAME'];
                            $uniq_filename = $row['UNIQ_FILENAME'];
                        ?>
                    <tr>
                      <td style="text-align:center"><?=$no?></td>
                      <td><?=$d_date ?></td>
                      <td><a href="javascript:OnloadImg('<?php echo site_url()?>','<?=$uniq_filename?>')"><?=$doc_name ?></a></td>
                      <td><?=$org_filename ?></td>
					  <td style="text-align:center; width:50px">
                        <a href=<?php echo site_url('welcome/delete_request_doc/'.$id)?> onclick="return confirm('���� �����ұ��?')">����</a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
	<br/>
    </div>
    </div>
