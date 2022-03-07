<script type="text/javascript">
    $(document).ready(function() {
		var uniq_no = Math.floor(+ new Date());
		$("#c_guid").val(uniq_no);
    });
	$('#area_name').keyup(function(){
		if ($(this).val().length > $(this).attr('maxlength')){
			alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); 
		} 
	});

	
</script>

<div class="container">
	<br>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5">단체(도장)등록</h1>
		  <hr class="my-4">
		  <p style="color:red; font-weight:bold">* 단체(도장)명은 중복될 수 없습니다. 소속협회에 등록된 단체명과 동일하게 입력하세요.
		  </p>
		</div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/add_center")?> method="post">
    <div class="row justify-content-center">
            <input id="c_guid" name="c_guid" type="hidden"/>
			<input type="hidden" id="ath_count" name="ath_count" value="1"/>
		<div class="col-sm-4">
            <p>
				<input id="center_name" name="center_name" class="form-control" type="text" placeholder="단체(도장)명을 입력하세요." required >
			</p>
            <p>
				<input id="c_name" name="c_name" class="form-control" type="text" placeholder="대표(담당)자명을 입력하세요." required >
			</p>
            <p>
				<input id="mobile" name="mobile" class="form-control" type="text" placeholder="휴대전화번호를 입력하세요." required>
			</p>
            <p>
				<input id="email" name="email" class="form-control" type="email" placeholder="이메일(로그인ID)입력" required>
			</p>
            <p>
				<input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="비밀번호를 입력하세요." required>
			</p>
            <p>
				<input id="area_name" name="area_name" class="form-control" type="text" maxlength="100" placeholder="도장주소(100자이내)" required>
			</p>
            <!--
			<p>
				<input id="recommander" name="recommander" class="form-control" type="text" placeholder="추천인">
			</p>
            <p>
				<input id="recommander_tel" name="recommander_tel" class="form-control" type="text" placeholder="추천인 전화번호">
			</p>
			-->
            <p>
				<select class="form-control" name="country" id="country" required>
					<option value="" selected="">국가(선택)</option>
					<?php 
					foreach($country as $row) {
						$id=$row['ID'];
						$country_name = $row['COUNTRY_NAME'];
						$country_code = $row['COUNTRY_ENG'];
						$country_mix = $country_name.'['.$country_code.']';
						?>	
					<option value="<?=$id?>"><?=$country_mix?></option>
					<?php } ?>
				</select>
			</p>
        </div> 
    </div>    
	<div class="row justify-content-center">
		<div class="col-sm-2">
		<button type="submit" class="btn btn-primary">자료저장</button>
		</div>
	</div>	
    </form>
	<br>
</div>