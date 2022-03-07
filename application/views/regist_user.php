<script type="text/javascript">
    $(document).ready(function() {
		var uniq_no = Math.floor(+ new Date());
		$("#c_guid").val(uniq_no);

		$('#add_ath').click(function(){
			var rowCount = $('#athlete tr').length;
			var uniq_no = Math.floor(+ new Date());
			$('#ath_count').val(rowCount);
			$("#athlete").append('<tr><th scope="row">'+rowCount+'</th>' + 
				'<td><input type="text" class="form-control" name="u_name'+ rowCount + '" required></input></td>' + 
				'<td><input type="text" class="form-control" name="u_grade'+ rowCount + '" required></input></td>' + 
				'<td><input type="text" class="form-control" name="u_email'+ rowCount + '" required></input></td>' + 
				'<td><input type="text" class="form-control" name="u_tel'+ rowCount + '" required></input></td>' + 
				'<td><input type="password" class="form-control" name="u_pass'+ rowCount + '" required></input></td></tr>');
		});
    });
</script>

<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h4><?=$_SESSION['login_user_center'];?>로그인 사용자 등록</h4>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/add_center_user")?> method="post">
    <div class="row">
        <div class="col-sm-3">
            <p><b>도장등록</b></p>
            <p><input id="c_guid" name="c_guid" type="hidden"></p>
			<input type="hidden" id="ath_count" name="ath_count" value="1"/>
            <p><input id="center_name" name="center_name" class="w3-input" type="text" placeholder="도장명을 입력하세요." required></p>
            <p><input id="area_name" name="area_name" class="w3-input" type="text" placeholder="지역명을 입력하세요." required></p>
            <p><input id="center_addr" name="center_addr" class="w3-input" type="text" placeholder="도장주소를 입력하세요." required></p>
            <p><input id="center_tel" name="center_tel" class="w3-input" type="text" placeholder="도장전화번호를 입력하세요." required></p>
        </div>
        <div class="col-sm-9"> 
			<p><b>임원등록</b></p>		
            <table class="table table-sm" id="athlete">
			  <thead>
				<tr>
				  <th scope="col" width="30px">#</th>
				  <th scope="col" width="200px">임원명</th>
				  <th scope="col" width="100px">직급</th>
				  <th scope="col" width="400px">이메일</th>
				  <th scope="col" width="300px">연락처</th>
				  <th scope="col" width="200px">비밀번호</th>
				</tr>
			  </thead>
			  <tbody>
					<tr>
					<th scope="row">1</th>
					<td><input type="text" class="form-control" id="u_name1" name="u_name1" required></input></td>
					<td><input type="text" class="form-control" id="u_grade1" name="u_grade1" required></input></td>
					<td><input type="text" class="form-control" id="u_email1" name="u_email1" required></input></td>
					<td><input type="text" class="form-control" id="u_tel1" name="u_tel1" required></input></td>
					<td><input type="password" class="form-control" id="u_pass1" name="u_pass1" required></input></td>
					</tr>
			  </tbody>
			</table>
			<p>
				<input type="button" id="add_ath" class="btn btn-primary" value="임원추가"></input>
                <button type="submit" class="btn btn-primary">자료저장</button>
            </p>
        </div> 
    </div>    
    </form>
