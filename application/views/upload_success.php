<div class="container">
	<br/>
	<div class="row">
		<p><h3>참가신청서 다운로드 안내</h3></p>
	</div>
	<br/>
	<div class="row">
        <p>
            모든 출전 도장 또는 학교는 참가신청서를 제출해야 합니다.<br />
            첨부파일의 이미지 포멧은 .JPG 형태로만 등록이 가능합니다.<br />
            참가신청서 업로드 파일을 만드는 방법은 2가지 방법중에서 하나를 선택하세요.<br />
        </p>
        <p>
        <ol>    
            <li><b><font style="color:blue">아래한글을 사용하는 방법</font></b></li>
                <ul>
                    <li>아래한글에서 다운로드 한 참가신청서 파일을 엽니다.</li>
                    <li>내용을 모두 입력하고 저장을 합니다.</li>
                    <li>아래한글 파일 메뉴에서 다른이름으로 저장하기를 선택한 후 파일명을 입력하고 </li>
                    <li>파일형식에서 JPG 이미지(*.jpg)를 선택하여 저장합니다.</li>
                    <li>저장된 jpg 이미지 파일을 찾아서 파일첨부를 하시면 등록이 완료됩니다.</li>
                </ul>    
            <li><b><font style="color:blue">수기로 작성 후 휴대폰으로 사진을 찍는 방법</font></b></li>
                <ul>    
                    <li>참가신청서의 내용을 모두 입력합니다.</li>
                    <li>디지털 카메라 또는 휴대폰에서 참가신청서를 잘 펼쳐놓고 사진을 찍습니다.</li>
                    <li>저장된 사진의 파일포멧을 확인하세요.(대부분 파일의 확장자는 *.jpg이나 아닌 경우도 있음)</li>
                    <li>만일 사진파일의 파일포멧이 jpg 형식이 아닐 경우에는 파일포멧 변환</li>
                    <li>알씨 등의 사진포멧 변환 툴을 이용하여 형식을 jpg로 변경 후 파일을 첨부</li>
                    <li>파일의</li>
                </ul>
        </ol>
        </p>
        <br />
	</div>
    <div class="row">
    <p><a href="http://ccnplaza.com/img/겨루기직인첨부용.hwp" class="btn btn-primary">참가신청서 다운로드 </a> &nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo form_open_multipart('welcome/upload_file');?>
        <?php echo "<input type='file' name='userfile' size='20' />"; ?>
        <?php echo "<input type='submit' name='submit' class='btn btn-primary' value='upload' /> ";?>
        <?php echo "</form>"?>
        <?php $errors ; ?>
    </p>    
    </div>
	<br/>
