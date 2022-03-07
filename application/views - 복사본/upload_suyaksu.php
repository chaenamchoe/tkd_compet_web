<script type="text/javascript">
	 function OnloadImg(url, img){
		window.location.href = url + '/compet/request_image_view/' + img;
	 }
</script>

<div class="container">
	<br/>
	<div class="row">
		<div class="col-sm-5">
            <p><h3>서약서 업로드 안내</h3></p>
            <p>
                모든 출전 도장 또는 학교는 서약서를 제출해야 합니다.<br />
                대회요강에 포함된 서약서 부분을 출력하여 작성한 후 첨부하세요.<br />
                첨부파일의 이미지 포멧은 *.jpg, *.png 형태로만 등록이 가능합니다.<br />
            </p>
            <p>
                서약서 이미지파일을 만들어 이곳에 업로드 하세요.<br />
            </p>
            <form id="login-form" action=<?php echo site_url("compet/upload_request_suyaksu");?> method="post" enctype="multipart/form-data">
                <p>
                    <input id="file_name" name="file_name" class="form-control" type="file" required>
                </p>
                <p><input type='submit' name='submit' class='btn btn-primary' value='업로드 ' /></p>
            </form>    
        </div>
        <div class="col-sm-7">
			<p><h3>참가신청서 업로드 리스트</h3></p>
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
							echo '<p>등록된 자료 없음...</p>';
						}	
					endforeach;
				?>
            </div>
		<br/>
		</div>
    </div>
