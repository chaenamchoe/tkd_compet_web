<script type="text/javascript">
	function form_submit() {
		document.getElementById("ADD_Modal").submit();
	} ;
	$(document).ready(function() {
        $("#submit").click(function(event) {
            var pwd = $("#login_pass").val();
            var pwd1 = $("#login_pass2").val();
            if( pwd != pwd1 ) {
                $("#confirm").text("비밀번호확인 오류! 다시 입력하세요.");
                event.preventDefault();
            }
        });
    });
</script>

<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h4><?=$_SESSION['login_user_center'];?> 정보수정</h4>
        <hr>
        </div>
    </div>
    <?php  
        $center_id = $center_info->ID;
        $center_name = $center_info->CENTER_NAME;
		$center_chief = $center_info->C_NAME;
		$center_area = $center_info->ADDR1;
        $center_email = $center_info->EMAIL;
        $center_tel = $center_info->TEL;
		$center_mobile = $center_info->MOBILE;
		$center_pass = $center_info->LOGIN_PASS;
		$center_recommander = $center_info->RECOMMANDER;
		$center_recommander_tel = $center_info->RECOMMANDER_TEL;
		$center_country = $country_name;
    ?>
    <div class="row">
        <div class="col-sm-5">
            <p><h4>단체(도장)정보 <a href="#" data-toggle="modal" data-target="#EDIT_CENTER" class="btn btn-primary">수정</a></h4></p>
			<hr>
			<p>대표자 : <?=$center_chief?></p>
			<p>이메일 : <?=$center_email?></p>
			<p>주소 : <?=$center_area?></p>
			<p>전화 : <?=$center_mobile?></p>
			<p>추천인 : <?=$center_recommander?></p>
			<p>추천인연락처 : <?=$center_recommander_tel?></p>
			<p>국가 : <?=$center_country?></p>
			<hr>	
        </div>
        <div class="col-sm-7">    
			<p><h4>임원등록정보  <a href="#" data-toggle="modal" data-target="#ADD_Modal" class="btn btn-primary">임원추가등록</a></h4></p>		
            <table class="table table-sm" id="athlete">
			  <thead>
				<tr>
				  <th scope="col">임원명</th>
				  <th scope="col" width="80">직급</th>
				  <th scope="col" width="130">연락처</th>
				  <th scope="col">로그인ID(이메일)</th>
				  <!--<th scope="col" width="130">비밀번호</th>-->
				  <th scope="col">수정</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
                $no = 0;
				$u_id = 0;
				$u_name = '';
				$u_email = '';
				$u_pass = '';
				$u_tel =  '';
				$u_grade = '';
				if(count($user_info) > 0){
					foreach ($user_info as $row):
						$no++;
						$u_id = $row['ID'];
						$u_name = $row['U_NAME'];
						$u_email = $row['EMAIL'];
						$u_pass = $row['LOGIN_PASS'];
						$u_tel = $row['TEL'];
						$u_grade = $row['U_GRADE'];
					?>					
					<tr>
					<td><?=$u_name?></td>
					<td><?=$u_grade?></td>
					<td><?=$u_tel?></td>
					<td><?=$u_email?></td>
					<!--<td><?=$u_pass?></td>-->
					<td>
						<a href="#" data-toggle="modal" data-target="#EDIT_Modal<?php echo $u_id?>" class="btn btn-primary btn-sm">수정</a>
						<a href=<?php echo site_url('compet/delete_center_member/'.$u_id)?> onclick="return confirm('정말 삭제할까요?')" class="btn btn-primary btn-sm">삭제</a>
					</td>	
					</tr>

					<!-- Modal 신규등록 -->
					<div class="modal fade" id="ADD_Modal" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header text-center">
									<h4 class="modal-title">임원 신규등록</h4>
								</div>
								<form id="add_form" action=<?php echo site_url("compet/add_center_user/")?> method="post">
								<div class="modal-body">
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">임원명:</label>
										<div class="col-sm-9">
											<input name="u_name" class="form-control" type="text" required>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">감독/코치:</label>
										<div class="col-sm-9">
											<input name="u_grade" class="form-control" type="text" required>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">연락처:</label>
										<div class="col-sm-9">
											<input name="u_tel" class="form-control" type="text" required>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">이메일:</label>
										<div class="col-sm-9">
											<input name="u_email" class="form-control" type="email" required>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">비밀번호:</label>
										<div class="col-sm-9">
											<input name="u_pass" class="form-control" type="password" required>
										</div>
									</div>		
									<p>
									<input name="in_edit" class="form-control" type="hidden" value = 1>
									</p>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">저장</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
								</div>
								</form>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal 수정 -->
					<div class="modal fade" id="EDIT_Modal<?php echo $u_id ?>" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header text-center">
									<h4 class="modal-title">임원 수정</h4>
								</div>
								<form action=<?php echo site_url("compet/update_center_user/".$u_id)?> method="post">
								<div class="modal-body">
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">임원명:</label>
										<div class="col-sm-9">
											<input name="u_name" class="form-control" type="text" value=<?=$u_name?>>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">감독/코치:</label>
										<div class="col-sm-9">
											<input name="u_grade" class="form-control" type="text" value=<?=$u_grade?>>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">연락처:</label>
										<div class="col-sm-9">
											<input name="u_tel" class="form-control" type="text" value=<?=$u_tel?>>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">이메일:</label>
										<div class="col-sm-9">
											<input name="u_email" class="form-control" type="email" value=<?=$u_email?>>
										</div>
									</div>		
									<div class="form-group row">
										<label for="aname" class="col-sm-3 col-form-label text-right">비밀번호:</label>
										<div class="col-sm-9">
											<input name="u_pass" class="form-control" type="password" value=<?=$u_pass?>>
										</div>
									</div>
									<p>	
									<input name="in_edit" class="form-control" type="hidden" value = 2>
									</p>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">저장</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Modal End -->  


				<?php endforeach; }?>	
			  </tbody>
			</table>
			<p>
				<hr>
				
            </p>
			
        </div> 
    </div>    

	<!-- Modal 수정 -->
	<div class="modal fade" id="EDIT_CENTER" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">단체(도장) 정보수정</h4>
				</div>
				<form action=<?php echo site_url("compet/update_center/".$center_id)?> method="post">
				<div class="modal-body">
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">대표자:</label>
						<div class="col-sm-9">
							<input name="c_chief" class="form-control" type="text" value="<?=$center_chief?>">
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">이메일:</label>
						<div class="col-sm-9">
							<input name="c_email" class="form-control" type="email" value="<?=$center_email?>">
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">주소:</label>
						<div class="col-sm-9">
							<input name="c_area" class="form-control" type="text" value="<?=$center_area?>">
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">전화:</label>
						<div class="col-sm-9">
							<input name="c_mobile" class="form-control" type="text" value="<?=$center_mobile?>">
						</div>
					</div>		
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">비밀번호:</label>
						<div class="col-sm-9">
							<input name="c_pass" class="form-control" type="password" value="<?=$center_pass?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">추천인:</label>
						<div class="col-sm-9">
							<input name="recommander" class="form-control" type="text" value="<?=$center_recommander?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">추천인연락처:</label>
						<div class="col-sm-9">
							<input name="recommander_tel" class="form-control" type="text" value=<?=$center_recommander_tel?>>
						</div>
					</div>
					<div class="form-group row">
						<label for="aname" class="col-sm-3 col-form-label text-right">국가:</label>
						<div class="col-sm-9">
							<select class="form-control" name="country" id="country">
								<?php 
								foreach($country as $row) {
									$id=$row['ID'];
									$country_name = $row['COUNTRY_NAME'];
									$country_code = $row['COUNTRY_ENG'];
									$country_mix = $country_name.'['.$country_code.']';
									?>	
								<option <?php if($center_country == $id){echo "selected";} ?> value="<?=$id?>"><?=$country_mix?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<p>	
					<input name="in_edit" class="form-control" type="hidden" value = 2>
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">저장</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">닫기</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal End -->  
