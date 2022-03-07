<style>

/* Small devices (landscape phones, 544px and up) */
@media (max-width: 544px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  h4 {font-size:1rem;} /*1rem = 16px*/
}	
</style>
<script>
function _(el){
	return document.getElementById(el);
}
function uploadFile(id){
	var file = _("file1").files[0];
	var fileName = file.name;
	var ath_id = id;
	var file_ext = fileName.substring(fileName.lastIndexOf('.')+1);
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	var rootFolder = '/';
	var changedName = ath_id+"."+file_ext;
	formdata.append("file1", file);
	formdata.append("ath_id", changedName);
	_("vimeo_file").innerText = changedName;
	
	$.ajax({
		url: 'https://content.dropboxapi.com/2/files/upload',
		type: 'post',
		data: file,
		processData: false,
		contentType: 'application/octet-stream',
		headers: {
			"Authorization": "Bearer yTiWUG0ieRkAAAAAAAAAAdriKy7xzrUtKPPyE3223EddLDEV7kYJI7xBF-7g8PZv",
			"Dropbox-API-Arg": '{"path": "/'+changedName+'","mode": "add","autorename": true,"mute": false}'
		},
		success: function (data) {
			console.log(data);
			completeHandler(data);
		},
		xhr: function() {
			var xhr = new XMLHttpRequest();
			xhr.upload.addEventListener("progress", progressHandler, false);
			xhr.addEventListener("abort", abortHandler, false);
			return xhr;
		},
		error: function (data) {
			console.error(data);
			errorHandler();
		}
	});
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(data){
	var ath_id = document.getElementById("ath_id").innerText;
	var vimeo_file = data.name;
	// window.location.href = "<?php echo site_url()?>compet/save_athlete_video/"+ath_id+"/"+vimeo_file;
	window.location.href = "<?php echo site_url()?>compet/registed_athlete";
}
function errorHandler(){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>
<div class="container">
	<br/>
	<div class="row text-center">
		<div class="col col-sm-12">
			<!-- <h3><?php echo $_SESSION['login_user_center']?></h3> -->
			<h3>드롭박스 파일업로드 테스트</h3>
		</div>
		
	</div>
	<div class="row justify-content-center">
		<div class="col col-sm-5 text-center">
			<table class="table table-bordered">
			<tr>
				<td style="background-color:#e0ebeb">종목</td> 
				<!-- <td><h4><?=$jongmok?></h4></td> -->
				<td>종목...</td>
			</tr>	
			<tr>
				<td style="background-color:#e0ebeb">부별</td>
				<!-- <td><h4><?=$category?></h4></td> -->
				<td>카테고리...</td>
			</tr>	
			<tr>
				<td style="background-color:#e0ebeb">성명/ID</td>
				<!-- <td><h4><?=$ath_name?>/<?=$ath_id?></h4></td>	 -->
				<td>선수명/선수ID</td>	
			</tr>
			<tr>
				<td colspan="2" style="align-text-left">
				<b style="background-color:blue; color: white;">영상파일을 올리기 전에 확인하세요!!!</b><br><br>
				- 영상포멧이 <b style="color:red">1080p 또는 720p, 16:9</b>로 되었나요?<br>
				- 영상파일이 <b style="color:red">가로로 촬영</b>이 되었나요?<br>
				- 종목별로 <b style="color:red">영상의 갯수</b>가 맞게 촬영되었나요?<br>
				- 영상의 파일명은 변경하지 않아도 됩니다.<br>
				- 파일명은 자동으로 등록 선수의 ID로 됩니다.
				</td>
			</tr>
			</table>
		</div>
	</div>
	<hr>
	<div class="row text-center">
		<div class="col col-sm-12">
		<!--<div id="vimeo_file" style="display:none"></div>-->
		<form id="upload_form" enctype="multipart/form-data" method="post">
		  <div class="col col-sm-12">
		  <input type="file" name="file1" id="file1"> 
		  <input class="btn btn-primary" type="button" value="UPLOAD" onclick="uploadFile(1111)">
		</div> 
		<div class="col col-sm-12">
		  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
		  <h3 id="status"></h3>
		  <p id="loaded_n_total"></p>
		  <div id="vimeo_file" style="display:none"></div>
		  <div id="ath_id" style="display:none">1111</div>
		</div>  
		</form>
		</div>
	</div>

