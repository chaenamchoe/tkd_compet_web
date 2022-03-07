<style>
html, body{
	margin: 0;
	padding: 0;
}
.container{
	margin: 10px auto;
	display: grid;
	grid-template-columns: 1fr;
	align-content: center;
	justify-content: center;
}
.jongmok_main{
	width: 550px;
	display: grid;
	margin: 10px auto;
	grid-template-columns: 70px 1fr;
	justify-content: center;
}
.jongmok{
	border: 1px solid silver;
	text-align: center;
	grid-gab : 2px;
}
.caution{
	display: grid;
	margin: 5px;
	padding: 5px;
	justify-content: center;
}
.notice{
	display: grid;
	width: 550px;
	margin: 5px auto;
	border: 1px solid;
	border-radius: 10px;
	padding: 15px;
	justify-content: center;
	background-color: yellow;
}
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 544px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  h4 {font-size:1rem;} /*1rem = 16px*/
  .jongmok_main{
	width: 95%;
  }
  .notice{
	width: 95%;
  }
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
	formdata.append("file1", file);
	formdata.append("ath_id", ath_id+"."+file_ext);
	_("vimeo_file").innerText = ath_id+"."+file_ext;
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "http://ccnplaza.com/tkd_compet/file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = event.loaded+" / "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	document.getElementById("status").innerHTML = event.target.responseText;
	//_("progressBar").value = 0;
	var ath_id = document.getElementById("ath_id").innerText;
	var vimeo_file = document.getElementById("vimeo_file").innerText;
	window.location.href = "<?php echo site_url()?>compet/save_athlete_video/"+ath_id+"/"+vimeo_file;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>
<script src="https://cdn.tailwindcss.com"></script>
  <meta charset="EUC-KR">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<div>
	<div class="m-5 text-3xl text-center">
		<h1><?php echo $_SESSION['login_user_center']?></h1>
	</div>
	<div class="m-5 grid sm:grid-cols-2 content-center text-center">
		<div class="border border-gray-300 text-center text-lg bg-gray-200">종목</div>
		<div class="border border-gray-300 text-center text-lg "><?=$jongmok?></div>
		<div class="border border-gray-300 text-center text-lg bg-gray-200">부별</div>
		<div class="border border-gray-300 text-center text-lg "><?=$category?></div>
		<div class="border border-gray-300 text-center text-lg bg-gray-200">성명/ID</div>
		<div class="border border-gray-300 text-center text-lg "><?=$ath_name?>/<?=$ath_id?></div>
	</div>
	<div class="m-5 text-3xl text-center">
		<div style="background-color:red; color: white;"> 영상파일을 올리기 전에 꼭 확인하세요!!! </div>
	</div>	
	<div class="m-5 grid text-md text-center">
		<p>- 영상포멧이 <b style="color:red">1080p 또는 720p, 16:9</b>로 되었나요?<br></p>
		<p>- 영상파일이 <b style="color:red">가로로 촬영</b>이 되었나요?<br></p>
		<p>- 종목별로 <b style="color:red">영상의 갯수</b>가 맞게 촬영되었나요?<br></p>
		<p>- 영상의 파일명은 변경하지 않아도 됩니다.<br></p>
		<p>- 파일명은 자동으로 등록 선수의 ID로 됩니다.</p>
	</div>
	<form id="upload_form" enctype="multipart/form-data" method="post">
	<div class="grid grid-cols-1">
		<div class="m-5 text-md text-center">
		  <input type="file" name="file1" id="file1"
			class="w-full text-sm text-slate-500
			  file:mr-4 file:py-2 file:px-4
			  file:rounded-full file:border
			  file:text-sm file:font-semibold
			  file:bg-violet-50 file:text-violet-700
			  hover:file:bg-violet-100
			"/>
		  <!--<input type="file" name="file1" id="file1"> -->
		  <input class="bg-blue-300 hover:bg-blue-500 rounded-full border p-2" type="button" value="UPLOAD" onclick="uploadFile(<?=$ath_id?>)">
		</div> 
		<div class="m-5 text-md text-center">
		  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
		  <h3 id="status"></h3>
		  <p id="loaded_n_total"></p>
		  <div id="vimeo_file" style="display:none"></div>
		  <div id="ath_id" style="display:none"><?=$ath_id?></div>
		</div>  
	</div>	
	</form>
</div>
