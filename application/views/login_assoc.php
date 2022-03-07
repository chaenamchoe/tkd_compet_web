<script>
	function myFunction() {
		var e = document.getElementById("assoc_id");
		var assoc = e.options[e.selectedIndex].value;
		if (assoc > 0) {
			window.location.href = "<?php echo site_url()?>compet/regist_center/"+assoc;
		}else{
			alert('소속협회를 먼저 선택하세요.');
			document.getElementById("assoc_id").focus();
		}
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5"><?php echo $_SESSION['assoc_name'] ?></h1>
		  <p class="lead">온라인 대회등록 사이트에 오신것을 환영합니다.</p>
		</div>
	</div>
    <form id="login-form" action=<?php echo site_url("compet/check_login")?> method="post">
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p style="color:red; font-weight:bold">등록한 이메일과 비밀번호로 로그인하세요.<br>
				비등록 도장(단체)은 신규등록을 먼저 하세요.</p>
            <p>
                <label>로그인아이디(이메일)를 입력하세요.</label>
                <input id="login_id" name="login_id" class="form-control" type="text" placeholder="이메일주소를 입력하세요." required>
            </p>
            <p>
                <label>비밀번호를 입력하세요.</label>
                <input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="비밀번호를 입력하세요." required>
            </p>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> 로그인 </button>
				<a href="#" onclick="myFunction();" class="btn btn-primary btn-mg">신규도장등록</a>
            </p>
        </div>    
    </div>    
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p style="color:red; font-weight:bold">크롬브라우저를 사용하여 입력하세요. IE를 사용하시면 정상적으로 입력이 안되는 불이익을 당할 수 있습니다.</p>
		</div>
	</div>	
    </form>
        