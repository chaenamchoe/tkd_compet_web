<script type="text/javascript">
	 function OnloadImg(url, img){
		window.location.href = url + '/welcome/request_image_view/' + img;
	 }
</script>

<div class="container">
	<br/>
	<div class="row">
		<div class="col-sm-5">
            <p><h3>참가신청서 업로드 안내</h3></p>
            <p>
                모든 출전 도장 또는 학교는 참가신청서를 제출해야 합니다.<br />
                첨부파일의 이미지 포멧은 *.jpg 형태로만 등록이 가능합니다.<br />
            </p>
            <p>
                참가선수 등록을 모두 마친 후에는 참가신청서 이미지파일을 만들어서 이곳에 업로드 하세요.<br />
                참가 신청서가 여러 파일인 경우에는 한번에 하나 씩 모든 파일을 첨부하셔야 합니다. 
            </p>
			<p><a href="<?php echo site_url('welcome/do_download') ?>" class="btn btn-primary">참가신청서 양식 다운로드 </a></p>
            <hr>
            <br />
            <form id="login-form" action=<?php echo site_url("compet/upload_request_image");?> method="post" enctype="multipart/form-data">
                <p>
                    <input id="subject_name" name="subject_name" class="form-control" type="text" placeholder="제목을 입력하세요." required><br />
                    <input id="file_name" name="file_name" class="form-control" type="file" required>
                </p>
                <p><input type='submit' name='submit' class='btn btn-primary' value='업로드 ' /></p>
            </form>    
        </div>
        <div class="col-sm-7">
			<p><h3>참가신청서 업로드 리스트</h3></p>
			<div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th style="text-align:center">No</th>
                            <th>등록일자</th>
                            <th>제목</th>
                            <th>파일명</th>
							<th style="text-align:center">삭제</th>
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
                        <a href=<?php echo site_url('welcome/delete_request_doc/'.$id)?> onclick="return confirm('정말 삭제할까요?')">삭제</a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
	<br/>
    </div>
    </div>
